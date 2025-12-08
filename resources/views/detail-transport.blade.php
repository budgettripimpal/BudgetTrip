<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transportasi - Budget Trip</title>

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

        /* MAP STYLING - HEIGHT WAJIB! */
        #detailMap {
            height: 400px !important;
            width: 100% !important;
            border-radius: 12px;
            background: #f3f4f6;
            position: relative;
            z-index: 0;
            /* Level rendah agar tidak menutupi modal */
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
</head>

<body class="bg-gray-50">
    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 h-20">
        <div class="container mx-auto px-6 h-full flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                </svg>
                <span class="text-2xl font-bold"><span class="text-gray-900">BUDGET</span><span
                        class="text-primary">TRIP</span></span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 hidden md:inline font-medium">Welcome,
                    {{ Auth::user()->name ?? 'User' }}</span>
                <div class="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-bold">
                    {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen pt-28 pb-12" x-data="{ showModal: false, quantity: 1 }">
        <div class="container mx-auto px-6">
            <button onclick="history.back()" class="mb-6 hover:bg-gray-200 p-2 rounded-full transition">
                <svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>

            <div class="grid lg:grid-cols-2 gap-8">
                <div class="space-y-6">
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden aspect-video">
                        <img src="{{ $transport->images[0] ?? 'https://placehold.co/600x400?text=No+Image' }}"
                            class="w-full h-full object-cover"
                            alt="{{ $transport->serviceProvider->providerName ?? 'Transport' }}">
                    </div>

                    {{-- MAP SECTION --}}
                    @if (isset($transport->start_latitude) && isset($transport->start_longitude))
                        <div class="bg-white rounded-3xl shadow-lg p-6 border border-gray-100">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2 text-lg">📍 Lokasi
                                Keberangkatan</h3>
                            <div id="detailMap"></div>
                            <p class="text-xs text-gray-500 mt-3 text-center">
                                Koordinat: {{ $transport->start_latitude }}, {{ $transport->start_longitude }}
                            </p>
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
                            <p class="text-3xl font-bold text-gray-900">
                                Rp {{ number_format($transport->averagePrice ?? 0, 0, ',', '.') }}
                                <span class="text-sm text-gray-500 font-normal">/ Orang</span>
                            </p>
                        </div>

                        <div class="space-y-4 mb-8 text-sm">
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Tipe Layanan</span>
                                <span class="text-gray-800 font-semibold">{{ $transport->class ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Waktu</span>
                                <span class="text-gray-800 font-semibold">
                                    {{ \Carbon\Carbon::parse($transport->departureTime)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($transport->arrivalTime)->format('H:i') }}
                                </span>
                            </div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Fasilitas</span>
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
                            <div class="flex justify-between py-3">
                                <span class="text-gray-600 font-medium">Link Pembelian</span>
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

        {{-- MODAL (Z-Index Tinggi 9999) --}}
        <div x-show="showModal" x-cloak
            class="fixed inset-0 z-[9999] flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm"
            style="display: none;">

            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative m-4 z-[10000]">
                <button @click="showModal = false"
                    class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 text-2xl w-8 h-8 flex items-center justify-center">✖</button>
                <h3 class="text-2xl font-bold mb-4">Simpan ke Rencana</h3>
                <form action="{{ route('plan.add-item', $travelPlan->planID ?? 1) }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_type" value="Transportasi">
                    <input type="hidden" name="item_id" value="{{ $transport->routeID ?? 0 }}">
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

    {{-- LEAFLET JS & INIT --}}
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

                        // Marker Merah untuk Transportasi
                        L.marker([lat, lng], {
                            icon: createMarker('#ef4444')
                        }).addTo(map).bindPopup(`<b>🔴 ${name}</b><br><small>Titik Keberangkatan</small>`).openPopup();

                        setTimeout(() => map.invalidateSize(), 500);
                        console.log('✅ Map rendered successfully');
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
</body>

</html>
