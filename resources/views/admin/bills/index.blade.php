@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-gray-800">Bills</h2>
                </div>

                <!-- Bills Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Bill #
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Order Details
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bills as $bill)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        #{{ $bill->id }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ $bill->created_at->format('M d, Y H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        Reservation #{{ $bill->reservation->id }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        Table #{{ $bill->reservation->table->table_number }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        ৳{{ number_format($bill->total, 2) }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Subtotal: ৳{{ number_format($bill->subtotal, 2) }}<br>
                                        Tax: ৳{{ number_format($bill->tax, 2) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($bill->payment_status == 'paid') bg-green-100 text-green-800
                                        @else bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($bill->payment_status) }}
                                    </span>
                                    @if($bill->payment_status == 'paid')
                                    <div class="text-xs text-gray-500 mt-1">
                                        via {{ ucfirst($bill->payment_method) }}
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('admin.bills.show', $bill) }}"
                                            class="text-[#C8A97E] hover:text-[#B69A71]">
                                            View
                                        </a>
                                        <a href="{{ route('admin.bills.download-pdf', $bill) }}"
                                            class="text-[#C8A97E] hover:text-[#B69A71]">
                                            Download
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                    No bills found
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($bills->hasPages())
                <div class="mt-4">
                    {{ $bills->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection