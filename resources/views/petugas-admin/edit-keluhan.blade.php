@extends('petugas-admin.layouts.dashboard')

@section('header')

<h1 class="text-2xl text-center font-semibold">
    EDIT DAFTAR KELUHAN
</h1>
@endsection

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="bg-white rounded-xl shadow-md overflow-hidden">

        <!-- HEADER -->

        <div class="bg-blue-800 text-white text-center py-3 font-semibold tracking-wide">
            Informasi Keluhan
        </div>

        <div class="p-6 space-y-6">

            <form action="{{ route('update-keluhan',$keluhan->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- INFORMASI -->

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="text-sm text-gray-600">ID</label>
                        <input type="text"
                            class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 text-sm"
                            value="{{ $keluhan->id }}" disabled>
                    </div>

                    <div>
                        <label class="text-sm text-gray-600">Tanggal</label>
                        <input type="text"
                            class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 text-sm"
                            value="{{ $keluhan->created_at->format('d M Y') }}" disabled>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-600">Lokasi</label>
                        <input type="text"
                            class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 text-sm"
                            value="{{ $keluhan->lokasi }}" disabled>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-600">Jenis Masalah</label>
                        <input type="text"
                            class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 text-sm"
                            value="{{ $keluhan->jenis_masalah }}" disabled>
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-sm text-gray-600">Deskripsi</label>
                        <textarea rows="3"
                            class="w-full mt-1 px-3 py-2 border rounded-lg bg-gray-100 text-sm"
                            disabled>{{ $keluhan->deskripsi }}</textarea>
                    </div>

                </div>

                <!-- CATATAN ADMIN -->

                <div>
                    <h2 class="text-md font-semibold text-gray-700 mb-2">
                        Catatan Admin
                    </h2>

                    <textarea name="catatan_admin"
                        rows="3"
                        class="w-full px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Tulis catatan untuk petugas...">{{ old('catatan_admin', $keluhan->catatan_admin) }}</textarea>

                </div>

                <!-- PENGATURAN -->

                <div>
                    <h2 class="text-md font-semibold text-gray-700 mb-3">
                        Pengaturan Admin
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                        <div>
                            <label class="text-sm text-gray-600">Petugas</label>

                            <select name="petugas"
                                class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-400">

                                <option value="">Pilih Petugas</option>
                                <option value="Andi" {{ old('petugas',$keluhan->petugas)=='Andi' ? 'selected' : '' }}>Andi</option>
                                <option value="Budi" {{ old('petugas',$keluhan->petugas)=='Budi' ? 'selected' : '' }}>Budi</option>

                            </select>

                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Status</label>

                            <select name="status"
                                class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-400">

                                <option value="Pending" {{ old('status',$keluhan->status)=='Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Diproses" {{ old('status',$keluhan->status)=='Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Selesai" {{ old('status',$keluhan->status)=='Selesai' ? 'selected' : '' }}>Selesai</option>

                            </select>

                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Prioritas</label>

                            <select name="prioritas"
                                class="w-full mt-1 px-3 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-400">

                                <option value="Rendah" {{ old('prioritas',$keluhan->prioritas)=='Rendah' ? 'selected' : '' }}>Rendah</option>
                                <option value="Sedang" {{ old('prioritas',$keluhan->prioritas)=='Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Tinggi" {{ old('prioritas',$keluhan->prioritas)=='Tinggi' ? 'selected' : '' }}>Tinggi</option>

                            </select>

                        </div>

                    </div>
                </div>

                <!-- TOMBOL -->

                <div class="flex justify-end gap-3 pt-4 border-t">

                    <a href="{{ route('keluhan') }}"
                        class="px-4 py-2 bg-gray-500 text-white text-sm rounded-lg hover:bg-gray-600 transition">
                        Kembali </a>

                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition shadow">
                        Simpan </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection