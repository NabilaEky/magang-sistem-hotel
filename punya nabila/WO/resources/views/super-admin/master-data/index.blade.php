@extends('super-admin.layouts.app')
@section('page_title', 'MASTER DATA MANAGEMENT')

@section('content')

<div class="mt-10 px-6">

    {{-- Header --}}
    <div class="bg-white border rounded-xl shadow-sm p-6 mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Master Data Management
            </h2>
            <p class="text-sm text-gray-500">
                Kelola data lokasi, kategori, dan departement
            </p>
        </div>

        {{-- Filter + Tambah --}}
        <form method="GET" action="{{ route('superadmin.master-data.index') }}" class="flex flex-wrap items-center gap-3">

            {{-- Text Search --}}
            <input type="text" name="search" value="{{ request('search') }}"
                placeholder="Cari kode atau nama..."
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm bg-white focus:ring focus:ring-blue-200 focus:outline-none">

            {{-- Filter Status --}}
            @php
            $statusMapping = [
            'aktif' => 'Aktif',
            'non_aktif' => 'Non Aktif',
            ];
            @endphp

            <select name="status"
                class="border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm bg-white focus:ring focus:ring-blue-200 focus:outline-none">
                <option value="">Pilih Status</option>
                @foreach($statusMapping as $value => $label)
                <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>
                    {{ $label }}
                </option>
                @endforeach
            </select>

            {{-- Filter Tipe --}}
            <select name="tipe"
                class="border border-gray-300 rounded-lg px-4 py-2 text-sm bg-white focus:ring focus:ring-blue-200 focus:outline-none">
                <option value="">Pilih Tipe</option>
                @foreach($tipeOptions as $tipe)
                <option value="{{ $tipe }}" {{ request('tipe') == $tipe ? 'selected' : '' }}>
                    {{ $tipe }}
                </option>
                @endforeach
            </select>

            {{-- Tombol Filter --}}
            <button type="submit"
                class="flex items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow transition">

                <ion-icon name="funnel-outline"></ion-icon>
                Filter

            </button>

            {{-- Tambah Dropdown --}}
            <div x-data="{ open: false }" class="relative ml-auto">

                <button
                    type="button"
                    @click="open = !open"
                    class="flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow transition">

                    <ion-icon name="add-outline"></ion-icon>
                    Tambah
                    <ion-icon name="chevron-down-outline"></ion-icon>

                </button>

                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 mt-2 w-44 bg-white border rounded-lg shadow overflow-hidden z-20">

                    <a href="{{ route('superadmin.lokasi.create') }}"
                        class="block px-4 py-2 text-sm hover:bg-gray-100">Lokasi</a>

                    <a href="{{ route('superadmin.kategori.create') }}"
                        class="block px-4 py-2 text-sm hover:bg-gray-100">Kategori</a>

                    <a href="{{ route('superadmin.departement.create') }}"
                        class="block px-4 py-2 text-sm hover:bg-gray-100">Departement</a>

                    <a href="{{ route('superadmin.jabatan.create') }}"
                        class="block px-4 py-2 text-sm hover:bg-gray-100">Jabatan</a>

                </div>

            </div>

        </form>
    </div>

    {{-- Table Card --}}
    <div class="bg-white border rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                {{-- Header --}}
                <thead class="bg-blue-800 text-white text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-4 text-center">Kode</th>
                        <th class="px-6 py-4">Nama Data</th>
                        <th class="px-6 py-4 text-center">Tipe</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($data as $item)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- KODE --}}
                        <td class="px-6 py-4 text-center font-medium text-gray-700">
                            {{ $item['kode'] }}
                        </td>

                        {{-- NAMA --}}
                        <td class="px-6 py-4 text-gray-800">
                            {{ $item['nama'] }}
                        </td>

                        {{-- TIPE --}}
                        <td class="px-6 py-4 text-center">
                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-xs font-medium">
                                {{ $item['tipe'] }}
                            </span>
                        </td>

                        {{-- STATUS --}}
                        <td class="px-6 py-4 text-center">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                {{ $item['status'] }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                <a href="{{ route('superadmin.master-data.edit', [
    'tipe' => $item['tipe_slug'],
    'id' => $item['id']
]) }}"
                                    class="flex items-center gap-1 px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs transition">

                                    <ion-icon name="create-outline"></ion-icon>
                                    Edit
                                </a>

                                <form
                                    action="{{ route('superadmin.master-data.destroy', [
'tipe' => $item['tipe_slug'],
'id' => $item['id']
]) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin mau hapus data ini?')">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="flex items-center gap-1 px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs transition">

                                        <ion-icon name="trash-outline"></ion-icon>
                                        Delete

                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-10 text-gray-400">
                            Belum ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

                {{-- per page --}}
                <form method="GET" class="flex items-center gap-2 text-sm">

                    @foreach(request()->except('per_page','page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <span class="text-gray-600">Tampilkan</span>

                    <select name="per_page"
                        onchange="this.form.submit()"
                        class="border rounded px-3 py-1 pr-8 text-sm">

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
                    {{ $data->links() }}
                </div>

            </div>
        </div>

    </div>

</div>

@endsection