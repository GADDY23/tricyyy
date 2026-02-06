@extends('layouts.shop')

@section('content')
  <div class="mb-4">
    <h1 class="text-3xl font-bold mb-2">Shop Kawasaki Barako Parts</h1>
    <p class="text-gray-600">Premium parts and accessories for your Kawasaki Barako 175 tricycle</p>
  </div>

  <!-- Search and Filters -->
  <div class="mb-6 bg-white p-4 rounded-lg shadow-sm">
    <form method="GET" action="{{ route('home') }}" class="flex flex-col sm:flex-row gap-4">
      <div class="flex-1">
        <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Search parts..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
      </div>
      <div>
        <select name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
          <option value="">All Categories</option>
          <option value="Electrical Parts" {{ $category === 'Electrical Parts' ? 'selected' : '' }}>Electrical Parts</option>
          <option value="Engine Parts" {{ $category === 'Engine Parts' ? 'selected' : '' }}>Engine Parts</option>
          <option value="Drivetrain" {{ $category === 'Drivetrain' ? 'selected' : '' }}>Drivetrain</option>
          <option value="Tricycle Accessories" {{ $category === 'Tricycle Accessories' ? 'selected' : '' }}>Tricycle Accessories</option>
          <option value="Brake System" {{ $category === 'Brake System' ? 'selected' : '' }}>Brake System</option>
          <option value="Suspension" {{ $category === 'Suspension' ? 'selected' : '' }}>Suspension</option>
          <option value="Tires & Wheels" {{ $category === 'Tires & Wheels' ? 'selected' : '' }}>Tires & Wheels</option>
          <option value="Fuel System" {{ $category === 'Fuel System' ? 'selected' : '' }}>Fuel System</option>
          <option value="Tools & Maintenance" {{ $category === 'Tools & Maintenance' ? 'selected' : '' }}>Tools & Maintenance</option>
        </select>
      </div>
      <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
        Search
      </button>
      @if($q || $category)
        <a href="{{ route('home') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
          Clear
        </a>
      @endif
    </form>
  </div>

  @if($products->count() == 0)
    <div class="text-center py-12">
      <p class="text-gray-600 text-lg">No products found. Try adjusting your search.</p>
    </div>
  @else
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
      @foreach($products as $product)
        <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition overflow-hidden">
          <div class="p-4 border-b border-gray-200">
            <div class="flex items-start justify-between mb-2">
              <div class="text-4xl">{{ $product->icon }}</div>
              @if(!$product->isAvailable())
                <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">{{ $product->getAvailabilityMessage() }}</span>
              @elseif($product->stock < 5 && $product->stock > 0)
                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-semibold rounded-full">{{ $product->getAvailabilityMessage() }}</span>
              @else
                <span class="px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">{{ $product->getAvailabilityMessage() }}</span>
              @endif
            </div>
            <h3 class="font-bold text-lg text-gray-900">{{ $product->name }}</h3>
            <p class="text-xs text-gray-500 mt-1">{{ $product->category }}</p>
          </div>
          <div class="p-4">
            <div class="text-sm text-gray-600 mb-2">
              <span class="font-semibold text-gray-900">Condition:</span> {{ $product->condition }}<br>
              <span class="font-semibold text-gray-900">Fitment:</span> {{ $product->fitment }}
            </div>
            <p class="text-sm text-gray-700 mb-3">{{ $product->details }}</p>
            <div class="flex items-center justify-between">
              <div class="text-2xl font-bold text-blue-600">₱{{ number_format($product->price, 0) }}</div>
            </div>
          </div>
          <div class="p-4 bg-gray-50 border-t border-gray-200 flex gap-2">
            @if($product->isAvailable())
              <a href="{{ route('product.show', $product->id) }}" class="flex-1 px-3 py-2 bg-blue-600 text-white text-sm font-semibold rounded hover:bg-blue-700 transition text-center">
                View & Buy
              </a>
            @else
              <button disabled class="flex-1 px-3 py-2 bg-gray-400 text-white text-sm font-semibold rounded cursor-not-allowed text-center">
                Unavailable
              </button>
            @endif
            <a href="{{ route('product.show', $product->id) }}" class="flex-1 px-3 py-2 bg-gray-300 text-gray-700 text-sm font-semibold rounded hover:bg-gray-400 transition text-center">
              Details
            </a>
          </div>
        </div>
      @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-8">
      {{ $products->links() }}
    </div>
  @endif
@endsection
