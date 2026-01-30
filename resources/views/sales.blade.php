@extends('layouts.app')

@section('content')
  <div class="max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-2xl font-bold">Sales / Attendance</h2>
      <div class="text-sm text-gray-400">Table of daily sales and attendance</div>
    </div>

    <div class="overflow-x-auto bg-transparent rounded">
      <table class="min-w-full divide-y divide-gray-700">
        <thead class="bg-[#071014]">
          <tr>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Date</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Product</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Quantity</th>
            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400">Status</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-800">
          <tr class="hover:bg-gray-900">
            <td class="px-4 py-3">2026-01-29</td>
            <td class="px-4 py-3">Drive Chain</td>
            <td class="px-4 py-3">2</td>
            <td class="px-4 py-3"><span class="text-green-400">Sold</span></td>
          </tr>
          <tr class="hover:bg-gray-900">
            <td class="px-4 py-3">2026-01-29</td>
            <td class="px-4 py-3">Brake Shoe Set</td>
            <td class="px-4 py-3">1</td>
            <td class="px-4 py-3"><span class="text-yellow-400">Pending</span></td>
          </tr>
          <tr class="hover:bg-gray-900">
            <td class="px-4 py-3">2026-01-28</td>
            <td class="px-4 py-3">Engine Gasket Set</td>
            <td class="px-4 py-3">1</td>
            <td class="px-4 py-3"><span class="text-red-400">Returned</span></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@endsection
