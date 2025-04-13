@extends('layouts.app')

@section('content')
<div class="relative min-h-screen">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2070&auto=format&fit=crop"
            class="w-full h-full object-cover" alt="Restaurant Background">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50"></div>
    </div>

    <!-- Verification Content -->
    <div class="relative flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/95 backdrop-blur-sm p-8 rounded-lg shadow-xl">
            <div>
                <h2 class="mt-6 text-center text-3xl font-serif text-gray-900">
                    {{ __('Verify Your Email Address') }}
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>
    </div>

    @if (session('status') == 'verification-link-sent')
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</span>
        </div>
    @endif

            <div class="flex items-center justify-between mt-4">
                <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
                    <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#C8A97E] hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                    {{ __('Resend Verification Email') }}
                    </button>
                </form>
            </div>

            <div class="text-center mt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
                    <button type="submit" class="text-sm text-[#C8A97E] hover:text-[#B69A71]">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
        </div>
    </div>
</div>
@endsection