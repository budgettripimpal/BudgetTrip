<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - BudgetTrip</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .bg-sidebar {
            background-color: #1e293b;
        }

        .text-brand-green {
            color: #2CB38B;
        }

        .bg-brand-green {
            background-color: #2CB38B;
        }

        .hover\:bg-brand-green:hover {
            background-color: #2CB38B;
        }

        .table-header {
            @apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider;
        }

        .table-cell {
            @apply px-6 py-4 whitespace-nowrap text-sm text-gray-900;
        }
    </style>
</head>

<body class="bg-gray-100" x-data="{ currentTab: 'overview', showModal: false, modalType: '' }">

    <div class="flex h-screen overflow-hidden">

        <div class="w-64 bg-sidebar text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 flex items-center gap-3 border-b border-gray-700">
                <div class="w-8 h-8 bg-brand-green rounded-lg flex items-center justify-center font-bold text-white">B
                </div>
                <span class="text-xl font-bold tracking-wide">Admin Panel</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="#" @click.prevent="currentTab = 'overview'"
                    :class="currentTab === 'overview' ? 'bg-gray-700 text-brand-green' :
                        'text-gray-400 hover:bg-gray-700 hover:text-white'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                    </svg>
                    Dashboard
                </a>

                <p class="px-4 text-xs font-semibold text-gray-500 uppercase mt-6 mb-2">Master Data</p>

                <a href="#" @click.prevent="currentTab = 'cities'"
                    :class="currentTab === 'cities' ? 'bg-gray-700 text-brand-green' :
                        'text-gray-400 hover:bg-gray-700 hover:text-white'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition">
                    <span>🏙️</span> Kota & Lokasi
                </a>
                <a href="#" @click.prevent="currentTab = 'providers'"
                    :class="currentTab === 'providers' ? 'bg-gray-700 text-brand-green' :
                        'text-gray-400 hover:bg-gray-700 hover:text-white'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition">
                    <span>🏢</span> Provider Jasa
                </a>
                <a href="#" @click.prevent="currentTab = 'routes'"
                    :class="currentTab === 'routes' ? 'bg-gray-700 text-brand-green' :
                        'text-gray-400 hover:bg-gray-700 hover:text-white'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition">
                    <span>🚌</span> Rute Transport
                </a>
                <a href="#" @click.prevent="currentTab = 'accommodations'"
                    :class="currentTab === 'accommodations' ? 'bg-gray-700 text-brand-green' :
                        'text-gray-400 hover:bg-gray-700 hover:text-white'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition">
                    <span>🏨</span> Akomodasi
                </a>
                <a href="#" @click.prevent="currentTab = 'attractions'"
                    :class="currentTab === 'attractions' ? 'bg-gray-700 text-brand-green' :
                        'text-gray-400 hover:bg-gray-700 hover:text-white'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition">
                    <span>🏖️</span> Wisata
                </a>
                <a href="#" @click.prevent="currentTab = 'promotions'"
                    :class="currentTab === 'promotions' ? 'bg-gray-700 text-brand-green' :
                        'text-gray-400 hover:bg-gray-700 hover:text-white'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition">
                    <span>🎫</span> Promo
                </a>
            </nav>

            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-2 text-red-400 hover:bg-gray-700 hover:text-red-300 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="bg-white shadow-sm py-4 px-8 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-800 capitalize" x-text="currentTab.replace('_', ' ')">Dashboard
                </h2>
                <div class="flex items-center gap-4">
                    <span class="text-sm text-gray-600">Halo, <span
                            class="font-bold text-gray-900">{{ Auth::user()->name }}</span></span>
                    <div
                        class="w-8 h-8 bg-brand-green rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}</div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">

                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                <div x-show="currentTab === 'overview'" class="space-y-8">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-l-4 border-brand-green pl-3">Statistik
                            Pengguna & Rencana</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div
                                class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-500 flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Total Users</p>
                                    <p class="text-3xl font-bold text-gray-800">{{ \App\Models\User::count() }}</p>
                                </div>
                                <div class="p-3 bg-blue-50 rounded-full text-blue-500">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div
                                class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-green-500 flex items-center justify-between">
                                <div>
                                    <p class="text-sm text-gray-500">Total Rencana Perjalanan</p>
                                    <p class="text-3xl font-bold text-gray-800">{{ \App\Models\TravelPlan::count() }}
                                    </p>
                                </div>
                                <div class="p-3 bg-green-50 rounded-full text-brand-green">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 7m0 13V7" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-l-4 border-brand-green pl-3">Statistik
                            Data Master (Database)</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                            <div
                                class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-400 hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Kota & Lokasi</p>
                                        <p class="text-2xl font-bold text-gray-800">{{ \App\Models\City::count() }}</p>
                                    </div>
                                    <div class="text-3xl bg-orange-50 p-2 rounded-lg">🏙️</div>
                                </div>
                            </div>

                            <div
                                class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-teal-500 hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Provider Jasa</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ \App\Models\ServiceProvider::count() }}</p>
                                    </div>
                                    <div class="text-3xl bg-teal-50 p-2 rounded-lg">🏢</div>
                                </div>
                            </div>

                            <div
                                class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-cyan-500 hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Rute Transportasi</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ \App\Models\TransportRoute::count() }}</p>
                                    </div>
                                    <div class="text-3xl bg-cyan-50 p-2 rounded-lg">🚌</div>
                                </div>
                            </div>

                            <div
                                class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500 hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Akomodasi</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ \App\Models\Accommodation::count() }}</p>
                                    </div>
                                    <div class="text-3xl bg-yellow-50 p-2 rounded-lg">🏨</div>
                                </div>
                            </div>

                            <div
                                class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500 hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Destinasi Wisata</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ \App\Models\Attraction::count() }}</p>
                                    </div>
                                    <div class="text-3xl bg-purple-50 p-2 rounded-lg">🏖️</div>
                                </div>
                            </div>

                            <div
                                class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-pink-500 hover:shadow-md transition">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-sm text-gray-500 font-medium">Promo Aktif</p>
                                        <p class="text-2xl font-bold text-gray-800">
                                            {{ \App\Models\Promotion::count() }}</p>
                                    </div>
                                    <div class="text-3xl bg-pink-50 p-2 rounded-lg">🎫</div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-sm text-center border border-gray-200 mt-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-1">Panel Kontrol Admin</h3>
                        <p class="text-sm text-gray-500">Gunakan sidebar di sebelah kiri untuk menambah, mengedit, atau
                            melihat detail data master aplikasi BudgetTrip.</p>
                    </div>
                </div>

                <div x-show="currentTab === 'cities'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Kota</h3>
                        <button @click="showModal = true; modalType = 'city'"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah Kota</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">ID</th>
                                    <th class="table-header">Nama Kota</th>
                                    <th class="table-header">Provinsi</th>
                                    <th class="table-header">Pulau</th>
                                    <th class="table-header">Tipe</th>
                                    <th class="table-header">Lat/Long</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cities as $city)
                                    <tr>
                                        <td class="table-cell">{{ $city->cityID }}</td>
                                        <td class="table-cell font-medium">{{ $city->cityName }}</td>
                                        <td class="table-cell">{{ $city->province }}</td>
                                        <td class="table-cell">{{ $city->island }}</td>
                                        <td class="table-cell"><span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $city->locationType }}</span>
                                        </td>
                                        <td class="table-cell text-xs">{{ $city->latitude }}, {{ $city->longitude }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div x-show="currentTab === 'providers'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Provider Jasa</h3>
                        <button @click="showModal = true; modalType = 'provider'"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah Provider</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">ID</th>
                                    <th class="table-header">Nama Provider</th>
                                    <th class="table-header">Tipe Layanan</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($providers as $p)
                                    <tr>
                                        <td class="table-cell">{{ $p->providerID }}</td>
                                        <td class="table-cell font-bold">{{ $p->providerName }}</td>
                                        <td class="table-cell">{{ $p->serviceType }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div x-show="currentTab === 'routes'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Rute Transportasi</h3>
                        <button @click="showModal = true; modalType = 'route'"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah Rute</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">Provider</th>
                                    <th class="table-header">Asal - Tujuan</th>
                                    <th class="table-header">Harga</th>
                                    <th class="table-header">Jam</th>
                                    <th class="table-header">Kursi</th>
                                    <th class="table-header">Fasilitas</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($routes as $r)
                                    <tr>
                                        <td class="table-cell font-bold">{{ $r->serviceProvider->providerName }} <span
                                                class="text-xs text-gray-400 block">{{ $r->class }}</span></td>
                                        <td class="table-cell">{{ $r->originCity->cityName }} ➝
                                            {{ $r->destinationCity->cityName }}</td>
                                        <td class="table-cell">Rp {{ number_format($r->averagePrice) }}</td>
                                        <td class="table-cell text-xs">
                                            {{ \Carbon\Carbon::parse($r->departureTime)->format('H:i') }} -
                                            {{ \Carbon\Carbon::parse($r->arrivalTime)->format('H:i') }}</td>
                                        <td class="table-cell">{{ $r->total_seats }} Kursi</td>
                                        <td class="table-cell text-xs truncate max-w-[150px]">
                                            {{-- FIX JSON DECODE ERROR --}}
                                            {{ implode(', ', is_array($r->facilities) ? $r->facilities : json_decode($r->facilities, true) ?? []) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">
                            {{ $routes->links() }}
                        </div>
                    </div>
                </div>

                <div x-show="currentTab === 'accommodations'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Akomodasi</h3>
                        <button @click="showModal = true; modalType = 'accommodation'"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah Akomodasi</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">Nama Hotel</th>
                                    <th class="table-header">Kota</th>
                                    <th class="table-header">Harga/Malam</th>
                                    <th class="table-header">Rating</th>
                                    <th class="table-header">Lat/Long</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @if ($accommodations->isEmpty())
                                    <tr>
                                        <td colspan="5" class="table-cell text-center text-gray-400">Belum ada data
                                            akomodasi</td>
                                    </tr>
                                @else
                                    @foreach ($accommodations as $acc)
                                        <tr>
                                            <td class="table-cell font-bold">{{ $acc->hotelName }} <span
                                                    class="text-xs font-normal text-gray-500 block">{{ $acc->type }}</span>
                                            </td>
                                            <td class="table-cell">{{ $acc->city->cityName }}</td>
                                            <td class="table-cell">Rp
                                                {{ number_format($acc->averagePricePerNight) }}
                                            </td>
                                            <td class="table-cell text-yellow-500">★ {{ $acc->rating }}</td>
                                            <td class="table-cell text-xs">{{ $acc->latitude }},
                                                {{ $acc->longitude }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="px-6 py-3">
                            {{ $accommodations->links() }}
                        </div>
                    </div>
                </div>

                <div x-show="currentTab === 'attractions'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Destinasi Wisata</h3>
                        <button @click="showModal = true; modalType = 'attraction'"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah Wisata</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach ($attractions as $attr)
                            <div class="bg-white rounded-lg shadow p-4 border border-gray-100">
                                <div class="flex justify-between items-start">
                                    <h4 class="font-bold text-gray-800">{{ $attr->attractionName }}</h4>
                                    <span
                                        class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">{{ $attr->category }}</span>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ $attr->city->cityName }}</p>
                                <div class="mt-4 flex justify-between items-end">
                                    <span class="text-yellow-500 text-sm font-bold">★ {{ $attr->rating }}</span>
                                    <span
                                        class="text-brand-green font-bold">{{ $attr->estimatedCost == 0 ? 'Gratis' : 'Rp ' . number_format($attr->estimatedCost) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4">
                        {{ $attractions->links() }}
                    </div>
                </div>

                <div x-show="currentTab === 'promotions'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Promo</h3>
                        <button @click="showModal = true; modalType = 'promotion'"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah Promo</button>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($promotions as $promo)
                            <div
                                class="bg-gradient-to-r from-brand-green to-teal-500 rounded-xl shadow-lg p-6 text-white relative overflow-hidden">
                                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white opacity-10 rounded-full">
                                </div>
                                <h4 class="font-bold text-xl mb-1">{{ $promo->discountValue * 100 }}% OFF</h4>
                                <p class="font-medium mb-4 text-green-50">{{ $promo->description }}</p>
                                <div class="text-xs bg-white/20 inline-block px-3 py-1 rounded-full">
                                    Valid until: {{ $promo->validUntil }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </main>
        </div>
    </div>

    <div x-show="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60]"
        style="display: none;">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg p-8 relative max-h-[90vh] overflow-y-auto">
            <button @click="showModal = false"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">✖</button>

            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">Tambah Data Baru</h3>

            <form x-show="modalType === 'city'" action="{{ route('admin.store.city') }}" method="POST"
                class="space-y-4">
                @csrf
                <input type="text" name="cityName" placeholder="Nama Kota" class="w-full border p-3 rounded-lg"
                    required>
                <input type="text" name="province" placeholder="Provinsi" class="w-full border p-3 rounded-lg">
                <input type="text" name="island" placeholder="Pulau (e.g. Jawa)"
                    class="w-full border p-3 rounded-lg">
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" step="0.0001" name="latitude" placeholder="Latitude"
                        class="w-full border p-3 rounded-lg">
                    <input type="number" step="0.0001" name="longitude" placeholder="Longitude"
                        class="w-full border p-3 rounded-lg">
                </div>
                <select name="locationType" class="w-full border p-3 rounded-lg">
                    <option value="Kota">Kota</option>
                    <option value="Kabupaten">Kabupaten</option>
                </select>
                <button type="submit" class="w-full bg-brand-green text-white py-3 rounded-lg font-bold">Simpan
                    Kota</button>
            </form>

            <form x-show="modalType === 'provider'" action="{{ route('admin.store.provider') }}" method="POST"
                class="space-y-4">
                @csrf
                <input type="text" name="providerName" placeholder="Nama Provider (misal: Cititrans)"
                    class="w-full border p-3 rounded-lg" required>
                <select name="serviceType" class="w-full border p-3 rounded-lg">
                    <option value="Transportasi">Transportasi</option>
                    <option value="Akomodasi">Akomodasi</option>
                </select>
                <button type="submit" class="w-full bg-brand-green text-white py-3 rounded-lg font-bold">Simpan
                    Provider</button>
            </form>

            <form x-show="modalType === 'route'" action="{{ route('admin.store.route') }}" method="POST"
                class="space-y-4">
                @csrf
                <select name="providerID" class="w-full border p-3 rounded-lg" required>
                    <option disabled selected>Pilih Provider</option>
                    @foreach ($providers as $p)
                        <option value="{{ $p->providerID }}">{{ $p->providerName }}</option>
                    @endforeach
                </select>
                <div class="grid grid-cols-2 gap-4">
                    <select name="originCityID" class="w-full border p-3 rounded-lg" required>
                        <option disabled selected>Asal</option>
                        @foreach ($cities as $c)
                            <option value="{{ $c->cityID }}">{{ $c->cityName }}</option>
                        @endforeach
                    </select>
                    <select name="destinationCityID" class="w-full border p-3 rounded-lg" required>
                        <option disabled selected>Tujuan</option>
                        @foreach ($cities as $c)
                            <option value="{{ $c->cityID }}">{{ $c->cityName }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" name="averagePrice" placeholder="Harga (Rp)"
                        class="w-full border p-3 rounded-lg" required>
                    <input type="number" name="total_seats" placeholder="Jumlah Kursi"
                        class="w-full border p-3 rounded-lg" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="time" name="departureTime" class="w-full border p-3 rounded-lg" required>
                    <input type="time" name="arrivalTime" class="w-full border p-3 rounded-lg" required>
                </div>
                <input type="text" name="class" placeholder="Kelas (e.g. Eksekutif)"
                    class="w-full border p-3 rounded-lg" required>

                <input type="url" name="bookingLink" placeholder="Link Booking (https://...)"
                    class="w-full border p-3 rounded-lg" required>

                <p class="text-sm font-bold text-gray-700">Fasilitas:</p>
                <div class="flex gap-4 text-sm flex-wrap">
                    <label><input type="checkbox" name="facilities[]" value="AC"> AC</label>
                    <label><input type="checkbox" name="facilities[]" value="Wifi"> Wifi</label>
                    <label><input type="checkbox" name="facilities[]" value="Makanan"> Makanan</label>
                    <label><input type="checkbox" name="facilities[]" value="Bagasi"> Bagasi</label>
                    <label><input type="checkbox" name="facilities[]" value="Toilet"> Toilet</label>
                </div>

                <button type="submit" class="w-full bg-brand-green text-white py-3 rounded-lg font-bold">Simpan
                    Rute</button>
            </form>

            <form x-show="modalType === 'accommodation'" action="{{ route('admin.store.accommodation') }}"
                method="POST" class="space-y-4">
                @csrf
                <input type="text" name="hotelName" placeholder="Nama Hotel / Penginapan"
                    class="w-full border p-3 rounded-lg" required>
                <select name="providerID" class="w-full border p-3 rounded-lg" required>
                    <option disabled selected>Provider (Booking Source)</option>
                    @foreach ($providers as $p)
                        @if ($p->serviceType == 'Akomodasi')
                            <option value="{{ $p->providerID }}">{{ $p->providerName }}</option>
                        @endif
                    @endforeach
                </select>
                <select name="cityID" class="w-full border p-3 rounded-lg" required>
                    <option disabled selected>Lokasi Kota</option>
                    @foreach ($cities as $c)
                        <option value="{{ $c->cityID }}">{{ $c->cityName }}</option>
                    @endforeach
                </select>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" name="averagePricePerNight" placeholder="Harga/Malam (Rp)"
                        class="w-full border p-3 rounded-lg" required>
                    <input type="number" step="0.1" name="rating" placeholder="Rating (1-5)"
                        class="w-full border p-3 rounded-lg">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" step="0.0001" name="latitude" placeholder="Lat"
                        class="w-full border p-3 rounded-lg">
                    <input type="number" step="0.0001" name="longitude" placeholder="Long"
                        class="w-full border p-3 rounded-lg">
                </div>
                <select name="type" class="w-full border p-3 rounded-lg">
                    <option value="Hotel">Hotel</option>
                    <option value="Villa">Villa</option>
                    <option value="Apartemen">Apartemen</option>
                    <option value="Hostel">Hostel</option>
                </select>

                <input type="url" name="bookingLink" placeholder="Link Booking (https://...)"
                    class="w-full border p-3 rounded-lg" required>

                <p class="text-sm font-bold text-gray-700">Fasilitas:</p>
                <div class="flex gap-4 text-sm flex-wrap">
                    <label><input type="checkbox" name="facilities[]" value="WiFi Gratis"> WiFi</label>
                    <label><input type="checkbox" name="facilities[]" value="Sarapan"> Sarapan</label>
                    <label><input type="checkbox" name="facilities[]" value="Kolam Renang"> Pool</label>
                    <label><input type="checkbox" name="facilities[]" value="Gym"> Gym</label>
                    <label><input type="checkbox" name="facilities[]" value="Parkir"> Parkir</label>
                </div>
                <button type="submit" class="w-full bg-brand-green text-white py-3 rounded-lg font-bold">Simpan
                    Akomodasi</button>
            </form>

            <form x-show="modalType === 'attraction'" action="{{ route('admin.store.attraction') }}" method="POST"
                class="space-y-4">
                @csrf
                <input type="text" name="attractionName" placeholder="Nama Tempat Wisata"
                    class="w-full border p-3 rounded-lg" required>
                <select name="cityID" class="w-full border p-3 rounded-lg">
                    <option disabled selected>Lokasi Kota</option>
                    @foreach ($cities as $c)
                        <option value="{{ $c->cityID }}">{{ $c->cityName }}</option>
                    @endforeach
                </select>
                <select name="category" class="w-full border p-3 rounded-lg">
                    <option value="Alam">Alam</option>
                    <option value="Sejarah & Budaya">Sejarah & Budaya</option>
                    <option value="Kuliner">Kuliner</option>
                    <option value="Belanja">Belanja</option>
                    <option value="Hiburan">Hiburan</option>
                    <option value="Landmark">Landmark</option>
                </select>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" name="estimatedCost" placeholder="Tiket Masuk (Rp)"
                        class="w-full border p-3 rounded-lg">
                    <input type="number" step="0.1" name="rating" placeholder="Rating (1-5)"
                        class="w-full border p-3 rounded-lg">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" step="0.0001" name="latitude" placeholder="Lat"
                        class="w-full border p-3 rounded-lg">
                    <input type="number" step="0.0001" name="longitude" placeholder="Long"
                        class="w-full border p-3 rounded-lg">
                </div>
                <textarea name="description" placeholder="Deskripsi singkat..." class="w-full border p-3 rounded-lg"></textarea>
                <button type="submit" class="w-full bg-brand-green text-white py-3 rounded-lg font-bold">Simpan
                    Wisata</button>
            </form>

            <form x-show="modalType === 'promotion'" action="{{ route('admin.store.promotion') }}" method="POST"
                class="space-y-4">
                @csrf
                <input type="text" name="description" placeholder="Judul Promo"
                    class="w-full border p-3 rounded-lg" required>
                <div class="grid grid-cols-2 gap-4">
                    <input type="number" step="0.01" name="discountValue"
                        placeholder="Diskon (misal 0.10 untuk 10%)" class="w-full border p-3 rounded-lg" required>
                    <input type="date" name="validUntil" placeholder="Berlaku Sampai"
                        class="w-full border p-3 rounded-lg">
                </div>
                <button type="submit" class="w-full bg-brand-green text-white py-3 rounded-lg font-bold">Simpan
                    Promo</button>
            </form>

        </div>
    </div>

</body>

</html>
