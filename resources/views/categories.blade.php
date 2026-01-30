@extends('layouts.app')

@section('content')
  <div class="max-w-4xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Categories</h2>
      <div class="text-sm text-gray-400">Parts grouped by type</div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
      <div class="p-4 bg-gray-800 rounded">Engine Parts</div>
      <div class="p-4 bg-gray-800 rounded">Chains</div>
      <div class="p-4 bg-gray-800 rounded">Tires</div>
      <div class="p-4 bg-gray-800 rounded">Brakes</div>
    </div>
  </div>
@endsection
