<x-app-layout>
    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

            .hover\:text-primary:hover {
                color: #2CB38B;
            }

            .hover\:bg-primary:hover {
                background-color: #2CB38B;
            }

            .no-scrollbar::-webkit-scrollbar {
                display: none;
            }

            .no-scrollbar {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    @endpush

    {{-- 1. LIBRARY SNAP (SAMA PERSIS DENGAN MANAGE PLAN) --}}
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 h-20">
        <div class="container mx-auto px-6 h-full flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" />
                </svg>
                <span class="text-2xl font-bold tracking-tight"><span class="text-gray-900">BUDGET</span><span
                        class="text-[#2CB38B]">TRIP</span></span>
            </div>
            <div class="flex items-center space-x-4">
                <span class="text-gray-600 font-medium">Welcome, {{ Auth::user()->name }}</span>
                <div
                    class="w-10 h-10 bg-[#2CB38B] rounded-full flex items-center justify-center text-white font-bold text-lg">
                    {{ substr(Auth::user()->name, 0, 1) }}</div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen bg-gray-50 pt-28 pb-12" x-data>

        {{-- 2. SCRIPT PEMICU POPUP (SAMA PERSIS DENGAN MANAGE PLAN) --}}
        @if (session('snapToken'))
            <script type="text/javascript">
                document.addEventListener("DOMContentLoaded", function(event) {
                    console.log("Snap Token ditemukan: {{ session('snapToken') }}");
                    window.snap.pay('{{ session('snapToken') }}', {
                        onSuccess: function(result) {
                            window.location.href = "{{ route('payment.success') }}?order_id=" + result.order_id;
                        },
                        onPending: function(result) {
                            alert("Menunggu pembayaran!");
                        },
                        onError: function(result) {
                            alert("Pembayaran gagal!");
                        },
                        onClose: function() {
                            alert('Anda membatalkan pembayaran');
                        }
                    });
                });
            </script>
        @endif

        <div class="container mx-auto px-6 max-w-5xl">

            {{-- ALERT ERROR --}}
            @if (session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Gagal!</strong> <span
                        class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- ALERT SUCCESS --}}
            @if (session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <strong class="font-bold">Berhasil!</strong> <span
                        class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-lg p-8 mb-8 relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-green-50 rounded-full mix-blend-multiply filter blur-3xl opacity-70 -translate-y-1/2 translate-x-1/2">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <h1 class="text-3xl font-bold text-gray-900">{{ $plan->planName }}</h1>
                            <span class="bg-blue-100 text-blue-600 text-xs px-3 py-1 rounded-full font-bold">Ringkasan
                                Perjalanan</span>
                        </div>
                        <div
                            class="flex flex-col sm:flex-row sm:items-center text-gray-500 gap-2 sm:gap-6 text-sm mb-4">
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg> {{ $plan->originCity->cityName }} &rarr;
                                {{ $plan->destinationCity->cityName }}</span>
                            <span class="flex items-center gap-1"><svg class="w-4 h-4" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg> {{ \Carbon\Carbon::parse($plan->startDate)->format('d M Y') }} -
                                {{ \Carbon\Carbon::parse($plan->endDate)->format('d M Y') }}</span>
                        </div>

                        <div class="inline-block bg-gray-50 border border-gray-200 rounded-xl px-4 py-2">
                            <span class="text-xs text-gray-500 uppercase font-bold">Target Budget</span>
                            <p class="text-xl font-bold text-gray-800">Rp
                                {{ number_format($plan->amount, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <a href="{{ route('travel-plan.manage', $plan->planID) }}"
                        class="flex items-center gap-2 bg-[#2CB38B] hover:bg-[#249d78] text-white px-6 py-3 rounded-xl font-bold transition shadow-lg hover:shadow-green-200 transform hover:-translate-y-1">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit / Atur Rencana
                    </a>
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

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden relative">
                        <div
                            class="absolute top-0 right-0 px-4 py-1 rounded-bl-xl text-xs font-bold text-white {{ $isOver ? 'bg-red-500' : 'bg-[#2CB38B]' }}">
                            {{ $isOver ? 'Over Budget' : 'Aman' }}
                        </div>

                        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">📂</span>
                                <div>
                                    <h2 class="text-lg font-bold text-gray-800">{{ $itinerary->itineraryName }}</h2>
                                    <p class="text-xs text-gray-500">Estimasi Total: <strong>Rp
                                            {{ number_format($totalCost, 0, ',', '.') }}</strong></p>
                                </div>
                            </div>
                        </div>

                        <div class="px-6 pt-4 pb-2">
                            <div class="flex justify-between text-xs mb-1">
                                <span class="text-gray-500">Budget Terpakai</span>
                                <span class="{{ $isOver ? 'text-red-500' : 'text-[#2CB38B]' }} font-bold">
                                    {{ $isOver ? 'Lebih:' : 'Sisa:' }} Rp
                                    {{ number_format(abs($remaining), 0, ',', '.') }}
                                </span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full {{ $isOver ? 'bg-red-500' : 'bg-[#2CB38B]' }}"
                                    style="width: {{ min($percentage, 100) }}%"></div>
                            </div>
                        </div>

                        <div class="p-6 space-y-8">

                            @foreach (['Transportasi' => '🚌', 'Akomodasi' => '🏨', 'Aktivitas' => '🏖️'] as $type => $icon)
                                @php
                                    $checkTypes = $type == 'Aktivitas' ? ['Aktivitas', 'Wisata'] : [$type];
                                    $items = $itinerary->planItems->whereIn('itemType', $checkTypes);
                                @endphp

                                @if ($items->isNotEmpty())
                                    <div>
                                        <h3 class="text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                            <span
                                                class="{{ $type == 'Transportasi' ? 'bg-blue-100 text-blue-600' : ($type == 'Akomodasi' ? 'bg-yellow-100 text-yellow-600' : 'bg-purple-100 text-purple-600') }} p-1.5 rounded-lg">{{ $icon }}</span>
                                            {{ $type == 'Aktivitas' ? 'Wisata' : $type }}
                                        </h3>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            @foreach ($items as $item)
                                                <div
                                                    class="flex items-start gap-3 p-3 rounded-lg border border-gray-100 bg-white hover:border-gray-300 transition">
                                                    <div
                                                        class="w-10 h-10 rounded-lg flex-shrink-0 flex items-center justify-center text-lg {{ $type == 'Transportasi' ? 'bg-blue-50' : ($type == 'Akomodasi' ? 'bg-yellow-50' : 'bg-purple-50') }}">
                                                        {{ $icon }}
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <p class="font-bold text-gray-800 text-sm truncate">
                                                            {{ $item->providerName }}</p>
                                                        <p class="text-xs text-gray-500 truncate">
                                                            {{ $item->description }}</p>

                                                        <div class="flex justify-between items-center mt-2 mb-2">
                                                            <span
                                                                class="text-[10px] bg-gray-100 text-gray-600 px-2 py-0.5 rounded">Qty:
                                                                {{ $item->quantity }}</span>
                                                            <p class="text-sm font-bold text-[#2CB38B]">Rp
                                                                {{ number_format($item->estimatedCost, 0, ',', '.') }}
                                                            </p>
                                                        </div>

                                                        {{-- 3. LOGIKA TOMBOL PEMBAYARAN --}}
                                                        @php
                                                            $isBudgettrip = \Illuminate\Support\Str::contains(
                                                                strtolower($item->providerName),
                                                                'budgettrip',
                                                            );
                                                            $isPaid = $item->order && $item->order->status == 'paid';
                                                        @endphp

                                                        @if ($isBudgettrip)
                                                            @if ($isPaid)
                                                                <span
                                                                    class="text-[10px] text-green-600 font-bold bg-green-50 px-2 py-1 rounded inline-block w-full text-center border border-green-200">
                                                                    ✅ Lunas - Tiket Terbit
                                                                </span>
                                                            @else
                                                                {{-- FORM POST KE CONTROLLER --}}
                                                                <form
                                                                    action="{{ route('payment.checkout', $item->planItemID) }}"
                                                                    method="POST" class="w-full">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="w-full text-white bg-[#2CB38B] hover:bg-green-700 font-medium rounded-lg text-[10px] px-3 py-1.5 text-center shadow-sm transition">
                                                                        💳 Bayar Sekarang
                                                                    </button>
                                                                </form>
                                                            @endif
                                                        @elseif($item->bookingLink)
                                                            <a href="{{ $item->bookingLink }}" target="_blank"
                                                                class="text-[10px] text-blue-500 hover:text-blue-700 hover:underline flex items-center gap-1">
                                                                🔗 Link Booking Eksternal
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach

                            @if ($itinerary->planItems->isEmpty())
                                <p class="text-center text-gray-400 italic py-4">Belum ada item di rencana ini.</p>
                            @endif

                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-3xl shadow-sm border border-dashed border-gray-300">
                        <p class="text-gray-400">Belum ada folder rencana yang dibuat.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-10 text-center pb-8">
                <a href="{{ route('travel-plan.index') }}"
                    class="text-gray-500 hover:text-gray-800 font-medium transition">&larr; Kembali ke Daftar Rencana
                    Saya</a>
            </div>
        </div>
    </div>
</x-app-layout>
