@extends('petugas-eng.layouts.petugas')
@section('page_title', 'Detail Keluhan')

@section('content')

@php
    // 🔥 HANDLE FOTO JSON / ARRAY
    $fotos = is_array($keluhan->foto) ? $keluhan->foto : json_decode($keluhan->foto, true);

    // 🔥 CEK STATUS
    $isReadonly = $keluhan->status == 'pending';
@endphp

{{-- ================= INFORMASI ================= --}}
<div class="bg-white shadow rounded-xl mb-8 overflow-hidden">

    <div class="bg-blue-600 text-white px-6 py-3 font-semibold">
        Informasi Keluhan
    </div>

    <div class="p-6 space-y-3 text-gray-700">

        <div class="flex gap-3">
            <span class="font-semibold w-40">Lokasi</span>
            <span>: {{ $keluhan->lokasi }}</span>
        </div>

        <div class="flex gap-3">
            <span class="font-semibold w-40">Jenis Masalah</span>
            <span>: {{ $keluhan->jenis_masalah }}</span>
        </div>

        <div class="flex gap-3">
            <span class="font-semibold w-40">Deskripsi</span>
            <span>: {{ $keluhan->deskripsi }}</span>
        </div>

        <div class="flex gap-3">
            <span class="font-semibold w-40">Status</span>
            <span>: 
                <span class="px-3 py-1 rounded text-white
                    {{ $keluhan->status == 'pending' ? 'bg-gray-500' : '' }}
                    {{ $keluhan->status == 'diproses' ? 'bg-blue-500' : '' }}
                    {{ $keluhan->status == 'selesai' ? 'bg-green-500' : '' }}">
                    {{ $keluhan->status }}
                </span>
            </span>
        </div>

    </div>

</div>


{{-- ================= FOTO BEFORE ================= --}}
<div class="bg-white shadow rounded-xl mb-8 overflow-hidden">

    <div class="bg-blue-600 text-white px-6 py-3 font-semibold">
        Foto Keluhan (Before)
    </div>

    <div class="p-6 flex flex-wrap gap-4">

        @if($fotos)
            @foreach($fotos as $img)
                <img src="{{ asset('storage/'.$img) }}"
                     onclick="window.open(this.src)"
                     class="w-56 object-contain rounded-lg border cursor-pointer hover:scale-105 transition">
            @endforeach
        @else
            <span class="text-gray-400">Tidak ada foto</span>
        @endif

    </div>

</div>


{{-- ================= BUTTON ================= --}}
<div class="flex justify-end gap-4">

    <a href="{{ route('petugas.daftar-keluhan') }}"
       class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">
        Kembali
    </a>

    @if(!$isReadonly)
    <button class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-lg">
        Edit
    </button>
    @endif

</div>

@endsection