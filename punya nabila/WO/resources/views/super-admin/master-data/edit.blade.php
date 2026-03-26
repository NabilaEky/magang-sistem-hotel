@extends('super-admin.layouts.blank')

@section('content')

{{-- Page Header --}}

<div class="bg-slate-700 text-white px-8 py-5 rounded-lg mb-8 shadow flex items-center">
    <div class="flex items-center gap-3">
        <ion-icon name="create-outline" class="text-2xl"></ion-icon>

    <div>
        <div class="text-xl font-semibold">
            Edit {{ ucfirst($tipe) }}
        </div>
        <div class="text-sm text-gray-200">
            Perbarui data master yang dipilih
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
            method="POST"
            action="{{ route('superadmin.master-data.update', ['tipe' => $tipe, 'id' => $data->id]) }}"
            class="space-y-6"
        >
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Nama
                </label>
                <input
                    type="text"
                    name="nama"
                    value="{{ old('nama', $data->nama) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
                @error('nama')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kode --}}
            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Kode
                </label>
                <input
                    type="text"
                    name="kode"
                    value="{{ old('kode', $data->kode) }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
                @error('kode')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Deskripsi --}}
            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Deskripsi
                </label>
                <textarea
                    name="deskripsi"
                    rows="3"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
            </div>

            {{-- Status --}}
            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Status
                </label>
                <select
                    name="status"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                >
                    <option value="aktif" @selected(old('status', $data->status) === 'aktif')>
                        Aktif
                    </option>
                    <option value="non_aktif" @selected(old('status', $data->status) === 'non_aktif')>
                        Non Aktif
                    </option>
                </select>
            </div>

            {{-- Action Buttons --}}
            <div class="mt-10 flex justify-between">

                <a
                    href="{{ route('superadmin.master-data.index') }}"
                    class="flex items-center gap-2 px-5 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition"
                >
                    <ion-icon name="arrow-back-outline"></ion-icon>
                    Kembali
                </a>

                <button
                    type="submit"
                    class="flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition"
                >
                    <ion-icon name="save-outline"></ion-icon>
                    Simpan
                </button>

            </div>

        </form>

    </div>

</div>

</div>

@endsection
