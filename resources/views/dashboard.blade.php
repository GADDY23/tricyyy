@extends('layouts.app')

@section('content')
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Dashboard</h2>
      <div class="text-sm text-gray-400">Welcome to Barako Motorparts</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
      <div class="p-4 bg-gray-800 rounded">
        <div class="text-sm text-gray-400">Total Parts</div>
        <div class="text-2xl font-semibold">128</div>
      </div>
      <div class="p-4 bg-gray-800 rounded">
        <div class="text-sm text-gray-400">Active Orders</div>
        <div class="text-2xl font-semibold text-yellow-400">12</div>
      </div>
      <div class="p-4 bg-gray-800 rounded">
        <div class="text-sm text-gray-400">Sales Today</div>
        <div class="text-2xl font-semibold text-green-400">₱5,430</div>
      </div>
    </div>
  </div>
@endsection
