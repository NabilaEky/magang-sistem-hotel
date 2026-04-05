@extends('customer.layouts.customer')

@section('page-content')

<div class="flex justify-center py-10 px-6">
    <div class="w-full max-w-6xl">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">

            {{-- LEFT --}}
            <div class="md:col-span-2 space-y-8">

                {{-- INFORMASI --}}
                <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                    <div class="grid grid-cols-3 gap-y-4 text-sm">

                        <div class="font-semibold">ID</div>
                        <div>:</div>
                        <div>{{ $keluhan->id }}</div>

                        <div class="font-semibold">Tanggal</div>
                        <div>:</div>
                        <div>{{ $keluhan->created_at->format('d/m/Y H:i') }}</div>

                        <div class="font-semibold">Jenis Masalah</div>
                        <div>:</div>
                        <div>{{ $keluhan->jenis_keluhan }}</div>

                        <div class="font-semibold">Kategori</div>
                        <div>:</div>
                        <div>{{ $keluhan->kategori }}</div>

                    </div>
                </div>

                {{-- FOTO --}}
                <div class="bg-white rounded-xl shadow-sm border p-6">
                    <h3 class="font-semibold mb-4">Foto Keluhan</h3>

                    @php
                        $fotos = $keluhan->foto;
                    @endphp

                    @if ($fotos)
                        <div class="flex gap-4 flex-wrap">
                            @foreach ($fotos as $foto)
                                <img src="{{ asset('storage/' . $foto) }}"
                                     class="w-32 h-28 object-cover rounded border">
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-sm">Tidak ada foto</p>
                    @endif
                </div>

                {{-- DESKRIPSI --}}
                <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
                    <div class="bg-blue-700 text-white px-6 py-3 font-semibold">
                        Deskripsi Keluhan
                    </div>

                    <div class="p-6 text-sm text-gray-700 min-h-[120px]">
                        {{ $keluhan->deskripsi }}
                    </div>
                </div>

                {{-- BUTTON --}}
                <div>
                    <a href="{{ route('customer.history') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg text-sm shadow">
                        ← Kembali
                    </a>
                </div>

            </div>

            {{-- RIGHT (STATUS) --}}
            <div>

                <h2 class="text-lg font-semibold mb-6">Status</h2>

                <div class="space-y-4 text-sm">

                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full bg-green-500"></div>
                        <span>Dikirim</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full 
                            {{ $keluhan->status != 'Menunggu' ? 'bg-green-500' : 'bg-gray-300' }}">
                        </div>
                        <span>Diproses</span>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-3 h-3 rounded-full 
                            {{ $keluhan->status == 'Selesai' ? 'bg-green-500' : 'bg-gray-300' }}">
                        </div>
                        <span>Selesai</span>
                    </div>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection