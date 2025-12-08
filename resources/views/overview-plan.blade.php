<x-app-layout>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <style>
        #map {
            height: 400px !important;
            width: 100%;
            border-radius: 12px 12px 0 0;
            z-index: 0;
        }

        .leaflet-pane {
            z-index: 0 !important;
        }

        /* Custom Marker Icons */
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

        /* Legenda Styling */
        .map-legend {
            background: white;
            border-radius: 0 0 12px 12px;
            padding: 16px;
            border-top: 2px solid #e5e7eb;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #374151;
        }

        .legend-dot {
            width: 16px;
            height: 16px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* Animation for markers */
        .leaflet-marker-icon {
            animation: markerBounce 0.5s ease-out;
        }

        @keyframes markerBounce {
            0% {
                transform: translateY(-20px);
                opacity: 0;
            }

            50% {
                transform: translateY(5px);
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
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

    <div class="min-h-screen bg-gray-50 pt-28 pb-12" x-data>

        {{-- LOGIKA POPUP MIDTRANS --}}
        @if (session('snapToken'))
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    window.snap.pay('{{ session('snapToken') }}', {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('payment.success') }}?order_id=" + result
                                .order_id;
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran!");
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal!");
                        },
                        onClose: function() {
                            alert('Anda menutup popup pembayaran');
                        }
                    });
                });
            </script>
        @endif

        <div class="container mx-auto px-6 max-w-5xl">

            @if (session('error'))
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Gagal!</strong> {{ session('error') }}
                </div>
            @endif
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    <strong class="font-bold">Berhasil!</strong> {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-lg p-8 mb-8 relative overflow-hidden">
                <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $plan->planName }}</h1>
                        <div class="flex items-center gap-4 text-sm text-gray-600">
                            <span>📅 {{ \Carbon\Carbon::parse($plan->startDate)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($plan->endDate)->format('d M Y') }}</span>
                            <span class="font-bold text-[#2CB38B]">Budget: Rp
                                {{ number_format($plan->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('travel-plan.manage', $plan->planID) }}"
                        class="bg-[#2CB38B] hover:bg-[#249d78] text-white px-6 py-3 rounded-xl font-bold transition shadow-lg">
                        Edit Rencana
                    </a>
                </div>
            </div>

            <!-- Map Container dengan Legend -->
            <div class="bg-white rounded-3xl shadow-lg mb-8 border border-gray-100 overflow-hidden">
                <div class="p-4 border-b border-gray-100">
                    <h2 class="text-lg font-bold text-gray-800">📍 Peta Sebaran Lokasi</h2>
                </div>
                <div id="map"></div>

                <!-- Legenda -->
                <div class="map-legend">
                    <h3 class="text-sm font-bold text-gray-700 mb-3">Keterangan Lokasi:</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                        <div class="legend-item">
                            <div class="legend-dot" style="background-color: #ef4444;"></div>
                            <span>Transportasi</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background-color: #eab308;"></div>
                            <span>Akomodasi</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background-color: #a855f7;"></div>
                            <span>Wisata</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background-color: #3b82f6;"></div>
                            <span>Kota Asal</span>
                        </div>
                        <div class="legend-item">
                            <div class="legend-dot" style="background-color: #22c55e;"></div>
                            <span>Kota Tujuan</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-8">
                @forelse($plan->itineraries as $itinerary)
                    @php
                        $totalCost = $itinerary->planItems->sum('estimatedCost');
                        $remaining = $plan->amount - $totalCost;
                        $percentage = $plan->amount > 0 ? ($totalCost / $plan->amount) * 100 : 0;
                        $isOver = $remaining < 0;
                    @endphp

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                            <h2 class="text-lg font-bold text-gray-800">📂 {{ $itinerary->itineraryName }}</h2>
                            <span
                                class="text-xs font-bold px-3 py-1 rounded-full text-white {{ $isOver ? 'bg-red-500' : 'bg-[#2CB38B]' }}">
                                {{ $isOver ? 'Over Budget' : 'Aman' }}
                            </span>
                        </div>

                        <div class="px-6 pt-4 pb-2">
                            <div class="flex justify-between text-xs mb-1">
                                <span>Terpakai: Rp {{ number_format($totalCost, 0, ',', '.') }}</span>
                                <span class="{{ $isOver ? 'text-red-500' : 'text-[#2CB38B]' }} font-bold">
                                    {{ $isOver ? 'Kurang' : 'Sisa' }}: Rp
                                    {{ number_format(abs($remaining), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full {{ $isOver ? 'bg-red-500' : 'bg-[#2CB38B]' }}"
                                    style="width: {{ min($percentage, 100) }}%"></div>
                            </div>
                        </div>

                        <div class="p-6 space-y-6">
                            @foreach (['Transportasi' => '🚌', 'Akomodasi' => '🏨', 'Aktivitas' => '🏖️'] as $type => $icon)
                                @php
                                    $checkTypes = $type == 'Aktivitas' ? ['Aktivitas', 'Wisata'] : [$type];
                                    $items = $itinerary->planItems->whereIn('itemType', $checkTypes);
                                @endphp

                                @if ($items->isNotEmpty())
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-600 mb-3 flex items-center gap-2">
                                            {{ $icon }} {{ $type == 'Aktivitas' ? 'Wisata' : $type }}</h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            @foreach ($items as $item)
                                                <div
                                                    class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 bg-white hover:border-gray-300 transition">
                                                    <div class="flex-1 min-w-0">
                                                        <p class="font-bold text-gray-800 text-sm">
                                                            {{ $item->providerName }}</p>
                                                        <p class="text-xs text-gray-500 truncate">
                                                            {{ $item->description }}</p>

                                                        <div class="flex justify-between items-center mt-2 mb-2">
                                                            <span
                                                                class="text-[10px] bg-gray-100 px-2 py-0.5 rounded">Jumlah:
                                                                {{ $item->quantity }}</span>
                                                            <p class="text-sm font-bold text-[#2CB38B]">Rp
                                                                {{ number_format($item->estimatedCost, 0, ',', '.') }}
                                                            </p>
                                                        </div>

                                                        @php
                                                            $isBudgettrip = \Illuminate\Support\Str::contains(
                                                                strtolower($item->providerName),
                                                                'budgettrip',
                                                            );
                                                            $isPaid = $item->order && $item->order->status == 'paid';
                                                        @endphp

                                                        @if ($isBudgettrip)
                                                            @if ($isPaid)
                                                                <div
                                                                    class="w-full bg-green-50 border border-green-200 text-green-700 text-[10px] font-bold py-1.5 rounded text-center">
                                                                    ✅ Lunas</div>
                                                            @else
                                                                <form
                                                                    action="{{ route('payment.checkout', $item->planItemID) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="w-full bg-[#2CB38B] hover:bg-green-700 text-white text-[10px] font-bold py-1.5 rounded shadow-sm transition">💳
                                                                        Bayar</button>
                                                                </form>
                                                            @endif
                                                        @elseif($item->bookingLink)
                                                            <a href="{{ $item->bookingLink }}" target="_blank"
                                                                class="block w-full bg-blue-50 text-blue-600 text-[10px] font-bold py-1.5 rounded text-center hover:bg-blue-100">🔗
                                                                Link Booking</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-gray-400 border-2 border-dashed rounded-2xl">Belum ada rencana.
                    </div>
                @endforelse
            </div>

            <div class="mt-8 text-center">
                <a href="{{ route('travel-plan.index') }}" class="text-gray-500 hover:text-gray-900">&larr;
                    Kembali</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek Leaflet
            if (typeof L === 'undefined') {
                console.error("Leaflet gagal dimuat");
                return;
            }

            var map = L.map('map').setView([-2.5, 118], 5);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            var bounds = [];

            function createColoredMarker(color) {
                return L.divIcon({
                    className: 'custom-marker',
                    html: `<div class="marker-pin" style="background-color: ${color};"></div>`,
                    iconSize: [30, 42],
                    iconAnchor: [15, 42],
                    popupAnchor: [0, -42]
                });
            }

            // 1. KOTA ASAL (Biru)
            @if ($plan->originCity && $plan->originCity->latitude)
                L.marker([{{ $plan->originCity->latitude }}, {{ $plan->originCity->longitude }}], {
                    icon: createColoredMarker('#3b82f6')
                }).addTo(map).bindPopup("<b>🔵 Asal</b><br>{{ $plan->originCity->cityName }}");
                bounds.push([{{ $plan->originCity->latitude }}, {{ $plan->originCity->longitude }}]);
            @endif

            // 2. KOTA TUJUAN (Hijau)
            @if ($plan->destinationCity && $plan->destinationCity->latitude)
                L.marker([{{ $plan->destinationCity->latitude }}, {{ $plan->destinationCity->longitude }}], {
                    icon: createColoredMarker('#22c55e')
                }).addTo(map).bindPopup("<b>🟢 Tujuan</b><br>{{ $plan->destinationCity->cityName }}");
                bounds.push([{{ $plan->destinationCity->latitude }}, {{ $plan->destinationCity->longitude }}]);
            @endif

            // 3. ITEM RENCANA dengan Marker Pin
            @foreach ($plan->itineraries as $itinerary)
                @foreach ($itinerary->planItems as $item)
                    @if ($item->latitude && $item->longitude)
                        var lat = {{ $item->latitude }};
                        var lng = {{ $item->longitude }};
                        var itemType = "{{ $item->itemType }}";
                        var color, emoji;

                        if (itemType === 'Transportasi') {
                            color = '#ef4444'; // Merah
                            emoji = '🔴';
                        } else if (itemType === 'Akomodasi') {
                            color = '#eab308'; // Kuning/Emas
                            emoji = '🟡';
                        } else {
                            color = '#a855f7'; // Ungu untuk Wisata/Aktivitas
                            emoji = '🟣';
                        }

                        L.marker([lat, lng], {
                            icon: createColoredMarker(color)
                        }).addTo(map).bindPopup(
                            `<b>${emoji} {{ $item->providerName }}</b><br><small>{{ $item->itemType }}</small>`
                        );

                        bounds.push([lat, lng]);
                    @endif
                @endforeach
            @endforeach

            // Fit bounds jika ada marker
            if (bounds.length > 0) {
                map.fitBounds(bounds, {
                    padding: [50, 50]
                });
            }

            // Fix Render Issue
            setTimeout(function() {
                map.invalidateSize();
            }, 500);
        });
    </script>
</x-app-layout>
