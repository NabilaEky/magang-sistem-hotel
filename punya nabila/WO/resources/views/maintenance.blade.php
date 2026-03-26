<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Maintenance</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-gray-100 to-gray-200 flex items-center justify-center min-h-screen font-sans">

<div class="bg-white p-12 rounded-3xl shadow-2xl text-center max-w-lg animate-fadeIn">
    
    <!-- Icon / Illustration -->
    <div class="flex justify-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-yellow-500 animate-bounce" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
    </div>

    <!-- Title -->
    <h1 class="text-4xl font-extrabold text-gray-800 mb-4">
        Sistem Sedang Maintenance
    </h1>

    <!-- Description -->
    <p class="text-gray-600 mb-8 leading-relaxed">
        Kami sedang melakukan perawatan sistem.<br>
        Silakan coba kembali beberapa saat lagi.
    </p>

    <!-- Button / Link -->
    <a href="/" 
       class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl shadow-md hover:bg-blue-700 transition transform hover:-translate-y-1">
        Kembali ke Beranda
    </a>

</div>

<!-- Animasi tambahan -->
<style>
@keyframes fadeIn {
  0% { opacity: 0; transform: translateY(-20px); }
  100% { opacity: 1; transform: translateY(0); }
}
.animate-fadeIn {
  animation: fadeIn 0.8s ease-out forwards;
}
</style>

</body>
</html>