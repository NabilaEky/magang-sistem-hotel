<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<body class="bg-gray-200 overflow-hidden">

    <div class="flex h-screen">

        <!-- SIDEBAR -->
        <div class="w-64 bg-slate-800 text-white p-6 shadow-lg h-screen">

            <!-- Logo -->
            <h1 class="text-center text-xl font-bold mb-10 tracking-wide">
                e-WO
                <div class="text-xs text-slate-300 font-normal">
                    Patra Semarang Hotel & Convention
                </div>
            </h1>

            <!-- Profile -->
            <div class="flex flex-col items-center mb-8">

                <div class="w-20 h-20 rounded-full mb-3 overflow-hidden bg-slate-600">

                    @if(!empty($profile->foto))
                    <img src="{{ asset('storage/'.$profile->foto) }}"
                        class="w-full h-full object-cover">
                    @else
                    <img src="https://ui-avatars.com/api/?name={{ $profile->nama ?? 'Admin' }}"
                        class="w-full h-full object-cover">
                    @endif

                </div>

                <p class="text-sm text-slate-300">
                    {{ $profile->nama ?? 'Admin' }}
                </p>

            </div>

            <!-- Search -->
            <input type="text"
                placeholder="Search..."
                class="w-full mb-8 px-3 py-2 rounded bg-slate-700 placeholder-slate-300 focus:outline-none">

            <!-- MENU -->
            <div class="space-y-2 text-sm">

                <!-- Dashboard -->
                <a href="/dashboard"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('dashboard') ? 'bg-white text-black' : 'hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7m-9 2v8m4-8v8m5-8h-2" />
                    </svg>
                    Dashboard
                </a>

                <!-- Profile -->
                <a href="{{ route('profil') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('profil') ? 'bg-white text-black' : 'hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5.121 17.804A4 4 0 019 16h6a4 4 0 013.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Profile
                </a>

                <!-- Keluhan -->
                <a href="/keluhan"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('keluhan') ? 'bg-white text-black' : 'hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M8 10h.01M12 10h.01M16 10h.01M9 16h6M21 12c0 4.418-4.03 8-9 8a9.96 9.96 0 01-4-.8L3 20l1.8-4A7.963 7.963 0 013 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Daftar Keluhan
                </a>

                <!-- Feedback -->
                <a href="{{ route('feedback') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('feedback') ? 'bg-white text-black' : 'hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M7 8h10M7 12h6m-6 4h10M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Feedback
                </a>

                <!-- Riwayat -->
                <a href="{{ route('riwayat') }}"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg transition
                {{ request()->is('riwayat') ? 'bg-white text-black' : 'hover:bg-slate-700' }}">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Riwayat
                </a>

            </div>

            <!-- Logout -->
            <div class="mt-16">
                <button class="w-full bg-white text-black py-2 rounded-lg hover:bg-gray-200 transition">
                    Logout
                </button>
            </div>

        </div>


        <!-- CONTENT -->
        <div class="flex-1 flex flex-col">

            {{-- HEADER --}}
            @hasSection('header')
            <div class="bg-slate-800 text-white px-10 py-6 shadow">
                @yield('header')
            </div>
            @endif

            {{-- CONTENT SCROLL --}}
            <div class="flex-1 overflow-y-auto bg-gray-100 p-10">

                {{-- NOTIFIKASI --}}
                @if(session('success'))
                <div id="notif" class="fixed top-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(function() {
                        document.getElementById('notif').style.display = 'none';
                    }, 3000);
                </script>
                @endif

                @yield('content')

            </div>

        </div>

    </div>

</body>

</html>