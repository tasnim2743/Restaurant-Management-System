@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Bill #{{ $bill->id }}</h2>
                    <div class="flex space-x-2">
                        <a href="{{ route('bills.download-pdf', $bill) }}"
                            class="inline-flex items-center px-4 py-2 bg-[#C8A97E] text-white rounded-md hover:bg-[#B69A71]">
                            Download PDF
                        </a>
                        <a href="{{ route('admin.bills.index') }}"
                            class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                            Back to Bills
                        </a>
                    </div>
                </div>

                <!-- Bill Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left Column -->
                    <div>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Reservation Information</h3>
                            <dl class="grid grid-cols-1 gap-3">
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Reservation Number</dt>
                                    <dd class="text-sm text-gray-900">#{{ $bill->reservation->id }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Table Number</dt>
                                    <dd class="text-sm text-gray-900">#{{ $bill->reservation->table->table_number }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Customer Name</dt>
                                    <dd class="text-sm text-gray-900">{{ $bill->reservation->customer_name }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Date & Time</dt>
                                    <dd class="text-sm text-gray-900">{{ $bill->reservation->reservation_date->format('F d, Y H:i') }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Number of Guests</dt>
                                    <dd class="text-sm text-gray-900">{{ $bill->reservation->number_of_guests }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div>
                        <!-- Bill Summary -->
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Bill Summary</h3>
                            <dl class="space-y-3">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Subtotal</dt>
                                    <dd class="text-sm text-gray-900">${{ number_format($bill->subtotal, 2) }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Tax (10%)</dt>
                                    <dd class="text-sm text-gray-900">${{ number_format($bill->tax, 2) }}</dd>
                                </div>
                                <div class="flex justify-between pt-3 border-t border-gray-200">
                                    <dt class="text-base font-medium text-gray-900">Total</dt>
                                    <dd class="text-base font-medium text-gray-900">${{ number_format($bill->total, 2) }}</dd>
                                </div>
                            </dl>
                        </div>

                        <!-- Payment Status -->
                        <div class="mt-6">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Payment Status</h3>
                                <div class="flex items-center space-x-2">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                        @if($bill->payment_status == 'paid') bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($bill->payment_status) }}
                                    </span>
                                    @if($bill->payment_status == 'paid')
                                    <span class="text-sm text-gray-500">via {{ ucfirst($bill->payment_method) }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Payment Form -->
                        @if($bill->payment_status != 'paid')
                        <div class="mt-6">
                            <div class="bg-white p-4 rounded-lg border border-gray-200">
                                <h3 class="text-lg font-medium text-gray-900 mb-4">Process Payment</h3>
                                <form action="{{ route('bills.process-payment', $bill) }}" method="POST">
                                    @csrf
                                    <div class="space-y-4">
                                        <div>
                                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Payment Method</label>
                                            <select name="payment_method" id="payment_method"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]">
                                                <option value="cash">Cash</option>
                                                <option value="card">Card</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="payment_reference" class="block text-sm font-medium text-gray-700">Reference/Note</label>
                                            <input type="text" name="payment_reference" id="payment_reference"
                                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                                                placeholder="Transaction ID or cash received amount">
                                        </div>
                                        <div>
                                            <button type="submit"
                                                class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-[#C8A97E] hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                                                Process Payment
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection