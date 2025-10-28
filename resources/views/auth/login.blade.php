<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-text-input id="email" class="block mt-1 w-full" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          autocomplete="username"
                          placeholder="Email or phone number" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" 
                       class="rounded border-gray-300 bg-white text-blue-900 shadow-sm focus:ring-blue-900" 
                       name="remember">
                <label for="remember_me" class="ms-2 block text-sm text-gray-700">{{ __('Remember me') }}</label>
            </div>

            @if (Route::has('password.request'))
                <a class="text-sm text-blue-900 hover:underline" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div>
            <x-primary-button>
                {{ __('Sign In') }}
            </x-primary-button>
        </div>

        <div class="text-center mt-6">
            <p class="text-sm text-gray-600">
                Don't have an account?
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-medium text-blue-900 hover:underline">
                        Sign up
                    </a>
                @endif
            </p>
        </div>
    </form>
</x-guest-layout>