<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2CB38B'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="" />

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        #detailMap {
            height: 400px !important;
            width: 100% !important;
            border-radius: 12px;
            background: #f3f4f6;
            position: relative;
            z-index: 0;
        }

        .leaflet-pane,
        .leaflet-top,
        .leaflet-bottom {
            z-index: 1 !important;
        }

        .leaflet-control {
            z-index: 2 !important;
        }

        .leaflet-popup {
            z-index: 3 !important;
        }

        .custom-marker {
            background: none;
            border: none;
        }

        .marker-pin {
            width: 30px;
            height: 30px;
            border-radius: 50% 50% 50% 0;
            position: relative;
            transform: rotate(-45deg);
            left: -15px;
            top: -15px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .marker-pin::after {
            content: '';
            width: 14px;
            height: 14px;
            margin: 8px 0 0 8px;
            background: #fff;
            position: absolute;
            border-radius: 50%;
        }
    </style>

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

    <div class="min-h-screen pt-28 pb-12 bg-gray-50" x-data="{
        showModal: false,
        quantity: 1,
        maxSeats: {{ $transport->remaining_seats ?? 0 }}
    }">
        <div class="container mx-auto px-6">
            <button onclick="history.back()" class="mb-6 hover:bg-gray-200 p-2 rounded-full transition"><svg
                    class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg></button>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden aspect-video"><img
                            src="{{ $transport->images[0] ?? 'https://placehold.co/600x400?text=No+Image' }}"
                            class="w-full h-full object-cover"
                            alt="{{ $transport->serviceProvider->providerName ?? 'Transport' }}"></div>
                    @if (isset($transport->start_latitude) && isset($transport->start_longitude))
                        <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-lg">📍 Lokasi
                                Keberangkatan</h3>
                            <div id="detailMap"></div>
                            <p class="text-xs text-gray-500 mt-3 text-center">Koordinat:
                                {{ $transport->start_latitude }}, {{ $transport->start_longitude }}</p>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="bg-white rounded-3xl shadow-lg p-8 sticky top-24">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">
                            {{ $transport->serviceProvider->providerName ?? 'Transportasi' }}</h1>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ $transport->description ?? 'Deskripsi tidak tersedia' }}</p>

                        <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-6 mb-8 text-center">
                            <p class="text-3xl font-bold text-gray-900">Rp
                                {{ number_format($transport->averagePrice ?? 0, 0, ',', '.') }} <span
                                    class="text-sm text-gray-500 font-normal">/ Orang</span></p>
                        </div>
                        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <span class="text-2xl">💺</span>
                                Jumlah Kursi
                            </h3>

                            @php
                                $isFull = ($transport->remaining_seats ?? 0) <= 0;
                            @endphp

                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                                {{-- KELAS --}}
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Kelas</p>
                                    <p class="text-lg font-bold text-gray-800">
                                        {{ $transport->class ?? 'Reguler' }}
                                    </p>
                                </div>

                                {{-- TOTAL KURSI --}}
                                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <p class="text-xs text-gray-500 font-bold uppercase mb-1">Total Kursi</p>
                                    <p class="text-lg font-bold text-gray-800">
                                        {{ $transport->total_seats ?? '-' }}
                                    </p>
                                </div>

                                {{-- SISA KURSI --}}
                                <div
                                    class="rounded-xl p-4 border
            {{ $isFull ? 'bg-red-50 border-red-200' : 'bg-green-50 border-green-200' }}">
                                    <p
                                        class="text-xs font-bold uppercase mb-1
                {{ $isFull ? 'text-red-700' : 'text-green-700' }}">
                                        Sisa Kursi
                                    </p>

                                    @if ($isFull)
                                        <p class="text-lg font-extrabold text-red-600">
                                            Habis
                                        </p>
                                    @else
                                        <p class="text-lg font-extrabold text-green-700 flex items-center gap-2">
                                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                            {{ $transport->remaining_seats }} kursi tersedia
                                        </p>
                                    @endif
                                </div>
                            </div>

                            {{-- ========================= --}}
                            {{-- PROGRESS BAR KURSI --}}
                            {{-- ========================= --}}
                            @if (!empty($transport->total_seats) && $transport->total_seats > 0)
                                @php
                                    $percentage = max(
                                        0,
                                        min(100, round(($transport->remaining_seats / $transport->total_seats) * 100)),
                                    );
                                @endphp

                                <div class="mt-6">
                                    <div class="flex justify-between items-center text-xs text-gray-500 font-bold mb-1">
                                        <span>Ketersediaan Kursi</span>
                                        <span>{{ $percentage }}%</span>
                                    </div>

                                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                                        <div class="h-3 rounded-full transition-all duration-500
                    {{ $percentage > 30 ? 'bg-green-500' : 'bg-red-500' }}"
                                            style="width: {{ $percentage }}%">
                                        </div>
                                    </div>

                                    <p class="text-[11px] text-gray-400 mt-2">
                                        {{ $transport->remaining_seats }} dari {{ $transport->total_seats }} kursi
                                        tersedia
                                    </p>
                                </div>
                            @endif
                        </div>

                        <div class="space-y-4 mb-8 text-sm">
                            <div class="flex justify-between py-3 border-b border-gray-200"><span
                                    class="text-gray-600 font-medium">Tipe Layanan</span><span
                                    class="text-gray-800 font-semibold">{{ $transport->class ?? '-' }}</span></div>
                            <div class="flex justify-between py-3 border-b border-gray-200"><span
                                    class="text-gray-600 font-medium">Waktu</span><span
                                    class="text-gray-800 font-semibold">{{ \Carbon\Carbon::parse($transport->departureTime)->format('H:i') }}
                                    - {{ \Carbon\Carbon::parse($transport->arrivalTime)->format('H:i') }}</span></div>
                            <div class="flex justify-between py-3 border-b border-gray-200"><span
                                    class="text-gray-600 font-medium">Fasilitas</span>
                                <div class="text-right">
                                    @if (isset($transport->facilities) && is_array($transport->facilities))
                                        @foreach ($transport->facilities as $fac)
                                            <span
                                                class="inline-block bg-green-50 text-primary text-xs px-2 py-1 rounded font-bold mb-1">{{ $fac }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between py-3"><span class="text-gray-600 font-medium">Link
                                    Pembelian</span>
                                @if (isset($transport->bookingLink) && $transport->bookingLink)
                                    <a href="{{ $transport->bookingLink }}" target="_blank"
                                        class="text-primary hover:underline font-bold">🔗 Buka Link</a>
                                @else
                                    <span class="text-gray-400 italic">Tidak tersedia</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center space-x-4 bg-gray-100 rounded-full px-6 py-3">
                                <button @click="if(quantity > 1) quantity--" :disabled="quantity <= 1"
                                    class="w-8 h-8 font-bold rounded-fulldisabled:opacity-40 disabled:cursor-not-allowedhover:bg-gray-200">
                                    -
                                </button>

                                <span class="text-2xl font-bold min-w-[40px] text-center" x-text="quantity"></span>

                                <button @click="if(quantity < maxSeats) quantity++" :disabled="quantity >= maxSeats"
                                    class="w-8 h-8 font-bold rounded-full disabled:opacity-40 disabled:cursor-not-allowed hover:bg-gray-200">
                                    +
                                </button>

                            </div>
                            <button @click="showModal = true" :disabled="maxSeats <= 0"
                                class="flex-1 font-bold py-4 rounded-full shadow-lg transition
        {{ ($transport->remaining_seats ?? 0) <= 0
            ? 'bg-gray-400 cursor-not-allowed text-white'
            : 'bg-primary hover:bg-green-600 text-white' }}">
                                {{ ($transport->remaining_seats ?? 0) <= 0 ? 'Kursi Habis' : 'Tambah ke Rencana' }}
                            </button>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showModal" x-cloak
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50"
            style="display: none;">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative m-4">
                <button @click="showModal = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">✖</button>
                <h3 class="text-2xl font-bold mb-4">Simpan ke Rencana</h3>
                <div class="bg-green-50 p-4 rounded-xl mb-4 text-sm border border-green-100">
                    <div class="flex justify-between mb-1 text-gray-600">
                        <span>Jumlah Penumpang:</span>
                        <span class="font-bold text-gray-900">
                            <span x-text="quantity"></span> Orang
                        </span>
                    </div>

                    <div class="flex justify-between mb-2 text-gray-600">
                        <span>Harga / Orang:</span>
                        <span class="font-bold text-gray-900">
                            Rp {{ number_format($transport->averagePrice ?? 0, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="flex justify-between border-t border-green-200 pt-2 mt-2">
                        <span class="font-bold text-gray-700">Total Estimasi:</span>
                        <span class="font-bold text-xl text-[#2CB38B]">
                            Rp <span
                                x-text="(quantity * {{ $transport->averagePrice ?? 0 }}).toLocaleString('id-ID')">
                            </span>
                        </span>
                    </div>
                </div>

                <form action="{{ route('plan.add-item', $travelPlan->planID ?? 1) }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_type" value="Transportasi">
                    <input type="hidden" name="item_id" value="{{ $transport->routeID ?? 0 }}">
                    <input type="hidden" name="quantity" :value="Math.min(quantity, maxSeats)">
                    <div class="space-y-3 mb-6 max-h-60 overflow-y-auto">
                        @if (isset($itineraries))
                            @foreach ($itineraries as $itinerary)
                                <label
                                    class="flex items-center gap-3 p-3 border rounded cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="itinerary_id" value="{{ $itinerary->itineraryID }}"
                                        {{ $loop->first ? 'checked' : '' }}>
                                    <span>{{ $itinerary->itineraryName }}</span>
                                </label>
                            @endforeach
                        @endif
                    </div>
                    <button type="submit"
                        class="w-full bg-primary hover:bg-green-600 text-white font-bold py-3 rounded-xl">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @if (isset($transport->start_latitude) && isset($transport->start_longitude))
        <script>
            (function() {
                const lat = {{ $transport->start_latitude }};
                const lng = {{ $transport->start_longitude }};
                const name = "{{ $transport->serviceProvider->providerName ?? 'Transport' }}";

                function createMarker(color) {
                    return L.divIcon({
                        className: 'custom-marker',
                        html: `<div class="marker-pin" style="background-color: ${color};"></div>`,
                        iconSize: [30, 42],
                        iconAnchor: [15, 42],
                        popupAnchor: [0, -42]
                    });
                }

                function initMap() {
                    if (typeof L === 'undefined') {
                        setTimeout(initMap, 500);
                        return;
                    }
                    const container = document.getElementById('detailMap');
                    if (!container) return;

                    try {
                        const map = L.map('detailMap').setView([lat, lng], 15);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; OpenStreetMap contributors',
                            maxZoom: 19
                        }).addTo(map);
                        L.marker([lat, lng], {
                            icon: createMarker('#ef4444')
                        }).addTo(map).bindPopup(`<b>🔴 ${name}</b><br><small>Titik Jemput</small>`).openPopup();
                        setTimeout(() => map.invalidateSize(), 500);
                    } catch (error) {
                        console.error('Map error:', error);
                    }
                }
                if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', initMap);
                else initMap();
            })();
        </script>
    @endif
</x-app-layout>
