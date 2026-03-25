@extends('petugas-admin.layouts.dashboard')

@section('header')
<h1 class="text-2xl text-center font-semibold text-white">
    DASHBOARD ADMIN
</h1>
@endsection


@section('content')

{{-- ================= CARD STATISTIK ================= --}}
<div class="grid grid-cols-4 gap-8 mb-14">

    {{-- Total Keluhan --}}
    <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-100 p-6">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-slate-500 text-sm font-semibold">Total Keluhan</h3>
            <div class="bg-slate-200 w-9 h-9 flex items-center justify-center rounded-lg text-lg">
                📋
            </div>
        </div>

        <div class="text-4xl font-bold text-slate-700">
            {{ $totalKeluhan }}
        </div>

    </div>


    {{-- Keluhan Baru --}}
    <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-100 p-6">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-slate-500 text-sm font-semibold">Pending</h3>
            <div class="bg-slate-200 w-9 h-9 flex items-center justify-center rounded-lg text-lg">
                🆕
            </div>
        </div>

        <div class="text-4xl font-bold text-slate-700">
            {{ $keluhanBaru }}
        </div>

    </div>


    {{-- Dalam Proses --}}
    <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-100 p-6">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-slate-500 text-sm font-semibold">Dalam Proses</h3>
            <div class="bg-slate-200 w-9 h-9 flex items-center justify-center rounded-lg text-lg">
                ⚙️
            </div>
        </div>

        <div class="text-4xl font-bold text-slate-700">
            {{ $dalamProses }}
        </div>

    </div>


    {{-- Selesai --}}
    <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-md hover:shadow-xl hover:-translate-y-1 transition duration-300 border border-slate-100 p-6">

        <div class="flex justify-between items-center mb-4">
            <h3 class="text-slate-500 text-sm font-semibold">Selesai</h3>
            <div class="bg-slate-200 w-9 h-9 flex items-center justify-center rounded-lg text-lg">
                ✅
            </div>
        </div>

        <div class="text-4xl font-bold text-slate-700">
            {{ $selesai }}
        </div>

    </div>

</div>



{{-- ================= TABEL KELUHAN ================= --}}
<div class="mb-14">

    <h2 class="text-xl font-bold text-slate-700 mb-5">
        Daftar Keluhan Terbaru
    </h2>

    <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden">

        <table class="w-full text-sm">

            <thead class="bg-blue-800 text-white">

                <tr>
                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Waktu</th>
                    <th class="p-4 text-left">Lokasi</th>
                    <th class="p-4 text-left">Jenis Masalah</th>
                    <th class="p-4 text-left">Prioritas</th>
                    <th class="p-4 text-left">Status</th>
                    <th class="p-4 text-left">Petugas</th>
                </tr>

            </thead>


            <tbody class="divide-y text-slate-700">

                @foreach($keluhanTerbaru as $k)

                <tr class="hover:bg-slate-50 transition duration-200">

                    <td class="p-4 font-semibold">
                        {{ $k->id }}
                    </td>

                    <td class="p-4">

                        {{ $k->created_at->format('d/m/Y') }}

                        <br>

                        <span class="text-xs text-slate-400">
                            {{ $k->created_at->format('H:i') }}
                        </span>

                    </td>

                    <td class="p-4">
                        {{ $k->lokasi }}
                    </td>

                    <td class="p-4">
                        {{ $k->jenis_masalah }}
                    </td>

                    <td class="p-4">

                        <span class="px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-xs font-semibold">
                            {{ $k->prioritas }}
                        </span>

                    </td>

                    <td class="p-4">

                        <span class="px-3 py-1 bg-slate-200 text-slate-800 rounded-full text-xs font-semibold">
                            {{ $k->status }}
                        </span>

                    </td>

                    <td class="p-4">
                        {{ $k->petugas ?? '-' }}
                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>



{{-- ================= MONITORING PETUGAS ================= --}}
<div>

    <h2 class="text-xl font-bold text-slate-700 mb-5">
        Monitoring Petugas Hari Ini
    </h2>

    <div class="bg-white rounded-2xl shadow-md border border-slate-100 overflow-hidden w-2/3">

        <table class="w-full text-sm">

            <thead class="bg-blue-800 text-white">

                <tr>
                    <th class="p-4 text-left">Nama</th>
                    <th class="p-4 text-left">Shift</th>
                    <th class="p-4 text-left">Status</th>
                </tr>

            </thead>


            <tbody class="divide-y">

                @foreach($petugas as $p)

                <tr class="hover:bg-slate-50 transition">

                    <td class="p-4 font-medium">
                        {{ $p->nama }}
                    </td>

                    <td class="p-4">
                        {{ $p->shift }}
                    </td>

                    <td class="p-4">

                        <span class="px-3 py-1 bg-slate-100 rounded-full text-xs font-semibold text-slate-700">
                            {{ $p->status }}
                        </span>

                    </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection