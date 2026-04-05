@extends('department.layouts.department')

@section('header')
<div class="">
    <h1 class="text-10 font-semibold">e-WO</h1>
    <p class="text-sm text-gray-600 mt-1">Patra Semarang Hotel & Convention</p>
</div>
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

    {{-- TEXT --}}
    <div class="text-center mt-10 space-y-3 px-4">

        <h2 class="text-2xl font-semibold">
            Selamat Datang Di Hotel Patra Jasa Semarang
        </h2>

        <p class="text-lg">
            Apakah Anda Memiliki Keluhan?
        </p>

        <p class="text-gray-600">
            Klik dibawah ini jika Anda memiliki masalah dengan room Anda
        </p>

        <div class="mt-6">
            <a href="{{ route('dept.form') }}"
                class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-lg shadow-md transition">
                Form Keluhan
            </a>
        </div>

    </div>

</div>

{{-- SCRIPT AUTO SLIDE --}}
<script>

let slider = document.getElementById('slider')
let index = 0
let total = slider.children.length

setInterval(() => {

    index++

    if(index >= total){
        index = 0
    }

    slider.style.transform = `translateX(-${index * 100}%)`

}, 3000)

</script>

@endsection