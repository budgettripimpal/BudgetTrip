<x-app-layout>
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style> body { font-family: 'Plus Jakarta Sans', sans-serif; } </style>
    @endpush

    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 h-20">
        <div class="container mx-auto px-6 h-full flex items-center justify-between">
            <div class="flex items-center space-x-2"><svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg><span class="text-2xl font-bold"><span class="text-gray-900">BUDGET</span><span class="text-[#2CB38B]">TRIP</span></span></div>
            <div class="flex items-center space-x-4"><span class="text-gray-600 font-medium">Welcome, {{ Auth::user()->name }}</span><div class="w-10 h-10 bg-[#2CB38B] rounded-full flex items-center justify-center text-white font-bold">{{ substr(Auth::user()->name, 0, 1) }}</div></div>
        </div>
    </nav>

    <div class="min-h-screen bg-gray-50 pt-28 pb-12" x-data="{ showModal: false, quantity: 1 }">
        <div class="container mx-auto px-6">
            <button onclick="history.back()" class="mb-6 hover:bg-gray-200 p-2 rounded-full transition"><svg class="w-8 h-8 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg></button>

            <div class="grid lg:grid-cols-2 gap-8">
                <div>
                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden mb-4 aspect-video"><img src="{{ $accommodation->images[0] ?? 'https://placehold.co/600x400?text=Hotel' }}" class="w-full h-full object-cover"></div>
                </div>

                <div>
                    <div class="bg-white rounded-3xl shadow-lg p-8">
                        <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $accommodation->hotelName }}</h1>
                        <div class="text-yellow-400 text-lg mb-4">{{ str_repeat('★', floor($accommodation->rating)) }} <span class="text-gray-400 text-sm">({{ $accommodation->rating }})</span></div>
                        <p class="text-gray-600 leading-relaxed mb-8">{{ $accommodation->description ?? 'Deskripsi hotel tidak tersedia.' }}</p>

                        <div class="bg-gray-50 border-2 border-gray-200 rounded-2xl p-6 mb-8 text-center">
                            <p class="text-3xl font-bold text-gray-900">Rp {{ number_format($accommodation->averagePricePerNight, 0, ',', '.') }} <span class="text-sm text-gray-500 font-normal">/ Malam</span></p>
                        </div>

                        <div class="space-y-4 mb-8 text-sm">
                            <div class="flex justify-between py-3 border-b border-gray-200"><span class="text-gray-600 font-medium">Tipe</span><span class="text-gray-800 font-semibold">{{ $accommodation->type }}</span></div>
                            <div class="flex justify-between py-3 border-b border-gray-200">
                                <span class="text-gray-600 font-medium">Fasilitas</span>
                                <div class="text-right">
                                    @if($accommodation->facilities) @foreach($accommodation->facilities as $f) <span class="inline-block bg-green-50 text-[#2CB38B] text-xs px-2 py-1 rounded font-bold mb-1">{{ $f }}</span> @endforeach @else - @endif
                                </div>
                            </div>
                            
                            <div class="flex justify-between py-3">
                                <span class="text-gray-600 font-medium">Link Pemesanan</span>
                                @if($accommodation->bookingLink)
                                    <a href="{{ $accommodation->bookingLink }}" target="_blank" class="text-[#2CB38B] hover:underline font-semibold truncate max-w-[200px] flex items-center gap-1">
                                        🔗 {{ $accommodation->bookingLink }}
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Tidak tersedia</span>
                                @endif
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-4">
                            <div class="flex items-center space-x-4 bg-gray-100 rounded-full px-6 py-3">
                                <button @click="if(quantity > 1) quantity--" class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-full text-gray-800 font-bold">-</button>
                                <span class="text-2xl font-bold text-gray-800 min-w-[40px] text-center" x-text="quantity">1</span>
                                <button @click="quantity++" class="w-8 h-8 flex items-center justify-center hover:bg-gray-200 rounded-full text-gray-800 font-bold">+</button>
                            </div>
                            <button @click="showModal = true" class="flex-1 bg-[#2CB38B] hover:bg-[#249d78] text-white font-bold py-4 px-8 rounded-full text-lg transition shadow-lg">Tambah ke Rencana</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div x-show="showModal" class="fixed inset-0 z-[60] flex items-center justify-center bg-black bg-opacity-50 backdrop-blur-sm" style="display: none;">
            <div class="bg-white rounded-3xl shadow-2xl w-full max-w-md p-8 relative m-4">
                <button @click="showModal = false" class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">✖</button>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Simpan ke Rencana</h3>
                <p class="text-gray-500 mb-6 text-sm">Jumlah malam: <span x-text="quantity"></span> Malam</p>
                <form action="{{ route('plan.add-item', $travelPlan->planID) }}" method="POST">
                    @csrf
                    <input type="hidden" name="item_type" value="Akomodasi">
                    <input type="hidden" name="item_id" value="{{ $accommodation->accommodationID }}">
                    <input type="hidden" name="quantity" x-model="quantity">
                    <div class="space-y-3 mb-6 max-h-60 overflow-y-auto pr-2">
                        @foreach($itineraries as $itinerary)
                        <label class="flex items-center justify-between p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-[#2CB38B] transition group">
                            <div class="flex items-center gap-3"><div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center text-yellow-600 text-lg">📁</div><span class="font-bold text-gray-700 group-hover:text-[#2CB38B] transition">{{ $itinerary->itineraryName }}</span></div>
                            <input type="radio" name="itinerary_id" value="{{ $itinerary->itineraryID }}" class="w-5 h-5 text-[#2CB38B] border-gray-300 focus:ring-[#2CB38B]" required checked>
                        </label>
                        @endforeach
                    </div>
                    <button type="submit" class="w-full bg-[#2CB38B] hover:bg-[#249d78] text-white font-bold py-4 rounded-xl shadow-lg transition">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>