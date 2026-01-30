@extends('layouts.shop')

@section('content')
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 bg-gray-50 rounded border border-gray-200 p-4">
      <div class="h-96 bg-gray-50 rounded flex items-center justify-center text-6xl text-gray-700">{{ ['tools'=>'🧰','tyre'=>'🛞','wrench'=>'🔧','carb'=>'🪩','battery'=>'🔌','key'=>'🔋','filter'=>'🧼','lever'=>'🚀'][$product['icon']] ?? '🧩' }}</div>
      <div class="mt-4">
        <h1 class="text-xl font-bold text-black">{{ $product['name'] }}</h1>
        <div class="text-sm text-gray-600">Compatible: {{ $product['fitment'] }}</div>
        <p class="mt-3 text-gray-700">{{ $product['details'] }}</p>
      </div>
    </div>

    <aside class="bg-gray-50 rounded border border-gray-200 p-4">
      <div class="text-kawasaki font-bold text-2xl">{{ $product['price_label'] }}</div>
      <div class="text-sm text-gray-600 mt-1">Stock: {{ $product['stock'] }}</div>

      <form method="POST" action="{{ route('cart.add') }}" class="mt-4">
        @csrf
        <input type="hidden" name="action" value="buy">
        <input type="hidden" name="id" value="{{ $product['id'] }}">
        <div class="flex items-center gap-2">
          <label class="text-sm text-black">Qty</label>
          <input type="number" name="quantity" value="1" min="1" max="{{ $product['stock'] }}" class="w-20 border border-gray-200 bg-gray-50 text-black rounded px-2 py-1 text-sm">
        </div>
        <button class="mt-4 w-full bg-gray-800 text-white py-2 rounded">Add to Cart</button>
      </form>
    </aside>
  </div>
@endsection
