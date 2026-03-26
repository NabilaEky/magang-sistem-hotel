@extends('super-admin.layouts.app')
@section('page_title', 'DASHBOARD SUPER ADMIN')

@section('content')

{{-- Statistik Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">

    {{-- Total Keluhan --}}
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-gray-500 text-sm">Total Keluhan</p>
        <div class="flex items-center justify-between mt-2">
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $totalKeluhan }}
            </h2>
            @php $naik = $growthTotal >= 0; @endphp
            <span class="text-sm font-semibold {{ $naik ? 'text-green-500' : 'text-red-500' }}">
                {{ $naik ? '↑' : '↓' }} {{ abs($growthTotal) }}%
            </span>
        </div>
    </div>

    {{-- Keluhan Baru --}}
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-gray-500 text-sm">Keluhan Baru</p>
        <div class="flex items-center justify-between mt-2">
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $keluhanBaru }}
            </h2>
            @php $naik = $growthBaru >= 0; @endphp
            <span class="text-sm font-semibold {{ $naik ? 'text-green-500' : 'text-red-500' }}">
                {{ $naik ? '↑' : '↓' }} {{ abs($growthBaru) }}%
            </span>
        </div>
    </div>

    {{-- Dalam Proses --}}
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-gray-500 text-sm">Dalam Proses</p>
        <div class="flex items-center justify-between mt-2">
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $dalamProses }}
            </h2>
            @php $naik = $growthDiproses >= 0; @endphp
            <span class="text-sm font-semibold {{ $naik ? 'text-green-500' : 'text-red-500' }}">
                {{ $naik ? '↑' : '↓' }} {{ abs($growthDiproses) }}%
            </span>
        </div>
    </div>

    {{-- Selesai --}}
    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-gray-500 text-sm">Selesai</p>
        <div class="flex items-center justify-between mt-2">
            <h2 class="text-3xl font-bold text-gray-800">
                {{ $selesai }}
            </h2>
            @php $naik = $growthSelesai >= 0; @endphp
            <span class="text-sm font-semibold {{ $naik ? 'text-green-500' : 'text-red-500' }}">
                {{ $naik ? '↑' : '↓' }} {{ abs($growthSelesai) }}%
            </span>
        </div>
    </div>

</div>


{{-- Chart Section --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Keluhan per Kategori</h3>
        <div class="h-64 flex items-center justify-center text-gray-400">
            Chart Area
        </div>
    </div>

    <div class="bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Laporan Bulanan</h3>
        <div class="h-64 flex items-center justify-center text-gray-400">
            Chart Area
        </div>
    </div>

</div>


{{-- Bottom Section --}}
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

    {{-- Table --}}
    <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
        <h3 class="text-lg font-semibold mb-4">Daftar Keluhan Terbaru</h3>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Nama Pelapor</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($keluhanTerbaru as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $item->id }}</td>
                        <td class="px-4 py-3">{{ $item->user->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $item->kategori }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full
            @if($item->status == 'selesai') bg-green-100 text-green-600
            @elseif($item->status == 'diproses') bg-yellow-100 text-yellow-600
            @else bg-red-100 text-red-600
            @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            {{ $item->created_at->format('d M Y') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-gray-400">
                            Belum ada data keluhan
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Pie + Performance --}}
    <div class="bg-white rounded-xl shadow p-6">

        {{-- Distribusi Status --}}
        <h3 class="text-lg font-semibold mb-2">
            Distribusi Status
        </h3>

        <div class="space-y-4 mb-4">

            @foreach($statusDistribusi as $status => $total)

            @php
            $percent = $totalKeluhan > 0 ? round(($total / $totalKeluhan) * 100) : 0;
            @endphp

            <div>

                <div class="flex justify-between text-sm mb-1">

                    <span class="capitalize font-medium">
                        {{ $status }}
                    </span>

                    <span class="text-gray-600">
                        {{ $total }} ({{ $percent }}%)
                    </span>

                </div>

                <div class="w-full bg-gray-200 rounded-full h-2">

                    <div
                        class="h-2 rounded-full
                    @if($status == 'selesai') bg-green-500
                    @elseif($status == 'diproses') bg-yellow-500
                    @else bg-red-500
                    @endif"
                        style="width: {{ $percent }}%">
                    </div>

                </div>

            </div>

            @endforeach

        </div>


        {{-- Performa Petugas --}}
        <h3 class="text-lg font-semibold mb-4">
            Performa Petugas
        </h3>

        <div class="space-y-4 text-sm">

            @forelse($performaPetugas as $petugas)

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-2">

                    <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-xs font-bold">
                        {{ strtoupper(substr($petugas->name,0,1)) }}
                    </div>

                    <span class="font-medium">
                        {{ $petugas->name }}
                    </span>

                </div>

                <span class="font-semibold text-blue-600">
                    {{ $petugas->total_selesai }}
                </span>

            </div>

            @empty

            <div class="text-gray-400 text-center">
                Belum ada data petugas
            </div>

            @endforelse

        </div>

    </div>

</div>

@endsection