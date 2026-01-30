<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BarakoController extends Controller
{
    // central product list
    private function productsList()
    {
        return [
            1 => [
                'id' => 1,
                'icon' => 'tools',
                'name' => 'Kawasaki Barako 175 Stator (Charging Unit)',
                'category' => 'Electrical Parts',
                'condition' => 'New',
                'fitment' => 'Kawasaki Barako 175',
                'price' => 720,
                'price_label' => '₱720',
                'stock' => 12,
                'details' => 'OEM fit stator for charging system. Great for replacing worn electrical units.'
            ],
            2 => [
                'id' => 2,
                'icon' => 'tyre',
                'name' => 'Kawasaki Barako 175 Sprocket 48T',
                'category' => 'Tricycle Accessories',
                'condition' => 'New',
                'fitment' => 'Kawasaki Barako BC‑175',
                'price' => 270,
                'price_label' => '₱270',
                'stock' => 34,
                'details' => 'Genuine sprocket with proper tooth count. Perfect for drive train replacement.'
            ],
            3 => [
                'id' => 3,
                'icon' => 'wrench',
                'name' => 'Kawasaki Barako BC175 Clutch Lining',
                'category' => 'Engine Parts',
                'condition' => 'New',
                'fitment' => 'BC‑175',
                'price' => 500,
                'price_label' => '₱500',
                'stock' => 8,
                'details' => 'Quality clutch lining — ideal for smoother gear engagement.'
            ],
            4 => [
                'id' => 4,
                'icon' => 'carb',
                'name' => 'Kawasaki Barako 175 Carburetor Assembly',
                'category' => 'Engine Parts',
                'condition' => 'New',
                'fitment' => 'Barako 175',
                'price' => 1250,
                'price_label' => '₱1,250',
                'stock' => 5,
                'details' => 'Durable carburetor — top choice for rebuilds or replacements.'
            ],
            5 => [
                'id' => 5,
                'icon' => 'battery',
                'name' => 'Rectifier / Regulator for Barako 175',
                'category' => 'Electrical Parts',
                'condition' => 'New',
                'fitment' => 'Kawasaki Barako 175',
                'price' => 225,
                'price_label' => '₱225',
                'stock' => 20,
                'details' => 'Keeps battery charging stable — essential electrical replacement.'
            ],
            6 => [
                'id' => 6,
                'icon' => 'key',
                'name' => 'Kawasaki Barako 175 Ignition Switch',
                'category' => 'Electrical Parts',
                'condition' => 'New',
                'fitment' => 'Barako 175',
                'price' => 200,
                'price_label' => '₱150–₱250',
                'stock' => 15,
                'details' => 'Genuine replacement ignition switch — high demand part.'
            ],
            7 => [
                'id' => 7,
                'icon' => 'filter',
                'name' => 'Air Filter Element (Genuine)',
                'category' => 'Engine Parts',
                'condition' => 'New',
                'fitment' => 'Barako B1/B2',
                'price' => 100,
                'price_label' => '₱80–₱120',
                'stock' => 40,
                'details' => 'OEM Kawasaki air filter — keeps engine clean and efficient.'
            ],
            8 => [
                'id' => 8,
                'icon' => 'lever',
                'name' => 'Brake & Clutch Pair Levers (Stock)',
                'category' => 'Tricycle Accessories',
                'condition' => 'New',
                'fitment' => 'Barako 175',
                'price' => 58,
                'price_label' => '₱58 per piece',
                'stock' => 120,
                'details' => 'Standard handle levers — essential wear parts.'
            ],
        ];
    }

    // Home / product listing
    public function index(Request $request)
    {
        $all = $this->productsList();

        // search
        $q = $request->query('q');
        if ($q) {
            $all = array_filter($all, function ($p) use ($q) {
                return stripos($p['name'], $q) !== false || stripos($p['details'], $q) !== false;
            });
        }

        // category filter
        $category = $request->query('category');
        if ($category) {
            $all = array_filter($all, function ($p) use ($category) {
                return strtolower($p['category']) === strtolower($category);
            });
        }

        // simple pagination-ish: keep as array
        return view('shop.index', ['products' => $all, 'q' => $q, 'category' => $category]);
    }

    // single product
    public function show($id)
    {
        $all = $this->productsList();
        if (!isset($all[$id])) {
            abort(404);
        }
        $product = $all[$id];
        return view('shop.show', compact('product'));
    }

    // add to cart (session based)
    public function addToCart(Request $request)
    {
        $id = (int) $request->input('id');
        $qty = max(1, (int) $request->input('quantity', 1));
        $products = $this->productsList();
        if (!isset($products[$id])) return redirect()->back();

        $cart = Session::get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'product' => $products[$id],
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
            $id = (int)$id; $qty = max(0, (int)$qty);
            if ($qty === 0) {
                unset($cart[$id]);
            } else {
                if (isset($cart[$id])) $cart[$id]['quantity'] = $qty;
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

        // Create order data
        $order = [
            'order_id' => 'ORD-' . strtoupper(uniqid()),
            'date' => now()->format('Y-m-d H:i:s'),
            'customer_name' => $customerName,
            'customer_email' => $customerEmail,
            'customer_phone' => $customerPhone,
            'customer_address' => $customerAddress,
            'items' => $cart,
            'payment_method' => $paymentMethod,
            'subtotal' => $total,
            'shipping' => 0,
            'total' => $total,
            'status' => 'Completed',
        ];

        Session::put('last_order', $order);
        Session::forget('cart');

        return redirect()->route('receipt');
    }

    // Display receipt
    public function receipt()
    {
        $order = Session::get('last_order');
        if (!$order) {
            return redirect()->route('home');
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
        // legacy admin products view — show full list
        $products = $this->productsList();
        return view('products', ['products' => $products]);
    }

    public function categories()
    {
        return view('categories');
    }

    public function orders()
    {
        return view('orders');
    }

    public function sales()
    {
        return view('sales');
    }
}
