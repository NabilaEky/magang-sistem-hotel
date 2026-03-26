@extends('super-admin.layouts.app')
@section('page_title', 'DETAIL DAFTAR KELUHAN')

@section('content')

<div class="max-w-6xl mx-auto mt-10 space-y-8">

    {{-- Title --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Detail Daftar Keluhan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Informasi lengkap laporan dan proses penanganan
        </p>
    </div>

    <div class="grid grid-cols-2 gap-8">

        {{-- ================= LEFT SIDE ================= --}}
        <div class="space-y-8">

            {{-- Informasi Keluhan --}}
            <div class="bg-white rounded-xl shadow-sm border p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    Informasi Keluhan
                </h2>

                <div class="grid grid-cols-2 gap-6 text-sm">

                    <div>
                        <span class="text-gray-500">ID</span>
                        <div class="font-medium">#{{ $keluhan->id }}</div>
                    </div>

                    <div>
                        <span class="text-gray-500">Tanggal</span>
                        <div class="font-medium">
                            {{ $keluhan->created_at->format('d M Y H:i') }}
                        </div>
                    </div>

                    <div>
                        <span class="text-gray-500">Lokasi</span>
                        <div class="font-medium">
                            {{ $keluhan->lokasi }}
                        </div>
                    </div>

                    <div>
                        <span class="text-gray-500">Jenis Masalah</span>
                        <div class="font-medium">
                            {{ $keluhan->jenis_masalah }}
                        </div>
                    </div>

                    <div class="col-span-2">
                        <span class="text-gray-500">Deskripsi</span>
                        <div class="font-medium">
                            {{ $keluhan->deskripsi ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="text-gray-500">Waktu Selesai</span>
                        <div class="font-medium">
                            {{ $keluhan->waktu_selesai ?? '-' }}
                        </div>
                    </div>

                </div>
            </div>

            {{-- Foto Masalah --}}
            <div class="bg-white rounded-xl shadow-sm border p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    Foto Masalah
                </h2>

                <div class="flex gap-4 flex-wrap">

                    @php
                    $fotos = [$keluhan->foto1, $keluhan->foto2, $keluhan->foto3];
                    @endphp

                    @forelse(array_filter($fotos) as $foto)
                    <img src="{{ asset('storage/'.$foto) }}"
                        class="w-32 h-24 object-cover rounded-lg shadow-sm hover:scale-105 transition cursor-pointer">
                    @empty
                    <div class="text-sm text-gray-400">
                        Tidak ada foto
                    </div>
                    @endforelse

                </div>
            </div>

            {{-- Pengaturan Admin --}}
            <div class="bg-white rounded-xl shadow-sm border p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6">
                    Pengaturan Admin
                </h2>

                <div class="space-y-4 text-sm">

                    <div>
                        <span class="text-gray-500">Petugas</span>
                        <div class="font-medium">
                            {{ $keluhan->petugas->name ?? '-' }}
                        </div>
                    </div>

                    <div>
                        <span class="text-gray-500">Status</span>
                        <div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $keluhan->status == 'selesai' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $keluhan->status == 'diproses' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $keluhan->status == 'menunggu' ? 'bg-gray-200 text-gray-700' : '' }}">
                                {{ ucfirst($keluhan->status) }}
                            </span>
                        </div>
                    </div>

                    <div>
                        <span class="text-gray-500">Prioritas</span>
                        <div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $keluhan->prioritas == 'tinggi' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $keluhan->prioritas == 'sedang' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $keluhan->prioritas == 'rendah' ? 'bg-green-100 text-green-700' : '' }}">
                                {{ ucfirst($keluhan->prioritas) }}
                            </span>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- ================= RIGHT SIDE ================= --}}
        <div class="space-y-8">

            {{-- Proses Pengerjaan --}}
            <div class="bg-white rounded-xl shadow-sm border p-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-6 text-center">
                    Proses Pengerjaan Petugas
                </h2>

                <div class="grid grid-cols-3 gap-4 mb-6">
                    @for($i = 0; $i < 6; $i++)
                        <div class="h-24 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400">
                        Bukti Proses
                </div>
                @endfor
            </div>

            <div class="text-sm">
                <span class="text-gray-500">Catatan Petugas</span>
                <div class="mt-1 font-medium">
                    {{ $keluhan->catatan_petugas ?? '-' }}
                </div>
            </div>
        </div>

        {{-- Feedback --}}
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">
                Feedback Pengunjung
            </h2>

            <div class="space-y-4 text-sm">

                <div>
                    <span class="text-gray-500">Rating</span>
                    <div class="text-lg">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <=($keluhan->rating ?? 0))
                            ⭐
                            @else
                            ☆
                            @endif
                            @endfor
                    </div>
                </div>

                <div>
                    <span class="text-gray-500">Komentar</span>
                    <div class="mt-2 border rounded-lg p-4 bg-gray-50">
                        {{ $keluhan->komentar ?? 'Belum ada komentar' }}
                    </div>
                </div>

            </div>
        </div>

        {{-- Aksi --}}
        <div class="flex gap-4 justify-end">

            <a href="{{ route('daftar-keluhan.index') }}"
                class="flex items-center gap-2 px-6 py-2 border rounded-lg text-gray-600 hover:bg-gray-100 transition text-sm">

                <ion-icon name="arrow-back-outline"></ion-icon>
                <span>Kembali</span>

            </a>

            <button class="flex items-center gap-2 px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm text-sm">

                <ion-icon name="logo-whatsapp"></ion-icon>
                <span>Kirim WhatsApp</span>

            </button>

            <button class="flex items-center gap-2 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-sm text-sm">

                <ion-icon name="print-outline"></ion-icon>
                <span>Cetak</span>

            </button>

        </div>

    </div>

</div>

</div>

@endsection