@extends('petugas-eng.layouts.petugas')

@section('page_title','RIWAYAT')

@section('content')

<div class="p-8">


    {{-- Filter Section --}}
    <div class="bg-white shadow-lg rounded-xl p-6 mb-6">

        <form method="GET">

            <div class="flex flex-wrap items-center justify-between gap-4">

                <div class="flex flex-wrap gap-3">

                    {{-- Filter Tanggal --}}
                    <input
                        type="date"
                        name="tanggal"
                        value="{{ request('tanggal') }}"
                        class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

                    {{-- Filter Lokasi --}}
                    <select name="lokasi"
                        class="border border-gray-300 rounded-lg px-4 py-2 bg-white pr-8">

                        <option value="">Semua Lokasi</option>
                        <option value="Gedung A">Gedung A</option>
                        <option value="Gedung B">Gedung B</option>

                    </select>

                </div>

                {{-- Button Filter --}}
                <button
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">

                    Filter

                </button>

            </div>

        </form>

    </div>


    {{-- Table --}}
    <div class="bg-white rounded-xl overflow-hidden shadow-lg">

        <table class="w-full text-center">

            {{-- Header --}}
            <thead class="bg-blue-800 text-white">
                <tr>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Lokasi</th>
                    <th class="p-4">Jenis Masalah</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>

            {{-- Body --}}
            <tbody class="text-gray-700">

                @forelse($complaints as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4">
                        {{ $item->created_at->format('d/m/Y') }}
                    </td>

                    <td class="p-4">
                        {{ $item->lokasi }}
                    </td>

                    <td class="p-4">
                        {{ $item->jenis_masalah }}
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 text-sm rounded-full
            @if($item->status == 'selesai') bg-green-100 text-green-600
            @elseif($item->status == 'diproses') bg-yellow-100 text-yellow-600
            @else bg-red-100 text-red-600
            @endif
        ">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>

                    <td class="p-4">
                        <a href="{{ route('petugas.detail-riwayat', $item->id) }}"
                            class="px-4 py-2 bg-gray-600 text-white rounded-md text-sm hover:bg-gray-700">
                            Detail
                        </a>
                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="5" class="p-4 text-gray-500">
                        Tidak ada data keluhan
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>
        {{-- Pagination --}}
        <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

            {{-- pilihan jumlah data --}}
            <form method="GET" class="flex items-center gap-2 text-sm">

                {{-- bawa semua filter --}}
                @foreach(request()->except('per_page','page') as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach

                <span class="text-gray-600">Tampilkan</span>

                <select name="per_page"
                    onchange="this.form.submit()"
                    class="border rounded px-3 py-1 pr-8 text-sm bg-white">

                    @foreach([5,10,25,50,100] as $size)
                    <option value="{{ $size }}"
                        {{ request('per_page',10) == $size ? 'selected' : '' }}>
                        {{ $size }}
                    </option>
                    @endforeach

                </select>

                <span class="text-gray-600">data</span>
            </form>

            {{-- links --}}
            <div class="text-sm">
                {{ $complaints->links() }}
            </div>

        </div>

    </div>

</div>

@endsection