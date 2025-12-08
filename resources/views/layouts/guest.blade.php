<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Custom Animations */
        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .fade-in-left {
            animation: fadeInLeft 0.8s ease-out forwards;
            opacity: 0;
            transform: translateX(-30px);
        }

        .fade-in-right {
            animation: fadeInRight 0.8s ease-out forwards;
            opacity: 0;
            transform: translateX(30px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInLeft {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeInRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .delay-100 {
            animation-delay: 0.1s;
        }

        .delay-200 {
            animation-delay: 0.2s;
        }

        .delay-300 {
            animation-delay: 0.3s;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white">
    <div class="min-h-screen flex overflow-hidden">

        <div class="hidden lg:flex lg:w-1/2 relative bg-[#f8fafc] p-12 flex-col justify-between overflow-hidden">

            <div
                class="absolute top-0 left-0 w-[600px] h-[600px] bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40 -z-10 translate-x-[-20%] translate-y-[-20%] fade-in-left">
            </div>
            <div
                class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-green-100 rounded-full mix-blend-multiply filter blur-3xl opacity-40 -z-10 translate-x-[20%] translate-y-[20%] fade-in-left">
            </div>

            <div
                class="inline-flex items-center gap-2 bg-[#FFDF67] border border-yellow-400/30 text-[#181E4B] px-5 py-2.5 rounded-full text-sm font-bold shadow-sm self-start fade-in-left delay-100">
                <span>🚌</span> Discover the best trips at the lowest prices, made just for you.
            </div>

            <div class="flex-1 flex flex-col justify-center pl-2 fade-in-left delay-200">
                <h1 class="text-5xl xl:text-6xl font-extrabold leading-[1.15] mb-6 tracking-tight text-[#181E4B]">
                    Berpergian &<br>
                    nikmati<br>
                    <span class="text-[#2CB38B]">tempat baru</span> di<br>
                    indonesia <span class="inline-block">🏝️</span>
                </h1>

                <p class="text-[#181E4B]/70 text-lg mb-12 max-w-md leading-relaxed font-medium">
                    Setiap perjalanan punya cerita, dan Budget Trip memastikan ceritamu dimulai dengan perencanaan yang
                    cerdas. ✨
                </p>

                <div>
                    <h2 class="text-xl font-bold text-[#181E4B] mb-6 flex items-center gap-2">
                        <span class="w-1 h-6 bg-[#2CB38B] rounded-full block"></span>
                        Temukan Destinasi Favoritmu
                    </h2>

                    <div class="flex gap-5 overflow-visible py-2">
                        <div
                            class="relative w-40 h-52 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group cursor-pointer transform hover:-translate-y-2 fade-in-up delay-100">
                            <img src="/images/pangandaran.jpg" alt="Pangandaran"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                onerror="this.src='https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=400'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent">
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="font-bold text-lg leading-tight">Pangandaran</h3>
                                <p class="text-xs text-green-300 font-medium">Jawa Barat</p>
                            </div>
                        </div>

                        <div
                            class="relative w-40 h-52 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group cursor-pointer transform hover:-translate-y-2 mt-4 fade-in-up delay-200">
                            <img src="/images/parangtritis.png" alt="Parangtritis"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                onerror="this.src='https://images.unsplash.com/photo-1506929562872-bb421503ef21?w=400'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent">
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="font-bold text-lg leading-tight">Parangtritis</h3>
                                <p class="text-xs text-yellow-300 font-medium">DIY</p>
                            </div>
                        </div>

                        <div
                            class="relative w-40 h-52 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 group cursor-pointer transform hover:-translate-y-2 fade-in-up delay-100">
                            <img src="/images/bromo.png" alt="Bromo"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                onerror="this.src='https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=400'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent">
                            </div>
                            <div class="absolute bottom-4 left-4 text-white">
                                <h3 class="font-bold text-lg leading-tight">Bromo</h3>
                                <p class="text-xs text-blue-300 font-medium">Jawa Timur</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white relative">
            <div
                class="absolute top-0 right-0 w-64 h-64 bg-[#2CB38B] rounded-full mix-blend-multiply filter blur-3xl opacity-10 lg:hidden">
            </div>

            <div class="w-full max-w-md relative z-10 fade-in-right delay-200">

                <div class="bg-white p-8 rounded-[40px] shadow-2xl border border-gray-100">

                    <div class="flex flex-col items-center mb-4">
                        <a href="/" class="transform hover:scale-105 transition duration-300">
                            <img src="{{ asset('images/logo-budgettrip.png') }}" alt="BudgetTrip Logo"
                                class="h-56 w-auto object-contain">
                        </a>
                    </div>

                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</body>

</html>
