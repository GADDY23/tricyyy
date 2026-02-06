@extends('layouts.shop')

@section('content')
  <div class="max-w-4xl mx-auto">
    <h2 class="text-4xl font-bold mb-8 text-gray-900">Checkout</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Order Summary -->
      <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h3 class="text-xl font-bold mb-6 text-gray-900">📋 Order Summary</h3>
        
        <div class="space-y-4 mb-6">
          @php $total = 0; @endphp
          @foreach($cart as $id => $item)
            @php 
              $product = $item['product'];
              $subtotal = $product['price'] * $item['quantity'];
              $total += $subtotal;
            @endphp
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
              <div class="flex-1">
                <div class="flex items-center gap-3">
                  <div class="text-3xl">{{ $product['icon'] }}</div>
                  <div>
                    <div class="font-bold text-gray-900">{{ $product['name'] }}</div>
                    <div class="text-sm text-gray-600">Qty: <strong>{{ $item['quantity'] }}</strong></div>
                  </div>
                </div>
              </div>
              <div class="text-right">
                <div class="font-bold text-gray-900">₱{{ number_format($subtotal, 0) }}</div>
                <div class="text-xs text-gray-500">₱{{ number_format($product['price'], 0) }} each</div>
              </div>
            </div>
          @endforeach
        </div>

        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
          <div class="flex justify-between items-center mb-3 pb-3 border-b-2 border-blue-200">
            <span class="text-gray-700">Subtotal:</span>
            <span class="text-lg font-bold text-gray-900">₱{{ number_format($total, 0) }}</span>
          </div>
          <div class="flex justify-between items-center mb-3 pb-3 border-b-2 border-blue-200">
            <span class="text-gray-700">Shipping:</span>
            <span class="text-lg font-bold text-gray-900">₱0</span>
          </div>
          <div class="flex justify-between items-center">
            <span class="text-xl font-bold text-gray-900">Total:</span>
            <span class="text-3xl font-bold text-blue-600">₱{{ number_format($total, 0) }}</span>
          </div>
        </div>
      </div>

      <!-- Payment & Customer Info -->
      <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 h-fit">
        <h3 class="text-xl font-bold mb-6 text-gray-900">💳 Payment & Delivery</h3>

        <form method="POST" action="{{ route('checkout.process') }}" class="space-y-5">
          @csrf

          <!-- Customer Info -->
          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-2">👤 Full Name</label>
            <input type="text" name="customer_name" required placeholder="Juan Dela Cruz" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-2">📧 Email</label>
            <input type="email" name="customer_email" placeholder="email@example.com" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-2">📱 Phone Number</label>
            <input type="tel" name="customer_phone" required placeholder="+63 9xxxxxxxxx" class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-900 mb-2">📍 Delivery Address</label>
            <textarea name="customer_address" rows="3" required placeholder="Enter your complete address..." class="w-full border border-gray-300 rounded-lg px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white resize-none"></textarea>
          </div>

          <!-- Payment Method -->
          <div class="border-t pt-5">
            <label class="block text-sm font-semibold text-gray-900 mb-3">Payment Method:</label>
            <div class="space-y-3">
              <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                <input type="radio" name="payment_method" value="Cash on Delivery" checked class="w-4 h-4 text-blue-600">
                <span class="ml-3 text-sm font-medium text-gray-900">💵 Cash on Delivery (COD)</span>
              </label>
              <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                <input type="radio" name="payment_method" value="Bank Transfer" class="w-4 h-4 text-blue-600">
                <span class="ml-3 text-sm font-medium text-gray-900">🏦 Bank Transfer</span>
              </label>
              <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                <input type="radio" name="payment_method" value="Online Payment" class="w-4 h-4 text-blue-600">
                <span class="ml-3 text-sm font-medium text-gray-900">💳 GCash/PayMaya</span>
              </label>
              <label class="flex items-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 transition">
                <input type="radio" name="payment_method" value="Pickup Payment" class="w-4 h-4 text-blue-600">
                <span class="ml-3 text-sm font-medium text-gray-900">🏪 Pickup Payment</span>
              </label>
            </div>
          </div>

          <!-- Buttons -->
          <div class="flex gap-3 pt-4 border-t">
            <a href="{{ route('cart') }}" class="flex-1 px-4 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-center">
              ← Back
            </a>
            <button type="submit" class="flex-1 px-4 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">
              Place Order →
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
