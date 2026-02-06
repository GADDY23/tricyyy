@extends('layouts.shop')

@section('content')
  <div class="max-w-3xl mx-auto">
    <!-- Receipt Header -->
    <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-lg border-2 border-green-200 p-8 mb-6">
      <div class="text-center mb-6">
        <div class="text-6xl mb-2">✓</div>
        <h1 class="text-4xl font-bold text-gray-900 mb-2">Order Confirmed!</h1>
        <p class="text-lg text-gray-600">Thank you for your purchase. Your order has been received.</p>
      </div>

      <div class="bg-white rounded-lg border border-gray-300 p-8 shadow-lg">
        <!-- Order Details -->
        <div class="grid grid-cols-2 gap-8 mb-8 border-b-2 border-gray-200 pb-8">
          <div>
            <div class="text-sm font-semibold text-gray-600 mb-1">📦 Order Number</div>
            <div class="text-2xl font-bold text-blue-600">{{ $order->order_number }}</div>
          </div>
          <div>
            <div class="text-sm font-semibold text-gray-600 mb-1">📅 Order Date</div>
            <div class="text-2xl font-bold text-gray-900">{{ $order->created_at->format('M d, Y H:i') }}</div>
          </div>
          <div>
            <div class="text-sm font-semibold text-gray-600 mb-1">✔️ Status</div>
            <div class="text-2xl font-bold text-green-600">{{ $order->status }}</div>
          </div>
          <div>
            <div class="text-sm font-semibold text-gray-600 mb-1">💳 Payment Method</div>
            <div class="text-2xl font-bold text-gray-900">{{ $order->payment_method }}</div>
          </div>
        </div>

        <!-- Customer Info -->
        <div class="mb-8 border-b-2 border-gray-200 pb-8">
          <h3 class="text-lg font-bold text-gray-900 mb-4">📍 Delivery Information</h3>
          <div class="bg-gray-50 rounded-lg p-4 text-sm space-y-2">
            <p><span class="font-semibold text-gray-900">Name:</span> {{ $order->customer_name }}</p>
            @if($order->customer_phone)
              <p><span class="font-semibold text-gray-900">Phone:</span> {{ $order->customer_phone }}</p>
            @endif
            @if($order->customer_email)
              <p><span class="font-semibold text-gray-900">Email:</span> {{ $order->customer_email }}</p>
            @endif
            @if($order->customer_address)
              <p><span class="font-semibold text-gray-900">Address:</span> {{ $order->customer_address }}</p>
            @endif
          </div>
        </div>

        <!-- Items -->
        <div class="mb-8 border-b-2 border-gray-200 pb-8">
          <h3 class="text-lg font-bold text-gray-900 mb-4">📦 Items Ordered</h3>
          <div class="space-y-4">
            @php $total = 0; @endphp
            @foreach($order->items as $item)
              @php $subtotal = $item->price * $item->quantity; $total += $subtotal; @endphp
              <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                <div>
                  <div class="font-bold text-gray-900">{{ $item->product_name }}</div>
                  <div class="text-sm text-gray-600">Qty: <strong>{{ $item->quantity }}</strong> × ₱{{ number_format($item->price, 0) }}</div>
                </div>
                <div class="text-right">
                  <div class="text-lg font-bold text-gray-900">₱{{ number_format($subtotal, 0) }}</div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Payment Summary -->
        <div class="bg-blue-50 rounded-lg p-6 mb-8 border border-blue-200">
          <div class="space-y-3">
            <div class="flex items-center justify-between text-lg">
              <span class="text-gray-700">Subtotal:</span>
              <span class="font-bold text-gray-900">₱{{ number_format($order->subtotal, 0) }}</span>
            </div>
            <div class="flex items-center justify-between text-lg border-b pb-3">
              <span class="text-gray-700">Shipping:</span>
              <span class="font-bold text-gray-900">₱{{ number_format($order->shipping, 0) }}</span>
            </div>
            <div class="flex items-center justify-between text-2xl font-bold">
              <span class="text-gray-900">Total Amount:</span>
              <span class="text-blue-600">₱{{ number_format($order->total, 0) }}</span>
            </div>
          </div>
        </div>

        <!-- Payment Info -->
        <div class="bg-yellow-50 rounded-lg p-6 border border-yellow-200 mb-8">
          <h4 class="font-bold text-gray-900 mb-3">📋 Next Steps</h4>
          @if($order->payment_method === 'Cash on Delivery')
            <p class="text-sm text-gray-700 mb-2">💵 Please prepare the exact amount of <strong>₱{{ number_format($order->total, 0) }}</strong> for payment upon delivery.</p>
            <p class="text-sm text-gray-700">Your order will be delivered within 3-5 business days.</p>
          @elseif($order->payment_method === 'Bank Transfer')
            <p class="text-sm text-gray-700 mb-2">🏦 Please transfer the amount to our bank account.</p>
            <p class="text-sm text-gray-700">Bank account details will be sent to your email shortly.</p>
          @elseif($order->payment_method === 'Online Payment')
            <p class="text-sm text-gray-700 mb-2">💳 A payment link will be sent to your email.</p>
            <p class="text-sm text-gray-700">Your order will be processed after payment confirmation.</p>
          @elseif($order->payment_method === 'Pickup Payment')
            <p class="text-sm text-gray-700 mb-2">🏪 Your order is ready for pickup at our store location.</p>
            <p class="text-sm text-gray-700 mb-2">Please pay <strong>₱{{ number_format($order->total, 0) }}</strong> when you pick up your order.</p>
            <p class="text-sm text-gray-700">Location: Near SM Angono, Along the Hi-way, Angono Rizal</p>
            <p class="text-sm text-gray-700 mt-2">Hours: Mon–Sat 8:00 AM — 6:00 PM</p>
          @endif
        </div>

        <!-- Confirmation Message -->
        <div class="text-center text-sm text-gray-600 p-4 bg-gray-50 rounded-lg">
          <p>✉️ A confirmation email has been sent to <strong>{{ $order->customer_email ?? 'your email' }}</strong></p>
        </div>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="flex gap-4 justify-center flex-wrap">
      <a href="{{ route('home') }}" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition">
        🏠 Continue Shopping
      </a>
      <button onclick="window.print()" class="px-8 py-3 border-2 border-gray-800 text-gray-800 rounded-lg font-bold hover:bg-gray-100 transition">
        🖨️ Print Receipt
      </button>
    </div>
  </div>

  <style>
    @media print {
      .hidden-print { display: none; }
      button { display: none; }
      a { display: none; }
    }
  </style>
@endsection
