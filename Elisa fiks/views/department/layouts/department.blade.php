<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">




    <!-- CONTENT -->
    <div class="flex-1 bg-gray-100 min-h-screen">

        @hasSection('header')
    <div class="bg-slate-800 text-white px-10 py-5 flex justify-between items-center">

        {{-- Judul --}}
        <h1 class="text-lg font-semibold tracking-wide">
            @yield('header')
        </h1>

        {{-- Menu Kanan --}}
        <div class="flex items-center gap-6 text-sm">

            <a href="{{ route('dept.profil-dept') }}"
               class="hover:text-gray-300 transition">
                Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                        class="bg-red-500 hover:bg-red-600 px-4 py-1.5 rounded-md transition">
                    Logout
                </button>
            </form>

        </div>

    </div>
@endif

        {{-- CONTENT --}}
        <div class="p-10">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>