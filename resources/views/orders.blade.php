@extends('layouts.app')

@section('content')
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Orders</h2>
      <div class="text-sm text-gray-400">Customer purchases and orders history</div>
    </div>

    @if($orders->isEmpty())
      <div class="bg-gray-900 rounded-lg p-8 text-center">
        <p class="text-gray-400">No orders yet</p>
      </div>
    @else
      <div class="overflow-x-auto bg-transparent rounded">
        <table class="min-w-full divide-y divide-gray-700">
          <thead class="bg-[#071014]">
            <tr>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Order #</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Customer</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Items</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Total</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Payment</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Status</th>
              <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Date</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-800">
            @foreach($orders as $order)
              <tr class="hover:bg-gray-900">
                <td class="px-4 py-3 font-semibold">{{ $order->order_number }}</td>
                <td class="px-4 py-3">{{ $order->customer_name }}</td>
                <td class="px-4 py-3 text-sm text-gray-400">{{ $order->items->count() }} item(s)</td>
                <td class="px-4 py-3 font-semibold">₱{{ number_format($order->total, 0) }}</td>
                <td class="px-4 py-3 text-sm">{{ $order->payment_method }}</td>
                <td class="px-4 py-3">
                  @if($order->status === 'Completed')
                    <span class="text-green-400 font-semibold">✓ {{ $order->status }}</span>
                  @elseif($order->status === 'Pending')
                    <span class="text-yellow-400 font-semibold">⏳ {{ $order->status }}</span>
                  @elseif($order->status === 'Cancelled')
                    <span class="text-red-400 font-semibold">✗ {{ $order->status }}</span>
                  @else
                    <span class="text-blue-400 font-semibold">{{ $order->status }}</span>
                  @endif
                </td>
                <td class="px-4 py-3 text-sm text-gray-400">{{ $order->created_at->format('M d, Y H:i') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      <div class="mt-6">
        {{ $orders->links() }}
      </div>
    @endif
  </div>
@endsection
