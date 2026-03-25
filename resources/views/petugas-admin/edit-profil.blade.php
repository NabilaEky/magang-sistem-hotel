@extends('petugas-admin.layouts.dashboard')

@section('content')

<div class="max-w-5xl mx-auto bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">

    <!-- HEADER -->
    <div class="bg-blue-800 py-4 text-center">
        <h1 class="text-2xl font-semibold text-white">
            Edit Profile
        </h1>
    </div>

    <form action="{{ route('update-profil') }}" method="POST" enctype="multipart/form-data" class="p-10 space-y-12">
        @csrf
        


        {{-- ================= PROFIL DASAR ================= --}}
        <div>

            <h2 class="text-xl font-semibold mb-6 border-b border-slate-200 pb-2 text-black">
                Profil Dasar
            </h2>

            <div class="flex gap-12">

                {{-- FOTO --}}
                <div class="flex flex-col items-center gap-4">

                    <div class="w-36 h-36 bg-slate-200 rounded-full border flex items-center justify-center shadow-inner overflow-hidden">

                        @if(!empty($profile->foto))
                            <img src="{{ asset('storage/'.$profile->foto) }}" class="w-full h-full object-cover">
                        @else
                            <span class="text-black text-sm">
                                Foto
                            </span>
                        @endif

                    </div>

                    <input type="file" name="foto" id="foto" class="hidden">

                    <button
                        type="button"
                        onclick="document.getElementById('foto').click()"
                        class="px-4 py-2 bg-slate-600 text-white rounded-lg hover:bg-slate-700 transition">
                        Ubah Foto
                    </button>

                </div>


                {{-- FORM --}}
                <div class="flex-1 space-y-6">

                    <div>
                        <label class="block mb-1 font-semibold text-black">
                            Nama
                        </label>

                        <input
                            type="text"
                            name="nama"
                            value="{{ $profile->nama ?? '' }}"
                            class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-400" />
                    </div>


                    <div>
                        <label class="block mb-1 font-semibold text-black">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ $profile->email ?? '' }}"
                            class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-400" />
                    </div>


                    <div>
                        <label class="block mb-1 font-semibold text-black">
                            No HP
                        </label>

                        <input
                            type="text"
                            name="no_hp"
                            value="{{ $profile->no_hp ?? '' }}"
                            class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-400" />
                    </div>

                </div>
            </div>
        </div>



        {{-- ================= AKUN ================= --}}
        <div>

            <h2 class="text-xl font-semibold mb-6 border-b border-slate-200 pb-2 text-black">
                Akun
            </h2>

            <div class="space-y-6">


                {{-- USERNAME --}}
                <div>

                    <label class="block mb-1 font-semibold text-black">
                        Username
                    </label>

                    <input
                        type="text"
                        name="username"
                        value="{{ $profile->username ?? '' }}"
                        class="w-full border border-slate-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-slate-400" />

                </div>



                {{-- PASSWORD --}}
                <div class="relative">

                    <label class="block mb-1 font-semibold text-black">
                        Password
                    </label>

                    <input
                        id="password"
                        name="password"
                        type="password"
                        class="w-full border border-slate-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-slate-400" />

                    <button
                        type="button"
                        onclick="togglePassword('password','eye1','eyeSlash1')"
                        class="absolute right-3 top-9 text-gray-600 hover:text-black">

                        <svg id="eye1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <svg id="eyeSlash1" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.042-3.368M6.18 6.18A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.178M3 3l18 18"/>
                        </svg>

                    </button>

                </div>



                {{-- KONFIRMASI PASSWORD --}}
                <div class="relative">

                    <label class="block mb-1 font-semibold text-black">
                        Konfirmasi Password
                    </label>

                    <input
                        id="confirmPassword"
                        name="password_confirmation"
                        type="password"
                        class="w-full border border-slate-300 rounded-lg px-4 py-2 pr-10 focus:outline-none focus:ring-2 focus:ring-slate-400" />

                    <button
                        type="button"
                        onclick="togglePassword('confirmPassword','eye2','eyeSlash2')"
                        class="absolute right-3 top-9 text-gray-600 hover:text-black">

                        <svg id="eye2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>

                        <svg id="eyeSlash2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.042-3.368M6.18 6.18A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.956 9.956 0 01-4.043 5.178M3 3l18 18"/>
                        </svg>

                    </button>

                </div>

            </div>
        </div>



        {{-- BUTTON --}}
        <div class="flex justify-end gap-6 pt-6">

            <a
                href="{{ route('profil') }}"
                class="px-8 py-3 bg-slate-500 text-white rounded-lg hover:bg-slate-600 transition">
                Kembali
            </a>

            <button
                type="submit"
                class="px-8 py-3 bg-blue-800 text-white rounded-lg hover:bg-blue-900 transition shadow">
                Simpan
            </button>

        </div>

    </form>

</div>

@endsection