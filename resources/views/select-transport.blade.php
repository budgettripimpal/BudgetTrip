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

            .ring-primary:focus {
                --tw-ring-color: #2CB38B;
            }

            input[type="checkbox"]:checked {
                background-color: #2CB38B;
                border-color: #2CB38B;
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

                    <div class="flex items-center flex-1">
                        <div class="flex flex-col items-center relative z-10">
                            <div
                                class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-lg ring-4 ring-green-100 transform scale-110">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18 20H6c-1.1 0-2-.9-2-2V6c0-2.2 1.8-4 4-4h8c2.2 0 4 1.8 4 4v12c0 1.1-.9 2-2 2zm-2-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-9h8V4H8v4z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center">Pilih<br>Transportasi</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </div>

                    <a href="{{ route('travel-plan.accommodation', $plan->planID) }}"
                        class="flex items-center flex-1 group cursor-pointer">
                        <div class="flex flex-col items-center relative z-10">
                            <div
                                class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2 transition-all duration-300 group-hover:bg-green-100 group-hover:text-[#2CB38B] group-hover:scale-110 group-hover:shadow-md">
                                <svg class="w-8 h-8 text-gray-400 group-hover:text-[#2CB38B]" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <p
                                class="text-xs font-semibold text-gray-400 text-center group-hover:text-[#2CB38B] group-hover:underline">
                                Pilih<br>Akomodasi</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </a>

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
            <form action="{{ route('travel-plan.transport', $plan->planID) }}" method="GET" id="filterForm">
                <div class="flex flex-col lg:flex-row gap-8">

                    <div class="w-full lg:w-80 flex-shrink-0">
                        <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-44 border border-gray-100">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">Filter</h2>
                                <button type="submit"
                                    class="text-xs font-bold text-[#2CB38B] hover:underline">Terapkan</button>
                            </div>

                            <div class="mb-6 pb-6 border-b border-gray-100">
                                <h3 class="font-semibold text-gray-700 mb-3">Jenis Transportasi</h3>
                                <div class="space-y-2">
                                    @foreach (['Shuttle', 'Bus', 'Kereta', 'Pesawat', 'Kapal'] as $type)
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

                            <div class="mb-6 pb-6 border-b border-gray-100">
                                <h3 class="font-semibold text-gray-700 mb-3">Fasilitas</h3>
                                <div class="space-y-2">
                                    @foreach (['Bagasi', 'AC', 'Makanan', 'Wifi'] as $facility)
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
                                <h3 class="font-semibold text-gray-700 mb-3">Waktu Berangkat</h3>
                                <div class="space-y-2">
                                    @foreach (['pagi' => 'Pagi (06-12)', 'siang' => 'Siang (12-18)', 'malam' => 'Malam (18-06)'] as $val => $label)
                                        <label class="flex items-center space-x-3 cursor-pointer">
                                            <input type="checkbox" name="times[]" value="{{ $val }}"
                                                class="w-5 h-5 text-[#2CB38B] rounded border-gray-300"
                                                {{ in_array($val, request('times', [])) ? 'checked' : '' }}
                                                onchange="this.form.submit()">
                                            <span class="text-gray-600">{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-1">

                        {{-- 1. BAGIAN REKOMENDASI TRANSIT --}}
                        @if (isset($transitRoutes) && $transitRoutes->isNotEmpty())
                            <div class="mb-8">
                                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                                    <span class="bg-blue-100 text-blue-700 p-1.5 rounded-lg text-lg">✈️</span>
                                    Rekomendasi Transit
                                </h2>

                                {{-- LOOPING TRANSIT ROUTES (INI YANG MEMPERBAIKI ERROR UNDEFINED VARIABLE) --}}
                                @foreach ($transitRoutes as $transit)
                                    <div
                                        class="bg-white rounded-2xl shadow-sm border border-blue-200 p-6 relative overflow-hidden mb-6">
                                        <div
                                            class="absolute top-0 right-0 bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-bl-xl">
                                            Via {{ $transit['hub_name'] }}</div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-2">
                                            <div>
                                                <div class="flex items-center gap-2 mb-3">
                                                    <span
                                                        class="w-6 h-6 rounded-full bg-gray-800 text-white flex items-center justify-center text-xs font-bold">1</span>
                                                    <h3 class="font-bold text-gray-700 text-sm">
                                                        {{ $transit['step1_label'] }}</h3>
                                                </div>
                                                <div class="space-y-3">
                                                    @foreach ($transit['feeders'] as $transport)
                                                        <div
                                                            class="border border-gray-200 rounded-lg p-3 flex justify-between items-center hover:border-blue-400 transition bg-gray-50">
                                                            <div>
                                                                <p class="font-bold text-sm">
                                                                    {{ $transport->serviceProvider->providerName }}</p>
                                                                <p class="text-xs text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($transport->departureTime)->format('H:i') }}
                                                                    WIB</p>
                                                                <p class="text-[10px] text-gray-400 mt-0.5">
                                                                    {{ $transport->originCity->cityName }} &rarr;
                                                                    {{ $transport->destinationCity->cityName }}</p>
                                                            </div>
                                                            <div class="text-right">
                                                                <p class="text-xs font-bold text-[#2CB38B] mb-1">Rp
                                                                    {{ number_format($transport->averagePrice, 0, ',', '.') }}
                                                                </p>
                                                                <a href="{{ route('transport.show', [$plan->planID, $transport->routeID]) }}"
                                                                    class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded-lg font-bold hover:bg-blue-700 shadow-sm inline-block">Lihat
                                                                    Detail</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2 mb-3">
                                                    <span
                                                        class="w-6 h-6 rounded-full bg-gray-800 text-white flex items-center justify-center text-xs font-bold">2</span>
                                                    <h3 class="font-bold text-gray-700 text-sm">
                                                        {{ $transit['step2_label'] }}</h3>
                                                </div>
                                                <div class="space-y-3">
                                                    @foreach ($transit['main_transport'] as $transport)
                                                        <div
                                                            class="border border-gray-200 rounded-lg p-3 flex justify-between items-center hover:border-blue-400 transition bg-gray-50">
                                                            <div>
                                                                <p class="font-bold text-sm">
                                                                    {{ $transport->serviceProvider->providerName }}</p>
                                                                <p class="text-xs text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($transport->departureTime)->format('H:i') }}
                                                                    WIB</p>
                                                                <p class="text-[10px] text-gray-400 mt-0.5">
                                                                    {{ $transport->originCity->cityName }} &rarr;
                                                                    {{ $transport->destinationCity->cityName }}</p>
                                                            </div>
                                                            <div class="text-right">
                                                                <p class="text-xs font-bold text-[#2CB38B] mb-1">Rp
                                                                    {{ number_format($transport->averagePrice, 0, ',', '.') }}
                                                                </p>
                                                                <a href="{{ route('transport.show', [$plan->planID, $transport->routeID]) }}"
                                                                    class="text-xs bg-blue-600 text-white px-3 py-1.5 rounded-lg font-bold hover:bg-blue-700 shadow-sm inline-block">Pilih</a>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        {{-- 2. BAGIAN RUTE LANGSUNG (DEFAULT) --}}
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <span class="bg-green-100 text-green-700 p-1.5 rounded-lg text-lg">🚌</span> Transportasi
                            Langsung
                        </h2>

                        @if ($transportRoutes->isEmpty())
                            <div class="bg-white rounded-2xl p-12 text-center border border-dashed border-gray-300">
                                <div
                                    class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Tidak ada rute langsung ditemukan</h3>
                                <p class="text-gray-500 mb-6">Coba ubah filter atau gunakan opsi transit jika tersedia.
                                </p>
                                <a href="{{ route('travel-plan.edit', $plan->planID) }}"
                                    class="text-[#2CB38B] font-bold hover:underline">Ubah Pencarian</a>
                            </div>
                        @else
                            @foreach ($transportRoutes as $route)
                                @php $isFull = $route->remaining_seats <= 0; @endphp

                                <div
                                    class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-5 hover:shadow-xl hover:border-[#2CB38B]/30 transition duration-300 group relative overflow-hidden {{ $isFull ? 'opacity-80 grayscale-[0.5]' : '' }}">
                                    <div
                                        class="absolute top-0 left-0 w-1 h-full {{ $isFull ? 'bg-gray-300' : 'bg-[#2CB38B]' }}">
                                    </div>

                                    <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                                        <div class="flex items-center gap-4">
                                            {{-- ICON & TIPE TRANSPORTASI --}}
                                            <div
                                                class="w-14 h-14 bg-blue-50 rounded-xl flex items-center justify-center text-3xl shadow-sm border border-blue-100">
                                                @php
                                                    $pName = $route->serviceProvider->providerName;

                                                    // Default: Shuttle/Travel
                                                    $icon = '🚐';
                                                    $typeLabel = 'Shuttle/Travel';

                                                    // Bus
                                                    if (
                                                        str_contains($pName, 'Bus') ||
                                                        str_contains($pName, 'DAMRI') ||
                                                        str_contains($pName, 'Rosalia') ||
                                                        str_contains($pName, 'Primajasa') ||
                                                        str_contains($pName, 'Sinar Jaya')
                                                    ) {
                                                        $icon = '🚌';
                                                        $typeLabel = 'Bus';
                                                    }

                                                    // Kereta Api
                                                    elseif (
                                                        str_contains($pName, 'KA') ||
                                                        str_contains($pName, 'Kereta') ||
                                                        str_contains($pName, 'Railink')
                                                    ) {
                                                        $icon = '🚂';
                                                        $typeLabel = 'Kereta Api';
                                                    }

                                                    // Kapal Ferry
                                                    elseif (
                                                        str_contains($pName, 'Ferry') ||
                                                        str_contains($pName, 'Kapal') ||
                                                        str_contains($pName, 'Pelni') ||
                                                        str_contains($pName, 'ASDP')
                                                    ) {
                                                        $icon = '🚢';
                                                        $typeLabel = 'Kapal Ferry';
                                                    }

                                                    // Pesawat
                                                    elseif (
                                                        str_contains($pName, 'Air') ||
                                                        str_contains($pName, 'Garuda') ||
                                                        str_contains($pName, 'Lion') ||
                                                        str_contains($pName, 'Super Air') ||
                                                        str_contains($pName, 'Batik')
                                                    ) {
                                                        $icon = '✈️';
                                                        $typeLabel = 'Pesawat';
                                                    }
                                                @endphp

                                                {{ $icon }}

                                            </div>

                                            <div>
                                                {{-- NAMA PROVIDER & LABEL TIPE --}}
                                                <div class="flex items-center gap-2">
                                                    <h3
                                                        class="text-xl font-bold text-gray-800 group-hover:text-[#2CB38B] transition">
                                                        {{ $pName }}
                                                    </h3>
                                                    <span
                                                        class="bg-gray-100 text-gray-600 text-[10px] px-2 py-0.5 rounded border border-gray-200 uppercase font-bold tracking-wide">
                                                        {{ $typeLabel }}
                                                    </span>
                                                </div>

                                                <div class="flex items-center gap-2 mt-1">
                                                    <span
                                                        class="inline-block bg-blue-50 text-blue-600 text-xs px-2 py-1 rounded-md font-bold border border-blue-100">
                                                        {{ $route->class }}
                                                    </span>
                                                    @if ($isFull)
                                                        <span
                                                            class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full font-bold">Habis</span>
                                                    @else
                                                        <span
                                                            class="bg-green-100 text-green-700 text-xs px-2 py-1 rounded-full font-bold flex items-center gap-1">
                                                            <span
                                                                class="w-1.5 h-1.5 bg-green-500 rounded-full animate-pulse"></span>
                                                            Sisa {{ $route->remaining_seats }}
                                                        </span>
                                                    @endif
                                                </div>

                                                @if ($route->facilities)
                                                    <div class="flex flex-wrap gap-1 mt-2">
                                                        @foreach ($route->facilities as $facility)
                                                            <span
                                                                class="text-[10px] bg-gray-50 text-gray-500 px-1.5 py-0.5 rounded border border-gray-200">
                                                                {{ $facility }}
                                                            </span>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div
                                            class="text-left md:text-right mt-4 md:mt-0 bg-gray-50 p-3 rounded-xl border border-gray-100 md:bg-transparent md:border-0 md:p-0">
                                            <p class="text-xs text-gray-400 font-bold uppercase mb-0.5">Harga Tiket</p>
                                            <p class="text-2xl font-extrabold text-[#2CB38B]">Rp
                                                {{ number_format($route->averagePrice, 0, ',', '.') }}</p>
                                            <p class="text-[10px] text-gray-400">/ penumpang</p>
                                        </div>
                                    </div>

                                    {{-- JADWAL PERJALANAN --}}
                                    <div
                                        class="flex flex-col md:flex-row items-center justify-between bg-gray-50 rounded-xl p-5 border border-gray-200 relative">
                                        <div
                                            class="hidden md:block absolute top-1/2 left-20 right-40 h-0.5 border-t-2 border-dashed border-gray-300 -z-0">
                                        </div>

                                        <div
                                            class="flex items-center justify-between w-full md:w-auto gap-8 relative z-10">
                                            <div class="text-center min-w-[80px]">
                                                <p class="text-xl font-bold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($route->departureTime)->format('H:i') }}
                                                </p>
                                                <div
                                                    class="bg-white border border-gray-200 px-2 py-1 rounded-md mt-1 inline-block">
                                                    <p class="text-[10px] font-bold text-gray-500 uppercase">
                                                        {{ substr($plan->originCity->cityName, 0, 3) }}</p>
                                                </div>
                                                <p class="text-[10px] text-gray-400 mt-1">
                                                    {{ $plan->originCity->cityName }}</p>
                                            </div>

                                            <div
                                                class="flex flex-col items-center bg-white px-3 py-1 rounded-full border border-gray-200 shadow-sm">
                                                @php
                                                    $start = \Carbon\Carbon::parse($route->departureTime);
                                                    $end = \Carbon\Carbon::parse($route->arrivalTime);
                                                    if ($end->lt($start)) {
                                                        $end->addDay();
                                                    }
                                                    $diff = $start->diff($end);
                                                @endphp
                                                <p class="text-[10px] text-gray-400 font-bold mb-0.5">DURASI</p>
                                                <p class="text-xs font-bold text-gray-700">{{ $diff->h }}j
                                                    {{ $diff->i }}m</p>
                                            </div>

                                            <div class="text-center min-w-[80px]">
                                                <p class="text-xl font-bold text-gray-800">
                                                    {{ \Carbon\Carbon::parse($route->arrivalTime)->format('H:i') }}</p>
                                                <div
                                                    class="bg-white border border-gray-200 px-2 py-1 rounded-md mt-1 inline-block">
                                                    <p class="text-[10px] font-bold text-gray-500 uppercase">
                                                        {{ substr($plan->destinationCity->cityName, 0, 3) }}</p>
                                                </div>
                                                <p class="text-[10px] text-gray-400 mt-1">
                                                    {{ $plan->destinationCity->cityName }}</p>
                                            </div>
                                        </div>

                                        @if ($isFull)
                                            <button disabled
                                                class="w-full md:w-auto mt-4 md:mt-0 bg-gray-200 text-gray-400 px-6 py-3 rounded-xl font-bold cursor-not-allowed border border-gray-300">
                                                Kursi Penuh
                                            </button>
                                        @else
                                            <a href="{{ route('transport.show', ['travelPlan' => $plan->planID, 'id' => $route->routeID]) }}"
                                                class="w-full md:w-auto mt-4 md:mt-0 bg-[#2CB38B] hover:bg-[#249d78] text-white px-6 py-3 rounded-xl font-bold transition shadow-lg hover:shadow-green-200 flex items-center justify-center gap-2 transform active:scale-95">
                                                Pilih Tiket
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                </svg>
                                            </a>
                                        @endif
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
                content.style.maxHeight = content.scrollHeight + "px"; // Default open
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
