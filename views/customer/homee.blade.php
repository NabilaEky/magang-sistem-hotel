@extends('customer.layouts.customer')

@section('page-content')

<div class="w-full max-w-5xl flex flex-col items-center">

    {{-- POPUP TENGAH --}}
    @if(session('success'))
        <div id="popupOverlay"
             class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 opacity-0 pointer-events-none transition duration-300">

            <div id="popupBox"
                 class="bg-white rounded-2xl shadow-xl px-8 py-6 text-center transform scale-75 opacity-0 transition duration-300">

                <div class="text-green-500 text-4xl mb-3">✔</div>

                <h3 class="text-lg font-semibold mb-2">Berhasil!</h3>

                <p class="text-gray-600">
                    {{ session('success') }}
                </p>

                <button onclick="closePopup()"
                        class="mt-5 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg">
                    OK
                </button>

            </div>
        </div>
    @endif

    {{-- Gambar --}}
    <div class="w-full">
        <img src="{{ asset('images/hotel.jpg') }}"
             class="w-full h-[400px] object-cover rounded-md shadow-md"
             alt="Hotel">
    </div>

    {{-- Text --}}
    <div class="text-center mt-10 space-y-4">
        <h2 class="text-xl font-medium">
            Selamat Datang Di Hotel Patra Jasa Semarang
        </h2>

        <p class="text-red-500 font-semibold">
            Room Xxxx
        </p>
        
        <p class="text-lg">
            Apakah Anda Memiliki Keluhan?
        </p>

        <p class="text-gray-700">
            Klik dibawah ini jika Anda memiliki masalah dengan room Anda
        </p>
    </div>

    {{-- Buttons --}}
    <div class="mt-12 flex gap-12">

        <a href="{{ route('customer.form') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-3 rounded-lg shadow-lg">
            Form Keluhan
        </a>

        <a href="{{ route('customer.history') }}"
           class="bg-gray-500 hover:bg-gray-600 text-white px-10 py-3 rounded-lg shadow-lg">
            History Keluhan
        </a>

    </div>

</div>

{{-- SCRIPT POPUP --}}
<script>
    const overlay = document.getElementById('popupOverlay');
    const box = document.getElementById('popupBox');

    if (overlay && box) {
        // munculin popup
        setTimeout(() => {
            overlay.classList.remove('opacity-0', 'pointer-events-none');
            box.classList.remove('scale-75', 'opacity-0');
            box.classList.add('scale-100', 'opacity-100');
        }, 100);
    }

    function closePopup() {
        overlay.classList.add('opacity-0', 'pointer-events-none');
    }
</script>

@endsection