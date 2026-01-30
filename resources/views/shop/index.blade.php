@extends('layouts.shop')

@section('content')
  <div class="mb-4 flex items-center justify-between">
    <h1 class="text-2xl font-semibold">Shop Kawasaki Barako Parts</h1>
    <div class="text-sm text-gray-500">Showing {{ count($products) }} results</div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($products as $p)
      @php
        // small emoji mapping for display
        $emojiMap = ['tools'=>'🧰','tyre'=>'🛞','wrench'=>'🔧','carb'=>'🪩','battery'=>'🔌','key'=>'🔋','filter'=>'🧼','lever'=>'🚀'];
        $p['icon_emoji'] = $emojiMap[$p['icon']] ?? '🧩';
      @endphp
      <div>
        @include('components.product-card', ['product' => $p])
      </div>
    @endforeach
  </div>
@endsection
