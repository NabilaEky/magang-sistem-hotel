@extends('petugas-eng.layouts.petugas')
@section('page_title', 'Detail Laporan')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">

        {{-- Header --}}
        <div class="bg-blue-700 text-white text-center py-5 font-semibold text-lg">
            Detail Laporan Engineering
        </div>

        <div class="p-8">

            {{-- Info Section --}}
            <div class="grid md:grid-cols-2 gap-10 mb-10">

                {{-- Info Laporan --}}
                <div>
                    <h3 class="font-semibold text-gray-700 mb-4 border-b pb-2">
                        Informasi Laporan
                    </h3>

                    <div class="space-y-3 text-gray-600">

                        <p>
                            <span class="font-semibold w-32 inline-block">Tanggal</span>:
                            {{ $laporan->created_at->format('d M Y') }}
                        </p>

                        <p>
                            <span class="font-semibold w-32 inline-block">Jenis</span>:
                            {{ $laporan->jenis }}
                        </p>
                        <p>
                            <span class="font-semibold w-32 inline-block">Realisasi</span>:
                            {{ $laporan->realisasi }}
                        </p>
                        <p>
                            <span class="font-semibold w-32 inline-block">Shift</span>:
                            {{ $laporan->shift }}
                        </p>

                        <p>
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                                {{ $laporan->status }}
                            </span>
                        </p>

                    </div>
                </div>

                {{-- Waktu --}}
                <div>
                    <h3 class="font-semibold text-gray-700 mb-4 border-b pb-2">
                        Waktu Pengerjaan
                    </h3>

                    <div class="space-y-3 text-gray-600">

                        <p>
                            <span class="font-semibold w-32 inline-block">Mulai</span>:
                            {{ $laporan->jam_mulai ?? '-' }}
                        </p>

                        <p>
                            <span class="font-semibold w-32 inline-block">Selesai</span>:
                            {{ $laporan->jam_selesai ?? '-' }}
                        </p>

                    </div>
                </div>

            </div>

            {{-- List Pekerjaan --}}
            <h3 class="font-semibold text-gray-700 mb-6 border-b pb-2">
                Detail Pekerjaan
            </h3>

            <div class="space-y-6">

                @forelse($laporan->items ?? [] as $index => $item)

                <div class="border rounded-lg p-6 bg-gray-50">

                    {{-- Nama pekerjaan --}}
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded-full text-sm font-semibold">
                            {{ $index + 1 }}
                        </div>

                        <span class="font-semibold text-gray-700">
                            {{ $item['nama'] ?? '-' }}
                        </span>
                    </div>

                    {{-- FOTO --}}
                    <div class="grid md:grid-cols-3 gap-4 text-center">

                        {{-- BEFORE --}}
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Before</p>
                            @if(!empty($item['before']))
                            <img src="{{ asset('storage/'.$item['before']) }}" class="rounded border">
                            @else
                            <p class="text-xs text-gray-400">Tidak ada</p>
                            @endif
                        </div>

                        {{-- PROGRESS --}}
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Progress</p>
                            @if(!empty($item['progress']))
                            <img src="{{ asset('storage/'.$item['progress']) }}" class="rounded border">
                            @else
                            <p class="text-xs text-gray-400">Tidak ada</p>
                            @endif
                        </div>

                        {{-- AFTER --}}
                        <div>
                            <p class="text-sm text-gray-600 mb-2">After</p>
                            @if(!empty($item['after']))
                            <img src="{{ asset('storage/'.$item['after']) }}" class="rounded border">
                            @else
                            <p class="text-xs text-gray-400">Tidak ada</p>
                            @endif
                        </div>

                    </div>

                </div>

                @empty
                <div class="text-center text-gray-500">
                    Tidak ada data pekerjaan
                </div>
                @endforelse

            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4 mt-10">

                <a href="{{ route('petugas.laporan') }}"
                    class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                    ← Kembali
                </a>

                <!-- <button onclick="window.print()"
                    class="flex items-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition">

                    <ion-icon name="print-outline"></ion-icon>
                    Cetak

                </button> -->

            </div>

        </div>

    </div>

</div>

@endsection