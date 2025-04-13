@extends('layouts.app')

@section('content')
<div class="relative min-h-screen">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0">
        <img src="https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2070&auto=format&fit=crop"
            class="w-full h-full object-cover animate-[gradientBG_8s_ease-in-out_infinite]" alt="Restaurant Interior">
        <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/50"></div>
    </div>

    <!-- Registration Form -->
    <div class="relative flex items-center justify-center min-h-screen py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/95 backdrop-blur-sm p-8 rounded-lg shadow-xl animate-[fadeIn_0.6s_ease-out]">
            <div>
                <div class="w-20 h-20 mx-auto bg-[#C8A97E] rounded-full flex items-center justify-center animate-[pulse_2s_infinite]">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h2 class="mt-6 text-center text-3xl font-serif text-gray-900 animate-[slideIn_0.6s_ease-out]">
                    Join Our Restaurant Family
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600 animate-[slideIn_0.6s_ease-out_0.2s]">
                    Create an account to make reservations and enjoy special offers
                </p>
            </div>
            <form id="registerForm" class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
                        @csrf

                <!-- Progress Steps -->
                <div class="flex justify-between mb-8">
                    <div class="w-1/3 text-center">
                        <div class="w-8 h-8 mx-auto rounded-full bg-[#C8A97E] text-white flex items-center justify-center">1</div>
                        <div class="mt-2 text-xs">Account</div>
                    </div>
                    <div class="w-1/3 text-center">
                        <div class="w-8 h-8 mx-auto rounded-full bg-gray-200 text-gray-600 flex items-center justify-center">2</div>
                        <div class="mt-2 text-xs">Details</div>
                    </div>
                    <div class="w-1/3 text-center">
                        <div class="w-8 h-8 mx-auto rounded-full bg-gray-200 text-gray-600 flex items-center justify-center">3</div>
                        <div class="mt-2 text-xs">Complete</div>
                    </div>
                </div>

                <!-- Name -->
                <div class="transform transition-all duration-300 translate-x-0">
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Full Name
                    </label>
                    <div class="mt-1 input-focus-effect">
                        <input id="name" name="name" type="text" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                            focus:outline-none focus:ring-[#C8A97E] focus:border-[#C8A97E] sm:text-sm transition-all duration-300
                            @error('name') animate-[shakeError_0.6s] border-red-500 @enderror"
                            value="{{ old('name') }}" autocomplete="name" autofocus placeholder="John Doe">
                                @error('name')
                        <p class="mt-1 text-sm text-red-600 animate-[fadeIn_0.3s]">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

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
                            value="{{ old('email') }}" autocomplete="email" placeholder="you@example.com">
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
                            autocomplete="new-password" placeholder="••••••••">
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

                <!-- Confirm Password -->
                <div class="transform transition-all duration-300 translate-x-0">
                    <label for="password-confirm" class="block text-sm font-medium text-gray-700">
                        Confirm Password
                    </label>
                    <div class="mt-1 input-focus-effect relative">
                        <input id="password-confirm" name="password_confirmation" type="password" required
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 
                            focus:outline-none focus:ring-[#C8A97E] focus:border-[#C8A97E] sm:text-sm transition-all duration-300"
                            autocomplete="new-password" placeholder="••••••••">
                        <button type="button" onclick="togglePassword('password-confirm')"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600">
                            <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                            </div>
                        </div>

                <!-- Password Strength Indicator -->
                <div class="space-y-2">
                    <div class="h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                        <div id="passwordStrength" class="h-full w-0 bg-red-500 transition-all duration-300"></div>
                    </div>
                    <p id="passwordStrengthText" class="text-xs text-gray-500">Password strength: Too weak</p>
                </div>

                <!-- Terms and Conditions -->
                <div class="flex items-center space-x-2">
                    <input id="terms" name="terms" type="checkbox" required
                        class="h-4 w-4 text-[#C8A97E] focus:ring-[#C8A97E] border-gray-300 rounded transition-all duration-300 hover:scale-110">
                    <label for="terms" class="ml-2 block text-sm text-gray-900">
                        I agree to the <a href="#" class="text-[#C8A97E] hover:text-[#B69A71] transition-colors duration-300">Terms and Conditions</a> and
                        <a href="#" class="text-[#C8A97E] hover:text-[#B69A71] transition-colors duration-300">Privacy Policy</a>
                    </label>
                </div>

                <div>
                    <button type="submit" id="submitButton"
                        class="btn-hover-effect w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#C8A97E] hover:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#C8A97E] transition-all duration-300">
                        <span class="loading-spinner hidden"></span>
                        <span class="btn-text">Create Account</span>
                                </button>
                            </div>

                <!-- Login Link -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-medium text-[#C8A97E] hover:text-[#B69A71] transition-colors duration-300">
                            Sign in here
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

    // Password strength checker
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strength = checkPasswordStrength(password);
        const strengthBar = document.getElementById('passwordStrength');
        const strengthText = document.getElementById('passwordStrengthText');

        // Update strength bar
        strengthBar.style.width = strength.percentage + '%';
        strengthBar.className = `h-full transition-all duration-300 ${strength.color}`;
        strengthText.textContent = 'Password strength: ' + strength.text;
    });

    function checkPasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength += 25;
        if (password.match(/[a-z]/)) strength += 25;
        if (password.match(/[A-Z]/)) strength += 25;
        if (password.match(/[0-9]/)) strength += 25;

        let result = {
            percentage: strength,
            text: 'Too weak',
            color: 'bg-red-500'
        };

        if (strength >= 100) {
            result.text = 'Strong';
            result.color = 'bg-green-500';
        } else if (strength >= 50) {
            result.text = 'Medium';
            result.color = 'bg-yellow-500';
        }

        return result;
    }

    // Form submission animation
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        const button = document.getElementById('submitButton');
        const spinner = button.querySelector('.loading-spinner');
        const btnText = button.querySelector('.btn-text');

        spinner.classList.remove('hidden');
        btnText.textContent = 'Creating Account...';
        button.disabled = true;
    });
</script>
@endpush
@endsection