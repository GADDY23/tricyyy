<div class="bg-gray-50 rounded-lg border border-gray-200 p-4 flex flex-col shadow hover:shadow-md">
  <div class="h-40 bg-gray-50 rounded flex items-center justify-center text-5xl text-gray-700">{{ $product['icon_emoji'] ?? '🧩' }}</div>
  <div class="mt-3 flex-1">
    <h3 class="font-semibold text-sm text-black">{{ $product['name'] }}</h3>
    <div class="text-xs text-gray-600">{{ $product['fitment'] }}</div>
    <div class="mt-2 flex items-center justify-between">
      <div class="text-kawasaki font-bold">{{ $product['price_label'] }}</div>
      <div class="text-xs {{ $product['stock'] > 0 ? 'text-green-600' : 'text-red-600' }}">{{ $product['stock'] > 0 ? 'In stock' : 'Out of stock' }}</div>
    </div>
  </div>
  <div class="mt-3 flex gap-2">
    <form method="POST" action="{{ route('cart.add') }}" class="flex-1">
      @csrf
      <input type="hidden" name="action" value="buy">
      <input type="hidden" name="id" value="{{ $product['id'] }}">
      <button class="w-full px-3 py-2 bg-gray-800 text-white rounded text-sm font-semibold">Add to Cart</button>
    </form>
    <a href="{{ route('product.show', $product['id']) }}" class="px-3 py-2 border border-gray-300 rounded text-sm text-black">Details</a>
  </div>
</div>
