@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Products Inventory</h2>
      <div class="text-sm text-gray-400">{{ $products->count() }} total products</div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($products as $product)
        <div class="bg-gray-900 border border-gray-700 rounded-lg p-4 hover:border-blue-500 transition">
          <div class="flex items-start gap-3 mb-4">
            <div class="text-4xl">{{ $product->icon }}</div>
            <div class="flex-1">
              <h3 class="font-bold text-lg text-white">{{ $product->name }}</h3>
              <div class="text-xs text-gray-400 mt-1">{{ $product->category }}</div>
            </div>
          </div>

          <div class="mb-4 border-t border-gray-700 pt-4">
            <div class="text-sm text-gray-400 mb-2">
              <span class="font-semibold text-gray-300">Condition:</span> {{ $product->condition }}<br>
              <span class="font-semibold text-gray-300">Fitment:</span> {{ $product->fitment }}
            </div>
            <p class="text-sm text-gray-300 mb-4">{{ $product->details }}</p>
          </div>

          <div class="flex items-center justify-between mb-4">
            <div>
              <div class="text-2xl font-bold text-green-400">₱{{ number_format($product->price, 0) }}</div>
              <div class="text-xs text-gray-400 mt-1">Stock: <span class="font-semibold text-white">{{ $product->stock }}</span></div>
            </div>
            <div class="text-right">
              @if($product->isAvailable())
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-green-900 border border-green-600 rounded-full">
                  <span class="w-2 h-2 bg-green-400 rounded-full"></span>
                  <span class="text-xs font-semibold text-green-400">Available</span>
                </div>
              @else
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-red-900 border border-red-600 rounded-full">
                  <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                  <span class="text-xs font-semibold text-red-400">Unavailable</span>
                </div>
              @endif
            </div>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
      {{ $products->links() }}
    </div>
  </div>
@endsection
