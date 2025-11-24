<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="text-center mb-8 fade-in-up delay-100">
        <h2 class="text-3xl font-bold text-[#181E4B]">Sign In</h2>
        <p class="text-gray-500 mt-2">Enter your details to get started</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-5" novalidate>
        @csrf

        <div class="fade-in-up delay-100">
            <x-text-input id="email" class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-[#181E4B] focus:ring-[#181E4B] transition shadow-sm" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required 
                          autofocus 
                          autocomplete="username"
                          placeholder="Email or phone number" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="fade-in-up delay-200">
            <x-text-input id="password" class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-[#181E4B] focus:ring-[#181E4B] transition shadow-sm"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between fade-in-up delay-300">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" 
                       class="rounded border-gray-300 text-[#181E4B] shadow-sm focus:ring-[#181E4B]" 
                       name="remember">
                <label for="remember_me" class="ms-2 block text-sm text-gray-600 hover:text-[#181E4B] cursor-pointer transition">{{ __('Remember me') }}</label>
            </div>

            @if (Route::has('password.request'))
                <a class="text-sm font-bold text-[#181E4B] hover:underline transition" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="fade-in-up delay-300">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-[#181E4B] hover:bg-[#2a3480] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#181E4B] transition transform hover:-translate-y-0.5">
                {{ __('Sign In') }}
            </button>
        </div>

        <div class="text-center mt-6 fade-in-up delay-300">
            <p class="text-sm text-gray-600">
                Don't have an account?
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="font-extrabold text-[#181E4B] hover:underline transition">
                        Sign up
                    </a>
                @endif
            </p>
        </div>
    </form>
</x-guest-layout>