@extends('super-admin.layouts.app')
@section('page_title', 'EDIT DAFTAR KELUHAN')

@section('content')

<div class="max-w-5xl mx-auto mt-10 space-y-8">

    {{-- Page Title --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-800">
            Edit Daftar Keluhan
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Perbarui informasi dan pengaturan keluhan
        </p>
    </div>

    <form action="{{ route('daftar-keluhan.update', $keluhan->id) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')

        {{-- INFORMASI KELUHAN --}}
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">
                Informasi Keluhan
            </h2>

            <div class="grid grid-cols-2 gap-x-10 gap-y-4 text-sm">

                <div>
                    <span class="text-gray-500">ID</span>
                    <div class="font-medium text-gray-800">
                        #{{ $keluhan->id }}
                    </div>
                </div>

                <div>
                    <span class="text-gray-500">Tanggal</span>
                    <div class="font-medium text-gray-800">
                        {{ $keluhan->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div>
                    <span class="text-gray-500">Lokasi</span>
                    <div class="font-medium text-gray-800">
                        {{ $keluhan->lokasi }}
                    </div>
                </div>

                <div>
                    <span class="text-gray-500">Jenis Masalah</span>
                    <div class="font-medium text-gray-800">
                        {{ $keluhan->jenis_masalah }}
                    </div>
                </div>

                <div class="col-span-2">
                    <span class="text-gray-500">Deskripsi</span>
                    <div class="font-medium text-gray-800">
                        {{ $keluhan->deskripsi }}
                    </div>
                </div>

            </div>
        </div>

        {{-- CATATAN ADMIN --}}
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Catatan Admin
            </h2>

            <textarea name="catatan_admin"
                class="w-full border rounded-lg p-4 h-32 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">{{ $keluhan->catatan_admin }}</textarea>
        </div>

        {{-- PENGATURAN ADMIN --}}
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h2 class="text-lg font-semibold text-gray-800 mb-6">
                Pengaturan Admin
            </h2>

            <div class="grid grid-cols-2 gap-8">

                {{-- Petugas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Petugas
                    </label>
                    <select name="petugas_id"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
                        @foreach($petugas as $p)
                        <option value="{{ $p->id }}"
                            {{ $keluhan->petugas_id == $p->id ? 'selected' : '' }}>
                            {{ $p->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Status
                    </label>
                    <select name="status"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
                        <option value="menunggu" {{ $keluhan->status == 'menunggu' ? 'selected' : '' }}>Menunggu</option>
                        <option value="diproses" {{ $keluhan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ $keluhan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                {{-- Prioritas --}}
                <div>
                    <label class="block text-sm font-medium text-gray-600 mb-2">
                        Prioritas
                    </label>
                    <select name="prioritas"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm">
                        <option value="rendah" {{ $keluhan->prioritas == 'rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="sedang" {{ $keluhan->prioritas == 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="tinggi" {{ $keluhan->prioritas == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                </div>

            </div>
        </div>

        {{-- ACTION BUTTONS --}}
        <div class="flex justify-end gap-4">

            <a href="{{ route('daftar-keluhan.index') }}"
                class="flex items-center gap-2 px-6 py-2 border rounded-lg text-gray-600 hover:bg-gray-100 transition text-sm">

                <ion-icon name="arrow-back-outline"></ion-icon>
                <span>Kembali</span>

            </a>

            <button type="submit"
                class="flex items-center gap-2 px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-sm transition text-sm font-medium">

                <ion-icon name="save-outline"></ion-icon>
                <span>Simpan</span>

            </button>

        </div>

    </form>

</div>

@endsection