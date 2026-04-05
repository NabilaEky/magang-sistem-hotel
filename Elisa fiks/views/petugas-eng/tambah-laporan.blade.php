@extends('petugas-eng.layouts.petugas')
@section('page_title', 'TAMBAH LAPORAN')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden">

    {{-- Header --}}
    <div class="bg-blue-700 text-white text-center py-5 font-semibold text-lg">
        Form Laporan Engineering
    </div>

    <form action="{{ route('petugas.store-laporan') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-8">
        @csrf

        @if ($errors->any())
    <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
        {{ $errors->first() }}
    </div>
@endif

        {{-- realisasi --}}
        <div class="flex items-center gap-6">
            <label class="w-40 font-semibold text-gray-700">
                realisasi
            </label>

            <select name="realisasi"
                class="border rounded-lg px-4 py-2 w-64 focus:ring-2 focus:ring-blue-500">
                <option value="">Pilih realisasi</option>
                <option value="Civil">Civil</option>
                <option value="ME">ME</option>
            </select>
        </div>

        {{-- Jenis Laporan --}}
        <div class="flex items-center gap-6">
            <label class="w-40 font-semibold text-gray-700">
                Jenis Laporan
            </label>

            <select name="jenis"
                class="border rounded-lg px-4 py-2 w-64 focus:ring-2 focus:ring-blue-500">
                <option value="Harian">Harian</option>
                <option value="Bulanan">Bulanan</option>
            </select>
        </div>

        {{-- Shift --}}
        <div class="flex items-center gap-6">
            <label class="w-40 font-semibold text-gray-700">
                Shift
            </label>

            <select name="shift"
                class="border rounded-lg px-4 py-2 w-64 focus:ring-2 focus:ring-blue-500">
                <option value="Pagi">Pagi</option>
                <option value="Sore">Sore</option>
                <option value="Malam">Malam</option>
            </select>
        </div>

        {{-- List Pekerjaan --}}
        <div>

            <h3 class="font-semibold text-gray-700 mb-4">
                List Pekerjaan
            </h3>

            <div class="space-y-4">

                @for($i = 1; $i <= 4; $i++)
                <div class="flex items-center gap-4 bg-gray-50 p-4 rounded-lg border">

                    <div class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded-full text-sm font-semibold">
                        {{ $i }}
                    </div>

                    <input 
                        type="text"
                        name="items[]"
                        value="{{ old('items.' . ($i-1)) }}"
                        placeholder="Masukkan pekerjaan..."
                        class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                    >

                    <input 
                        type="file"
                        name="foto[]"
                        class="text-sm"
                    >

                </div>
                @endfor

            </div>

            <p class="text-sm text-gray-500 mt-2">
                Upload foto bersifat opsional.
            </p>

        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-4 pt-6">

            <a href="{{ route('petugas.laporan') }}"
               class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                ← Kembali
            </a>

            <button type="submit"
                class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700">
                Simpan Laporan
            </button>

        </div>

    </form>

</div>

@endsection