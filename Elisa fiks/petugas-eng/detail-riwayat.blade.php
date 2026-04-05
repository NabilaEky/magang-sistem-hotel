@extends('petugas-eng.layouts.petugas')
@section('page_title', 'DETAIL RIWAYAT')

@section('content')



<div class="p-8">

    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-blue-800 text-white py-4 text-center font-semibold text-lg">
            Rincian Riwayat Keluhan
        </div>

        <div class="p-8 space-y-8">

            {{-- INFORMASI --}}
            <div class="space-y-4 text-gray-700">

                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-500">Tanggal</span>
                    <span>{{ $complaint->created_at->format('d/m/Y H:i') }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-500">Lokasi</span>
                    <span>{{ $complaint->lokasi }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-500">Jenis Masalah</span>
                    <span>{{ $complaint->jenis_masalah }}</span>
                </div>

                <div class="flex justify-between border-b pb-2">
                    <span class="font-medium text-gray-500">Kategori</span>
                    <span>{{ $complaint->kategori }}</span>
                </div>

                <div class="flex justify-between">
                    <span class="font-medium text-gray-500">Status</span>

                    <span class="px-3 py-1 text-sm rounded-full
                        @if($complaint->status == 'selesai') bg-green-100 text-green-600
                        @elseif($complaint->status == 'diproses') bg-yellow-100 text-yellow-600
                        @else bg-red-100 text-red-600
                        @endif
                    ">
                        {{ ucfirst($complaint->status) }}
                    </span>
                </div>

            </div>

            {{-- FOTO --}}
            <div>
                <h3 class="font-semibold text-gray-700 mb-4 border-b pb-2">
                    Foto Keluhan
                </h3>

                @php
    if (is_array($complaint->foto)) {
        $fotos = $complaint->foto;
    } elseif (!empty($complaint->foto)) {
        $decoded = json_decode($complaint->foto, true);
        $fotos = is_array($decoded) ? $decoded : [];
    } else {
        $fotos = [];
    }
@endphp

                @if (!empty($fotos))
                <div class="flex flex-wrap gap-4">
                    @foreach ($fotos as $foto)
                    <img src="{{ asset('storage/' . $foto) }}"
                        class="w-36 h-28 object-cover rounded-lg border shadow-sm">
                    @endforeach
                </div>
                @else
                <p class="text-gray-400 text-sm">Tidak ada foto</p>
                @endif
            </div>

            {{-- FOTO SELESAI --}}
            <div>
                <h3 class="font-semibold text-gray-700 mb-2 border-b pb-2">
                    Bukti Selesai
                </h3>
                <p class="text-xs text-gray-400 mb-4">
                    Foto setelah keluhan ditangani oleh petugas
                </p>

                @php
    if (is_array($complaint->foto_selesai)) {
        $fotosSelesai = $complaint->foto_selesai;
    } elseif (!empty($complaint->foto_selesai)) {
        $decoded = json_decode($complaint->foto_selesai, true);
        $fotosSelesai = is_array($decoded) ? $decoded : [];
    } else {
        $fotosSelesai = [];
    }
@endphp

                @if (!empty($fotosSelesai))
                <div class="flex flex-wrap gap-4">
                    @foreach ($fotosSelesai as $foto)
                    <img src="{{ asset('storage/' . $foto) }}"
                        class="w-36 h-28 object-cover rounded-lg border shadow-sm hover:scale-105 transition">
                    @endforeach
                </div>
                @else
                <p class="text-gray-400 text-sm italic">
                    Belum ada bukti selesai
                </p>
                @endif
            </div>

            {{-- DESKRIPSI --}}
            <div>
                <h3 class="font-semibold text-gray-700 mb-4 border-b pb-2">
                    Deskripsi Keluhan
                </h3>

                <div class="text-gray-700 text-sm bg-gray-50 p-4 rounded-lg border min-h-[80px]">
                    {{ $complaint->deskripsi }}
                </div>
            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end">
                <a href="{{ route('petugas.riwayat') }}"
                    class="px-6 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                    ← Kembali
                </a>
            </div>

        </div>

    </div>

</div>

@endsection