@extends('layouts.shop')

@section('content')
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Product Image & Details -->
    <div class="lg:col-span-2 bg-white rounded-lg shadow-md p-6">
      <div class="h-96 bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg flex items-center justify-center text-8xl mb-6">
        {{ $product->icon }}
      </div>
      <div>
        <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
        <div class="flex items-center gap-4 mt-2">
          <span class="text-sm text-gray-600">Category: <strong>{{ $product->category }}</strong></span>
          <span class="text-sm text-gray-600">Condition: <strong>{{ $product->condition }}</strong></span>
        </div>
        <div class="text-sm text-gray-600 mt-2">Compatible with: <strong>{{ $product->fitment }}</strong></div>
        
        @if(!$product->isAvailable())
          <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-lg">
            <p class="text-red-800 font-semibold">⚠️ {{ $product->getAvailabilityMessage() }}</p>
            <p class="text-red-700 text-sm mt-1">This item is currently not available for purchase.</p>
          </div>
        @elseif($product->stock < 5)
          <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <p class="text-yellow-800 font-semibold">⚡ {{ $product->getAvailabilityMessage() }}</p>
            <p class="text-yellow-700 text-sm mt-1">Hurry! Limited stock available.</p>
          </div>
        @endif

        <div class="mt-6 prose prose-sm max-w-none">
          <h3 class="text-lg font-semibold text-gray-900">Product Details</h3>
          <p class="text-gray-700">{{ $product->details }}</p>
        </div>
      </div>
    </div>

    <!-- Sidebar - Price & Purchase -->
    <aside class="bg-white rounded-lg shadow-md p-6 h-fit sticky top-20">
      <div class="mb-4">
        <div class="text-sm text-gray-600">Price</div>
        <div class="text-4xl font-bold text-blue-600">₱{{ number_format($product->price, 0) }}</div>
      </div>

      <div class="mb-6 p-3 bg-gray-50 rounded-lg">
        <div class="text-sm font-semibold text-gray-900">Stock Status</div>
        @if($product->isAvailable())
          <div class="flex items-center gap-2 mt-1">
            <span class="w-3 h-3 bg-green-500 rounded-full"></span>
            <span class="text-sm text-gray-700">{{ $product->stock }} in stock</span>
          </div>
        @else
          <div class="flex items-center gap-2 mt-1">
            <span class="w-3 h-3 bg-red-500 rounded-full"></span>
            <span class="text-sm text-red-600 font-semibold">{{ $product->getAvailabilityMessage() }}</span>
          </div>
        @endif
      </div>

      @if($product->isAvailable())
        <form method="POST" action="{{ route('cart.add') }}" class="mb-4">
          @csrf
          <input type="hidden" name="id" value="{{ $product->id }}">
          <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Quantity</label>
            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
            🛒 Add to Cart
          </button>
        </form>
      @else
        <button disabled class="w-full bg-gray-400 text-white py-3 rounded-lg font-semibold cursor-not-allowed mb-4">
          Item Unavailable
        </button>
      @endif

      <a href="{{ route('home') }}" class="w-full block text-center px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold">
        ← Continue Shopping
      </a>

      <!-- Product Info Box -->
      <div class="mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
        <h4 class="font-semibold text-gray-900 mb-2">📋 Quick Info</h4>
        <ul class="text-sm text-gray-700 space-y-1">
          <li>✓ Genuine Kawasaki parts</li>
          <li>✓ Fast delivery available</li>
          <li>✓ Money-back guarantee</li>
          <li>✓ Expert support</li>
        </ul>
      </div>
    </aside>
  </div>
@endsection
