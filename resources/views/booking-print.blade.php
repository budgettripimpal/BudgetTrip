<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher Hotel - {{ $item->ticket_code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&family=Plus+Jakarta+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f3f4f6;
            -webkit-print-color-adjust: exact;
        }

        .ticket-font {
            font-family: 'Courier Prime', monospace;
        }

        @media print {
            body {
                background: white;
            }

            .no-print {
                display: none;
            }

            .shadow-2xl {
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen p-6">

    <div class="mb-8 flex gap-4 no-print">
        <button onclick="window.print()"
            class="bg-[#2CB38B] hover:bg-green-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak Voucher
        </button>
        <button onclick="window.close()"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition">Tutup</button>
    </div>

    <div class="bg-white w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden relative border border-gray-200">
        <div class="bg-[#2CB38B] p-8 text-white flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold tracking-tight">HOTEL VOUCHER</h1>
                <p class="opacity-90 mt-1 font-medium">BudgetTrip Reservation</p>
            </div>
            <div class="text-right">
                <p class="text-xs uppercase tracking-wider opacity-80">Booking ID</p>
                <p class="text-2xl ticket-font font-bold">{{ $item->ticket_code }}</p>
            </div>
        </div>

        <div class="p-8">
            <div class="flex flex-col md:flex-row gap-8 mb-8 border-b border-dashed border-gray-300 pb-8">
                <div class="w-full md:w-3/4">
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">{{ $item->providerName }}</h2>
                    <p class="text-gray-500 text-lg mb-4 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $item->itinerary->travelPlan->destinationCity->cityName }}
                    </p>

                    <div class="flex gap-2">
                        <span
                            class="bg-blue-100 text-blue-700 px-4 py-1.5 rounded-lg text-sm font-bold border border-blue-200">Confirmed</span>
                        <span
                            class="bg-green-100 text-green-700 px-4 py-1.5 rounded-lg text-sm font-bold border border-green-200">PAID</span>
                        <span
                            class="bg-gray-100 text-gray-700 px-4 py-1.5 rounded-lg text-sm font-bold border border-gray-200">{{ $item->quantity }}
                            Kamar</span>
                    </div>
                </div>

                <div
                    class="w-full md:w-1/4 bg-gray-50 rounded-2xl p-4 text-center border border-gray-200 flex flex-col justify-center">
                    <p class="text-gray-400 text-xs uppercase font-bold tracking-widest mb-2">Nomor Kamar</p>

                    @php
                        $roomNumbers = explode(', ', $item->room_number ?? '');
                    @endphp

                    @if (count($roomNumbers) > 1)
                        <div class="flex flex-wrap justify-center gap-2">
                            @foreach ($roomNumbers as $room)
                                <span
                                    class="bg-white border border-gray-300 px-2 py-1 rounded font-bold text-[#2CB38B] text-lg shadow-sm">{{ $room }}</span>
                            @endforeach
                        </div>
                    @else
                        <p class="text-4xl font-bold text-[#2CB38B]">{{ $item->room_number ?? 'TBA' }}</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-y-6 gap-x-4 mb-8">
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold mb-1">Tamu Utama</p>
                    <p class="font-bold text-gray-800 text-lg">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold mb-1">Durasi Menginap</p>
                    <p class="font-bold text-gray-800 text-lg">{{ $item->duration ?? 1 }} Malam</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold mb-1">Check-In</p>
                    <p class="font-bold text-gray-800 text-lg">
                        {{ \Carbon\Carbon::parse($item->itinerary->travelPlan->startDate)->format('d M Y') }}</p>
                    <p class="text-sm text-gray-500">14:00 WIB</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase font-bold mb-1">Check-Out</p>
                    <p class="font-bold text-gray-800 text-lg">
                        {{ \Carbon\Carbon::parse($item->itinerary->travelPlan->startDate)->addDays($item->duration ?? 1)->format('d M Y') }}
                    </p>
                    <p class="text-sm text-gray-500">12:00 WIB</p>
                </div>
            </div>

            <div
                class="flex flex-col md:flex-row justify-between items-end bg-gray-50 rounded-2xl p-6 border border-gray-100">
                <div class="mb-4 md:mb-0">
                    <p class="text-xs text-gray-400 mb-1 uppercase font-bold">Layanan Pelanggan</p>
                    <p class="text-sm text-gray-600">Butuh bantuan? Hubungi <strong>cs@budgettrip.com</strong></p>
                </div>
                <div class="text-center flex items-center gap-4">
                    <div class="text-right hidden md:block">
                        <p class="text-xs text-gray-400 uppercase font-bold">Scan Validasi</p>
                        <p class="text-[10px] text-gray-400">Tunjukkan saat check-in</p>
                    </div>
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $item->ticket_code }}"
                        class="w-20 h-20 mix-blend-multiply p-1 bg-white rounded-lg border border-gray-200">
                </div>
            </div>
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
