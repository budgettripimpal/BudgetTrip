<x-app-layout>
    @push('styles')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .text-primary { color: #2CB38B; }
        .bg-primary { background-color: #2CB38B; }
        .border-primary { border-color: #2CB38B; }
        .hover\:text-primary:hover { color: #2CB38B; }
        .hover\:bg-primary:hover { background-color: #2CB38B; }
        .hover\:bg-green-600:hover { background-color: #249372; }
    </style>
    @endpush

    <nav class="bg-white shadow-sm fixed w-full top-0 z-50 h-20">
        <div class="container mx-auto px-6 h-full">
            <div class="flex items-center justify-between h-full">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                    <span class="text-2xl font-bold tracking-tight">
                        <span class="text-gray-900">BUDGET</span><span class="text-[#2CB38B]">TRIP</span>
                    </span>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-[#2CB38B] font-bold transition">Home</a>
                </div>
                <div class="flex items-center space-x-4 relative group">
                    <span class="text-gray-600 hidden md:inline font-medium">Welcome, {{ Auth::user()->name }}</span>
                    <div class="w-10 h-10 bg-[#2CB38B] rounded-full flex items-center justify-center cursor-pointer shadow-md text-white font-bold text-lg">{{ substr(Auth::user()->name, 0, 1) }}</div>
                    <div class="absolute top-10 right-0 w-48 bg-white rounded-xl shadow-xl py-2 hidden group-hover:block border border-gray-100 animate-fade-in-down z-50">
                        <form method="POST" action="{{ route('logout') }}">@csrf<a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-green-50 hover:text-[#2CB38B] transition rounded-md mx-2">Log Out</a></form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-screen bg-gray-50 pt-28 pb-12">
        <div class="container mx-auto px-6 max-w-6xl">
            
            @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
                <div class="mb-6 bg-green-50 border-l-4 border-[#2CB38B] p-4 rounded-r-md shadow-sm flex items-start animate-fade-in-down">
                    <svg class="h-5 w-5 text-[#2CB38B] mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    <div><h3 class="text-sm font-bold text-gray-800">Berhasil!</h3><p class="text-sm text-gray-600">Perubahan telah disimpan.</p></div>
                </div>
            @endif

            <div class="flex flex-col lg:flex-row gap-8">
                <div class="w-full lg:w-80 flex-shrink-0">
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden sticky top-28">
                        <div class="p-8 text-center border-b border-gray-200 bg-gradient-to-b from-gray-50 to-white">
                            <div class="w-32 h-32 bg-gradient-to-br from-gray-400 to-gray-600 rounded-full mx-auto mb-4 flex items-center justify-center shadow-inner ring-4 ring-white">
                                <span class="text-5xl font-bold text-white uppercase">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800 mb-1 truncate px-2">{{ Auth::user()->name }}</h2>
                            <p class="text-gray-500 text-sm truncate px-2">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="p-4 space-y-1">
                            <a href="{{ route('profile.show') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#2CB38B] transition font-medium group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2CB38B]" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                                <span>Profile</span>
                            </a>
                            <a href="{{ route('travel-plan.index') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#2CB38B] transition font-medium group">
                                <svg class="w-5 h-5 text-gray-400 group-hover:text-[#2CB38B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"/></svg>
                                <span>Rencana Saya</span>
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-3 px-4 py-3 rounded-xl bg-[#2CB38B]/10 text-gray-900 font-bold border-l-4 border-[#2CB38B] transition">
                                <svg class="w-5 h-5 text-[#2CB38B]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                                <span>Edit Profile</span>
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-red-50 hover:text-red-600 transition font-medium group mt-4">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="flex-1 space-y-8">
                    
                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="bg-blue-50 p-2 rounded-lg mr-4 text-blue-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
                            <div><h2 class="text-xl font-bold text-gray-800">Informasi Profil</h2><p class="text-sm text-gray-500">Perbarui detail akun dan email Anda.</p></div>
                        </div>
                        
                        <form method="post" action="{{ route('profile.update') }}" class="space-y-6" novalidate>
                            @csrf @method('patch')
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" 
                                       class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 text-gray-800 outline-none transition">
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-bold text-gray-700 mb-2">Alamat Email</label>
                                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" 
                                       class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 text-gray-800 outline-none transition">
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>
                            <div>
                                <label for="phoneNumber" class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $user->phoneNumber) }}" 
                                       class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 text-gray-800 outline-none transition"
                                       placeholder="+62...">
                                <x-input-error class="mt-2" :messages="$errors->get('phoneNumber')" />
                            </div>
                            <button type="submit" class="px-6 py-3 bg-[#2CB38B] hover:bg-[#249d78] text-white font-bold rounded-xl shadow-lg transition transform active:scale-95">Simpan Perubahan</button>
                        </form>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
                        <div class="flex items-center mb-6 pb-4 border-b border-gray-100">
                            <div class="bg-yellow-50 p-2 rounded-lg mr-4 text-yellow-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg></div>
                            <div><h2 class="text-xl font-bold text-gray-800">Ganti Kata Sandi</h2><p class="text-sm text-gray-500">Pastikan akun Anda aman.</p></div>
                        </div>
                        
                        <form method="post" action="{{ route('password.update') }}" class="space-y-6" novalidate>
                            @csrf @method('put')
                            <div>
                                <label for="current_password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Saat Ini</label>
                                <input type="password" id="current_password" name="current_password" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 text-gray-800 outline-none transition">
                                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                            </div>
                            <div>
                                <label for="password" class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Baru</label>
                                <input type="password" id="password" name="password" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 text-gray-800 outline-none transition">
                                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Kata Sandi</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-3 rounded-xl border-gray-200 focus:border-[#2CB38B] focus:ring-2 focus:ring-[#2CB38B]/20 bg-gray-50 text-gray-800 outline-none transition">
                                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                            </div>
                            <button type="submit" class="px-6 py-3 bg-gray-800 hover:bg-gray-900 text-white font-bold rounded-xl shadow-lg transition transform active:scale-95">Update Password</button>
                        </form>
                    </div>

                    <div class="bg-red-50 rounded-2xl shadow-inner p-8 border border-red-100">
                        <div class="flex items-center mb-4">
                            <div class="bg-red-100 p-2 rounded-lg mr-4 text-red-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></div>
                            <div><h2 class="text-xl font-bold text-red-700">Hapus Akun</h2><p class="text-sm text-red-500">Tindakan ini permanen.</p></div>
                        </div>
                        <p class="text-sm text-gray-600 mb-6">Setelah dihapus, semua data Anda akan hilang selamanya.</p>
                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Hapus Akun Saya') }}</x-danger-button>
                        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                                @csrf @method('delete')
                                <h2 class="text-lg font-medium text-gray-900">{{ __('Yakin ingin menghapus akun?') }}</h2>
                                <p class="mt-1 text-sm text-gray-600">{{ __('Masukkan password Anda untuk konfirmasi penghapusan permanen.') }}</p>
                                <div class="mt-6">
                                    <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />
                                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />
                                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                                </div>
                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">{{ __('Batal') }}</x-secondary-button>
                                    <x-danger-button class="ms-3">{{ __('Hapus Akun') }}</x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>