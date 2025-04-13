@extends('layouts.app')

@section('content')
<div class="relative min-h-screen">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1414235077428-338989a2e8c0?q=80&w=2070&auto=format&fit=crop"
            class="w-full h-full object-cover animate-[gradientBG_8s_ease-in-out_infinite]" alt="Restaurant Background">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50"></div>
    </div>

    <!-- Login Form -->
    <div class="relative flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/95 backdrop-blur-sm p-8 rounded-lg shadow-xl animate-[fadeIn_0.6s_ease-out]">
            <div>
                <div class="w-20 h-20 mx-auto bg-[#C8A97E] rounded-full flex items-center justify-center animate-[pulse_2s_infinite]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="mt-6 text-center text-3xl font-serif text-gray-900 animate-[slideIn_0.6s_ease-out]">
                    {{ request()->has('admin') ? 'Admin Login' : 'Welcome Back' }}
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 animate-[slideIn_0.6s_ease-out_0.2s]">
                    {{ request()->has('admin') ? 'Please sign in to access admin panel' : 'Please sign in to your account' }}
                </p>
            </div>
            <form id="loginForm" class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                        @csrf

                <!-- Email Address -->
                <div class="transform transition-all duration-300 translate-x-0">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email Address
                    </label>
                    <div class="mt-1 input-focus-effect">
                        <input id="email" name="email" type="email" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                            focus:outline-none focus:ring-[#C8A97E] focus:border-[#C8A97E] sm:text-sm transition-all duration-300
                            @error('email') animate-[shakeError_0.6s] border-red-500 @enderror"
                            value="{{ old('email') }}" autocomplete="email" autofocus placeholder="you@example.com">
                                @error('email')
                        <p class="mt-1 text-sm text-red-600 animate-[fadeIn_0.3s]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                <!-- Password -->
                <div class="transform transition-all duration-300 translate-x-0">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Password
                    </label>
                    <div class="mt-1 input-focus-effect relative">
                        <input id="password" name="password" type="password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                            focus:outline-none focus:ring-[#C8A97E] focus:border-[#C8A97E] sm:text-sm transition-all duration-300
                            @error('password') animate-[shakeError_0.6s] border-red-500 @enderror"
                            autocomplete="current-password" placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                                @error('password')
                        <p class="mt-1 text-sm text-red-600 animate-[fadeIn_0.3s]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-[#C8A97E] focus:ring-[#C8A97E] border-gray-300 rounded transition-all duration-300 hover:scale-110"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="ml-2 block text-sm text-gray-900">
                            Remember me
                                    </label>
                    </div>

                    <!-- @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}"
                            class="font-medium text-[#C8A97E] hover:text-[#B69A71] transition-colors duration-300">
                            Forgot your password?
                        </a>
                    </div>
                    @endif -->
                </div>

                <div>
                    <button type="submit" id="submitButton"
                        class="btn-hover-effect w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#C8A97E] hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E] transition-all duration-300">
                        <span class="loading-spinner hidden"></span>
                        <span class="btn-text">Sign in</span>
                    </button>
                </div>

                <!-- Social Login Buttons -->
                <!-- <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">Or continue with</span>
                                </div>
                            </div>

                    <div class="mt-6 grid grid-cols-2 gap-3">
                        <div>
                            <a href="#"
                                class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z" />
                                </svg>
                                <span class="ml-2">Google</span>
                            </a>
                        </div>

                        <div>
                            <a href="#"
                                class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-300">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M24,12.073c0,5.989-4.394,10.954-10.13,11.855v-8.363h2.789l0.531-3.46H13.87V9.86c0-0.947,0.464-1.869,1.95-1.869h1.509V5.045c0,0-1.37-0.234-2.679-0.234c-2.734,0-4.52,1.657-4.52,4.656v2.637H7.091v3.46h3.039v8.363C4.395,23.025,0,18.061,0,12.073c0-6.627,5.373-12,12-12S24,5.445,24,12.073z" />
                                </svg>
                                <span class="ml-2">Facebook</span>
                            </a>
                        </div>
                    </div>
                </div> -->

                <!-- Registration Link -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="font-medium text-[#C8A97E] hover:text-[#B69A71] transition-colors duration-300">
                            Register here
                        </a>
                    </p>
            </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
    }

    // Form submission animation
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        const button = document.getElementById('submitButton');
        const spinner = button.querySelector('.loading-spinner');
        const btnText = button.querySelector('.btn-text');

        spinner.classList.remove('hidden');
        btnText.textContent = 'Signing in...';
        button.disabled = true;
    });
</script>
@endpush
@endsection