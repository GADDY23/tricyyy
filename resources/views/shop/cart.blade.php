@extends('layouts.shop')

@section('content')
  <div class="bg-gray-50 rounded border border-gray-200 p-4">
    <h2 class="text-xl font-semibold text-black mb-4">Your Cart</h2>

    <form method="POST" action="{{ route('cart.update') }}">
      @csrf
      <table class="w-full text-sm text-black">
        <thead class="text-gray-600">
          <tr>
            <th class="text-left py-2">Product</th>
            <th class="text-left py-2">Price</th>
            <th class="text-left py-2">Quantity</th>
            <th class="text-left py-2">Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @php $total = 0; @endphp
          @forelse($cart as $id => $item)
            @php $subtotal = ($item['product']['price'] ?? 0) * $item['quantity']; $total += $subtotal; @endphp
            <tr class="border-t border-gray-100">
              <td class="py-3">
                <div class="font-semibold text-black">{{ $item['product']['name'] }}</div>
                <div class="text-xs text-gray-600">{{ $item['product']['fitment'] }}</div>
              </td>
              <td class="py-3">{{ $item['product']['price_label'] }}</td>
              <td class="py-3">
                <input type="number" name="quantity[{{ $item['product']['id'] }}]" value="{{ $item['quantity'] }}" min="0" class="w-20 border border-gray-200 bg-gray-50 text-black rounded px-2 py-1 text-sm">
              </td>
              <td class="py-3">₱{{ number_format($subtotal,0) }}</td>
              <td class="py-3">
                <a href="{{ route('cart.remove', $item['product']['id']) }}" class="text-red-600 text-sm">Remove</a>
              </td>
            </tr>
          @empty
            <tr><td colspan="5" class="py-6 text-center text-gray-600">Your cart is empty.</td></tr>
          @endforelse
        </tbody>
      </table>

      <div class="mt-4 flex items-center justify-between">
        <div>
          <button type="submit" class="px-4 py-2 bg-gray-100 text-black rounded">Update Cart</button>
        </div>
        <div class="text-right">
          <div class="text-sm text-gray-600">Total</div>
          <div class="text-2xl font-bold text-black">₱{{ number_format($total,0) }}</div>
          <a href="{{ route('checkout') }}" class="mt-3 px-4 py-2 bg-gray-800 text-white rounded inline-block">Proceed to Checkout</a>
        </div>
      </div>
    </form>
  </div>
@endsection
