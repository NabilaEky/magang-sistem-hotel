@extends('department.layouts.department')

@section('header')
RIWAYAT KELUHAN
@endsection

@section('content')

<div class="flex justify-center py-10 px-4">
    <div class="w-full max-w-6xl">

        {{-- FILTER --}}
        <form method="GET" action="{{ route('dept.index') }}">
            <div class="bg-white p-6 rounded-xl shadow-sm mb-6">
                <div class="flex gap-4 items-center flex-wrap">

                    {{-- SEARCH --}}
                    <input type="text" name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari..."
                        class="border px-4 py-2 rounded-lg w-64 h-10 focus:ring-2 focus:ring-blue-500 outline-none">

                    {{-- TANGGAL --}}
                    <input type="date" name="tanggal"
                        value="{{ request('tanggal') }}"
                        class="border px-4 py-2 rounded-lg h-10 w-40 focus:ring-2 focus:ring-blue-500 outline-none">

                    {{-- STATUS --}}
                    <select name="status"
                        class="border px-4 py-2 rounded-lg h-10 w-40 focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">Pilih Status</option>
                        <option value="Proses" {{ request('status')=='Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ request('status')=='Selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="Pending" {{ request('status')=='Pending' ? 'selected' : '' }}>Pending</option>
                    </select>

                    {{-- 🔥 JUMLAH DATA --}}
                    <select name="per_page" onchange="this.form.submit()"
                        class="border px-4 py-2 rounded-lg h-10 w-32">
                        <option value="5" {{ request('per_page')==5 ? 'selected' : '' }}>5</option>
                        <option value="10" {{ request('per_page')==10 ? 'selected' : '' }}>10</option>
                        <option value="50" {{ request('per_page')==50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page')==100 ? 'selected' : '' }}>100</option>
                    </select>

                    {{-- BUTTON --}}
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700">
                        Filter
                    </button>

                </div>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">

                    <thead class="bg-blue-700 text-white">
                        <tr>
                            <th class="px-6 py-3 text-left">ID</th>
                            <th class="px-6 py-3 text-left">Waktu</th>
                            <th class="px-6 py-3 text-left">Lokasi</th>
                            <th class="px-6 py-3 text-left">Jenis Masalah</th>
                            <th class="px-6 py-3 text-left">Status</th>
                            <th class="px-6 py-3 text-left">Petugas</th>
                            <th class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-700 divide-y">

                        @forelse ($data as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                {{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->waktu)->format('d/m/Y') }}
                                <div class="text-xs text-gray-500">
                                    {{ \Carbon\Carbon::parse($item->waktu)->format('H:i') }} WIB
                                </div>
                            </td>

                            <td class="px-6 py-4">{{ $item->lokasi }}</td>
                            <td class="px-6 py-4">{{ $item->jenis_masalah }}</td>

                            <td class="px-6 py-4">
                                <span class="inline-block 
                                    @if($item->status == 'Selesai') bg-green-100 text-green-700
                                    @elseif($item->status == 'Proses') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-700
                                    @endif
                                    px-3 py-1 rounded-full text-xs">
                                    {{ $item->status }}
                                </span>
                            </td>

                            <td class="px-6 py-4">{{ $item->petugas }}</td>

                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('dept.detail', $item->id) }}"
                                    class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-1.5 rounded-lg text-sm transition">
                                    Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-6 text-gray-400">
                                Belum ada riwayat keluhan
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

        {{-- 🔥 INFO DATA --}}
        <div class="mt-4 text-sm text-gray-600">
            Menampilkan {{ $data->firstItem() }} - {{ $data->lastItem() }}
            dari {{ $data->total() }} data
        </div>

        {{-- 🔥 PAGINATION --}}
        <div class="mt-4 flex justify-center">
            {{ $data->links() }}
        </div>

        {{-- BUTTON KEMBALI --}}
        <div class="flex justify-end mt-6">
            <a href="{{ route('dept.homee') }}"
                class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg text-sm shadow transition">
                Kembali
            </a>
        </div>

    </div>
</div>

@endsection