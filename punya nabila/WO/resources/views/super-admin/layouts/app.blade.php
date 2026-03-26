<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard Super Admin</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script type="module" src="https://unpkg.com/ionicons@7/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7/dist/ionicons/ionicons.js"></script>
</head>

<body class="bg-gray-200">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('super-admin.partials.sidebar')

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col">

            {{-- Header --}}
            <div class="bg-slate-800 text-white p-6 text-center text-3xl font-semibold tracking-wide">
                @yield('page_title', 'Dashboard Super Admin')
            </div>

            {{-- Content --}}
            <div class="p-8">

                {{-- Flash Messages --}}
                @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
                @endif

                {{-- Page Content --}}
                @yield('content')

            </div>

        </div>

    </div>

</body>

</html>