<x-app-layout>
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .text-primary { color: #2CB38B; }
        .bg-primary { background-color: #2CB38B; }
        .border-primary { border-color: #2CB38B; }
        .hover\:bg-primary:hover { background-color: #2CB38B; }
        .hover\:text-primary:hover { color: #2CB38B; }
    </style>
    @endpush

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
                    <a href="{{ route('dashboard') }}" class="text-gray-900 hover:text-[#2CB38B] font-bold transition">Home</a>
                    <a href="{{ route('dashboard') }}#about" class="text-gray-600 hover:text-[#2CB38B] transition">About</a>
                    <a href="{{ route('dashboard') }}#tutorial" class="text-gray-600 hover:text-[#2CB38B] transition">Tutorial</a>
                </div>

                <div class="flex items-center space-x-4 relative group">
                    <span class="text-gray-600 hidden md:inline font-medium">Welcome, {{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 bg-[#2CB38B] rounded-full flex items-center justify-center cursor-pointer shadow-md text-white font-bold text-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    
                    <div class="absolute top-10 right-0 w-56 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border border-gray-100 animate-fade-in-down z-50">
                        <div class="px-4 py-2 border-b border-gray-100 mb-1">
                            <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition">View Profile</a>
                        <a href="{{ route('travel-plan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition font-bold">Rencana Saya</a>
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition">Edit Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition rounded-b-xl">Log Out</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen bg-gray-50 pt-28 pb-12">
        <div class="container mx-auto px-6 max-w-7xl">
            
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Rencana Saya</h1>
                    <p class="text-gray-500 mt-1">Kelola semua rencana perjalanan impianmu di sini.</p>
                </div>
                <a href="{{ route('travel-plan.create') }}" class="bg-[#2CB38B] hover:bg-[#249d78] text-white px-6 py-3 rounded-xl font-bold shadow-lg flex items-center gap-2 transition transform hover:-translate-y-1">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Buat Rencana Baru
                </a>
            </div>

            @if($plans->isEmpty())
                <div class="bg-white rounded-3xl p-16 text-center shadow-sm border border-gray-100">
                    <div class="w-24 h-24 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-[#2CB38B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7"/></svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada rencana perjalanan</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">Ayo mulai petualanganmu sekarang! Buat rencana perjalanan pertamamu dengan mudah dan hemat.</p>
                    <a href="{{ route('travel-plan.create') }}" class="text-[#2CB38B] font-bold hover:underline">Mulai Sekarang &rarr;</a>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($plans as $plan)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 group">
                        <div class="h-32 bg-gradient-to-r from-[#2CB38B] to-teal-600 relative p-6">
                            <div class="absolute top-4 right-4 bg-white/20 backdrop-blur-sm px-3 py-1 rounded-lg text-white text-xs font-bold border border-white/30">
                                {{ $plan->startDate->format('d M') }} - {{ $plan->endDate->format('d M Y') }}
                            </div>
                            <h3 class="text-white font-bold text-xl mt-8 truncate drop-shadow-md">{{ $plan->planName }}</h3>
                        </div>
                        
                        <div class="p-6">
                            <div class="flex justify-between items-center mb-4">
                                <div>
                                    <p class="text-xs text-gray-400 uppercase font-bold">Budget</p>
                                    <p class="text-lg font-bold text-[#2CB38B]">Rp {{ number_format($plan->amount, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-gray-400 uppercase font-bold">Tujuan</p>
                                    <p class="text-gray-800 font-medium">{{ $plan->destinationCity->cityName ?? 'Unknown' }}</p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <a href="{{ route('travel-plan.transport', $plan->planID) }}" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-green-50 transition group/item">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm text-lg">🚌</div>
                                        <span class="text-sm font-medium text-gray-600 group-hover/item:text-[#2CB38B]">Transportasi</span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                                <a href="{{ route('travel-plan.accommodation', $plan->planID) }}" class="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-green-50 transition group/item">
                                    <div class="flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full bg-white flex items-center justify-center shadow-sm text-lg">🏨</div>
                                        <span class="text-sm font-medium text-gray-600 group-hover/item:text-[#2CB38B]">Akomodasi</span>
                                    </div>
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                                </a>
                            </div>

                            <div class="mt-6 pt-4 border-t border-gray-100 flex gap-3">
                                <a href="{{ route('travel-plan.edit', $plan->planID) }}" class="flex-1 py-2 text-center text-sm font-bold text-gray-600 hover:text-[#2CB38B] hover:bg-green-50 rounded-lg transition border border-gray-200 hover:border-[#2CB38B]">
                                    Edit Rencana
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>