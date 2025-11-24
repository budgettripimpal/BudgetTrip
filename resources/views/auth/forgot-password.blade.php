<x-guest-layout>
    <a href="{{ route('login') }}" class="absolute top-8 left-8 text-gray-400 hover:text-[#181E4B] transition duration-300 transform hover:-translate-x-1" title="Back to Login">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
    </a>

    <div class="text-center mb-8 fade-in-up delay-100">
        <h2 class="text-3xl font-bold text-[#181E4B]">Forgot Password</h2>
        <p class="text-gray-500 mt-2 text-sm leading-relaxed">
            {{ __('No problem. Just let us know your email address and we will email you a password reset link.') }}
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5" novalidate>
        @csrf

        <div class="fade-in-up delay-200">
            <x-text-input id="email" class="block mt-1 w-full px-4 py-3 rounded-xl border-gray-300 focus:border-[#181E4B] focus:ring-[#181E4B] transition shadow-sm" 
                          type="email" 
                          name="email" 
                          :value="old('email')" 
                          required autofocus 
                          placeholder="Enter your registered email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="fade-in-up delay-300">
            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-lg text-sm font-bold text-white bg-[#181E4B] hover:bg-[#2a3480] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#181E4B] transition transform hover:-translate-y-0.5">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>