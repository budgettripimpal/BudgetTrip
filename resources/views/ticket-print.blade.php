<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Tiket - {{ $item->ticket_code }}</title>
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

            .ticket-container {
                box-shadow: none;
                border: 1px solid #000;
            }
        }
    </style>
</head>

<body class="flex flex-col items-center justify-center min-h-screen p-4">

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

    <div
        class="ticket-container bg-white w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row border border-gray-200 relative">

        <div class="flex-1 p-8 relative">
            <div class="flex justify-between items-start mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-[#2CB38B] tracking-tight">BUDGET<span
                            class="text-gray-900">TRIP</span></h1>
                    <p class="text-xs text-gray-500 font-bold tracking-widest uppercase mt-1">Boarding Pass</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400 uppercase">Booking Ref</p>
                    <p class="text-lg font-bold text-gray-900 ticket-font">{{ $item->ticket_code }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mb-8 border-b-2 border-dashed border-gray-200 pb-8">
                <div class="text-center w-1/3">
                    <p class="text-4xl font-bold text-gray-800">
                        {{ substr($item->itinerary->travelPlan->originCity->cityName, 0, 3) }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase">
                        {{ $item->itinerary->travelPlan->originCity->cityName }}</p>
                </div>
                <div class="flex-1 flex flex-col items-center">
                    <svg class="w-8 h-8 text-[#2CB38B] mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                    <p class="text-xs font-bold text-gray-400">
                        {{ \Carbon\Carbon::parse($item->itinerary->travelPlan->startDate)->format('d M Y') }}</p>
                </div>
                <div class="text-center w-1/3">
                    <p class="text-4xl font-bold text-gray-800">
                        {{ substr($item->itinerary->travelPlan->destinationCity->cityName, 0, 3) }}</p>
                    <p class="text-xs text-gray-500 mt-1 uppercase">
                        {{ $item->itinerary->travelPlan->destinationCity->cityName }}</p>
                </div>
            </div>
            @if ($item->itemType === 'Transportasi' && $item->transportRoute)
                <div class="grid grid-cols-2 gap-6 mb-6 mt-4">
                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">
                        <p class="text-xs text-gray-400 uppercase mb-1 font-bold">Waktu Berangkat</p>
                        <p class="text-xl font-bold text-gray-800 ticket-font">
                            {{ \Carbon\Carbon::parse($item->transportRoute->departureTime)->format('H:i') }}
                        </p>
                    </div>

                    <div class="bg-gray-50 border border-gray-200 rounded-xl p-4 text-right">
                        <p class="text-xs text-gray-400 uppercase mb-1 font-bold">Waktu Tiba</p>
                        <p class="text-xl font-bold text-gray-800 ticket-font">
                            {{ \Carbon\Carbon::parse($item->transportRoute->arrivalTime)->format('H:i') }}
                        </p>
                    </div>
                </div>
            @endif

            <div class="grid grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-xs text-gray-400 uppercase mb-1">Pemesan</p>
                    <p class="font-bold text-gray-800">{{ Auth::user()->name }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-400 uppercase mb-1">Operator</p>
                    <p class="font-bold text-gray-800">{{ $item->providerName }}</p>
                </div>
            </div>

            <div class="bg-gray-50 rounded-xl p-4 border border-gray-100 flex justify-between items-center">
                <div>
                    <p class="text-xs text-gray-500 uppercase mb-1 font-bold">Total Penumpang</p>
                    <p class="text-xl font-bold text-[#2CB38B]">{{ $item->quantity }} Orang</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500 uppercase mb-1 font-bold text-right">Kategori</p>
                    <p class="text-sm font-bold text-gray-800 text-right">{{ $item->description }}</p>
                </div>
            </div>

            <div class="absolute -right-4 top-1/2 w-8 h-8 bg-[#f3f4f6] rounded-full"></div>
        </div>

        <div class="w-full md:w-64 bg-[#2CB38B] p-8 text-white flex flex-col justify-between relative overflow-hidden">
            <div class="absolute -left-4 top-1/2 w-8 h-8 bg-[#f3f4f6] rounded-full"></div>
            <div class="absolute left-0 top-4 bottom-4 border-l-2 border-dashed border-white/30"></div>

            <div class="text-center z-10">
                <p class="text-xs opacity-70 uppercase tracking-widest mb-2">Scan Here</p>
                <div class="bg-white p-2 rounded-lg inline-block">
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $item->ticket_code }}"
                        class="w-24 h-24">
                </div>
            </div>

            <div class="text-center z-10 mt-6">
                <p class="text-sm font-bold opacity-90 mb-1">Total Paid</p>
                <p class="text-2xl font-bold">Rp {{ number_format($item->estimatedCost, 0, ',', '.') }}</p>
                <div class="mt-4 px-3 py-1 bg-white/20 rounded-full text-xs font-bold inline-block">LUNAS</div>
            </div>

            <div class="absolute bottom-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-10 -mb-10 pointer-events-none">
            </div>
            <div class="absolute top-0 left-0 w-20 h-20 bg-white/10 rounded-full -ml-10 -mt-10 pointer-events-none">
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
