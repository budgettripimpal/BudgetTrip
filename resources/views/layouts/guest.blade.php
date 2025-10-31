<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            body {
                font-family: 'Figtree', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased bg-gray-50">
        <div class="min-h-screen flex">
            <!-- Left Side - Promotional Content -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-gray-50 to-gray-100 p-12 flex-col justify-between">
                <!-- Top Badge -->
                <div class="inline-flex items-center gap-2 bg-yellow-300 text-gray-800 px-4 py-2 rounded-full text-sm font-medium self-start">
                    🚌 Discover the best trips at the lowest prices, made just for you.
                </div>

                <!-- Main Content -->
                <div class="flex-1 flex flex-col justify-center">
                    <h1 class="text-6xl font-bold leading-tight mb-6">
                        <span class="text-gray-900">Berpergian &</span><br>
                        <span class="text-gray-900">nikmati</span><br>
                        <span class="text-teal-500">tempat baru</span> <span class="text-gray-900">di</span><br>
                        <span class="text-gray-900">indonesia</span> <span class="inline-block">🏝️</span>
                    </h1>
                    
                    <p class="text-gray-600 text-lg mb-12 max-w-md leading-relaxed">
                        Setiap perjalanan punya cerita, dan Budget Trip memastikan ceritamu dimulai dengan perencanaan yang cerdas. Dari destinasi impian hingga rincian biaya, semuanya bisa kamu atur dalam satu aplikasi hemat perjalanan ini. ✨
                    </p>

                    <!-- Destination Cards -->
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                            🚌 Temukan Destinasi Favoritmu <span class="text-2xl">✨</span>
                        </h2>
                        
                        <div class="flex gap-4">
                            <!-- Pangandaran Card -->
                            <div class="relative w-36 h-48 rounded-2xl overflow-hidden shadow-lg group cursor-pointer">
                                <img src="/images/pangandaran.jpg" alt="Pangandaran" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" onerror="this.src='https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400'">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-3 left-3 text-white">
                                    <h3 class="font-bold text-lg">Pangandaran</h3>
                                    <p class="text-sm text-teal-300">Jawa Barat</p>
                                </div>
                            </div>

                            <!-- Parangtritis Card -->
                            <div class="relative w-36 h-48 rounded-2xl overflow-hidden shadow-lg group cursor-pointer">
                                <img src="/images/parangtritis.jpg" alt="Parangtritis" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" onerror="this.src='https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=400'">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-3 left-3 text-white">
                                    <h3 class="font-bold text-lg">Parangtritis</h3>
                                    <p class="text-sm text-yellow-300">DIY</p>
                                </div>
                            </div>

                            <!-- Bromo Card -->
                            <div class="relative w-36 h-48 rounded-2xl overflow-hidden shadow-lg group cursor-pointer">
                                <img src="/images/bromo.jpg" alt="Bromo" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" onerror="this.src='https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=400'">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-3 left-3 text-white">
                                    <h3 class="font-bold text-lg">Bromo</h3>
                                    <p class="text-sm text-gray-300">Jawa Timur</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Sign In Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white">
                <div class="w-full max-w-md">
                    <div class="bg-white rounded-3xl border border-gray-200 p-8 shadow-sm">
                        
                        <div class="flex flex-col items-center mb-2">
                            
                            <a href="/">
                                <img src="{{ asset('images/logo-budgettrip.png') }}" alt="BudgetTrip Logo" class="w-50 h-50 mb-2">
                            </a>
                        </div>
                        <div class="text-center mb-2">
                            <h2 class="text-3xl font-bold text-gray-900 mb-2">Sign In</h2>
                            <p class="text-gray-500">Enter your details to get started</p>
                        </div>
                        
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>