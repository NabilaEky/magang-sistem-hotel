@extends('petugas-eng.layouts.petugas')
@section('page_title', 'Detail Keluhan')

@section('content')

{{-- Informasi Keluhan --}}
<div class="bg-white shadow rounded-xl mb-8 overflow-hidden">

    <div class="bg-blue-600 text-white px-6 py-3 font-semibold">
        Informasi Keluhan
    </div>

    <div class="p-6 space-y-3 text-gray-700">

        <div class="flex gap-3">
            <span class="font-semibold w-40">Room</span>
            <span>: 204</span>
        </div>

        <div class="flex gap-3">
            <span class="font-semibold w-40">Jenis Masalah</span>
            <span>: AC Tidak Dingin</span>
        </div>

        <div class="flex gap-3">
            <span class="font-semibold w-40">Deskripsi</span>
            <span>: AC tidak mengeluarkan udara dingin sejak pagi.</span>
        </div>

    </div>

</div>


{{-- Bukti Proses --}}
<div class="bg-white shadow rounded-xl mb-8 overflow-hidden">

    <div class="bg-blue-600 text-white px-6 py-3 font-semibold">
        Bukti Proses
    </div>

    <div class="p-6 flex flex-wrap gap-6">

        {{-- Upload Box --}}
        <div class="w-56 h-36 border-2 border-dashed rounded-lg flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition">

            <ion-icon name="cloud-upload-outline" class="text-3xl text-gray-500"></ion-icon>
            <span class="text-sm text-gray-500 mt-1">Upload Foto</span>

        </div>

        {{-- Image --}}
        <div class="w-56 h-36 border rounded-lg relative flex items-center justify-center bg-gray-50">
            Image
            <button class="absolute top-2 right-2 text-gray-500 hover:text-red-500">
                ✕
            </button>
        </div>

        <div class="w-56 h-36 border rounded-lg relative flex items-center justify-center bg-gray-50">
            Image
            <button class="absolute top-2 right-2 text-gray-500 hover:text-red-500">
                ✕
            </button>
        </div>

    </div>

</div>


{{-- Bukti Selesai --}}
<div class="bg-white shadow rounded-xl mb-8 overflow-hidden">

    <div class="bg-blue-600 text-white px-6 py-3 font-semibold">
        Bukti Selesai
    </div>

    <div class="p-6">

        <div class="w-64 h-40 border-2 border-dashed rounded-lg flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition">

            <ion-icon name="cloud-upload-outline" class="text-3xl text-gray-500"></ion-icon>
            <span class="text-sm text-gray-500 mt-1">Upload Foto</span>

        </div>

    </div>

</div>


{{-- Catatan --}}
<div class="bg-white shadow rounded-xl mb-10 overflow-hidden">

    <div class="bg-blue-600 text-white px-6 py-3 font-semibold">
        Catatan
    </div>

    <div class="p-6 flex flex-col md:flex-row gap-6">

        <textarea
            class="flex-1 border rounded-lg p-3 h-40 focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Tambahkan catatan pekerjaan..."></textarea>

        <div class="flex items-start gap-3">

            <label class="font-semibold text-gray-700 mt-2">
                Status
            </label>

            <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option>Proses</option>
                <option>Selesai</option>
                <option>Pending</option>
            </select>

        </div>

    </div>

</div>


{{-- Buttons --}}
<div class="flex justify-end gap-4">

    <a href="{{ route('petugas.daftar-keluhan') }}"
       class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
         Kembali
    </a>

    <button class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-lg transition">
        Edit
    </button>

</div>

@endsection