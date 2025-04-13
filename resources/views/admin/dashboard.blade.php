@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-semibold mb-6">Admin Dashboard</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Tables Management Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Tables</h3>
                            <svg class="w-8 h-8 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">Manage restaurant tables and seating arrangements</p>
                        <a href="{{ route('admin.tables.index') }}" class="inline-block bg-[#C8A97E] text-white px-4 py-2 rounded hover:bg-[#B69A71] transition-colors">
                            Manage Tables
                        </a>
                    </div>

                    <!-- Reservations Management Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Reservations</h3>
                            <svg class="w-8 h-8 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">View and manage customer reservations</p>
                        <a href="{{ route('admin.reservations.index') }}" class="inline-block bg-[#C8A97E] text-white px-4 py-2 rounded hover:bg-[#B69A71] transition-colors">
                            Manage Reservations
                        </a>
                    </div>

                    <!-- Menu Management Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Menu</h3>
                            <svg class="w-8 h-8 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">Update menu items and categories</p>
                        <a href="{{ route('admin.menu.index') }}" class="inline-block bg-[#C8A97E] text-white px-4 py-2 rounded hover:bg-[#B69A71] transition-colors">
                            Manage Menu
                        </a>
                    </div>

                    <!-- Billing Management Card -->
                    <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200 hover:shadow-lg transition-shadow">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-800">Bills</h3>
                            <svg class="w-8 h-8 text-[#C8A97E]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-4">Generate and manage bills, process payments</p>
                        <a href="{{ route('admin.bills.index') }}" class="inline-block bg-[#C8A97E] text-white px-4 py-2 rounded hover:bg-[#B69A71] transition-colors">
                            Manage Bills
                        </a>
                    </div>
                </div>

                <!-- Quick Stats -->
                <!-- <div class="mt-8">
                    <h3 class="text-xl font-semibold mb-4">Quick Stats</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <div class="bg-[#C8A97E] text-white p-6 rounded-lg">
                            <div class="text-3xl font-bold">{{ App\Models\Table::count() }}</div>
                            <div class="text-sm opacity-80">Total Tables</div>
                        </div>
                        <div class="bg-[#C8A97E] text-white p-6 rounded-lg">
                            <div class="text-3xl font-bold">{{ App\Models\Reservation::where('status', 'pending')->count() }}</div>
                            <div class="text-sm opacity-80">Pending Reservations</div>
                        </div>
                        <div class="bg-[#C8A97E] text-white p-6 rounded-lg">
                            <div class="text-3xl font-bold">{{ App\Models\Bill::where('payment_status', 'pending')->count() }}</div>
                            <div class="text-sm opacity-80">Pending Bills</div>
                        </div>
                        <div class="bg-[#C8A97E] text-white p-6 rounded-lg">
                            <div class="text-3xl font-bold">${{ number_format(App\Models\Bill::where('payment_status', 'paid')->whereDate('created_at', today())->sum('total'), 2) }}</div>
                            <div class="text-sm opacity-80">Today's Revenue</div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
@endsection