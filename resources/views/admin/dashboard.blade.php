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

        .table-header {
            @apply px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider;
        }

        .table-cell {
            @apply px-6 py-4 whitespace-nowrap text-sm text-gray-900;
        }

        input:disabled,
        select:disabled,
        textarea:disabled {
            background-color: #f3f4f6;
            cursor: not-allowed;
            opacity: 0.7;
        }
    </style>
</head>

<body class="bg-gray-100" x-data="{
    currentTab: '{{ request('routes_page') ? 'routes' : (request('accommodations_page') ? 'accommodations' : (request('attractions_page') ? 'attractions' : 'overview')) }}',
    showModal: false,
    modalType: '',
    isEdit: false,
    formAction: '',
    formData: {},

    openAddModal(type, url) {
        this.modalType = type;
        this.isEdit = false;
        this.formAction = url;
        this.formData = { facilities: [], providerID: '' };
        this.showModal = true;
    },

    openEditModal(type, data, url) {
        this.modalType = type;
        this.isEdit = true;
        this.formAction = url;
        let dataClone = JSON.parse(JSON.stringify(data));

        if (dataClone.facilities) {
            if (typeof dataClone.facilities === 'string') {
                try { dataClone.facilities = JSON.parse(dataClone.facilities); } catch (e) { dataClone.facilities = []; }
            }
            if (!dataClone.facilities) dataClone.facilities = [];
        } else {
            dataClone.facilities = [];
        }

        this.formData = dataClone;
        this.showModal = true;
    }
}">

    <div class="flex h-screen overflow-hidden">
        <div class="w-64 bg-sidebar text-white flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6 flex items-center gap-3 border-b border-gray-700">
                <div class="w-8 h-8 bg-brand-green rounded-lg flex items-center justify-center font-bold text-white">B
                </div>
                <span class="text-xl font-bold tracking-wide">Admin Panel</span>
            </div>
            <nav class="flex-1 px-4 py-6 space-y-2">
                <a href="#" @click.prevent="currentTab = 'overview'"
                    :class="currentTab === 'overview' ? 'bg-gray-700 text-brand-green' : 'text-gray-400 hover:bg-gray-700'"
                    class="flex items-center gap-3 px-4 py-3 rounded-lg transition"><span>📊</span> Dashboard</a>
                <p class="px-4 text-xs font-semibold text-gray-500 uppercase mt-6 mb-2">Master Data</p>
                <a href="#" @click.prevent="currentTab = 'cities'"
                    :class="currentTab === 'cities' ? 'bg-gray-700 text-brand-green' : 'text-gray-400 hover:bg-gray-700'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition"><span>🏙️</span> Kota</a>
                <a href="#" @click.prevent="currentTab = 'providers'"
                    :class="currentTab === 'providers' ? 'bg-gray-700 text-brand-green' : 'text-gray-400 hover:bg-gray-700'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition"><span>🏢</span> Provider</a>
                <a href="#" @click.prevent="currentTab = 'routes'"
                    :class="currentTab === 'routes' ? 'bg-gray-700 text-brand-green' : 'text-gray-400 hover:bg-gray-700'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition"><span>🚌</span> Rute</a>
                <a href="#" @click.prevent="currentTab = 'accommodations'"
                    :class="currentTab === 'accommodations' ? 'bg-gray-700 text-brand-green' : 'text-gray-400 hover:bg-gray-700'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition"><span>🏨</span> Akomodasi</a>
                <a href="#" @click.prevent="currentTab = 'attractions'"
                    :class="currentTab === 'attractions' ? 'bg-gray-700 text-brand-green' : 'text-gray-400 hover:bg-gray-700'"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition"><span>🏖️</span> Wisata</a>
            </nav>
            <div class="p-4 border-t border-gray-700">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full flex items-center gap-3 px-4 py-2 text-red-400 hover:bg-gray-700 hover:text-red-300 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg> Logout
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
                            class="font-bold">{{ Auth::user()->name }}</span></span>
                    <div
                        class="w-8 h-8 bg-brand-green rounded-full flex items-center justify-center text-white font-bold">
                        {{ substr(Auth::user()->name, 0, 1) }}</div>
                </div>
            </header>

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-8">
                @if (session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('success') }}</div>
                @endif
                @if (session('error'))
                    <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        {{ session('error') }}</div>
                @endif

                <div x-show="currentTab === 'overview'" class="space-y-8">
                    <div>
                        <h3 class="text-lg font-bold text-gray-700 mb-4 border-l-4 border-brand-green pl-3">Statistik
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500">
                                <p class="text-sm text-gray-500">Total Users</p>
                                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\User::count() }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500">
                                <p class="text-sm text-gray-500">Rencana Perjalanan</p>
                                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\TravelPlan::count() }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-orange-500">
                                <p class="text-sm text-gray-500">Total Kota</p>
                                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\City::count() }}</p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-cyan-500">
                                <p class="text-sm text-gray-500">Rute</p>
                                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\TransportRoute::count() }}
                                </p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500">
                                <p class="text-sm text-gray-500">Akomodasi</p>
                                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Accommodation::count() }}
                                </p>
                            </div>
                            <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500">
                                <p class="text-sm text-gray-500">Wisata</p>
                                <p class="text-3xl font-bold text-gray-800">{{ \App\Models\Attraction::count() }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="currentTab === 'cities'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Kota</h3>
                        <button @click="openAddModal('city', '{{ route('admin.store.city') }}')"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">Nama</th>
                                    <th class="table-header">Provinsi</th>
                                    <th class="table-header">Tipe</th>
                                    <th class="table-header">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($cities as $city)
                                    <tr>
                                        <td class="table-cell font-medium">{{ $city->cityName }}</td>
                                        <td class="table-cell">{{ $city->province }}</td>
                                        <td class="table-cell">{{ $city->locationType }}</td>
                                        <td class="table-cell flex gap-2">
                                            <button
                                                @click="openEditModal('city', {{ $city }}, '{{ route('admin.update.city', $city->cityID) }}')"
                                                class="text-blue-600 hover:text-blue-900 font-bold">Edit</button>
                                            <form action="{{ route('admin.destroy.city', $city->cityID) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div x-show="currentTab === 'providers'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Daftar Provider</h3>
                        <button @click="openAddModal('provider', '{{ route('admin.store.provider') }}')"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">Nama</th>
                                    <th class="table-header">Tipe</th>
                                    <th class="table-header">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($providers as $p)
                                    <tr>
                                        <td class="table-cell font-bold">{{ $p->providerName }}</td>
                                        <td class="table-cell">{{ $p->serviceType }}</td>
                                        <td class="table-cell flex gap-2">
                                            <button
                                                @click="openEditModal('provider', {{ $p }}, '{{ route('admin.update.provider', $p->providerID) }}')"
                                                class="text-blue-600 hover:text-blue-900 font-bold">Edit</button>
                                            <form action="{{ route('admin.destroy.provider', $p->providerID) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div x-show="currentTab === 'routes'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Rute Transportasi</h3>
                        <button @click="openAddModal('route', '{{ route('admin.store.route') }}')"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">Provider</th>
                                    <th class="table-header">Rute</th>
                                    <th class="table-header">Harga</th>
                                    <th class="table-header">Aksi</th>
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
                                        <td class="table-cell flex gap-2">
                                            <button
                                                @click="openEditModal('route', {{ $r }}, '{{ route('admin.update.route', $r->routeID) }}')"
                                                class="text-blue-600 hover:text-blue-900 font-bold">Edit</button>
                                            <form action="{{ route('admin.destroy.route', $r->routeID) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">{{ $routes->links() }}</div>
                    </div>
                </div>

                <div x-show="currentTab === 'accommodations'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Akomodasi</h3>
                        <button @click="openAddModal('accommodation', '{{ route('admin.store.accommodation') }}')"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">Nama</th>
                                    <th class="table-header">Kota</th>
                                    <th class="table-header">Harga</th>
                                    <th class="table-header">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($accommodations as $acc)
                                    <tr>
                                        <td class="table-cell font-bold">{{ $acc->hotelName }}</td>
                                        <td class="table-cell">{{ $acc->city->cityName }}</td>
                                        <td class="table-cell">Rp {{ number_format($acc->averagePricePerNight) }}</td>
                                        <td class="table-cell flex gap-2">
                                            <button
                                                @click="openEditModal('accommodation', {{ $acc }}, '{{ route('admin.update.accommodation', $acc->accommodationID) }}')"
                                                class="text-blue-600 hover:text-blue-900 font-bold">Edit</button>
                                            <form
                                                action="{{ route('admin.destroy.accommodation', $acc->accommodationID) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">{{ $accommodations->links() }}</div>
                    </div>
                </div>

                <div x-show="currentTab === 'attractions'">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-700">Wisata</h3>
                        <button @click="openAddModal('attraction', '{{ route('admin.store.attraction') }}')"
                            class="bg-brand-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">+
                            Tambah</button>
                    </div>
                    <div class="bg-white shadow overflow-hidden sm:rounded-lg overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="table-header">Nama</th>
                                    <th class="table-header">Kota</th>
                                    <th class="table-header">Kategori</th>
                                    <th class="table-header">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($attractions as $attr)
                                    <tr>
                                        <td class="table-cell font-bold">{{ $attr->attractionName }}</td>
                                        <td class="table-cell">{{ $attr->city->cityName }}</td>
                                        <td class="table-cell">{{ $attr->category }}</td>
                                        <td class="table-cell flex gap-2">
                                            <button
                                                @click="openEditModal('attraction', {{ $attr }}, '{{ route('admin.update.attraction', $attr->attractionID) }}')"
                                                class="text-blue-600 hover:text-blue-900 font-bold">Edit</button>
                                            <form
                                                action="{{ route('admin.destroy.attraction', $attr->attractionID) }}"
                                                method="POST" onsubmit="return confirm('Yakin hapus?');">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:text-red-900 font-bold">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-3">{{ $attractions->links() }}</div>
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

            <h3 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-2">
                <span x-text="isEdit ? 'Edit Data' : 'Tambah Data'"></span>
            </h3>

            <form :action="formAction" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="_method" :value="isEdit ? 'PUT' : 'POST'">

                <template x-if="modalType === 'city'">
                    <div class="space-y-4">
                        <input type="text" name="cityName" x-model="formData.cityName" placeholder="Nama Kota"
                            class="w-full border p-3 rounded-lg" required>
                        <input type="text" name="province" x-model="formData.province" placeholder="Provinsi"
                            class="w-full border p-3 rounded-lg">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="0.0001" name="latitude" x-model="formData.latitude"
                                placeholder="Latitude" class="w-full border p-3 rounded-lg">
                            <input type="number" step="0.0001" name="longitude" x-model="formData.longitude"
                                placeholder="Longitude" class="w-full border p-3 rounded-lg">
                        </div>
                        <select name="locationType" x-model="formData.locationType"
                            class="w-full border p-3 rounded-lg">
                            <option value="Kota">Kota</option>
                            <option value="Kabupaten">Kabupaten</option>
                            <option value="Bandara">Bandara</option>
                            <option value="Pelabuhan">Pelabuhan</option>
                        </select>
                    </div>
                </template>

                <template x-if="modalType === 'provider'">
                    <div class="space-y-4">
                        <input type="text" name="providerName" x-model="formData.providerName"
                            placeholder="Nama Provider" class="w-full border p-3 rounded-lg" required>
                        <select name="serviceType" x-model="formData.serviceType"
                            class="w-full border p-3 rounded-lg">
                            <option value="Transportasi">Transportasi</option>
                            <option value="Akomodasi">Akomodasi</option>
                        </select>
                    </div>
                </template>

                <template x-if="modalType === 'route'">
                    <div class="space-y-4">
                        <select name="providerID" x-model="formData.providerID" class="w-full border p-3 rounded-lg"
                            required>
                            <option value="" disabled>Pilih Provider</option>
                            @foreach ($providers as $p)
                                <option value="{{ $p->providerID }}">{{ $p->providerName }}</option>
                            @endforeach
                        </select>
                        <div class="grid grid-cols-2 gap-4">
                            <select name="originCityID" x-model="formData.originCityID"
                                class="w-full border p-3 rounded-lg" required>
                                <option value="" disabled>Asal</option>
                                @foreach ($cities as $c)
                                    <option value="{{ $c->cityID }}">{{ $c->cityName }}</option>
                                @endforeach
                            </select>
                            <select name="destinationCityID" x-model="formData.destinationCityID"
                                class="w-full border p-3 rounded-lg" required>
                                <option value="" disabled>Tujuan</option>
                                @foreach ($cities as $c)
                                    <option value="{{ $c->cityID }}">{{ $c->cityName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" name="averagePrice" x-model="formData.averagePrice"
                                placeholder="Harga" class="w-full border p-3 rounded-lg" required>
                            <input type="number" name="total_seats" x-model="formData.total_seats"
                                placeholder="Kursi" class="w-full border p-3 rounded-lg" required>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="time" name="departureTime" x-model="formData.departureTime"
                                class="w-full border p-3 rounded-lg" required>
                            <input type="time" name="arrivalTime" x-model="formData.arrivalTime"
                                class="w-full border p-3 rounded-lg" required>
                        </div>
                        <input type="text" name="class" x-model="formData.class" placeholder="Kelas"
                            class="w-full border p-3 rounded-lg">

                        <textarea name="description" x-model="formData.description" placeholder="Deskripsi Rute"
                            class="w-full border p-3 rounded-lg"></textarea>

                        <input type="text" name="bookingLink" x-model="formData.bookingLink"
                            placeholder="Link Booking" class="w-full border p-3 rounded-lg"
                            x-bind:disabled="formData.providerID == 99" x-bind:required="formData.providerID != 99"
                            x-effect="if(formData.providerID == 99) formData.bookingLink = ''">

                        <p class="text-sm font-bold text-gray-700">Fasilitas:</p>
                        <div class="flex gap-4 text-sm flex-wrap">
                            <template x-for="fac in ['AC', 'Wifi', 'Makanan', 'Bagasi', 'Toilet']">
                                <label class="flex items-center gap-1">
                                    <input type="checkbox" name="facilities[]" :value="fac"
                                        x-model="formData.facilities"> <span x-text="fac"></span>
                                </label>
                            </template>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="0.0001" name="start_latitude"
                                x-model="formData.start_latitude" placeholder="Lat Asal"
                                class="w-full border p-3 rounded-lg">
                            <input type="number" step="0.0001" name="start_longitude"
                                x-model="formData.start_longitude" placeholder="Long Asal"
                                class="w-full border p-3 rounded-lg">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="0.0001" name="end_latitude" x-model="formData.end_latitude"
                                placeholder="Lat Tujuan" class="w-full border p-3 rounded-lg">
                            <input type="number" step="0.0001" name="end_longitude"
                                x-model="formData.end_longitude" placeholder="Long Tujuan"
                                class="w-full border p-3 rounded-lg">
                        </div>

                    </div>
                </template>

                <template x-if="modalType === 'accommodation'">
                    <div class="space-y-4">
                        <input type="text" name="hotelName" x-model="formData.hotelName" placeholder="Nama Hotel"
                            class="w-full border p-3 rounded-lg" required>
                        <select name="providerID" x-model="formData.providerID" class="w-full border p-3 rounded-lg"
                            required>
                            <option value="" disabled>Provider</option>
                            @foreach ($providers as $p)
                                @if ($p->serviceType == 'Akomodasi')
                                    <option value="{{ $p->providerID }}">{{ $p->providerName }}</option>
                                @endif
                            @endforeach
                        </select>
                        <select name="cityID" x-model="formData.cityID" class="w-full border p-3 rounded-lg"
                            required>
                            <option value="" disabled>Kota</option>
                            @foreach ($cities as $c)
                                <option value="{{ $c->cityID }}">{{ $c->cityName }}</option>
                            @endforeach
                        </select>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" name="averagePricePerNight" x-model="formData.averagePricePerNight"
                                placeholder="Harga/Malam" class="w-full border p-3 rounded-lg" required>
                            <input type="number" step="0.1" name="rating" x-model="formData.rating"
                                placeholder="Rating" class="w-full border p-3 rounded-lg">
                        </div>
                        <select name="type" x-model="formData.type" class="w-full border p-3 rounded-lg">
                            <option value="Hotel">Hotel</option>
                            <option value="Villa">Villa</option>
                            <option value="Hostel">Hostel</option>
                        </select>

                        <textarea name="description" x-model="formData.description" placeholder="Deskripsi Hotel"
                            class="w-full border p-3 rounded-lg"></textarea>

                        <input type="text" name="bookingLink" x-model="formData.bookingLink"
                            placeholder="Link Booking" class="w-full border p-3 rounded-lg"
                            x-bind:disabled="formData.providerID == 100" x-bind:required="formData.providerID != 100"
                            x-effect="if(formData.providerID == 100) formData.bookingLink = ''">

                        <p class="text-sm font-bold text-gray-700">Fasilitas:</p>
                        <div class="flex gap-4 text-sm flex-wrap">
                            <template x-for="fac in ['WiFi Gratis', 'Sarapan', 'Kolam Renang', 'Gym', 'Parkir']">
                                <label class="flex items-center gap-1">
                                    <input type="checkbox" name="facilities[]" :value="fac"
                                        x-model="formData.facilities"> <span x-text="fac"></span>
                                </label>
                            </template>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="0.0001" name="latitude" x-model="formData.latitude"
                                placeholder="Latitude" class="w-full border p-3 rounded-lg">
                            <input type="number" step="0.0001" name="longitude" x-model="formData.longitude"
                                placeholder="Longitude" class="w-full border p-3 rounded-lg">
                        </div>
                    </div>
                </template>

                <template x-if="modalType === 'attraction'">
                    <div class="space-y-4">
                        <input type="text" name="attractionName" x-model="formData.attractionName"
                            placeholder="Nama Wisata" class="w-full border p-3 rounded-lg" required>
                        <select name="cityID" x-model="formData.cityID" class="w-full border p-3 rounded-lg">
                            <option value="" disabled>Kota</option>
                            @foreach ($cities as $c)
                                <option value="{{ $c->cityID }}">{{ $c->cityName }}</option>
                            @endforeach
                        </select>
                        <select name="category" x-model="formData.category" class="w-full border p-3 rounded-lg">
                            <option value="Alam">Alam</option>
                            <option value="Sejarah & Budaya">Sejarah</option>
                            <option value="Hiburan">Hiburan</option>
                            <option value="Landmark">Landmark</option>
                        </select>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" name="estimatedCost" x-model="formData.estimatedCost"
                                placeholder="Tiket Masuk (0 jika gratis)" class="w-full border p-3 rounded-lg">
                            <input type="number" step="0.1" name="rating" x-model="formData.rating"
                                placeholder="Rating" class="w-full border p-3 rounded-lg">
                        </div>
                        <input type="number" name="reviewCount" x-model="formData.reviewCount"
                            placeholder="Jumlah Review" class="w-full border p-3 rounded-lg">

                        <input type="text" name="bookingLink" x-model="formData.bookingLink"
                            placeholder="Link Booking Tiket (Opsional)" class="w-full border p-3 rounded-lg">

                        <input type="text" name="images" x-model="formData.images"
                            placeholder="URL Gambar Utama" class="w-full border p-3 rounded-lg">

                        <div class="grid grid-cols-2 gap-4">
                            <input type="number" step="0.0001" name="latitude" x-model="formData.latitude"
                                placeholder="Latitude" class="w-full border p-3 rounded-lg">
                            <input type="number" step="0.0001" name="longitude" x-model="formData.longitude"
                                placeholder="Longitude" class="w-full border p-3 rounded-lg">
                        </div>
                        <textarea name="description" x-model="formData.description" placeholder="Deskripsi"
                            class="w-full border p-3 rounded-lg"></textarea>
                    </div>
                </template>

                <button type="submit"
                    class="w-full bg-brand-green text-white py-3 rounded-lg font-bold hover:bg-green-700 transition">
                    <span x-text="isEdit ? 'Simpan Perubahan' : 'Simpan Data Baru'"></span>
                </button>
            </form>
        </div>
    </div>
</body>

</html>
