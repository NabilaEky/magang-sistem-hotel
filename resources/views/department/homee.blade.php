@extends('department.layouts.department')

@section('header')
e-WO 
@endsection

@section('content')

<div class="w-full max-w-4xl mx-auto">

    {{-- SLIDER --}}
    <div class="relative w-full overflow-hidden rounded-lg shadow-md">

        <div id="slider" class="flex transition-transform duration-700">

            <img src="{{ asset('images/hotel.png') }}"
                class="w-full h-[300px] object-cover flex-shrink-0">

            <img src="{{ asset('images/hotel1.png') }}"
                class="w-full h-[300px] object-cover flex-shrink-0">

            <img src="{{ asset('images/hotel2.jpg') }}"
                class="w-full h-[300px] object-cover flex-shrink-0">

            <img src="{{ asset('images/hotel3.jpg') }}"
                class="w-full h-[300px] object-cover flex-shrink-0">

        </div>

    </div>

    {{-- Text --}}
    <div class="mt-10 space-y-3">
        <h2 class="text-2xl text-center font-semibold">
            Selamat Datang Di Hotel Patra Jasa Semarang
        </h2>

        <p class="text-lg text-center">
            Apakah Anda Memiliki Keluhan?
        </p>

        <p class="text-gray-600 text-center">
            Klik dibawah ini jika Anda memiliki masalah dengan room Anda
        </p>
    </div>

    {{-- Button --}}
    <div class="mt-5 flex justify-center gap-6">
        <a href="{{ route('form') }}"
            class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-lg shadow-md transition">
            Form Keluhan
        </a>

        <a href="{{ route('index') }}"
            class="bg-gray-500 hover:bg-gray-600 text-white px-10 py-3 rounded-lg shadow-lg transition duration-300">
            History Keluhan
        </a>
    </div>

</div>

{{-- JS Auto Scroll --}}
<script>
    const slider = document.getElementById('slider');
    const slides = slider.children;
    const totalSlides = slides.length;
    let index = 0;

    function slideNext() {
        index++;
        if(index >= totalSlides) index = 0; // kembali ke slide pertama
        slider.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(slideNext, 3000); // ganti slide tiap 3 detik
</script>

@endsection