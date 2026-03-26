@extends('super-admin.layouts.app')
@section('page_title', 'DAFTAR KELUHAN')
@section('content')

{{-- Filter Section --}}
<div class="bg-white border rounded-xl shadow-sm p-6 mt-10 mb-6">

    <form method="GET">

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">

            {{-- Dari Tanggal --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">
                    Dari Tanggal
                </label>
                <input type="date" name="tanggal_dari"
                    value="{{ request('tanggal_dari') }}"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- Sampai Tanggal --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">
                    Sampai Tanggal
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
                    <option value="">Semua</option>
                    @foreach($petugasList as $petugas)
                    <option value="{{ $petugas->id }}"
                        {{ request('petugas') == $petugas->id ? 'selected' : '' }}>
                        {{ $petugas->name }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Prioritas --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">
                    Prioritas
                </label>
                <select name="prioritas"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Semua</option>
                    @foreach($prioritasList as $prioritas)
                    <option value="{{ $prioritas }}"
                        {{ request('prioritas') == $prioritas ? 'selected' : '' }}>
                        {{ ucfirst($prioritas) }}
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
                    <option value="">Semua</option>
                    @foreach($jenisMasalahList as $jenis)
                    <option value="{{ $jenis }}"
                        {{ request('jenis_masalah') == $jenis ? 'selected' : '' }}>
                        {{ $jenis }}
                    </option>
                    @endforeach
                </select>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-xs font-medium text-gray-500 mb-1">
                    Status
                </label>
                <select name="status"
                    class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">Semua</option>
                    @foreach($statusList as $status)
                    <option value="{{ $status }}"
                        {{ request('status') == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                    @endforeach
                </select>
            </div>

        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3 mt-6">

            <a href="{{ route('superadmin.daftar-keluhan.index') }}"
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
{{-- Filter Info --}}
<div class="mb-4 text-sm text-gray-600 bg-blue-50 border border-blue-200 px-4 py-2 rounded-lg">
    {{ $filterKeterangan }}
</div>

{{-- Table Card --}}
<div class="bg-white rounded-xl shadow-sm border overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">

            <thead class="bg-blue-800 text-white text-xs uppercase tracking-wide">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Waktu</th>
                    <th class="px-6 py-3">Jenis Masalah</th>
                    <th class="px-6 py-3">Kategori</th>
                    <th class="px-6 py-3">Lokasi</th>
                    <th class="px-6 py-3">Petugas</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">Prioritas</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200 bg-white">

                @forelse($keluhan as $item)
                <tr class="hover:bg-gray-50 transition">

                    <td class="px-6 py-4 font-medium text-gray-700">
                        {{ $loop->iteration }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->created_at->format('d/m/Y H:i') }}
                    </td>

                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $item->jenis_masalah }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->kategori }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->lokasi }}
                    </td>

                    <td class="px-6 py-4 text-gray-600">
                        {{ $item->petugas ?? '-' }}
                    </td>

                    <td class="px-6 py-4">
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium capitalize">
                            {{ $item->status }}
                        </span>
                    </td>

                    <td class="px-6 py-4">
                        <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold capitalize">
                            {{ $item->prioritas }}
                        </span>
                    </td>

                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-2">

                            <a href="{{ route('daftar-keluhan.show', $item->id) }}"
                                class="flex items-center gap-1 bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-xs transition">

                                <ion-icon name="eye-outline"></ion-icon>
                                <span>Detail</span>

                            </a>

                            <a href="{{ route('daftar-keluhan.edit', $item->id) }}"
                                class="flex items-center gap-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-xs transition">

                                <ion-icon name="create-outline"></ion-icon>
                                <span>Edit</span>

                            </a>

                            <form action="{{ route('daftar-keluhan.destroy', $item->id) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin hapus data ini?')"
                                    class="flex items-center gap-1 bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition">

                                    <ion-icon name="trash-outline"></ion-icon>
                                    <span>Hapus</span>

                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="9" class="text-center py-12">
                        <div class="flex flex-col items-center justify-center text-gray-400">
                            <span class="text-4xl mb-2">📭</span>
                            <p class="font-semibold">
                                Tidak ada data keluhan
                            </p>
                            <p class="text-xs">
                                Data akan muncul setelah ada keluhan masuk
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

                {{-- pertahankan filter saat ganti pagination --}}
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
                {{ $keluhan->links() }}
            </div>

        </div>

    </div>
</div>
@endsection