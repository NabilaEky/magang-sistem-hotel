<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sistem Keluhan</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

</head>

<body class="h-screen bg-gradient-to-br from-slate-100 to-slate-300 flex items-center justify-center overflow-hidden">

    <div class="w-[1050px] h-[600px] bg-white rounded-2xl shadow-2xl grid grid-cols-2 overflow-hidden">

        <!-- LEFT : BRANDING -->
        <div class="relative">

            <img src="{{ asset('images/test2.jpg') }}"
                class="w-full h-full object-cover">

            <!-- overlay -->
            <div class="absolute inset-0 bg-black/40 flex items-center justify-center text-center p-10">

                <div class="text-white">

                    <h1 class="text-4xl font-bold tracking-wide drop-shadow-lg">
                        e-Work Order
                    </h1>

                    <p class="text-sm mt-2 text-gray-200">
                        Hotel Patra Jasa Semarang
                    </p>

                </div>

            </div>

        </div>


        <!-- RIGHT : LOGIN -->
        <div class="flex items-center justify-center p-12">

            <div class="w-full max-w-sm">
                {{ $slot }}
            </div>

        </div>

    </div>

</body>

</html>