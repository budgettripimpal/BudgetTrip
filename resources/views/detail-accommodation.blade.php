<x-app-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2CB38B',
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

    <div class="min-h-screen pt-28 pb-12 bg-gray-50" x-data="{ showModal: false, quantity: 1 }">
        <div class="container mx-auto px-6">
            <button onclick="history.back()" class="mb-6 hover:bg-gray-200 p-2 rounded-full transition">
                <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden aspect-video">
                        <img src="{{ $accommodation->images[0] ?? 'https://placehold.co/600x400?text=Hotel' }}"
                            class="w-full h-full object-cover" alt="{{ $accommodation->hotelName ?? 'Hotel' }}">
                    </div>

                    @if (isset($accommodation->latitude) && isset($accommodation->longitude))
                        <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-lg">📍 Lokasi Hotel
                            </h3>
                            <div id="detailMap"></div>
                            <p class="text-xs text-gray-500 mt-3 text-center">
                                Koordinat: {{ $accommodation->latitude }}, {{ $accommodation->longitude }}
                            </p>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="bg-white rounded-3xl shadow-lg p-8 sticky top-24">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $accommodation->hotelName ?? 'Hotel' }}
                        </h1>
                        <div class="text-yellow-400 text-lg mb-4">★ {{ $accommodation->rating ?? '0' }}</div>
                        <p class="text-gray-600 leading-relaxed mb-6">
                            {{ $accommodation->description ?? 'Deskripsi tidak tersedia' }}</p>

                        <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-6 mb-8 text-center">
                            <p class="text-3xl font-bold text-gray-900">
                                Rp {{ number_format($accommodation->averagePricePerNight ?? 0, 0, ',', '.') }}
                                <span class="text-sm text-gray-500 font-normal">/ Malam</span>
                            </p>
                        </div>

                        <div class="space-y-4 mb-8 text-sm">
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Tipe</span>
                                <span class="text-gray-800 font-semibold">{{ $accommodation->type ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Fasilitas</span>
                                <div class="text-right">
                                    @if (isset($accommodation->facilities) && is_array($accommodation->facilities))
                                        @foreach ($accommodation->facilities as $f)
                                            <span
                                                class="inline-block bg-green-50 text-primary text-xs px-2 py-1 rounded font-bold mb-1">{{ $f }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between py-3">
                                <span class="text-gray-600 font-medium">Link Pemesanan</span>
                                @if (isset($accommodation->bookingLink) && $accommodation->bookingLink)
                                    <a href="{{ $accommodation->bookingLink }}" target="_blank"
                                        class="text-primary hover:underline font-bold">🔗 Buka Link</a>
                                @else
                                    <span class="text-gray-400 italic">Tidak tersedia</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center space-x-4 bg-gray-100 rounded-full px-6 py-3">
                                <button @click="if(quantity > 1) quantity--"
                                    class="w-8 h-8 font-bold hover:bg-gray-200 rounded-full">-</button>
                                <span class="text-2xl font-bold min-w-[40px] text-center" x-text="quantity">1</span>
                                <button @click="quantity++"
                                    class="w-8 h-8 font-bold hover:bg-gray-200 rounded-full">+</button>
                            </div>
                            <button @click="showModal = true"
                                class="flex-1 bg-primary hover:bg-green-600 text-white font-bold py-4 rounded-full shadow-lg transition">
                                Tambah ke Rencana
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
                <form action="{{ route('plan.add-item', $travelPlan->planID ?? 1) }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_type" value="Akomodasi">
                    <input type="hidden" name="item_id" value="{{ $accommodation->accommodationID ?? 0 }}">
                    <input type="hidden" name="quantity" x-model="quantity">
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

    @if (isset($accommodation->latitude) && isset($accommodation->longitude))
        <script>
            (function() {
                const lat = {{ $accommodation->latitude }};
                const lng = {{ $accommodation->longitude }};
                const name = "{{ $accommodation->hotelName ?? 'Hotel' }}";

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
                        console.error('Leaflet not loaded');
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
                            icon: createMarker('#eab308')
                        }).addTo(map).bindPopup(`<b>🟡 ${name}</b><br><small>Akomodasi</small>`).openPopup();

                        setTimeout(() => map.invalidateSize(), 500);
                    } catch (error) {
                        console.error('Map error:', error);
                    }
                }

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initMap);
                } else {
                    initMap();
                }
            })();
        </script>
    @endif
</x-app-layout>
