@extends('petugas-admin.layouts.dashboard')

@section('header')
<h1 class="text-2xl text-center font-semibold text-white">
    RIWAYAT KELUHAN
</h1>
@endsection

@if(session('success'))
<div class="bg-green-100 text-green-700 p-3 rounded mb-4">
    {{ session('success') }}
</div>
@endif

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <!-- FILTER -->
    <form method="GET" action="{{ route('admin.riwayat') }}">
        <div class="flex flex-wrap gap-4 mb-6">

            <!-- TANGGAL -->
            <input
                type="date"
                name="tanggal"
                value="{{ request('tanggal') }}"
                class="border px-3 py-2 rounded">

            <!-- PETUGAS -->
            <select name="petugas" class="border px-8 py-2 rounded">
                <option value="">Petugas</option>
                <option value="Andi" {{ request('petugas')=='Andi' ? 'selected' : '' }}>Andi</option>
                <option value="Budi" {{ request('petugas')=='Budi' ? 'selected' : '' }}>Budi</option>
                <option value="Rudi" {{ request('petugas')=='Rudi' ? 'selected' : '' }}>Rudi</option>
            </select>

            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Filter
            </button>

            <!-- RESET FILTER -->
            <a href="{{ route('admin.riwayat') }}"
                class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                Reset
            </a>

        </div>
    </form>

    <!-- TABLE -->
    <div class="bg-white shadow-md rounded-xl overflow-hidden">

        <table class="w-full text-sm">

            <!-- HEADER -->
            <thead class="bg-blue-700 text-white text-center uppercase text-xs tracking-wider">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Waktu</th>
                    <th class="p-3">Jenis Masalah</th>
                    <th class="p-3">Lokasi</th>
                    <th class="p-3">Petugas</th>
                    <th class="p-3">Tanggal Selesai</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody class="text-center text-gray-700">

                @forelse($riwayat as $r)
                <tr class="border-t hover:bg-gray-50 transition">

                    <td class="p-3 font-medium">{{ $r->id }}</td>

                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($r->waktu)->format('d/m/Y') }}
                    </td>

                    <td class="p-3">{{ $r->jenis_masalah }}</td>

                    <td class="p-3">{{ $r->lokasi }}</td>

                    <td class="p-3">{{ $r->petugas }}</td>

                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($r->tanggal_selesai)->format('d/m/Y') }}
                    </td>

                    <td class="p-3 flex justify-center gap-2">

                        <!-- DETAIL -->
                        <a href="{{ route('admin.detail-riwayat', $r->id) }}"
                            class="bg-gray-600 text-white px-4 py-1.5 rounded-lg hover:bg-gray-700 transition text-sm shadow">
                            Detail
                        </a>

                        <!-- HAPUS -->
                        <form action="{{ route('admin.riwayat-hapus', $r->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus riwayat ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 text-white px-4 py-1.5 rounded-lg hover:bg-red-700 transition text-sm shadow">
                                Hapus
                            </button>
                        </form>

                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="7" class="p-6 text-gray-500 text-center">
                        Data riwayat tidak ditemukan !
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>

        <!-- PAGINATION -->
        <div class="p-4 border-t flex justify-center">
            {{ $riwayat->links() }}
        </div>

    </div>

</div>
@endsection