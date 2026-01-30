<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Barako Motorparts System</title>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              kawasaki: '#0b6e3b',
              garage: '#1f2937'
            }
          }
        }
      }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="min-h-screen bg-[#0f1720] text-gray-200 antialiased">
    <!-- Header -->
    <header class="flex items-center justify-between bg-[#0b0f11] border-b border-black-800 px-4 py-3">
      <div class="flex items-center gap-3">
        <button id="mobile-menu-btn" class="sm:hidden p-2 rounded-md bg-black-800 hover:bg-gray-700">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
        <h1 class="font-semibold text-lg text-gray-100 hidden sm:block">Barako Motorparts System</h1>
      </div>
      <div class="flex items-center gap-4">
        <div class="text-sm text-gray-400 hidden sm:block">Industrial • Garage UI</div>
        <div class="px-3 py-1 rounded bg-gray-800 text-green-300 text-xs">System Online</div>
      </div>
    </header>

    <div class="flex">
      <!-- Sidebar (Desktop) -->
      <aside id="sidebar" class="hidden sm:block w-64 h-[calc(100vh-64px)] bg-[#0b1112] border-r border-gray-800 text-sm">
        <div class="p-4 border-b border-gray-800">
          <div class="text-gray-300 font-bold">Barako Dashboard</div>
          <div class="text-xs text-gray-500">Kawasaki Theme</div>
        </div>
        <nav class="p-3 space-y-1">
          <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-kawasaki' : '' }}">
            <span class="w-2 h-2 bg-kawasaki rounded-full"></span>
            Dashboard
          </a>
          <a href="{{ route('products') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('products') ? 'bg-gray-900 text-kawasaki' : '' }}">
            <span class="w-2 h-2 bg-green-600 rounded-full"></span>
            Products
          </a>
          <a href="{{ route('categories') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('categories') ? 'bg-gray-900 text-kawasaki' : '' }}">
            <span class="w-2 h-2 bg-red-600 rounded-full"></span>
            Categories
          </a>
          <a href="{{ route('orders') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('orders') ? 'bg-gray-900 text-kawasaki' : '' }}">
            <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
            Orders
          </a>
          <a href="{{ route('sales') }}" class="flex items-center gap-3 px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('sales') ? 'bg-gray-900 text-kawasaki' : '' }}">
            <span class="w-2 h-2 bg-kawasaki rounded-full"></span>
            Sales / Attendance
          </a>
        </nav>
        <div class="p-4 mt-auto text-xs text-gray-500">
          <div>Battery: Good</div>
          <div>Engine: Ready</div>
        </div>
      </aside>

      <!-- Mobile Sidebar (hidden by default) -->
      <div id="mobile-sidebar" class="fixed inset-y-0 left-0 z-40 w-64 transform -translate-x-full transition-transform bg-[#0b1112] border-r border-gray-800 sm:hidden">
        <div class="p-4 border-b border-gray-800">
          <div class="text-gray-300 font-bold">Barako Menu</div>
        </div>
        <nav class="p-3 space-y-1">
          <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('dashboard') ? 'bg-gray-900 text-kawasaki' : '' }}">Dashboard</a>
          <a href="{{ route('products') }}" class="block px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('products') ? 'bg-gray-900 text-kawasaki' : '' }}">Products</a>
          <a href="{{ route('categories') }}" class="block px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('categories') ? 'bg-gray-900 text-kawasaki' : '' }}">Categories</a>
          <a href="{{ route('orders') }}" class="block px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('orders') ? 'bg-gray-900 text-kawasaki' : '' }}">Orders</a>
          <a href="{{ route('sales') }}" class="block px-3 py-2 rounded hover:bg-gray-800 {{ request()->routeIs('sales') ? 'bg-gray-900 text-kawasaki' : '' }}">Sales / Attendance</a>
        </nav>
      </div>

      <!-- Main Content -->
      <main class="flex-1 p-6 pb-24">
        @yield('content')
      </main>
    </div>

    <!-- Sticky Footer -->
    <footer class="fixed bottom-0 left-0 w-full bg-[#0b0f11] border-t border-gray-800 text-xs text-gray-300">
      <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between">
        <div class="flex items-center gap-4">
          <div class="px-2 py-1 bg-gray-800 rounded">Engine Ready</div>
          <div class="px-2 py-1 bg-gray-800 rounded">Parts In Stock</div>
        </div>
        <div class="text-green-400">System Online</div>
      </div>
    </footer>

    <script>
      const mobileBtn = document.getElementById('mobile-menu-btn');
      const mobileSidebar = document.getElementById('mobile-sidebar');
      mobileBtn && mobileBtn.addEventListener('click', () => {
        if (mobileSidebar.classList.contains('-translate-x-full')) {
          mobileSidebar.classList.remove('-translate-x-full');
          mobileSidebar.classList.add('translate-x-0');
        } else {
          mobileSidebar.classList.add('-translate-x-full');
          mobileSidebar.classList.remove('translate-x-0');
        }
      });
      // close when clicking outside (mobile)
      document.addEventListener('click', (e) => {
        if (!mobileSidebar || !mobileBtn) return;
        if (!mobileSidebar.contains(e.target) && !mobileBtn.contains(e.target)) {
          if (!mobileSidebar.classList.contains('-translate-x-full')) {
            mobileSidebar.classList.add('-translate-x-full');
            mobileSidebar.classList.remove('translate-x-0');
          }
        }
      });
    </script>
  </body>
</html>
