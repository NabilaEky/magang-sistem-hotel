@extends('petugas-eng.layouts.petugas')
@section('page_title', 'LAPORAN PROGRAM KERJA')

@section('content')

{{-- Filter Section --}}
<div class="bg-white shadow-lg rounded-xl p-6 mb-6">

    <div class="flex flex-wrap items-center justify-between gap-4">

        {{-- Search --}}
        <input
            type="text"
            placeholder="Cari laporan..."
            class="border rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-blue-500">

        {{-- Filter --}}
        <div class="flex flex-wrap gap-4">

            {{-- Filter Realisasi --}}
            <select class="border rounded-lg px-4 py-2 pr-8">
                <option>Semua Realisasi</option>
                <option>Civil</option>
                <option>ME</option>
            </select>

            {{-- Filter Jenis --}}
            <select class="border rounded-lg px-4 py-2 pr-8">
                <option>Semua Jenis</option>
                <option>Harian</option>
                <option>Bulanan</option>
            </select>

            {{-- Filter Shift --}}
            <select class="border rounded-lg px-4 py-2 pr-8">
                <option>Semua Shift</option>
                <option>Pagi</option>
                <option>Sore</option>
                <option>Malam</option>
            </select>

            {{-- Filter Status --}}
            <select class="border rounded-lg px-4 py-2 pr-8">
                <option>Semua Status</option>
                <option>Draft</option>
                <option>Proses</option>
                <option>Selesai</option>
            </select>

        </div>

    </div>

</div>

{{-- Tombol Tambah --}}
<div class="flex justify-end mt-8 mb-3">

    <a href="{{ route('petugas.tambah-laporan') }}"
        class="px-6 py-3 bg-green-600 text-white rounded-full shadow hover:bg-green-700 transition">

        + Tambah Laporan

    </a>
</div>
{{-- Table --}}
<div class="bg-white shadow-lg rounded-xl overflow-hidden">

    <table class="w-full text-center">

        <thead class="bg-blue-800 text-white">
            <tr>
                <th class="p-4">Tanggal</th>
                <th class="p-4">Realisasi</th>
                <th class="p-4">Jenis Laporan</th>
                <th class="p-4">Shift</th>
                <th class="p-4">Status</th>
                <th class="p-4">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-gray-700">

            @forelse($laporan as $item)

            <tr class="border-b hover:bg-gray-50 transition">

                <td class="p-4">
                    {{ $item->created_at->format('d M Y') }}
                </td>

                <td class="p-4">
                    <span class="px-3 py-1 bg-blue-100 text-blue-600 text-sm rounded-full">
                        {{ $item->realisasi }}
                    </span>
                </td>

                <td class="p-4">{{ $item->jenis }}</td>
                <td class="p-4">{{ $item->shift }}</td>

                <td class="p-4">
                    {{ $item->status }}
                </td>

                <td class="p-4">
                    <div class="flex justify-center gap-2">

                        {{-- DETAIL --}}
                        <a href="{{ route('petugas.detail-laporan', $item->id) }}"
                            class="px-3 py-1 bg-blue-600 text-white rounded-md text-sm">
                            Detail
                        </a>

                        {{-- EDIT --}}
                        <a href="{{ route('petugas.edit-laporan', $item->id) }}"
                            class="px-3 py-1 bg-orange-500 text-white rounded-md text-sm">
                            Edit
                        </a>

                        {{-- DELETE --}}
                        <form action="{{ route('petugas.hapus-laporan',$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Yakin hapus?')"
                                class="px-3 py-1 bg-red-500 text-white rounded-md text-sm">
                                Hapus
                            </button>
                        </form>

                    </div>
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="6" class="p-6 text-gray-500 text-center">
                    Belum ada data laporan
                </td>
            </tr>

            @endforelse

        </tbody>
    </table>

    @if(session('success'))
    <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif





</div>

@endsection