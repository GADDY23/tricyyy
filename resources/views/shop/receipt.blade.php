@extends('layouts.shop')

@section('content')
  <div class="max-w-2xl mx-auto">
    <!-- Receipt Header -->
    <div class="bg-gray-50 rounded border border-gray-200 p-8 mb-6">
      <div class="text-center mb-6">
        <div class="text-4xl font-bold text-gray-800 mb-2">✓</div>
        <h1 class="text-3xl font-bold">Order Confirmed</h1>
        <p class="text-gray-600 mt-1">Thank you for your purchase!</p>
      </div>

      <div class="bg-white rounded border border-gray-300 p-6">
        <!-- Order Details -->
        <div class="grid grid-cols-2 gap-6 mb-6 border-b border-gray-200 pb-6">
          <div>
            <div class="text-sm text-gray-600">Order Number</div>
            <div class="text-xl font-bold">{{ $order['order_id'] }}</div>
          </div>
          <div>
            <div class="text-sm text-gray-600">Order Date</div>
            <div class="text-xl font-bold">{{ $order['date'] }}</div>
          </div>
          <div>
            <div class="text-sm text-gray-600">Status</div>
            <div class="text-xl font-bold text-green-600">{{ $order['status'] }}</div>
          </div>
          <div>
            <div class="text-sm text-gray-600">Payment Method</div>
            <div class="text-xl font-bold">{{ $order['payment_method'] }}</div>
          </div>
        </div>

        <!-- Customer Info -->
        <div class="mb-6 border-b border-gray-200 pb-6">
          <h3 class="font-semibold mb-3">Shipping To</h3>
          <div class="text-sm">
            <p class="font-medium">{{ $order['customer_name'] }}</p>
            <p class="text-gray-600">{{ $order['customer_phone'] }}</p>
            @if($order['customer_email'])
              <p class="text-gray-600">{{ $order['customer_email'] }}</p>
            @endif
          </div>
        </div>

        <!-- Items -->
        <div class="mb-6 border-b border-gray-200 pb-6">
          <h3 class="font-semibold mb-3">Items Ordered</h3>
          <div class="space-y-3">
            @php $total = 0; @endphp
            @foreach($order['items'] as $item)
              @php $subtotal = ($item['product']['price'] ?? 0) * $item['quantity']; $total += $subtotal; @endphp
              <div class="flex items-center justify-between text-sm">
                <div>
                  <div class="font-medium">{{ $item['product']['name'] }}</div>
                  <div class="text-gray-600">Qty: {{ $item['quantity'] }} × ₱{{ number_format($item['product']['price'], 0) }}</div>
                </div>
                <div class="text-right font-semibold">₱{{ number_format($subtotal, 0) }}</div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Payment Summary -->
        <div class="space-y-2 mb-6">
          <div class="flex items-center justify-between">
            <span class="text-gray-600">Subtotal</span>
            <span>₱{{ number_format($order['subtotal'], 0) }}</span>
          </div>
          <div class="flex items-center justify-between">
            <span class="text-gray-600">Shipping</span>
            <span>₱{{ number_format($order['shipping'], 0) }}</span>
          </div>
          <div class="border-t border-gray-300 pt-3 flex items-center justify-between text-lg font-bold">
            <span>Total Amount</span>
            <span>₱{{ number_format($order['total'], 0) }}</span>
          </div>
        </div>

        <!-- Payment Info -->
        <div class="bg-gray-100 rounded p-4 mb-6">
          <h4 class="font-semibold mb-2">Payment Instructions</h4>
          @if($order['payment_method'] === 'Cash on Delivery')
            <p class="text-sm text-gray-700">Please prepare the exact amount of ₱{{ number_format($order['total'], 0) }} for payment upon delivery.</p>
          @elseif($order['payment_method'] === 'Bank Transfer')
            <p class="text-sm text-gray-700">Please transfer to our bank account. Details will be sent via email.</p>
          @elseif($order['payment_method'] === 'Online Payment')
            <p class="text-sm text-gray-700">A payment link will be sent to your email shortly.</p>
          @elseif($order['payment_method'] === 'Check')
            <p class="text-sm text-gray-700">Please send your check to our office. Details will be provided via email.</p>
          @endif
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-3 justify-center">
      <a href="{{ route('home') }}" class="px-6 py-2 bg-gray-800 text-white rounded">Continue Shopping</a>
      <button onclick="window.print()" class="px-6 py-2 border border-gray-800 text-gray-800 rounded">Print Receipt</button>
    </div>
  </div>

  <style>
    @media print {
      .hidden-print { display: none; }
      button { display: none; }
    }
  </style>
@endsection
