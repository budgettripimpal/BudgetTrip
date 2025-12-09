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
            @page {
                size: A4;
                margin: 0;
            }

            body {
                background: white;
                padding: 0;
                margin: 0;
                display: block;
            }

            .no-print {
                display: none !important;
            }

            .print-container {
                box-shadow: none;
                border: none;
                width: 100%;
                max-width: 100%;
                margin: 0;
                border-radius: 0;
            }

            .main-wrapper {
                padding: 40px;
                /* Margin kertas */
                min-h-0;
                /* Reset min-h-screen */
                display: block;
            }
        }
    </style>
</head>

<body class="main-wrapper flex flex-col items-center justify-center min-h-screen p-6">

    <div class="mb-6 flex gap-4 no-print">
        <button onclick="window.print()"
            class="bg-[#2CB38B] hover:bg-green-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
            </svg>
            Cetak / Simpan PDF
        </button>
        <button onclick="window.close()"
            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded-full shadow-lg transition">Tutup</button>
    </div>

    <div class="print-container bg-white w-full max-w-3xl rounded-3xl shadow-xl overflow-hidden border border-gray-200">

        <div class="bg-[#2CB38B] px-8 py-6 text-white flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="bg-white/20 p-2 rounded-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold tracking-tight">HOTEL VOUCHER</h1>
                    <p class="text-xs opacity-90 font-medium tracking-wide">CONFIRMED BOOKING</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-[10px] uppercase tracking-wider opacity-80 mb-1">Booking Reference</p>
                <p class="text-xl ticket-font font-bold bg-white/10 px-3 py-1 rounded">{{ $item->ticket_code }}</p>
            </div>
        </div>

        <div class="p-8">
            <div class="flex justify-between items-start mb-8 border-b border-dashed border-gray-200 pb-6">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-1">{{ $item->providerName }}</h2>
                    <p class="text-gray-500 flex items-center gap-1 text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ $item->itinerary->travelPlan->destinationCity->cityName }}
                    </p>
                </div>
                <div class="text-right">
                    <span
                        class="bg-green-100 text-green-700 px-3 py-1 rounded text-xs font-bold border border-green-200">LUNAS
                        / PAID</span>
                </div>
            </div>

            <div class="grid grid-cols-4 gap-4 mb-6">
                <div class="col-span-2 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Tamu Utama</p>
                    <p class="font-bold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                </div>
                <div class="col-span-1 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Kamar</p>
                    <p class="font-bold text-gray-800">{{ $item->quantity }} Unit</p>
                </div>
                <div class="col-span-1 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <p class="text-[10px] text-gray-400 uppercase font-bold mb-1">Durasi</p>
                    <p class="font-bold text-gray-800">{{ $item->duration ?? 1 }} Malam</p>
                </div>
            </div>

            <div class="flex gap-4 mb-8">
                <div class="flex-1 bg-green-50/50 rounded-xl p-4 border border-green-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-green-100 rounded-full -mr-8 -mt-8"></div>
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Check-In</p>
                    <p class="text-lg font-bold text-gray-800">
                        {{ \Carbon\Carbon::parse($item->itinerary->travelPlan->startDate)->format('d M Y') }}</p>
                    <p class="text-xs text-gray-500 mt-1">Mulai 14:00 WIB</p>
                </div>

                <div class="flex items-center text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </div>

                <div class="flex-1 bg-red-50/50 rounded-xl p-4 border border-red-100 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-16 h-16 bg-red-100 rounded-full -mr-8 -mt-8"></div>
                    <p class="text-[10px] text-gray-500 uppercase font-bold mb-1">Check-Out</p>
                    <p class="text-lg font-bold text-gray-800">
                        {{ \Carbon\Carbon::parse($item->itinerary->travelPlan->startDate)->addDays($item->duration ?? 1)->format('d M Y') }}
                    </p>
                    <p class="text-xs text-gray-500 mt-1">Sebelum 12:00 WIB</p>
                </div>
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-100">
                <div>
                    <p class="text-xs text-gray-400 font-bold mb-1">BUTUH BANTUAN?</p>
                    <p class="text-sm text-gray-600">Hubungi <strong>cs@budgettrip.com</strong></p>
                    <p class="text-[10px] text-gray-400 mt-2">Tunjukkan voucher ini saat check-in di resepsionis.</p>
                </div>
                <div class="bg-white p-1 border border-gray-200 rounded-lg">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=80x80&data={{ $item->ticket_code }}"
                        class="w-20 h-20">
                </div>
            </div>
        </div>

        <div
            class="h-2 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iOCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMCAwaDIwbDIwIDhIMjB6IiBmaWxsPSIjMkNCMzhCIiBmaWxsLW9wYWNpdHk9IjAuNCIvPjwvc3ZnPg==')]">
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>

</html>
