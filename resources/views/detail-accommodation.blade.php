<x-app-layout>
    {{-- 1. LOAD LIBRARY & CSS DARI KODE 1 (Agar Peta Muncul) --}}
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

    {{-- NAVIGASI --}}
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

    <div class="min-h-screen bg-gray-50 pt-28 pb-12" x-data="{ showModal: false, quantity: 1, duration: 1 }">
        <div class="container mx-auto px-6">
            <button onclick="history.back()" class="mb-6 hover:bg-gray-200 p-2 rounded-full transition">
                <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="grid lg:grid-cols-2 gap-8">

                <div class="space-y-8">
                    {{-- Gambar --}}
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden aspect-video">
                        <img src="{{ $accommodation->images[0] ?? 'https://placehold.co/600x400?text=Hotel' }}"
                            class="w-full h-full object-cover">
                    </div>

                    {{-- PETA (Wadah HTML Peta) --}}
                    @if (isset($accommodation->latitude) && isset($accommodation->longitude))
                        <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100 relative">
                            <h3 class="font-bold text-gray-800 mb-2 flex items-center gap-2">
                                <span class="bg-blue-50 text-blue-600 p-1.5 rounded-lg text-sm">📍</span> Lokasi Hotel
                            </h3>
                            {{-- Container ID ini harus cocok dengan script di bawah --}}
                            <div id="detailMap"></div>
                            <p class="text-xs text-gray-400 mt-2 text-center font-mono">
                                {{ $accommodation->latitude }}, {{ $accommodation->longitude }}
                            </p>
                        </div>
                    @endif
                </div>

                <div>
                    <div class="bg-white rounded-3xl shadow-lg p-8 sticky top-24">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $accommodation->hotelName }}</h1>
                        <div class="text-yellow-400 text-lg mb-4">
                            {{ str_repeat('★', floor($accommodation->rating)) }} <span
                                class="text-gray-400 text-sm">({{ $accommodation->rating }})</span></div>
                        <p class="text-gray-600 leading-relaxed mb-6">{{ $accommodation->description }}</p>

                        <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-6 mb-8 text-center">
                            <p class="text-3xl font-bold text-gray-900">Rp
                                {{ number_format($accommodation->averagePricePerNight, 0, ',', '.') }} <span
                                    class="text-sm text-gray-500 font-normal">/ Malam</span></p>
                        </div>

                        <div class="space-y-4 mb-8 text-sm">
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Tipe</span><span
                                    class="text-gray-800 font-bold">{{ $accommodation->type }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Fasilitas</span>
                                <div class="text-right">
                                    @if ($accommodation->facilities)
                                        @foreach ($accommodation->facilities as $f)
                                            <span
                                                class="inline-block bg-green-50 text-[#2CB38B] text-xs px-2 py-1 rounded font-bold mb-1">{{ $f }}</span>
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </div>
                            </div>
                            <div class="flex justify-between py-3">
                                <span class="text-gray-600 font-medium">Link Booking</span>
                                @if ($accommodation->bookingLink)
                                    <a href="{{ $accommodation->bookingLink }}" target="_blank"
                                        class="text-[#2CB38B] hover:underline font-bold">🔗 Buka Link</a>
                                @else
                                    <span class="text-gray-400 italic">Tidak tersedia</span>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 ml-1">Jumlah Kamar</label>
                                <div
                                    class="flex items-center justify-between bg-gray-100 rounded-xl px-4 py-3 border border-gray-200">
                                    <button @click="if(quantity > 1) quantity--"
                                        class="w-6 h-6 font-bold text-gray-500 hover:text-black transition">-</button>
                                    <span class="text-lg font-bold text-gray-800" x-text="quantity">1</span>
                                    <button @click="quantity++"
                                        class="w-6 h-6 font-bold text-gray-500 hover:text-black transition">+</button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 mb-1 ml-1">Durasi (Malam)</label>
                                <div
                                    class="flex items-center justify-between bg-gray-100 rounded-xl px-4 py-3 border border-gray-200">
                                    <button @click="if(duration > 1) duration--"
                                        class="w-6 h-6 font-bold text-gray-500 hover:text-black transition">-</button>
                                    <span class="text-lg font-bold text-gray-800" x-text="duration">1</span>
                                    <button @click="duration++"
                                        class="w-6 h-6 font-bold text-gray-500 hover:text-black transition">+</button>
                                </div>
                            </div>
                        </div>

                        <button @click="showModal = true"
                            class="w-full bg-[#2CB38B] hover:bg-[#249d78] text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                            Tambah ke Rencana
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- MODAL --}}
        <div x-show="showModal"
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
            style="display: none;">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative m-4 transform transition-all">
                <button @click="showModal = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">✖</button>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Simpan ke Rencana</h3>

                <div class="bg-green-50 p-4 rounded-xl mb-4 text-sm border border-green-100">
                    <div class="flex justify-between mb-1 text-gray-600"><span>Kamar:</span> <span
                            class="font-bold text-gray-900"><span x-text="quantity"></span> Unit</span></div>
                    <div class="flex justify-between mb-2 text-gray-600"><span>Durasi:</span> <span
                            class="font-bold text-gray-900"><span x-text="duration"></span> Malam</span></div>
                    <div class="flex justify-between border-t border-green-200 pt-2 mt-2">
                        <span class="font-bold text-gray-700">Total Estimasi:</span>
                        <span class="font-bold text-xl text-[#2CB38B]">Rp <span
                                x-text="(quantity * duration * {{ $accommodation->averagePricePerNight }}).toLocaleString('id-ID')"></span></span>
                    </div>
                </div>

                <form action="{{ route('plan.add-item', $travelPlan->planID) }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_type" value="Akomodasi">
                    <input type="hidden" name="item_id" value="{{ $accommodation->accommodationID }}">
                    <input type="hidden" name="quantity" x-model="quantity">
                    <input type="hidden" name="duration" x-model="duration">

                    <div class="space-y-3 mb-6 max-h-60 overflow-y-auto">
                        <p class="text-xs font-bold text-gray-500 mb-2 uppercase">Pilih Folder Rencana:</p>
                        @foreach ($itineraries as $itinerary)
                            <label
                                class="flex items-center justify-between p-3 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-[#2CB38B] transition">
                                <div class="flex items-center gap-3"><span class="text-lg">📁</span> <span
                                        class="font-bold text-gray-700 text-sm">{{ $itinerary->itineraryName }}</span>
                                </div>
                                <input type="radio" name="itinerary_id" value="{{ $itinerary->itineraryID }}"
                                    class="w-5 h-5 text-[#2CB38B]" required checked>
                            </label>
                        @endforeach
                    </div>
                    <button type="submit"
                        class="w-full bg-[#2CB38B] hover:bg-[#249d78] text-white font-bold py-3 rounded-xl shadow-lg">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    {{-- SCRIPTS --}}
    {{-- Load Library di sini, bukan di @push, untuk memastikan termuat --}}
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    {{-- SCRIPT INIT PETA DARI KODE 1 (YANG BEKERJA) --}}
    @if (isset($accommodation->latitude) && isset($accommodation->longitude))
        <script>
            (function() {
                const lat = {{ $accommodation->latitude }};
                const lng = {{ $accommodation->longitude }};
                const name = "{{ $accommodation->hotelName ?? 'Hotel' }}";

                // Fungsi membuat custom marker agar terlihat seperti Kode 1
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
                    // Cek apakah library Leaflet sudah termuat
                    if (typeof L === 'undefined') {
                        console.error('Leaflet not loaded yet, retrying...');
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

                        // Gunakan marker custom
                        L.marker([lat, lng], {
                            icon: createMarker('#eab308') // Warna kuning
                        }).addTo(map).bindPopup(`<b>🟡 ${name}</b><br><small>Akomodasi</small>`).openPopup();

                        // Fix agar map tidak abu-abu saat baru diload
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