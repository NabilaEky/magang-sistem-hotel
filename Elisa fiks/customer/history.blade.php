@extends('customer.layouts.customer')

@section('page-title', 'RIWAYAT KELUHAN')

@section('page-content')

<div class="w-full max-w-6xl mx-auto space-y-6">

    {{-- SEARCH + FILTER --}}
    <div class="bg-white p-5 rounded-xl shadow-md flex items-center justify-between">

        <form method="GET" class="flex items-center gap-3">
            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari keluhan..."
                class="border border-gray-300 rounded-md px-4 py-2 w-64 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
                Search
            </button>
        </form>

        <form method="GET" class="flex items-center gap-3">
            <input type="date"
                name="tanggal"
                value="{{ request('tanggal') }}"
                class="border border-gray-300 rounded-md px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md shadow">
                Filter
            </button>
        </form>

    </div>


    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <table class="w-full text-sm text-center">

            <thead class="bg-blue-800 text-white">
                <tr>
                    <th class="px-4 py-3">ID</th>
                    <th class="px-4 py-3">Waktu</th>
                    <th class="px-4 py-3">Jenis Masalah</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                @forelse($keluhan as $item)

                <tr class="hover:bg-gray-50">

                    <td class="py-3">{{ $item->id }}</td>

                    <td>{{ $item->created_at->format('H:i') }}</td>

                    <td>{{ $item->jenis_keluhan }}</td>

                    <td>{{ $item->kategori }}</td>

                    {{-- 🔥 FOTO --}}
                    <td>
                        @php
                        $fotos = $item->foto;

                        // kalau string → decode
                        if (is_string($fotos)) {
                        $fotos = json_decode($fotos, true);
                        }
                        @endphp

                        @if (!empty($fotos))
                        <div class="flex justify-center gap-2">
                            @foreach ($fotos as $foto)
                            <img src="{{ asset('storage/' . $foto) }}"
                                class="w-14 h-14 object-cover rounded border">
                            @endforeach
                        </div>
                        @else
                        <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">
                            {{ $item->status }}
                        </span>
                    </td>

                    <td class="flex justify-center gap-2 py-3">

                        <a href="{{ route('customer.detail',$item->id) }}"
                            class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-1 rounded-md text-xs">
                            Detail
                        </a>

                        <form action="{{ route('customer.delete', $item->id) }}" method="POST"
                            onsubmit="return confirm('Yakin mau hapus keluhan ini?')">

                            @csrf
                            @method('DELETE')

                            <button
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-md text-xs">
                                Delete
                            </button>

                        </form>

                    </td>

                </tr>

                @empty

                {{-- EMPTY DATA --}}
                <tr>
                    <td colspan="7" class="py-10 text-gray-500">
                        <div class="flex flex-col items-center space-y-2">
                            <span class="text-lg">📭</span>
                            <p class="font-medium">Belum ada keluhan</p>
                            <p class="text-sm text-gray-400">
                                Keluhan yang Anda kirim akan muncul di sini
                            </p>
                        </div>
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{-- Pagination --}}
    <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

        {{-- pilihan jumlah data --}}
        <form method="GET" class="flex items-center gap-2 text-sm">

            {{-- bawa semua parameter --}}
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

        {{-- pagination --}}
        <div class="text-sm">
            {{ $keluhan->links() }}
        </div>

    </div>

</div>

@endsection