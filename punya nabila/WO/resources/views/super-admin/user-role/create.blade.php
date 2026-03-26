@extends('super-admin.layouts.blank')

@section('content')

{{-- Page Header --}}

<div class="bg-slate-700 text-white px-8 py-5 rounded-lg mb-8 shadow flex items-center justify-between">

<div class="flex items-center gap-3">
    <ion-icon name="add-circle-outline" class="text-2xl"></ion-icon>

    <div>
        <div class="text-xl font-semibold">
            Tambah Role
        </div>
        <div class="text-sm text-gray-200">
            Tambahkan role baru untuk mengatur hak akses pengguna
        </div>
    </div>
</div>

</div>

<div class="flex justify-center">

<div class="w-full max-w-xl bg-white rounded-xl shadow-lg border border-gray-200">

{{-- Card Header --}}
<div class="bg-blue-700 text-white text-center py-4 text-lg font-semibold rounded-t-xl">
    Form Role
</div>

<div class="p-8">

    <form action="{{ route('superadmin.roles.store') }}" method="POST">
        @csrf

        {{-- Nama Role --}}
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">
                Nama Role
            </label>

            <input 
                type="text"
                name="name"
                class="w-full border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                placeholder="Masukkan nama role">
        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-3 mt-8">

            <a href="{{ route('superadmin.roles.index') }}"
               class="flex items-center gap-2 px-5 py-2.5 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">

                <ion-icon name="arrow-back-outline"></ion-icon>
                Kembali
            </a>

            <button type="submit"
                class="flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">

                <ion-icon name="save-outline"></ion-icon>
                Simpan
            </button>

        </div>

    </form>

</div>

</div>

</div>

@endsection
