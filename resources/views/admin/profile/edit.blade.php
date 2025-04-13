@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- Profile Information -->
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Profile Information
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Update your account's profile information and email address.
                    </p>
                </header>

                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" name="name" id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                            value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                        @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                            value="{{ old('email', $user->email) }}" required autocomplete="email">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input type="tel" name="phone" id="phone"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                            value="{{ old('phone', $user->phone) }}" autocomplete="tel">
                        @error('phone')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#C8A97E] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B69A71] focus:bg-[#B69A71] active:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-[#C8A97E] focus:ring-offset-2 transition ease-in-out duration-150">
                            Save Changes
                        </button>

                        @if (session('status') === 'profile-updated')
                        <p class="text-sm text-gray-600">Saved.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Update Password -->
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Update Password
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Ensure your account is using a long, random password to stay secure.
                    </p>
                </header>

                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('put')

                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700">Current Password</label>
                        <input type="password" name="current_password" id="current_password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                            autocomplete="current-password">
                        @error('current_password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                        <input type="password" name="password" id="password"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                            autocomplete="new-password">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                            autocomplete="new-password">
                        @error('password_confirmation')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#C8A97E] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B69A71] focus:bg-[#B69A71] active:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-[#C8A97E] focus:ring-offset-2 transition ease-in-out duration-150">
                            Update Password
                        </button>

                        @if (session('status') === 'password-updated')
                        <p class="text-sm text-gray-600">Saved.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Notification Preferences -->
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Notification Preferences
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Manage your notification settings and preferences.
                    </p>
                </header>

                <form method="post" action="{{ route('profile.notifications') }}" class="mt-6 space-y-6">
                    @csrf
                    @method('patch')

                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="email_notifications" id="email_notifications"
                                    class="rounded border-gray-300 text-[#C8A97E] focus:ring-[#C8A97E]"
                                    {{ $user->email_notifications ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="email_notifications" class="font-medium text-gray-700">Email Notifications</label>
                                <p class="text-gray-500">Receive email notifications for new reservations and important updates.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" name="sms_notifications" id="sms_notifications"
                                    class="rounded border-gray-300 text-[#C8A97E] focus:ring-[#C8A97E]"
                                    {{ $user->sms_notifications ? 'checked' : '' }}>
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="sms_notifications" class="font-medium text-gray-700">SMS Notifications</label>
                                <p class="text-gray-500">Receive SMS alerts for urgent matters and immediate attention items.</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-[#C8A97E] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#B69A71] focus:bg-[#B69A71] active:bg-[#B69A71] focus:outline-none focus:ring-2 focus:ring-[#C8A97E] focus:ring-offset-2 transition ease-in-out duration-150">
                            Save Preferences
                        </button>

                        @if (session('status') === 'notifications-updated')
                        <p class="text-sm text-gray-600">Saved.</p>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Account -->
        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
            <div class="max-w-xl">
                <header>
                    <h2 class="text-lg font-medium text-gray-900">
                        Delete Account
                    </h2>
                    <p class="mt-1 text-sm text-gray-600">
                        Once your account is deleted, all of its resources and data will be permanently deleted.
                    </p>
                </header>

                <div class="mt-6">
                    <button type="button"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150"
                        x-data
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
                        Delete Account
                    </button>
                </div>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900">
                            Are you sure you want to delete your account?
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Once your account is deleted, all of its resources and data will be permanently deleted.
                            Please enter your password to confirm you would like to permanently delete your account.
                        </p>

                        <div class="mt-6">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#C8A97E] focus:ring-[#C8A97E]"
                                placeholder="Enter your password">
                            @error('password', 'userDeletion')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="button"
                                class="inline-flex items-center px-4 py-2 bg-gray-50 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-[#C8A97E] focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
                                x-on:click="$dispatch('close')">
                                Cancel
                            </button>

                            <button type="submit"
                                class="ml-3 inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Delete Account
                            </button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
    </div>
</div>
@endsection