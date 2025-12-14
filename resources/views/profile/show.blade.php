<x-app-layout>
    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }

            .text-primary {
                color: #2CB38B;
            }

            .bg-primary {
                background-color: #2CB38B;
            }

            .border-primary {
                border-color: #2CB38B;
            }

            .hover\:text-primary:hover {
                color: #2CB38B;
            }

            .hover\:bg-primary:hover {
                background-color: #2CB38B;
            }

            .hover\:bg-green-600:hover {
                background-color: #249372;
            }
        </style>
    @endpush

    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 h-20">
        <div class="container mx-auto px-6 h-full">
            <div class="flex items-center justify-between h-full">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('images/budgettrip-logo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                    <span class="text-2xl font-bold tracking-tight">
                        <span class="text-gray-900">BUDGET</span><span class="text-[#2CB38B]">TRIP</span>
                    </span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-900 hover:text-[#2CB38B] font-bold transition">Home</a>
                </div>

                <div class="flex items-center space-x-4 relative group">
                    <span class="text-gray-600 hidden md:inline font-medium">Welcome, {{ Auth::user()->name }}</span>
                    <div
                        class="w-10 h-10 bg-[#2CB38B] rounded-full flex items-center justify-center cursor-pointer shadow-md text-white font-bold text-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>

                    <div
                        class="absolute top-10 right-0 w-56 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border border-gray-100 animate-fade-in-down z-50">
                        <div class="px-4 py-2 border-b border-gray-100 mb-1">
                            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition">View
                            Profile</a>
                        <a href="{{ route('travel-plan.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition font-bold">Rencana
                            Saya</a>
                        <a href="{{ route('profile.edit') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition">Edit
                            Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition rounded-b-xl">Log
                                Out</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen bg-gray-50 pt-28 pb-12">
        <div class="container mx-auto px-6 max-w-6xl">

            <div class="flex flex-col lg:flex-row gap-8">

                <div class="w-full lg:w-80 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-28">

                        <div class="p-8 text-center border-b border-gray-200 bg-gradient-to-b from-gray-50 to-white">
                            <div
                                class="w-32 h-32 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full mx-auto mb-4 flex items-center justify-center shadow-inner ring-4 ring-white">
                                <span class="text-5xl font-bold text-white uppercase">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800 mb-1 truncate px-2">{{ Auth::user()->name }}
                            </h2>
                            <p class="text-gray-500 text-sm truncate px-2">{{ Auth::user()->email }}</p>
                        </div>

                        <div class="p-4 space-y-1">
                            <a href="{{ route('profile.show') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-[#2CB38B]/10 text-gray-900 font-bold border-l-4 border-[#2CB38B] transition">
                                <svg class="w-5 h-5 text-[#2CB38B]" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                                <span>Profile</span>
                            </a>

                            <a href="{{ route('travel-plan.index') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#2CB38B] transition font-medium group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2CB38B]" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                                <span>Rencana Saya</span>
                            </a>

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#2CB38B] transition font-medium group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2CB38B]" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                <span>Edit Profile</span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-red-50 hover:text-red-600 transition font-medium group mt-4">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="flex-1">
                    <div class="bg-white rounded-2xl shadow-lg p-8 md:p-10 border border-gray-100 h-full">

                        <div class="flex items-center justify-between mb-10 border-b border-gray-100 pb-6">
                            <div class="flex items-center">
                                <div class="bg-green-50 p-3 rounded-full mr-4">
                                    <svg class="w-8 h-8 text-[#2CB38B]" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                    </svg>
                                </div>
                                <div>
                                    <h1 class="text-3xl font-bold text-gray-900 mb-1">Detail Profile</h1>
                                    <p class="text-gray-500 text-sm">Informasi akun Anda saat ini.</p>
                                </div>
                            </div>

                            <a href="{{ route('profile.edit') }}"
                                class="hidden md:flex items-center gap-2 px-6 py-3 bg-[#2CB38B] text-white rounded-xl font-semibold hover:bg-[#249d78] transition shadow-md shadow-green-200">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                </svg>
                                Ubah Profil
                            </a>
                        </div>

                        <div class="space-y-8 max-w-2xl">

                            <div class="group">
                                <label class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Nama
                                    Lengkap</label>
                                <div
                                    class="flex items-center justify-between border-b border-gray-200 pb-2 group-hover:border-[#2CB38B] transition">
                                    <p class="text-xl font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Nomor
                                    Telepon</label>
                                <div
                                    class="flex items-center justify-between border-b border-gray-200 pb-2 group-hover:border-[#2CB38B] transition">
                                    <p class="text-xl font-semibold text-gray-800">
                                        {{ Auth::user()->phoneNumber ?? '-' }}
                                    </p>
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="group">
                                <label
                                    class="block text-gray-400 text-xs font-bold uppercase tracking-wider mb-2">Alamat
                                    Email</label>
                                <div
                                    class="flex items-center justify-between border-b border-gray-200 pb-2 group-hover:border-[#2CB38B] transition">
                                    <p class="text-xl font-semibold text-gray-800">{{ Auth::user()->email }}</p>
                                    <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                            </div>

                            <div class="md:hidden pt-6">
                                <a href="{{ route('profile.edit') }}"
                                    class="block w-full px-6 py-3 bg-[#2CB38B] hover:bg-[#249d78] text-white font-bold rounded-xl shadow-lg text-center">
                                    Ubah Profil
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
