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
                    Verify Your Email
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Please enter the verification code sent to your email.
                </p>
            </div>

            @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('status') }}</span>
            </div>
            @endif

            <form method="POST" action="{{ route('verification.verify-otp') }}" class="mt-8 space-y-6">
                @csrf
                <div>
                    <label for="otp" class="sr-only">Verification Code</label>
                    <input id="otp" name="otp" type="text" required
                        class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-[#C8A97E] focus:border-[#C8A97E] focus:z-10 sm:text-sm"
                        placeholder="Enter 6-digit verification code">
                    @error('otp')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#C8A97E] hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E]">
                        Verify Email
                    </button>
                </div>
            </form>

            <div class="text-center">
                <form method="POST" action="{{ route('verification.send-otp') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-[#C8A97E] hover:text-[#B69A71]">
                        Resend verification code
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection