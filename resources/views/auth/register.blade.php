<x-guest-layout>
    <div class="text-center mb-8 fade-in-up delay-100">
        <h2 class="text-3xl font-bold text-[#181E4B]">Sign Up</h2>
        <p class="text-gray-500 mt-2">Create your account to start your journey</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" novalidate>
        @csrf

        <div class="fade-in-up delay-100">
            <x-text-input id="name" class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-[#181E4B] focus:ring-[#181E4B] transition shadow-sm" 
                          type="text" 
                          name="name" 
                          :value="old('name')" 
                          required autofocus autocomplete="name"
                          placeholder="Full Name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="fade-in-up delay-200">
            <x-text-input id="email" class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-[#181E4B] focus:ring-[#181E4B] transition shadow-sm" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required autocomplete="username"
                          placeholder="Email Address" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="fade-in-up delay-300">
            <x-text-input id="password" class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-[#181E4B] focus:ring-[#181E4B] transition shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="new-password"
                            placeholder="Password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="fade-in-up delay-300">
            <x-text-input id="password_confirmation" class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-[#181E4B] focus:ring-[#181E4B] transition shadow-sm"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password"
                            placeholder="Confirm Password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="fade-in-up delay-300">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-[#181E4B] hover:bg-[#2a3480] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#181E4B] transition transform hover:-translate-y-0.5">
                {{ __('Sign Up') }}
            </button>
        </div>

        <div class="text-center mt-6 fade-in-up delay-300">
            <p class="text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="font-extrabold text-[#181E4B] hover:underline transition">
                    {{ __('Sign In') }}
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>