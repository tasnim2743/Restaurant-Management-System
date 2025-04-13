@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    Notifications
                </h2>

                @if($notifications->isEmpty())
                <p class="text-gray-500">You have no notifications.</p>
                @else
                <div class="space-y-4">
                    @foreach($notifications as $notification)
                    <div class="p-4 rounded-lg border {{ !$notification->read ? 'bg-gray-50' : '' }} 
                                {{ $notification->type === 'success' ? 'border-green-200' : 
                                   ($notification->type === 'error' ? 'border-red-200' : 
                                   ($notification->type === 'warning' ? 'border-yellow-200' : 'border-gray-200')) }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-medium text-gray-900">{{ $notification->title }}</h3>
                                <p class="mt-1 text-sm text-gray-600">{{ $notification->message }}</p>
                                <p class="mt-2 text-xs text-gray-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                                @if($notification->type === 'success' && 
                                    $notification->reservation && 
                                    $notification->reservation->status !== 'completed' &&
                                    (!$notification->reservation->bill || 
                                    ($notification->reservation->bill && $notification->reservation->bill->payment_status === 'pending')))
                                <div class="mt-3">
                                    <form method="POST" action="{{ route('bills.generate', $notification->reservation) }}">
                                        @csrf
                                        <button type="submit"
                                            class="inline-flex items-center px-4 py-2 bg-[#C8A97E] text-white text-sm font-medium rounded-md hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                                            Pay Bill
                                        </button>
                                    </form>
                                </div>
                                @elseif($notification->reservation && $notification->reservation->bill && $notification->reservation->bill->payment_status === 'paid')
                                <div class="mt-3">
                                    <span class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 text-sm font-medium rounded-md">
                                        Payment Completed
                                    </span>
                                </div>
                                @endif
                            </div>
                            @if(!$notification->read)
                            <form method="POST" action="{{ route('profile.notifications.mark-as-read', $notification) }}">
                                @csrf
                                <button type="submit" class="text-sm text-gray-500 hover:text-gray-700">
                                    Mark as read
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection