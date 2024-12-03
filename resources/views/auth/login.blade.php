<x-guest-layout>
    <x-authentication-card class="bg-gray-900">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4 text-red-500" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-500">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="block text-sm font-medium text-white" />
                <x-input id="email" class="block mt-1 w-full bg-gray-800 border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-gray-100" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div>
                <x-label for="password" value="{{ __('Password') }}" class="block text-sm font-medium text-white" />
                <x-input id="password" class="block mt-1 w-full bg-gray-800 border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50 text-gray-100" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="rounded border-gray-700 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50" />
                    <span class="ml-2 text-sm text-white    ">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div>
                <x-button class="w-full justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
