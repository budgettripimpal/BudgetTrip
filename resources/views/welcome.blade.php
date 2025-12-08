<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BudgetTrip - Travel Smart</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .fade-in-right {
            animation: fadeInRight 1s ease-out forwards;
            opacity: 0;
            transform: translateX(20px);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
    </style>
</head>

<body class="antialiased bg-white text-gray-800 overflow-x-hidden">

    <nav
        class="fixed w-full top-0 z-50 bg-white/90 backdrop-blur-xl border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center relative">

            <div class="flex items-center hover:opacity-90 transition cursor-pointer">

                <img src="{{ asset('images/logo-budgettrip.png') }}" alt="BudgetTrip Logo"
                    class="absolute top-0 left-6 h-28 w-auto object-contain drop-shadow-sm transform -translate-y-2 hover:scale-105 transition duration-300">

                <span class="ml-28 text-2xl font-bold text-gray-900 tracking-tight whitespace-nowrap">
                    BUDGET <span class="text-[#28B088]">TRIP</span>
                </span>
            </div>

            <div class="flex items-center gap-6">
                @if (Route::has('login'))
                    @auth
                        <div class="flex items-center gap-4">
                            <span class="font-bold text-gray-700 hidden md:block text-lg">Hi,
                                {{ Auth::user()->name }}</span>
                            <a href="{{ url('/dashboard') }}"
                                class="px-8 py-3 bg-[#2CB38B] text-white font-bold text-lg rounded-full shadow-lg shadow-green-200 hover:bg-green-600 hover:shadow-xl transition transform hover:-translate-y-0.5">
                                Dashboard
                            </a>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="font-bold text-gray-600 hover:text-[#28B088] text-lg transition px-2">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-9 py-3 bg-[#2CB38B] text-white font-bold text-lg rounded-full shadow-lg shadow-green-200 hover:bg-green-700 hover:shadow-green-300 transition transform hover:-translate-y-0.5">
                                Sign Up
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <section class="relative pt-48 pb-20 px-6 max-w-7xl mx-auto min-h-screen flex items-center">

        <div
            class="absolute top-0 right-0 w-[800px] h-[800px] bg-blue-50 rounded-full mix-blend-multiply filter blur-3xl opacity-40 -z-10 translate-x-1/3 -translate-y-1/4">
        </div>
        <div
            class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-green-50 rounded-full mix-blend-multiply filter blur-3xl opacity-40 -z-10 -translate-x-1/4 translate-y-1/4">
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-20 items-center w-full">

            <div class="flex flex-col gap-10 fade-in-up" style="animation-delay: 0.1s;">

                <div class="relative group w-fit">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-[#4475F2] to-[#2a52be] rounded-[65px] blur-2xl opacity-30 group-hover:opacity-50 transition duration-700">
                    </div>

                    <div
                        class="relative bg-gradient-to-br from-[#4475F2] via-[#3a66e0] to-[#2a52be] rounded-[60px] p-10 md:p-14 shadow-[0_30px_60px_-15px_rgba(68,117,242,0.5),inset_0_2px_20px_rgba(255,255,255,0.2)] overflow-hidden border border-white/10">

                        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl">
                        </div>
                        <div
                            class="absolute -bottom-10 -left-10 w-40 h-40 bg-[#6390ff] rounded-full blur-2xl opacity-40">
                        </div>
                        <div class="absolute top-10 right-20 w-16 h-16 bg-white/10 rounded-full blur-xl"></div>

                        <h1
                            class="relative font-bold text-3xl md:text-[44px] leading-relaxed text-white tracking-wide text-left max-w-lg drop-shadow-sm">
                            Temukan, rencanakan, dan wujudkan perjalanan impianmu dengan Budget Trip.
                            <svg class="w-10 h-10 inline-block mb-2 text-green-300 opacity-90 align-bottom drop-shadow-md"
                                fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z" />
                            </svg>
                        </h1>
                    </div>
                </div>

                <div class="pl-5">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center px-10 py-4 bg-[#2CB38B] text-white font-bold text-xl rounded-full shadow-lg shadow-green-200 hover:bg-green-700 hover:shadow-green-300 transition transform hover:-translate-y-1">
                        Mulai Sekarang
                    </a>
                </div>

            </div>

            <div class="relative flex justify-center md:justify-end items-center fade-in-right"
                style="animation-delay: 0.3s;">
                <div
                    class="relative w-full max-w-3xl transform scale-110 lg:scale-125 origin-center lg:origin-right transition-transform duration-700 hover:scale-[1.30]">
                    <img src="{{ asset('images/landing-hero.png') }}" alt="Budget Trip Hero"
                        class="w-full h-auto object-contain drop-shadow-2xl">
                </div>
            </div>

        </div>
    </section>

</body>

</html>
