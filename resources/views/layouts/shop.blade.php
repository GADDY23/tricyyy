<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barako Parts Shop</title>
    <script>
      tailwind.config = { theme: { extend: { colors: { kawasaki: '#0b6e3b' } } } };
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="min-h-screen bg-gray-400 text-black font-sans">
    <header class="bg-black border-b border-gray-500 sticky top-0 z-50">
      <div class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-4">
        <button id="mobile-menu-btn" class="sm:hidden p-2 rounded-md bg-gray-100">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-kawasaki" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="/images/shop/logo.jpg" alt="TRI Motoshop & Services" class="h-10">
          <div class="hidden sm:block">
            <div class="font-semibold text-white">TRI MOTOSHOP</div>
            <div class="text-xs text-white">Motorparts • Kawasaki Compatible</div>
          </div>
        </a>

        <form method="GET" action="{{ route('home') }}" class="flex-1">
          <div class="relative">
            <input name="q" value="{{ $q ?? '' }}" placeholder="Search parts, e.g., carburetor, chain" class="w-full border border-gray-200 bg-gray-50 text-black rounded-full py-2 px-4 pl-10 text-sm focus:outline-none focus:ring-2 focus:ring-kawasaki">
            <div class="absolute left-3 top-1/2 -translate-y-1/2 text-kawasaki">🔎</div>
          </div>
        </form>

        <nav class="hidden sm:flex items-center gap-4">
          <a href="#" class="text-sm text-white">Categories</a>
          <a href="{{ route('company-profile') }}" class="text-sm text-white">About Us</a>
          <a href="{{ route('services') }}" class="text-sm text-white">Services</a>
          <a href="#" class="text-sm text-white">Help</a>
        </nav>

        <div class="ml-2">
          <?php $cart = session('cart', []); $count = array_sum(array_map(function($c){return $c['quantity'];}, $cart)); ?>
          <a href="{{ route('cart') }}" class="relative inline-flex items-center gap-2 px-3 py-1 rounded-md bg-gray-100 border border-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-kawasaki" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9h14l-2-9M9 21h6"/></svg>
            <span class="text-sm font-medium text-black">Cart</span>
            <span class="ml-1 inline-flex items-center justify-center px-2 py-0.5 text-xs font-semibold bg-kawasaki text-black rounded">{{ $count }}</span>
          </a>
        </div>
      </div>

      <!-- Category nav -->
      <div class="bg-gray-900 border-t border-gray-200">
        <div class="max-w-6xl mx-auto px-4 py-3 flex gap-3 overflow-x-auto">
          <a href="{{ route('home') }}" class="text-sm px-3 py-1 rounded {{ empty($category) ? 'bg-kawasaki text-black' : 'text-black' }}">All</a>
          @foreach(['Engine Parts','Electrical Parts','Tires & Wheels','Brakes','Tricycle Accessories'] as $cat)
            <a href="{{ route('home', ['category' => $cat]) }}" class="text-sm px-3 py-1 rounded {{ (isset($category) && strtolower($category)===strtolower($cat)) ? 'bg-kawasaki text-black' : 'text-white' }}">{{ $cat }}</a>
          @endforeach
        </div>
      </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-6">
      @yield('content')
    </main>

    <footer class="bg-white border-t mt-8">
      <div class="max-w-6xl mx-auto px-4 py-4 text-sm text-gray-600 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div class="text-gray-800">
          <div class="font-semibold">Shop Location & Schedule</div>
          <div class="text-sm">Near SM Angono, Along the Hi-way,Angono Rizal</div>
          <div class="text-sm mt-1">Hours: Mon–Sat 8:00 AM — 6:00 PM</div>
          <div class="text-sm mt-1">Contact: <a href="tel:+639-075-952311" class="text-kawasaki font-medium">+63 917 123 4567</a> </div>
        </div>

        <div class="hidden sm:block text-gray-600">Secure Checkout | Barako-Ready Parts | Fast Service</div>

        <div class="text-gray-400 sm:text-right">© {{ date('Y') }} Barako Parts Shop</div>
      </div>
    </footer>

    <script>
      const mobileBtn = document.getElementById('mobile-menu-btn');
      mobileBtn && mobileBtn.addEventListener('click', () => {
        document.body.classList.toggle('overflow-hidden');
        const m = document.getElementById('mobile-menu');
        if (m) m.classList.toggle('hidden');
      });
    </script>
  </body>
</html>
