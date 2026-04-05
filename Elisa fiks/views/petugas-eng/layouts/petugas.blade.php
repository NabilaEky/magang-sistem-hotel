<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title', 'Petugas Engineering')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Ionicons --}}
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</head>

<body class="bg-gray-200">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('petugas-eng.partials.sidebar')

    {{-- Main Content --}}
    <div class="flex-1">

        {{-- Header --}}
        <div class="bg-slate-800 text-white p-6 text-center text-3xl font-semibold">
            @yield('page_title')
        </div>

        {{-- Page Content --}}
        <div class="p-8">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>