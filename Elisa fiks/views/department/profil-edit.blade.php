@extends('department.layouts.department')

@section('header')
    EDIT PROFILE DEPARTMENT
@endsection

@section('content')

<div class="max-w-5xl mx-auto bg-white rounded-xl shadow-lg p-10">

    <form action="{{ route('dept.profil.update') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
        @csrf

        {{-- ================= PROFIL DASAR ================= --}}
        <div>
            <h2 class="text-2xl font-bold mb-8 border-b pb-3">
                Profil Department
            </h2>

            <div class="flex gap-12">

                {{-- FOTO --}}
                <div class="flex flex-col items-center gap-4">
                    <div class="w-40 h-40 bg-gray-200 rounded-xl overflow-hidden border flex items-center justify-center">
                        
                        @if($data && $data->logo)
                            <img src="{{ asset('logo/' . $data->logo) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-400">Logo</span>
                        @endif

                    </div>

                    <label class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition cursor-pointer">
                        Ubah Logo
                        <input type="file" name="logo" class="hidden">
                    </label>
                </div>

                {{-- FORM KANAN --}}
                <div class="flex-1 space-y-6">

                    <div class="flex items-center gap-6">
                        <label class="w-40 font-semibold">Nama Department</label>
                        <input type="text" name="nama"
                            value="{{ $data->nama ?? '' }}"
                            class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-slate-400 outline-none">
                    </div>

                    <div class="flex items-center gap-6">
                        <label class="w-40 font-semibold">Email</label>
                        <input type="email" name="email"
                            value="{{ $data->email ?? '' }}"
                            class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-slate-400 outline-none">
                    </div>

                    <div class="flex items-center gap-6">
                        <label class="w-40 font-semibold">No Telepon</label>
                        <input type="text" name="no_hp"
                            value="{{ $data->no_hp ?? '' }}"
                            class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-slate-400 outline-none">
                    </div>

                </div>
            </div>
        </div>

        {{-- ================= AKUN ================= --}}
        <div>
            <h2 class="text-2xl font-bold mb-8 border-b pb-3">
                Informasi Akun
            </h2>

            <div class="space-y-6">

                <div class="flex items-center gap-6">
                    <label class="w-40 font-semibold">Username</label>
                    <input type="text" name="username"
                        value="{{ $data->username ?? '' }}"
                        class="flex-1 border rounded-lg px-4 py-2 focus:ring-2 focus:ring-slate-400 outline-none">
                </div>

                <div class="flex items-center gap-6">
                    <label class="w-40 font-semibold">Password Baru</label>
                    <div class="flex-1 relative">
                        <input type="password" name="password"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-slate-400 outline-none">
                    </div>
                </div>

                <div class="flex items-center gap-6">
                    <label class="w-40 font-semibold">Konfirmasi Password</label>
                    <div class="flex-1 relative">
                        <input type="password" name="password_confirmation"
                            class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-slate-400 outline-none">
                    </div>
                </div>

            </div>
        </div>

        {{-- ================= BUTTON ================= --}}
        <div class="flex justify-end gap-6 pt-6">

            <a href="{{ route('dept.profil-dept') }}"
                class="px-8 py-3 bg-gray-500 text-white rounded-full hover:bg-gray-600 transition">
                ← Kembali
            </a>

            <button type="submit"
                class="px-8 py-3 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition">
                💾 Simpan
            </button>

        </div>

    </form>

</div>

@endsection