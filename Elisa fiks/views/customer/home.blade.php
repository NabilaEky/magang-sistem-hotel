@extends('customer.layouts.customer')

@section('page-content')

<div class="w-full max-w-4xl mx-auto">

    {{-- SLIDER --}}
    <div class="relative w-full overflow-hidden rounded-lg shadow-md">

        <div id="slider" class="flex transition-transform duration-700">

            <img src="{{ asset('images/RS RTBL.png') }}"
                class="w-full h-[300px] object-cover flex-shrink-0">

            <img src="{{ asset('images/ball.jpeg') }}"
                class="w-full h-[300px] object-cover flex-shrink-0">

            <img src="{{ asset('images/hal.jpg') }}"
                class="w-full h-[300px] object-cover flex-shrink-0">



        </div>

    </div>

    {{-- TEXT --}}
    <div class="text-center mt-10 space-y-3 px-4">

        <h2 class="text-2xl font-semibold">
            Selamat Datang Di Hotel Patra Jasa Semarang
        </h2>

        <p class="text-red-500 font-semibold ">
            Room Xxxx
        </p>

        <p class="text-lg">
            Apakah Anda Memiliki Keluhan?
        </p>

        <p class="text-gray-600">
            Klik dibawah ini jika Anda memiliki masalah dengan room Anda
        </p>

        <div class="mt-6">
            <a href="{{ route('customer.form') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-lg shadow-md">
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

        if (index >= total) {
            index = 0
        }

        slider.style.transform = `translateX(-${index * 100}%)`

    }, 3000)
</script>

@endsection