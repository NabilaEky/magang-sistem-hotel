<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center">

    <!-- CARD UTAMA -->
    <div class="w-[1000px] h-[600px] bg-white rounded-xl shadow-lg grid grid-cols-2 overflow-hidden">

        <!-- KIRI : GAMBAR -->
        <div>
            <img src="{{ asset('images/login.jpeg') }}"
                 class="w-full h-full object-cover">
        </div>

        <!-- KANAN : FORM -->
        <div class="flex items-center justify-center p-10">
            <div class="w-full max-w-sm">
                {{ $slot }}
            </div>
        </div>

    </div>

</body>
</html>