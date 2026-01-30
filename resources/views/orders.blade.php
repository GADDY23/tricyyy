@extends('layouts.app')

@section('content')
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Orders</h2>
      <div class="text-sm text-gray-400">Customer purchases</div>
    </div>

    <div class="overflow-x-auto bg-transparent rounded">
      <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-[#071014]">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Order #</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Customer</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Total</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
          <tr class="hover:bg-gray-900">
            <td class="px-4 py-3">#1001</td>
            <td class="px-4 py-3">Juan Dela Cruz</td>
            <td class="px-4 py-3">₱2,300</td>
            <td class="px-4 py-3"><span class="text-green-400">Completed</span></td>
          </tr>
          <tr class="hover:bg-gray-900">
            <td class="px-4 py-3">#1002</td>
            <td class="px-4 py-3">Maria Santos</td>
            <td class="px-4 py-3">₱850</td>
            <td class="px-4 py-3"><span class="text-yellow-400">Pending</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
