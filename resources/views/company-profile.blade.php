@extends('layouts.app')

@section('content')
  <div class="max-w-4xl mx-auto">
    <!-- Company Logo & Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white rounded-lg shadow-lg p-8 mb-8">
      <div class="flex items-center justify-center flex-col">
        <div class="mb-6">
          <img src="/images/shop/logo.jpg" alt="TRI MOTOSHOP & SERVICES" class="h-48 w-48 rounded-lg shadow-md">
        </div>
        <div class="text-center">
          <h1 class="text-4xl font-bold mb-2">TRI MOTOSHOP & SERVICES</h1>
          <p class="text-xl text-blue-100">Your One-Stop Shop for Motorcycle & Tricycle Parts and Services</p>
        </div>
      </div>
    </div>

    <!-- Company Overview -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-l-4 border-blue-600">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">📍 Company Overview</h2>
      <p class="text-gray-700 mb-4 leading-relaxed">
        TRI MOTOSHOP & SERVICES is a community-based motorshop located near SM Angono, along the highway in Angono, Rizal. We specialize in the sale of motorcycle and tricycle spare parts, accessories, and basic mechanical services.
      </p>
      <p class="text-gray-700 leading-relaxed">
        Built with the goal of supporting everyday riders and hardworking tricycle drivers, our shop focuses on affordable pricing, reliable products, and honest service. We offer both OEM (Original) and aftermarket parts, giving customers the freedom to choose what best fits their needs and budget.
      </p>
    </div>

    <!-- Products We Offer -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-l-4 border-green-600">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">🏍️ Products We Offer</h2>
      <p class="text-gray-700 mb-4 font-semibold">Through our E-Commerce system, customers can easily browse and purchase:</p>
      <ul class="space-y-3 mb-6">
        <li class="flex items-start gap-3">
          <span class="text-green-600 font-bold mt-1">✓</span>
          <span class="text-gray-700">Motorcycle spare parts (Engine, Electrical, Brake, Body, Suspension)</span>
        </li>
        <li class="flex items-start gap-3">
          <span class="text-green-600 font-bold mt-1">✓</span>
          <span class="text-gray-700">Tricycle spare parts</span>
        </li>
        <li class="flex items-start gap-3">
          <span class="text-green-600 font-bold mt-1">✓</span>
          <span class="text-gray-700">Kawasaki Barako OEM & aftermarket parts</span>
        </li>
        <li class="flex items-start gap-3">
          <span class="text-green-600 font-bold mt-1">✓</span>
          <span class="text-gray-700">Motorcycle accessories</span>
        </li>
        <li class="flex items-start gap-3">
          <span class="text-green-600 font-bold mt-1">✓</span>
          <span class="text-gray-700">Maintenance consumables (oils, cables, filters, brake parts)</span>
        </li>
      </ul>
      
      <p class="text-gray-700 font-semibold mb-3">Each product in our system includes:</p>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div class="bg-green-50 p-3 rounded-lg">• Clear product name</div>
        <div class="bg-green-50 p-3 rounded-lg">• OEM or Aftermarket label</div>
        <div class="bg-green-50 p-3 rounded-lg">• Compatible motorcycle model</div>
        <div class="bg-green-50 p-3 rounded-lg">• Price</div>
        <div class="bg-green-50 p-3 rounded-lg">• Stock availability</div>
        <div class="bg-green-50 p-3 rounded-lg">• Product image</div>
      </div>
    </div>

    <!-- Vision & Mission -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
      <!-- Vision -->
      <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-600">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">🎯 Vision</h2>
        <p class="text-gray-700 leading-relaxed">
          To become a trusted community motorshop known for quality products, fair pricing, and genuine care for customers—especially tricycle drivers and everyday riders.
        </p>
      </div>

      <!-- Mission -->
      <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-orange-600">
        <h2 class="text-2xl font-bold text-gray-900 mb-4">🎯 Mission</h2>
        <p class="text-gray-700 leading-relaxed">
          To provide affordable, reliable, and quality motorcycle and tricycle parts and services that support daily transportation and livelihoods while ensuring customer satisfaction and long-term trust.
        </p>
      </div>
    </div>

    <!-- Business Strategy -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-l-4 border-cyan-600">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">💡 Our Business Strategy</h2>
      <p class="text-gray-700 mb-4 font-semibold">Our E-Commerce and POS system supports our strategy by allowing us to:</p>
      <ul class="space-y-3">
        <li class="flex items-start gap-3">
          <span class="text-cyan-600 font-bold mt-1">→</span>
          <span class="text-gray-700">Offer both premium (OEM) and pang-masa (aftermarket) products</span>
        </li>
        <li class="flex items-start gap-3">
          <span class="text-cyan-600 font-bold mt-1">→</span>
          <span class="text-gray-700">Maintain transparent and competitive pricing</span>
        </li>
        <li class="flex items-start gap-3">
          <span class="text-cyan-600 font-bold mt-1">→</span>
          <span class="text-gray-700">Track inventory accurately to avoid stock shortages</span>
        </li>
        <li class="flex items-start gap-3">
          <span class="text-cyan-600 font-bold mt-1">→</span>
          <span class="text-gray-700">Build long-term customer relationships</span>
        </li>
        <li class="flex items-start gap-3">
          <span class="text-cyan-600 font-bold mt-1">→</span>
          <span class="text-gray-700">Provide honest product recommendations, not forced upselling</span>
        </li>
      </ul>
    </div>

    <!-- Competitive Advantage -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-l-4 border-red-600">
      <h2 class="text-2xl font-bold text-gray-900 mb-4">🏆 Competitive Advantage</h2>
      <p class="text-gray-700 mb-4 font-semibold">What makes TRI MOTOSHOP & SERVICES different:</p>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
          <div class="font-bold text-red-700">OEM & Aftermarket</div>
          <p class="text-sm text-gray-700 mt-1">Options available for every budget</p>
        </div>
        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
          <div class="font-bold text-red-700">Kawasaki Barako Specialization</div>
          <p class="text-sm text-gray-700 mt-1">Extensive parts catalog for this model</p>
        </div>
        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
          <div class="font-bold text-red-700">Affordable Pricing</div>
          <p class="text-sm text-gray-700 mt-1">But honest and transparent always</p>
        </div>
        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
          <div class="font-bold text-red-700">Customer-First Service</div>
          <p class="text-sm text-gray-700 mt-1">Your needs come first</p>
        </div>
        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
          <div class="font-bold text-red-700">Tricycle Driver Focus</div>
          <p class="text-sm text-gray-700 mt-1">Deep understanding of needs</p>
        </div>
        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
          <div class="font-bold text-red-700">Community Trusted</div>
          <p class="text-sm text-gray-700 mt-1">Local presence and reputation</p>
        </div>
      </div>
    </div>

    <!-- Store Information -->
    <div class="bg-gradient-to-r from-gray-800 to-gray-900 text-white rounded-lg shadow-lg p-8">
      <h2 class="text-2xl font-bold mb-6">🕒 Store Information</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div>
          <h3 class="text-lg font-semibold mb-3 text-blue-300">Operating Hours</h3>
          <p class="text-gray-100 text-lg">Monday – Saturday</p>
          <p class="text-gray-100 text-lg">8:00 AM – 10:00 PM</p>
        </div>
        <div>
          <h3 class="text-lg font-semibold mb-3 text-blue-300">Location</h3>
          <p class="text-gray-100">Near SM Angono</p>
          <p class="text-gray-100">Along the Highway</p>
          <p class="text-gray-100">Angono, Rizal</p>
        </div>
        <div class="md:col-span-2">
          <h3 class="text-lg font-semibold mb-3 text-blue-300">📞 Contact Number</h3>
          <p class="text-gray-100 text-lg font-semibold">
            <a href="tel:+639075952311" class="hover:text-blue-300 transition">+63 907 595 2311</a>
          </p>
        </div>
      </div>
    </div>

    <!-- Call to Action -->
    <div class="mt-8 bg-blue-600 text-white rounded-lg shadow-lg p-8 text-center">
      <h3 class="text-2xl font-bold mb-4">Ready to Shop?</h3>
      <p class="text-blue-100 mb-6">Visit our online store to browse our complete catalog of motorcycle and tricycle parts.</p>
      <a href="{{ route('home') }}" class="inline-block px-8 py-3 bg-white text-blue-600 rounded-lg font-bold hover:bg-gray-100 transition">
        🛒 Start Shopping Now
      </a>
    </div>
  </div>
@endsection
