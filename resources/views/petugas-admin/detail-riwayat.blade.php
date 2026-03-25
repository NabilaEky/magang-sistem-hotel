@extends('petugas-admin.layouts.dashboard')

@section('header')
<h1 class="text-2xl text-center font-semibold text-white">
    DETAIL RIWAYAT
</h1>
@endsection

@section('content')
<div class="flex justify-center mt-10">

    <div class="w-full max-w-2xl bg-white rounded-xl shadow">

        <!-- HEADER -->
        <div class="bg-blue-600 text-white text-center py-3 font-semibold rounded-t-xl">
            RINCIAN RIWAYAT PENGERJAAN
        </div>

        <!-- CONTENT -->
        <div class="p-6 grid grid-cols-2 gap-y-4 text-sm">

            <div>ID</div>
            <div>: {{ $riwayat->id }}</div>

            <div>Tanggal</div>
            <div>: {{ \Carbon\Carbon::parse($riwayat->waktu)->format('d/m/Y') }}</div>

            <div>Lokasi</div>
            <div>: {{ $riwayat->lokasi }}</div>

            <div>Jenis Masalah</div>
            <div>: {{ $riwayat->jenis_masalah }}</div>

            <div>Tanggal Selesai</div>
            <div>: {{ \Carbon\Carbon::parse($riwayat->tanggal_selesai)->format('d/m/Y') }}</div>

            <div>Petugas</div>
            <div>: {{ $riwayat->petugas }}</div>

        </div>

        <!-- BUTTON -->
        <div class="text-center pb-5">
            <a href="{{ route('riwayat') }}"
               class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700">
                Kembali
            </a>
        </div>

    </div>

</div>
@endsection