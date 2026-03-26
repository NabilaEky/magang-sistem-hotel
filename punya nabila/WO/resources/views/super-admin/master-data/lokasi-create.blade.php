@extends('super-admin.layouts.blank')

@section('content')

{{-- Page Header --}}

<div class="bg-slate-700 text-white px-8 py-5 rounded-lg mb-8 shadow flex items-center">
    <div class="flex items-center gap-3">
        <ion-icon name="location-outline" class="text-2xl"></ion-icon>

        <div>
            <div class="text-xl font-semibold">
                Tambah Lokasi
            </div>
            <div class="text-sm text-gray-200">
                Tambahkan data lokasi baru ke sistem
            </div>
        </div>
    </div>

</div>

<div class="flex justify-center">

    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

        {{-- Card Header --}}
        <div class="bg-slate-600 text-white text-center py-3 font-semibold tracking-wide">
            Master Data Management
        </div>

        <div class="p-8">

            <form
                class="space-y-6"
                action="{{ route('superadmin.lokasi.store') }}"
                method="POST"
                x-data="{ status: 'aktif' }">
                @csrf

                {{-- Nama Lokasi --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-2">
                        Nama Lokasi
                    </label>
                    <input
                        type="text"
                        name="nama"
                        required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Deskripsi --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea
                        name="deskripsi"
                        rows="4"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                </div>

                {{-- Kode --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-2">
                        Kode Lokasi
                    </label>
                    <input
                        type="text"
                        name="kode"
                        required
                        class="w-1/2 border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block font-medium text-gray-700 mb-4">
                        Status
                    </label>

                    <div class="flex gap-6">

                        {{-- Aktif --}}
                        <button
                            type="button"
                            @click="status='aktif'"
                            :class="status==='aktif'
                ? 'border-2 border-green-600 bg-green-50 text-green-700'
                : 'border border-gray-300 bg-white text-gray-600'"
                            class="flex items-center gap-3 px-6 py-3 rounded-lg transition">

                            <ion-icon name="checkmark-circle-outline" class="text-xl"></ion-icon>
                            <span class="font-medium">Aktif</span>

                        </button>

                        {{-- Non Aktif --}}
                        <button
                            type="button"
                            @click="status='non_aktif'"
                            :class="status==='non_aktif'
                ? 'border-2 border-red-600 bg-red-50 text-red-700'
                : 'border border-gray-300 bg-white text-gray-600'"
                            class="flex items-center gap-3 px-6 py-3 rounded-lg transition">

                            <ion-icon name="close-circle-outline" class="text-xl"></ion-icon>
                            <span class="font-medium">Non Aktif</span>

                        </button>

                    </div>

                    <input type="hidden" name="status" :value="status">
                </div>
               
        {{-- Action Buttons --}}
        <div class="mt-10 flex justify-between">

            <a
                href="{{ route('superadmin.master-data.index') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">
                <ion-icon name="arrow-back-outline"></ion-icon>
                Kembali
            </a>

            <button
                type="submit"
                class="flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                <ion-icon name="save-outline"></ion-icon>
                Simpan
            </button>

        </div>

        </form>

    </div>

</div>

</div>

@endsection