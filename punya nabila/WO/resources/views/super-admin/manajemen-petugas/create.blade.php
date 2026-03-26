@extends('super-admin.layouts.blank')

@section('content')

<div class="bg-gradient-to-r from-slate-700 to-slate-800 text-white py-8 px-12 shadow">
    <h1 class="text-3xl font-bold">Tambah Petugas</h1>
    <p class="text-sm opacity-80 mt-1">Tambahkan petugas baru ke dalam sistem</p>
</div>

<div class="py-16 bg-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow-xl p-14">

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-xl">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('superadmin.petugas.store') }}" class="space-y-8">
            @csrf
            {{-- Nama --}}
            <div class="grid grid-cols-3 items-center gap-8">
                <label class="text-gray-700 font-semibold text-lg">
                    Nama
                </label>
                <div class="col-span-2">
                    <input type="text" name="nama" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-50
                       focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>
            </div>

            {{-- Email --}}
            <div class="grid grid-cols-3 items-center gap-8">
                <label class="text-gray-700 font-semibold text-lg">
                    Email
                </label>
                <div class="col-span-2">
                    <input type="email" name="email"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-50
                       focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                </div>
            </div>

            {{-- Role --}}
            <div class="grid grid-cols-3 items-center gap-8">
                <label class="text-gray-700 font-semibold text-lg">
                    Role
                </label>

                <div class="col-span-2">
                    <select name="role" required
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-50
                   focus:ring-2 focus:ring-blue-500 focus:outline-none transition">

                        <option value="">Pilih Role</option>

                        @foreach($roles as $role)
                        <option value="{{ $role->name }}">
                            {{ ucfirst(str_replace('_', ' ', $role->name)) }}
                        </option>
                        @endforeach

                    </select>
                </div>
            </div>

            {{-- Status --}}
            <div class="grid grid-cols-3 items-center gap-8">
                <label class="text-gray-700 font-semibold text-lg">
                    Status
                </label>
                <div class="col-span-2">
                    <select name="status"
                        class="w-full border border-gray-300 px-5 py-3 rounded-xl bg-gray-50
                       focus:ring-2 focus:ring-blue-500 focus:outline-none transition">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>


            {{-- Buttons --}}
            <div class="flex items-center justify-between pt-10">

                <a href="{{ route('superadmin.petugas.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 rounded-xl 
                  bg-gray-200 hover:bg-gray-300 
                  text-gray-700 font-semibold transition shadow-sm">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>

                <button type="submit"
                    class="px-8 py-3 rounded-xl bg-green-600 hover:bg-green-700
    text-white font-semibold transition shadow-md
    focus:outline-none focus:ring-2 focus:ring-green-400">
                    Simpan
                </button>

            </div>

        </form>
    </div>
</div>
@endsection