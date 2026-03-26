<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title', 'Petugas Engineering')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-200">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @include('petugas-eng.partials.sidebar')

    {{-- Content langsung tanpa header --}}
    <div class="flex-1 p-8">
        @yield('content')
    </div>

</div>

</body>
</html>