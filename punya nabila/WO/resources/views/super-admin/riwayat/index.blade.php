@extends('super-admin.layouts.app')
@section('page_title', 'RIWAYAT')
@section('content')

<div class="px-10 mt-10">

    {{-- Title --}}
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">
            Riwayat Keluhan Selesai
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Data keluhan yang telah diselesaikan
        </p>
    </div>

    {{-- Filter Card --}}
    <div class="bg-white border rounded-xl shadow-sm p-6 mb-8">

        <form method="GET">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Dari Tanggal Selesai --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">
                        Dari Tanggal Selesai
                    </label>
                    <input type="date" name="tanggal_dari"
                        value="{{ request('tanggal_dari') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Sampai Tanggal Selesai --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">
                        Sampai Tanggal Selesai
                    </label>
                    <input type="date" name="tanggal_sampai"
                        value="{{ request('tanggal_sampai') }}"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Petugas --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">
                        Petugas
                    </label>
                    <select name="petugas"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Semua Petugas</option>
                        @foreach($petugasList as $petugas)
                        <option value="{{ $petugas->id }}"
                            {{ request('petugas') == $petugas->id ? 'selected' : '' }}>
                            {{ $petugas->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Jenis Masalah --}}
                <div>
                    <label class="block text-xs font-medium text-gray-500 mb-1">
                        Jenis Masalah
                    </label>
                    <select name="jenis_masalah"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Semua Jenis</option>
                        @foreach($jenisMasalahList as $jenis)
                        <option value="{{ $jenis }}"
                            {{ request('jenis_masalah') == $jenis ? 'selected' : '' }}>
                            {{ $jenis }}
                        </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="flex justify-end mt-6 gap-3">

                <a href="{{ route('superadmin.riwayat') }}"
                    class="flex items-center gap-2 px-5 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition shadow-sm">

                    <ion-icon name="refresh-outline"></ion-icon>
                    <span>Reset</span>

                </a>

                <button type="submit"
                    class="flex items-center gap-2 px-6 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition shadow">

                    <ion-icon name="funnel-outline"></ion-icon>
                    <span>Filter</span>

                </button>

            </div>

        </form>

    </div>

    {{-- Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                <thead class="bg-blue-800 text-white text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Waktu Lapor</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Lokasi</th>
                        <th class="px-6 py-3">Petugas</th>
                        <th class="px-6 py-3">Waktu Selesai</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse($riwayat as $item)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            <div class="font-medium">
                                {{ $item->created_at->format('d/m/Y') }}
                            </div>
                            <div class="text-xs text-gray-400">
                                {{ $item->created_at->format('H:i') }}
                            </div>
                        </td>

                        <td class="px-6 py-4 text-gray-700">
                            {{ $item->kategori }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->lokasi }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->petugas ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ optional($item->waktu_selesai)->format('d/m/Y H:i') ?? '-' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <a href="#"
                                class="flex items-center justify-center gap-1 bg-gray-700 hover:bg-gray-800 text-white px-4 py-1.5 rounded-md text-xs transition">

                                <ion-icon name="eye-outline"></ion-icon>
                                <span>Detail</span>

                            </a>
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <span class="text-4xl mb-2">📁</span>
                                <p class="font-semibold">
                                    Belum ada riwayat keluhan selesai
                                </p>
                                <p class="text-xs">
                                    Data akan muncul setelah ada keluhan dengan status selesai
                                </p>
                            </div>
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

                {{-- pilihan jumlah data --}}
                <form method="GET" class="flex items-center gap-2 text-sm">

                    {{-- supaya filter tetap ada --}}
                    @foreach(request()->except('per_page','page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <span class="text-gray-600">Tampilkan</span>

                    <select name="per_page"
                        onchange="this.form.submit()"
                        class="border rounded px-3 py-1 pr-8 text-sm appearance-none bg-white">

                        @foreach([5,10,25,50,100] as $size)

                        <option value="{{ $size }}"
                            {{ request('per_page',10) == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>

                        @endforeach

                    </select>

                    <span class="text-gray-600">data</span>

                </form>

                {{-- pagination --}}
                <div class="text-sm">
                    {{ $riwayat->links() }}
                </div>

            </div>

        </div>
    </div>

    @endsection