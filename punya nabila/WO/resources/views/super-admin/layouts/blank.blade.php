<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('page_title', 'Super Admin')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
     <script type="module" src="https://unpkg.com/ionicons@7/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7/dist/ionicons/ionicons.js"></script>
</head>
</head>

<body class="min-h-screen bg-gradient-to-br from-gray-100 to-gray-200">

    <div class="min-h-screen flex flex-col">
        {{-- CONTENT WRAPPER --}}
        <main class="flex-1 flex items-center justify-center px-6 pb-10">

            <div class="w-full max-w-5xl">
                <div class="bg-white rounded-2xl shadow-xl p-10 mt-20">
                    @yield('content')
                </div>
            </div>

        </main>

        {{-- FOOTER --}}
        <footer class="text-center text-sm text-gray-500 pb-6">
            © {{ date('Y') }} Super Admin Panel
        </footer>

    </div>

</body>
</html>