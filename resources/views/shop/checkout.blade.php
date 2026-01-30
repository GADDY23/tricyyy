@extends('layouts.shop')

@section('content')
  <div class="max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6">Checkout</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Order Summary -->
      <div class="lg:col-span-2 bg-gray-50 rounded border border-gray-200 p-6">
        <h3 class="text-lg font-semibold mb-4">Order Summary</h3>
        <div class="divide-y divide-gray-200">
          @php $total = 0; @endphp
          @foreach($cart as $item)
            @php $subtotal = ($item['product']['price'] ?? 0) * $item['quantity']; $total += $subtotal; @endphp
            <div class="py-3 flex items-center justify-between">
              <div>
                <div class="font-semibold">{{ $item['product']['name'] }}</div>
                <div class="text-sm text-gray-600">Qty: {{ $item['quantity'] }}</div>
              </div>
              <div class="text-right">
                <div class="font-semibold">₱{{ number_format($subtotal, 0) }}</div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="mt-6 border-t border-gray-300 pt-4">
          <div class="flex items-center justify-between mb-2">
            <span class="text-gray-600">Subtotal</span>
            <span>₱{{ number_format($total, 0) }}</span>
          </div>
          <div class="flex items-center justify-between mb-4">
            <span class="text-gray-600">Shipping</span>
            <span>₱0</span>
          </div>
          <div class="flex items-center justify-between text-lg font-bold">
            <span>Total</span>
            <span>₱{{ number_format($total, 0) }}</span>
          </div>
        </div>
      </div>

      <!-- Payment & Customer Info -->
      <div class="bg-gray-50 rounded border border-gray-200 p-6">
        <h3 class="text-lg font-semibold mb-4">Payment & Shipping</h3>

        <form method="POST" action="{{ route('checkout.process') }}" class="space-y-4">
          @csrf

          <!-- Customer Info -->
          <div>
            <label class="block text-sm font-medium mb-1">Full Name</label>
            <input type="text" name="customer_name" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-white">
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="customer_email" class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-white">
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Phone Number</label>
            <input type="tel" name="customer_phone" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-white">
          </div>

          <div>
            <label class="block text-sm font-medium mb-1">Address</label>
            <textarea name="customer_address" rows="3" required class="w-full border border-gray-300 rounded px-3 py-2 text-sm bg-white"></textarea>
          </div>

          <!-- Payment Method -->
          <div>
            <label class="block text-sm font-medium mb-2">Payment Method</label>
            <div class="space-y-2">
              <label class="flex items-center">
                <input type="radio" name="payment_method" value="Cash on Delivery" checked class="mr-2">
                <span class="text-sm">Cash on Delivery (COD)</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="payment_method" value="Bank Transfer" class="mr-2">
                <span class="text-sm">Pickup Payment</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="payment_method" value="Online Payment" class="mr-2">
                <span class="text-sm">Online Payment (GCash/PayMaya)</span>
              </label>
              <label class="flex items-center">
                <input type="radio" name="payment_method" value="Check" class="mr-2">
                <span class="text-sm">Pickup Online Payment</span>
              </label>
            </div>
          </div>

          <!-- Buttons -->
          <div class="flex gap-2 pt-4">
            <a href="{{ route('cart') }}" class="flex-1 px-4 py-2 border border-gray-300 rounded text-center">Back to Cart</a>
            <button type="submit" class="flex-1 px-4 py-2 bg-gray-800 text-white rounded">Place Order</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
