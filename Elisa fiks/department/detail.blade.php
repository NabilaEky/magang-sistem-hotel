@extends('department.layouts.department')

@section('header')
    DETAIL KELUHAN
@endsection

@section('content')

<div class="flex justify-center py-10 px-6">
    <div class="w-full max-w-6xl">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- LEFT SIDE --}}
            <div class="md:col-span-2 space-y-8">

                {{-- INFORMASI BOX --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                    <div class="grid grid-cols-3 gap-y-4 text-sm">

                        <div class="font-semibold text-gray-700">ID</div>
                        <div>:</div>
                        <div>{{ $data->id }}</div>

                        <div class="font-semibold text-gray-700">Tanggal</div>
                        <div>:</div>
                        <div>
                            {{ \Carbon\Carbon::parse($data->waktu)->format('d/m/Y') }}
                        </div>

                        <div class="font-semibold text-gray-700">Kamar</div>
                        <div>:</div>
                        <div>{{ $data->lokasi }}</div>

                        <div class="font-semibold text-gray-700">Jenis Masalah</div>
                        <div>:</div>
                        <div>{{ $data->jenis_masalah }}</div>

                    </div>
                </div>

                {{-- DESKRIPSI --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                    <div class="bg-blue-700 text-white px-6 py-3 font-semibold">
                        Deskripsi Keluhan
                    </div>

                    <div class="p-6 text-sm text-gray-700 min-h-[150px] leading-relaxed">
                        {{ $data->deskripsi ?? '-' }}
                    </div>

                </div>

                {{-- BUTTON --}}
                <div>
                    <a href="{{ route('dept.index') }}"
                       class="inline-flex items-center gap-2 bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg text-sm transition shadow-sm">
                        ← Kembali
                    </a>
                </div>

            </div>

            {{-- RIGHT SIDE (STATUS TIMELINE) --}}
            <div>

                <h2 class="text-lg font-semibold mb-6">
                    Status
                </h2>

                <div class="relative pl-10">

                    {{-- Garis --}}
                    <div class="absolute left-4 top-2 bottom-2 w-[2px] bg-gray-300"></div>

                    {{-- Step 1: Dikirim --}}
                    <div class="relative mb-10 flex items-center gap-4">
                        <div class="w-6 h-6 
                            {{ in_array($data->status, ['Proses','Selesai']) ? 'bg-black' : 'bg-black' }}
                            rounded-full border-4 border-white shadow z-10"></div>
                        <p class="text-sm">Dikirim</p>
                    </div>

                    {{-- Step 2: Diproses --}}
                    <div class="relative mb-10 flex items-center gap-4">
                        <div class="w-6 h-6 
                            {{ in_array($data->status, ['Proses','Selesai']) ? 'bg-black' : 'bg-gray-400' }}
                            rounded-full border-4 border-white shadow z-10"></div>
                        <p class="text-sm 
                            {{ in_array($data->status, ['Proses','Selesai']) ? '' : 'text-gray-400' }}">
                            Diproses
                        </p>
                    </div>

                    {{-- Step 3: Selesai --}}
                    <div class="relative flex items-center gap-4">
                        <div class="w-6 h-6 
                            {{ $data->status == 'Selesai' ? 'bg-green-500' : 'bg-gray-400' }}
                            rounded-full border-4 border-white shadow z-10"></div>
                        <p class="text-sm 
                            {{ $data->status == 'Selesai' ? 'text-green-600 font-semibold' : 'text-gray-400' }}">
                            Selesai
                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection