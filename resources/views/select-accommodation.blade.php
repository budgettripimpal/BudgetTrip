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

            .ring-primary {
                --tw-ring-color: #2CB38B;
            }

            .focus\:ring-primary:focus {
                --tw-ring-color: #2CB38B;
            }

            input[type="checkbox"]:checked {
                background-color: #2CB38B;
                border-color: #2CB38B;
            }

            input[type="checkbox"]:focus {
                --tw-ring-color: #2CB38B;
            }

            .accordion-content {
                transition: max-height 0.3s ease-out;
                overflow: hidden;
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

    <div class="min-h-screen bg-gray-50 pb-12 pt-20">

        <div class="bg-white shadow-sm py-8 mb-8 sticky top-20 z-40">
            <div class="container mx-auto px-6">
                <div class="flex items-center justify-between max-w-6xl mx-auto">

                    <a href="{{ route('travel-plan.edit', $plan->planID) }}"
                        class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div
                                class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center group-hover:underline">Input Budget
                                &<br>Rencana</p>
                        </div>
                        <div class="w-full h-1 bg-[#2CB38B] mx-2 rounded-full"></div>
                    </a>

                    <a href="{{ route('travel-plan.transport', $plan->planID) }}"
                        class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div
                                class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-md border-2 border-[#2CB38B] group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18 20H6c-1.1 0-2-.9-2-2V6c0-2.2 1.8-4 4-4h8c2.2 0 4 1.8 4 4v12c0 1.1-.9 2-2 2zm-2-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-9h8V4H8v4z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center group-hover:underline">
                                Pilih<br>Transportasi</p>
                        </div>
                        <div class="w-full h-1 bg-[#2CB38B] mx-2 rounded-full"></div>
                    </a>

                    <div class="flex items-center flex-1">
                        <div class="flex flex-col items-center relative z-10">
                            <div
                                class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-lg ring-4 ring-green-100 transform scale-110">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center">Pilih<br>Akomodasi</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </div>

                    <a href="{{ route('travel-plan.attraction', $plan->planID) }}"
                        class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div
                                class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2 transition-all duration-300 group-hover:bg-green-100 group-hover:text-[#2CB38B] group-hover:scale-110 group-hover:shadow-md">
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-[#2CB38B]" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p
                                class="text-xs font-semibold text-gray-400 text-center group-hover:text-[#2CB38B] group-hover:underline">
                                Pilih<br>Wisata</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </a>

                    <a href="{{ route('travel-plan.manage', $plan->planID) }}"
                        class="flex flex-col items-center relative z-10 group cursor-pointer">
                        <div
                            class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2 transition-all duration-300 group-hover:bg-green-100 group-hover:text-[#2CB38B] group-hover:scale-110 group-hover:shadow-md">
                            <svg class="w-8 h-8 text-gray-400 group-hover:text-[#2CB38B]" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p
                            class="text-xs font-semibold text-gray-400 text-center group-hover:text-[#2CB38B] group-hover:underline">
                            Atur<br>Rencana</p>
                    </a>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-6 py-4">
            <form action="{{ route('travel-plan.accommodation', $plan->planID) }}" method="GET">
                <div class="flex flex-col lg:flex-row gap-8">

                    <div class="w-full lg:w-80 flex-shrink-0">
                        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-44 border border-gray-100">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-[#2CB38B]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                                    </svg>
                                    Filter Akomodasi
                                </h2>
                                <button type="submit"
                                    class="text-xs font-bold text-[#2CB38B] hover:underline">Terapkan</button>
                            </div>

                            <div class="mb-6 pb-6 border-b border-gray-100">
                                <h3 class="font-semibold text-gray-700 mb-3">Bintang Hotel</h3>
                                <div class="space-y-2">
                                    @foreach ([5, 4, 3] as $star)
                                        <label class="flex items-center space-x-3 cursor-pointer">
                                            <input type="checkbox" name="ratings[]" value="{{ $star }}"
                                                class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"
                                                {{ in_array($star, request('ratings', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="text-gray-600 flex items-center gap-1"><span
                                                    class="text-yellow-400">{{ str_repeat('★', $star) }}{{ str_repeat('☆', 5 - $star) }}</span></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-6 pb-6 border-b border-gray-100">
                                <h3 class="font-semibold text-gray-700 mb-3">Fasilitas</h3>
                                <div class="space-y-2">
                                    @foreach (['WiFi Gratis', 'Sarapan', 'Kolam Renang', 'Gym', 'Parkir'] as $facility)
                                        <label class="flex items-center space-x-3 cursor-pointer">
                                            <input type="checkbox" name="facilities[]" value="{{ $facility }}"
                                                class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"
                                                {{ in_array($facility, request('facilities', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="text-gray-600">{{ $facility }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div>
                                <h3 class="font-semibold text-gray-700 mb-3">Tipe Akomodasi</h3>
                                <div class="space-y-2">
                                    @foreach (['Hotel', 'Villa', 'Hostel'] as $type)
                                        <label class="flex items-center space-x-3 cursor-pointer">
                                            <input type="checkbox" name="types[]" value="{{ $type }}"
                                                class="w-5 h-5 text-[#2CB38B] rounded border-gray-300 focus:ring-[#2CB38B]"
                                                {{ in_array($type, request('types', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="text-gray-600">{{ $type }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Rekomendasi Akomodasi</h2>
                        @if ($accommodations->isEmpty())
                            <div class="bg-white rounded-2xl p-12 text-center border border-gray-100 shadow-sm">
                                <div
                                    class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                                    🏨</div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Tidak ada akomodasi ditemukan</h3>
                                <p class="text-gray-500">Coba ubah filter atau cari di kota lain.</p>
                            </div>
                        @else
                            @foreach ($accommodations as $acc)
                                <div
                                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5 hover:shadow-xl hover:border-[#2CB38B]/30 transition duration-300 group">
                                    <div class="flex flex-col md:flex-row gap-6">
                                        <div
                                            class="w-full md:w-1/3 h-48 bg-gray-200 rounded-xl overflow-hidden relative">
                                            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                                                alt="{{ $acc->hotelName }}"
                                                class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                                            <div
                                                class="absolute top-3 right-3 bg-white/90 px-2 py-1 rounded-lg text-xs font-bold text-[#2CB38B] shadow-sm flex items-center gap-1">
                                                <span>★</span> {{ $acc->rating }}
                                            </div>
                                        </div>

                                        <div class="w-full md:w-2/3 flex flex-col justify-between">
                                            <div>
                                                <div class="flex justify-between items-start">
                                                    <div>
                                                        <h3
                                                            class="text-xl font-bold text-gray-800 group-hover:text-[#2CB38B] transition">
                                                            {{ $acc->hotelName }}
                                                        </h3>

                                                        {{-- Tipe Akomodasi --}}
                                                        <span
                                                            class="inline-block mt-1 mb-1 bg-green-50 text-[#2CB38B] text-xs font-semibold px-3 py-1 rounded-full">
                                                            {{ $acc->type }}
                                                        </span>

                                                        {{-- Kota --}}
                                                        <p class="text-sm text-gray-500 mt-1 flex items-center gap-1">
                                                            <svg class="w-4 h-4 text-gray-400" fill="none"
                                                                stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            </svg>
                                                            {{ $acc->city->cityName }}
                                                        </p>
                                                    </div>

                                                    <div class="hidden sm:flex text-yellow-400 text-sm">
                                                        {{ str_repeat('★', floor($acc->rating)) }}
                                                    </div>
                                                </div>


                                                @if ($acc->facilities)
                                                    <div class="mt-4 flex flex-wrap gap-2">
                                                        @foreach (array_slice($acc->facilities, 0, 4) as $f)
                                                            <span
                                                                class="bg-green-50 text-[#2CB38B] text-xs px-3 py-1 rounded-full font-medium">{{ $f }}</span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="flex items-end justify-between mt-6">
                                                <div>
                                                    <p class="text-xs text-gray-400">Mulai dari</p>
                                                    <p class="text-2xl font-bold text-[#2CB38B]">Rp
                                                        {{ number_format($acc->averagePricePerNight, 0, ',', '.') }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">/ malam</p>
                                                </div>
                                                <a href="{{ route('accommodation.show', ['travelPlan' => $plan->planID, 'id' => $acc->accommodationID]) }}"
                                                    class="bg-[#2CB38B] hover:bg-[#249d78] text-white px-8 py-3 rounded-xl font-semibold transition shadow-lg hover:shadow-green-200 text-center">
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accordions = document.querySelectorAll('.accordion-btn');
            accordions.forEach(acc => {
                const content = acc.nextElementSibling;
                const icon = acc.querySelector('svg');
                content.style.maxHeight = content.scrollHeight + "px";
                icon.style.transform = "rotate(180deg)";
                acc.addEventListener('click', function() {
                    if (content.style.maxHeight) {
                        content.style.maxHeight = null;
                        icon.style.transform = "rotate(0deg)";
                    } else {
                        content.style.maxHeight = content.scrollHeight + "px";
                        icon.style.transform = "rotate(180deg)";
                    }
                });
            });
        });
    </script>
</x-app-layout>
