{{--
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-200">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <div class="w-64 bg-slate-800 text-white p-5">

        <h1 class="text-xl font-bold mb-10">
            Work Order
            <div class="text-sm font-normal">for Patra</div>
        </h1>

        <!-- Profile -->
        <div class="flex justify-center mb-8">
            <div class="w-20 h-20 bg-gray-300 rounded-full"></div>
        </div>

        <!-- Search -->
        <input type="text"
               placeholder="Search..."
               class="w-full mb-6 px-3 py-2 text-black rounded">

        <!-- Menu -->
        <div class="space-y-3">

            <a href="/dashboard" 
                class="block px-4 py-2 rounded
                {{ request()->is('dashboard') ? 'bg-white text-black' : 'text-white' }}">
                Dashboard
            </a>

            <a href="{{ route('profil') }}"
                class="block px-4 py-2 rounded
                {{ request()->is('profil') ? 'bg-white text-black' : 'text-white' }}">
                Profile
            </a>

            <a href="/keluhan"
                class="block px-4 py-2 rounded
                {{ request()->is('keluhan') ? 'bg-white text-black' : 'text-white' }}">
                Daftar Keluhan
            </a>

            <a href="{{ route('feedback') }}"
                class="block px-4 py-2 rounded
                {{ request()->is('feedback') ? 'bg-white text-black' : 'text-white' }}">
                Feedback
            </a>

            <a href="{{ route('riwayat') }}"
                class="block px-4 py-2 rounded
                {{ request()->is('riwayat') ? 'bg-white text-black' : 'text-white' }}">
                Riwayat
            </a>

        </div>

        <!-- Logout -->
        <div class="mt-20">
            <button class="bg-white text-black px-4 py-2 rounded">
                Logout
            </button>
        </div>

    </div>


    <!-- CONTENT -->
    <div class="flex-1 bg-gray-100 min-h-screen">

        @if(isset($header))
            <div class="bg-slate-800 text-white px-10 py-6">
                {{ $header }}
            </div>
        @endif

        <div class="p-10">
            {{ $slot }}
        </div>

    </div>

</div>

</body>
</html>
--}}