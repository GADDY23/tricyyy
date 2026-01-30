@extends('layouts.app')

@section('content')
  <div class="max-w-6xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Products</h2>
      <div class="text-sm text-gray-400">Select parts for your Kawasaki Barako</div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($products as $p)
        <div class="bg-gradient-to-br from-gray-900 to-[#071018] p-4 rounded-lg border border-gray-800 hover:shadow-lg">
          <div class="flex items-start gap-3">
            <div class="text-3xl">{{ $p['icon'] }}</div>
            <div class="flex-1">
              <h3 class="font-semibold text-lg">{{ $p['name'] }}</h3>
              <div class="text-xs text-gray-400 mt-1">Condition: <span class="text-gray-200">{{ $p['condition'] }}</span></div>
              <div class="text-xs text-gray-400">Fitment: <span class="text-gray-200">{{ $p['fitment'] }}</span></div>
              <div class="text-sm text-kawasaki font-semibold mt-2">{{ $p['price'] }}</div>
              <p class="text-sm text-gray-300 mt-2">{{ $p['details'] }}</p>
            </div>
          </div>
          <div class="mt-4 flex items-center justify-between">
            <a href="#" class="px-3 py-1 bg-kawasaki text-black rounded hover:brightness-95">Buy Now</a>
            <a href="#" class="text-sm text-gray-400 hover:underline">More details</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
