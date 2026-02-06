@extends('layouts.shop')

@section('content')
  <div class="bg-white rounded-lg shadow-md p-6">
    <h2 class="text-3xl font-bold text-gray-900 mb-6">🛒 Your Shopping Cart</h2>

    @if(session('error'))
      <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
        <p class="text-red-800 font-semibold">⚠️ {{ session('error') }}</p>
      </div>
    @endif

    @if(session('success'))
      <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
        <p class="text-green-800 font-semibold">✓ {{ session('success') }}</p>
      </div>
    @endif

    @forelse($cart as $id => $item)
      @php
        $product = $item['product'];
        $subtotal = $product['price'] * $item['quantity'];
      @endphp
      <div class="mb-4">
        <div class="cart-item"></div>
      </div>
    @empty
    @endforelse

    <form method="POST" action="{{ route('cart.update') }}" class="mb-6">
      @csrf
      <div class="overflow-x-auto">
        <table class="w-full text-sm">
          <thead class="bg-gray-100 border-b-2 border-gray-300">
            <tr>
              <th class="text-left py-3 px-4 font-semibold text-gray-900">Product</th>
              <th class="text-left py-3 px-4 font-semibold text-gray-900">Price</th>
              <th class="text-center py-3 px-4 font-semibold text-gray-900">Quantity</th>
              <th class="text-right py-3 px-4 font-semibold text-gray-900">Subtotal</th>
              <th class="text-center py-3 px-4"></th>
            </tr>
          </thead>
          <tbody>
            @php $total = 0; @endphp
            @forelse($cart as $id => $item)
              @php 
                $product = $item['product'];
                $subtotal = $product['price'] * $item['quantity'];
                $total += $subtotal;
              @endphp
              <tr class="border-b border-gray-200 hover:bg-gray-50">
                <td class="py-4 px-4">
                  <div class="flex items-start gap-3">
                    <div class="text-2xl">{{ $product['icon'] }}</div>
                    <div>
                      <a href="{{ route('product.show', $product['id']) }}" class="font-semibold text-gray-900 hover:text-blue-600">{{ $product['name'] }}</a>
                      <p class="text-xs text-gray-500 mt-1">{{ $product['fitment'] }}</p>
                    </div>
                  </div>
                </td>
                <td class="py-4 px-4 text-gray-900 font-semibold">₱{{ number_format($product['price'], 0) }}</td>
                <td class="py-4 px-4 text-center">
                  <input type="number" name="quantity[{{ $id }}]" value="{{ $item['quantity'] }}" min="0" max="{{ $product['stock'] }}" class="w-20 border border-gray-300 rounded px-2 py-1 text-center text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                </td>
                <td class="py-4 px-4 text-right font-semibold text-gray-900">₱{{ number_format($subtotal, 0) }}</td>
                <td class="py-4 px-4 text-center">
                  <a href="{{ route('cart.remove', $id) }}" class="text-red-600 hover:text-red-800 font-semibold text-sm">Remove</a>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="py-12 text-center">
                  <p class="text-gray-600 text-lg mb-4">Your cart is empty</p>
                  <a href="{{ route('home') }}" class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Continue Shopping
                  </a>
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      @if(!empty($cart))
        <div class="mt-6 flex gap-4">
          <button type="submit" class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition font-semibold">
            Update Cart
          </button>
          <a href="{{ route('home') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-semibold">
            Continue Shopping
          </a>
        </div>
      @endif
    </form>

    @if(!empty($cart))
      <div class="bg-gray-50 rounded-lg p-6 border border-gray-200">
        <div class="flex justify-between items-center mb-4 border-b pb-4">
          <span class="text-gray-700">Subtotal:</span>
          <span class="text-lg font-semibold text-gray-900">₱{{ number_format($total, 0) }}</span>
        </div>
        <div class="flex justify-between items-center mb-6 border-b pb-4">
          <span class="text-gray-700">Shipping:</span>
          <span class="text-lg font-semibold text-gray-900">₱0</span>
        </div>
        <div class="flex justify-between items-center mb-6">
          <span class="text-lg font-bold text-gray-900">Total:</span>
          <span class="text-3xl font-bold text-blue-600">₱{{ number_format($total, 0) }}</span>
        </div>
        <a href="{{ route('checkout') }}" class="w-full block text-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-bold text-lg">
          Proceed to Checkout →
        </a>
      </div>
    @endif
  </div>
@endsection
