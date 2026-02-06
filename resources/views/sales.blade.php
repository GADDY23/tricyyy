@extends('layouts.app')

@section('content')
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Sales Analytics</h2>
      <div class="text-sm text-gray-400">Complete sales history and statistics</div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
      <div class="bg-gray-900 border border-gray-700 rounded-lg p-6">
        <div class="text-gray-400 text-sm mb-2">💰 Total Revenue</div>
        <div class="text-3xl font-bold text-green-400">₱{{ number_format($totalRevenue, 0) }}</div>
        <div class="text-xs text-gray-500 mt-2">All completed orders</div>
      </div>
      <div class="bg-gray-900 border border-gray-700 rounded-lg p-6">
        <div class="text-gray-400 text-sm mb-2">📦 Total Orders</div>
        <div class="text-3xl font-bold text-blue-400">{{ $totalOrders }}</div>
        <div class="text-xs text-gray-500 mt-2">Completed transactions</div>
      </div>
      <div class="bg-gray-900 border border-gray-700 rounded-lg p-6">
        <div class="text-gray-400 text-sm mb-2">📊 Items Sold</div>
        <div class="text-3xl font-bold text-yellow-400">{{ $totalItems }}</div>
        <div class="text-xs text-gray-500 mt-2">Total quantity sold</div>
      </div>
    </div>

    <!-- Sales Details Table -->
    @if($orders->isEmpty())
      <div class="bg-gray-900 rounded-lg p-8 text-center border border-gray-700">
        <p class="text-gray-400">No sales yet</p>
      </div>
    @else
      <div class="overflow-x-auto bg-transparent rounded">
        <table class="min-w-full divide-y divide-gray-700">
          <thead class="bg-[#071014]">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Order Date</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Order #</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Customer</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Items</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Revenue</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Payment</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800">
            @foreach($orders as $order)
              @php
                $itemCount = $order->items->sum('quantity');
              @endphp
              <tr class="hover:bg-gray-900">
                <td class="px-4 py-3 text-sm">{{ $order->created_at->format('M d, Y H:i') }}</td>
                <td class="px-4 py-3 font-semibold">{{ $order->order_number }}</td>
                <td class="px-4 py-3">{{ $order->customer_name }}</td>
                <td class="px-4 py-3 text-sm text-gray-400">{{ $itemCount }} item(s)</td>
                <td class="px-4 py-3 font-semibold text-green-400">₱{{ number_format($order->total, 0) }}</td>
                <td class="px-4 py-3 text-sm">{{ $order->payment_method }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif
  </div>
@endsection
