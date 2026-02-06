<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;


class BarakoController extends Controller
{
    // Home / product listing
    public function index(Request $request)
    {
        $query = Product::query();

        // search
        $q = $request->query('q');
        if ($q) {
            $query->where(function ($builder) use ($q) {
                $builder->where('name', 'like', "%$q%")
                    ->orWhere('details', 'like', "%$q%");
            });
        }

        // category filter
        $category = $request->query('category');
        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->paginate(12);
        return view('shop.index', ['products' => $products, 'q' => $q, 'category' => $category]);
    }

    // single product
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('shop.show', compact('product'));
    }

    // add to cart (session based)
    public function addToCart(Request $request)
    {
        $id = (int) $request->input('id');
        $qty = max(1, (int) $request->input('quantity', 1));
        
        $product = Product::findOrFail($id);

        // Check availability
        if (!$product->isAvailable()) {
            return redirect()->back()->with('error', 'This item is ' . $product->getAvailabilityMessage());
        }

        // Check stock
        if ($product->stock < $qty) {
            return redirect()->back()->with('error', 'Not enough stock. Only ' . $product->stock . ' available.');
        }

        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            // Check if adding more would exceed available stock
            if ($cart[$id]['quantity'] + $qty > $product->stock) {
                return redirect()->back()->with('error', 'Cannot add more items than available stock.');
            }
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'product' => $product,
                'quantity' => $qty,
            ];
        }
        Session::put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Added to cart');
    }

    public function cart()
    {
        $cart = Session::get('cart', []);
        return view('shop.cart', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $updates = $request->input('quantity', []);
        $cart = Session::get('cart', []);
        foreach ($updates as $id => $qty) {
            $id = (int)$id;
            $qty = max(0, (int)$qty);
            
            if ($qty === 0) {
                unset($cart[$id]);
            } else {
                if (isset($cart[$id])) {
                    // Verify product still has stock
                    $product = Product::find($id);
                    if ($product && $qty > $product->stock) {
                        continue; // Skip this update if stock exceeded
                    }
                    $cart[$id]['quantity'] = $qty;
                }
            }
        }
        Session::put('cart', $cart);
        return redirect()->route('cart')->with('success', 'Cart updated');
    }

    public function removeFromCart($id)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$id])) unset($cart[$id]);
        Session::put('cart', $cart);
        return redirect()->route('cart');
    }

    // Checkout - payment method selection
    public function checkout()
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Cart is empty');
        }
        return view('shop.checkout', compact('cart'));
    }

    // Process payment
    public function processPayment(Request $request)
    {
        $cart = Session::get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart');
        }

        $paymentMethod = $request->input('payment_method');
        $customerName = $request->input('customer_name', 'Guest');
        $customerEmail = $request->input('customer_email', '');
        $customerPhone = $request->input('customer_phone', '');
        $customerAddress = $request->input('customer_address', '');

        // Calculate total
        $total = 0;
        foreach ($cart as $item) {
            $total += ($item['product']['price'] ?? 0) * $item['quantity'];
        }

        // Create order in database
        $order = Order::create([
            'order_number' => 'ORD-' . strtoupper(uniqid()),
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'customer_address' => $customerAddress,
            'subtotal' => $total,
            'shipping' => 0,
            'total' => $total,
            'payment_method' => $paymentMethod,
            'status' => 'Completed',
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']['id'],
                'product_name' => $item['product']['name'],
                'price' => $item['product']['price'],
                'quantity' => $item['quantity'],
            ]);

            // Deduct stock
            $product = Product::find($item['product']['id']);
            if ($product) {
                $product->stock -= $item['quantity'];
                $product->save();
            }
        }

        Session::put('last_order', $order);
        Session::forget('cart');

        return redirect()->route('receipt');
    }

    // Display receipt
    public function receipt()
    {
        $order = Session::get('last_order');
        if ($order && $order instanceof Order) {
            // Reload from database to ensure relationships are loaded
            $order = Order::with('items')->find($order->id);
        } else {
            $orderId = request()->query('order_id');
            if ($orderId) {
                $order = Order::with('items')->find($orderId);
            }
            if (!$order) {
                return redirect()->route('home');
            }
        }
        return view('shop.receipt', compact('order'));
    }

    // keep existing admin/dashboard pages
    public function dashboard()
    {
        return view('dashboard');
    }

    public function products()
    {
        // admin products view
        $products = Product::paginate(20);
        return view('products', ['products' => $products]);
    }

    public function categories()
    {
        return view('categories');
    }

    public function orders()
    {
        $orders = Order::latest()->paginate(20);
        return view('orders', ['orders' => $orders]);
    }

    public function sales()
    {
        $orders = Order::where('status', 'Completed')->latest()->get();
        $totalRevenue = $orders->sum('total');
        $totalOrders = $orders->count();
        $totalItems = $orders->sum(function($order) {
            return $order->items->sum('quantity');
        });
        
        return view('sales', compact('orders', 'totalRevenue', 'totalOrders', 'totalItems'));
    }
    
    public function companyProfile()
    {
        return view('company-profile');
    }
}
