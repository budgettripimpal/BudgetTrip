<x-app-layout>
    @push('styles')
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
            rel="stylesheet">
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

            .ring-primary:focus {
                --tw-ring-color: #2CB38B;
            }

            input[type=range]::-webkit-slider-thumb {
                -webkit-appearance: none;
                background: #2CB38B;
                cursor: pointer;
                margin-top: -6px;
                border: 2px solid white;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                height: 20px;
                width: 20px;
                border-radius: 50%;
            }

            input[type=range]::-webkit-slider-runnable-track {
                background: #e5e7eb;
                height: 8px;
                border-radius: 4px;
            }

            .no-arrow {
                -webkit-appearance: none;
                background-image: none !important;
                padding-right: 2.5rem;
            }
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

    <div class="min-h-screen bg-gray-50 pb-12 pt-20">

        <div class="bg-white shadow-sm py-8 mb-8 sticky top-20 z-40">
            <div class="container mx-auto px-6">
                <div class="flex items-center justify-between max-w-6xl mx-auto">

                    <div class="flex items-center flex-1">
                        <div class="flex flex-col items-center relative z-10">
                            <div
                                class="w-16 h-16 bg-[#2CB38B] rounded-full flex items-center justify-center mb-2 shadow-lg ring-4 ring-green-50">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <p class="text-xs font-bold text-[#2CB38B] text-center">Input Budget &<br>Rencana</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </div>

                    <div class="flex items-center flex-1">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2">
                                <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M18 20H6c-1.1 0-2-.9-2-2V6c0-2.2 1.8-4 4-4h8c2.2 0 4 1.8 4 4v12c0 1.1-.9 2-2 2zm-2-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm-8 0c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0-9h8V4H8v4z" />
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-400 text-center">Pilih<br>Transportasi</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </div>

                    <div class="flex items-center flex-1">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-400 text-center">Pilih<br>Akomodasi</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </div>

                    <div class="flex items-center flex-1">
                        <div class="flex flex-col items-center relative z-10">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <p class="text-xs font-semibold text-gray-400 text-center">Pilih<br>Wisata</p>
                        </div>
                        <div class="w-full h-1 bg-gray-200 mx-2 rounded-full"></div>
                    </div>

                    <div class="flex flex-col items-center relative z-10">
                        <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mb-2">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-xs font-semibold text-gray-400 text-center">Atur<br>Rencana</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (session('success'))
                <div
                    class="mb-6 bg-green-50 border-l-4 border-[#2CB38B] p-4 rounded-r-md shadow-sm flex items-start animate-fade-in-down">
                    <svg class="h-5 w-5 text-[#2CB38B] mt-0.5 mr-3" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-bold text-gray-800">Berhasil!</h3>
                        <p class="text-sm text-gray-600">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <div
                class="bg-white overflow-hidden shadow-xl sm:rounded-[2.5rem] flex flex-col lg:flex-row border border-gray-100 relative">
                <div class="w-full lg:w-2/3 p-8 md:p-12">
                    <div class="mb-10">
                        <h1 class="text-3xl font-extrabold text-gray-900 mb-3 tracking-tight">
                            {{ isset($plan) ? 'Edit Rencana Perjalanan' : 'Mulai Perjalananmu ✈️' }}
                        </h1>
                        <p class="text-gray-500 leading-relaxed">Isi detail dasar di bawah ini agar kami bisa
                            mencarikan rekomendasi terbaik sesuai kantongmu.</p>
                    </div>

                    <form
                        action="{{ isset($plan) ? route('travel-plan.update', $plan->planID) : route('travel-plan.store') }}"
                        method="POST" novalidate>
                        @csrf
                        @if (isset($plan))
                            @method('PUT')
                        @endif

                        <div class="space-y-8 mb-12">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Nama Rencana</label>
                                <input type="text" name="planName"
                                    value="{{ old('planName', $plan->planName ?? '') }}"
                                    class="w-full px-5 py-4 rounded-2xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 outline-none {{ $errors->has('planName') ? 'border-red-500 bg-red-50' : '' }}"
                                    placeholder="Contoh: Liburan Akhir Tahun" required autofocus>
                                <x-input-error :messages="$errors->get('planName')" class="mt-2" />
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Total Budget Kamu</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-4 text-gray-400 font-bold">Rp</span>
                                    <input type="number" id="budget" name="amount"
                                        value="{{ old('amount', $plan->amount ?? 5000000) }}"
                                        class="w-full pl-14 pr-5 py-4 rounded-2xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 font-bold text-xl outline-none {{ $errors->has('amount') ? 'border-red-500 bg-red-50' : '' }}"
                                        required>
                                </div>
                                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                                <div class="mt-6 px-2">
                                    <input type="range" min="0" max="20000000" step="100000"
                                        value="{{ old('amount', $plan->amount ?? 5000000) }}"
                                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer"
                                        oninput="document.getElementById('budget').value = this.value">
                                    <div class="flex justify-between text-xs font-semibold text-gray-400 mt-2"><span>Rp
                                            0</span><span>Rp 20 Juta+</span></div>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-8 mb-12">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Dari Mana?</label>
                                    <div class="relative">
                                        <select name="originCityID" style="background-image: none !important;"
                                            class="no-arrow w-full px-5 py-4 rounded-2xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 text-gray-700 outline-none cursor-pointer {{ $errors->has('originCityID') ? 'border-red-500 bg-red-50' : '' }}">
                                            <option value="" disabled {{ !isset($plan) ? 'selected' : '' }}>
                                                Pilih Kota Asal</option>
                                            @foreach (['1' => 'Bandung', '2' => 'Palembang', '3' => 'Merak', '4' => 'Bakauheni', '5' => 'Jakarta'] as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ old('originCityID', $plan->originCityID ?? '') == $id ? 'selected' : '' }}>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none">
                                            <svg class="w-5 h-5 text-[#2CB38B]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg></div>
                                    </div>
                                    <x-input-error :messages="$errors->get('originCityID')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Mau ke Mana?</label>
                                    <div class="relative">
                                        <select name="destinationCityID" style="background-image: none !important;"
                                            class="no-arrow w-full px-5 py-4 rounded-2xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 text-gray-700 outline-none cursor-pointer {{ $errors->has('destinationCityID') ? 'border-red-500 bg-red-50' : '' }}">
                                            <option value="" disabled {{ !isset($plan) ? 'selected' : '' }}>
                                                Pilih Kota Tujuan</option>
                                            @foreach (['1' => 'Bandung', '2' => 'Palembang', '3' => 'Merak', '4' => 'Bakauheni', '5' => 'Jakarta'] as $id => $name)
                                                <option value="{{ $id }}"
                                                    {{ old('destinationCityID', $plan->destinationCityID ?? '') == $id ? 'selected' : '' }}>
                                                    {{ $name }}</option>
                                            @endforeach
                                        </select>
                                        <div
                                            class="absolute inset-y-0 right-0 flex items-center px-5 pointer-events-none">
                                            <svg class="w-5 h-5 text-[#2CB38B]" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg></div>
                                    </div>
                                    <x-input-error :messages="$errors->get('destinationCityID')" class="mt-2" />
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Berangkat</label>
                                    <input type="date" name="startDate"
                                        value="{{ old('startDate', isset($plan) ? $plan->startDate->format('Y-m-d') : '') }}"
                                        class="w-full px-5 py-4 rounded-2xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 outline-none {{ $errors->has('startDate') ? 'border-red-500 bg-red-50' : '' }}">
                                    <x-input-error :messages="$errors->get('startDate')" class="mt-2" />
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Pulang</label>
                                    <input type="date" name="endDate"
                                        value="{{ old('endDate', isset($plan) ? $plan->endDate->format('Y-m-d') : '') }}"
                                        class="w-full px-5 py-4 rounded-2xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 outline-none {{ $errors->has('endDate') ? 'border-red-500 bg-red-50' : '' }}">
                                    <x-input-error :messages="$errors->get('endDate')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full bg-[#2CB38B] hover:bg-[#249d78] text-white font-bold py-5 rounded-2xl text-lg transition shadow-xl hover:shadow-2xl transform active:scale-[0.99] flex items-center justify-center gap-3 group">
                            <span>{{ isset($plan) ? 'Simpan Perubahan & Lanjut' : 'Lanjut Pilih Transportasi' }}</span>
                            <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </form>
                </div>
                <div class="hidden lg:block lg:w-1/3 relative bg-gray-100">
                    <img src="https://images.unsplash.com/photo-1530789253388-582c481c54b0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>
                    <div class="absolute bottom-16 left-8 right-8 text-white">
                        <p class="text-2xl font-serif italic leading-relaxed drop-shadow-lg">"Investasi terbaik adalah
                            memasukkan uang ke dalam kenangan."</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
