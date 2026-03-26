@extends('super-admin.layouts.app')
@section('page_title', 'LAPORAN KELUHAN')

@section('content')

<div class="max-w-7xl mx-auto mt-10 space-y-10">

    {{-- Page Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Laporan Keluhan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Ringkasan dan daftar seluruh laporan keluhan
        </p>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <p class="text-gray-500 text-sm">Total Keluhan</p>
            <div class="mt-3 text-3xl font-bold text-gray-800">
                {{ $summary['total'] }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <p class="text-gray-500 text-sm">Selesai</p>
            <div class="mt-3 text-3xl font-bold text-gray-800">
                {{ $summary['selesai'] }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <p class="text-gray-500 text-sm">Diproses</p>
            <div class="mt-3 text-3xl font-bold text-gray-800">
                {{ $summary['proses'] }}
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border p-6">
            <p class="text-gray-500 text-sm">Menunggu</p>
            <div class="mt-3 text-3xl font-bold text-gray-800">
                {{ $summary['pending'] }}
            </div>
        </div>

    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left">

                <thead class="bg-blue-800 text-white text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3">ID</th>
                        <th class="px-6 py-3">Jenis Masalah</th>
                        <th class="px-6 py-3">Kategori</th>
                        <th class="px-6 py-3">Lokasi</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Petugas</th>
                        <th class="px-6 py-3">Waktu Selesai</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse($keluhans as $keluhan)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 font-medium text-gray-700">
                            #{{ $keluhan->id }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $keluhan->jenis_masalah }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $keluhan->kategori }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $keluhan->lokasi }}
                        </td>

                        {{-- STATUS NETRAL --}}
                        <td class="px-6 py-4">
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium capitalize">
                                {{ $keluhan->status }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $keluhan->petugas?->name ?? '-' }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $keluhan->waktu_selesai ?? '-' }}
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <div class="flex flex-col items-center text-gray-400">
                                <span class="text-4xl mb-2">📁</span>
                                <p class="font-semibold">Belum ada data keluhan</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

                {{-- per page --}}
                <form method="GET" class="flex items-center gap-2 text-sm">

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

                {{-- links --}}
                <div class="text-sm">
                    {{ $keluhans->links() }}
                </div>

            </div>

        </div>

    </div>

</div>

@endsection