@extends('petugas-admin.layouts.dashboard')

@section('header')
<h1 class="text-2xl text-center font-semibold">
    PROFILE ADMIN
</h1>
@endsection


@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 space-y-10">

    {{-- CARD PROFILE --}}
    <div class="bg-white shadow-md rounded-xl p-6">

        <div class="flex flex-col md:flex-row items-center md:items-start gap-6">

            {{-- Foto --}}
            <div class="w-32 h-32 md:w-40 md:h-40 bg-gray-200 rounded-lg flex items-center justify-center overflow-hidden">

                @if(isset($profile) && $profile->foto)
                    <img src="{{ asset('storage/'.$profile->foto) }}" class="w-full h-full object-cover">
                @else
                    <span class="text-gray-500 text-sm">Foto</span>
                @endif

            </div>

            {{-- Info --}}
            <div class="text-center md:text-left">
                <h2 class="text-2xl font-bold mb-3">
                    {{ $profile->nama ?? 'NAMA Xxxx' }}
                </h2>

                <div class="space-y-1 text-gray-600">
                    <p><span class="font-semibold">Role:</span> Engineering</p>
                    <p><span class="font-semibold">Email:</span> {{ $profile->email ?? 'email@email.com' }}</p>
                    <p><span class="font-semibold">No HP:</span> {{ $profile->no_hp ?? '08xxxxxxxxxx' }}</p>
                </div>
            </div>

        </div>
    </div>


    {{-- INFORMASI AKUN --}}
    <div class="bg-white shadow-md rounded-xl p-6">
        <h3 class="text-xl font-semibold mb-6 border-b pb-2">
            Informasi Akun
        </h3>

        <div class="space-y-4 text-gray-700">
            <p><span class="font-semibold">Username:</span> {{ $profile->username ?? 'username123' }}</p>
            <p><span class="font-semibold">Password:</span> ********</p>
        </div>
    </div>


    {{-- AKTIVITAS --}}
    <div class="bg-white shadow-md rounded-xl p-6">
        <h3 class="text-xl font-semibold mb-6 border-b pb-2">
            Aktivitas Singkat
        </h3>

        <div class="space-y-4 text-gray-700">
            <p><span class="font-semibold">Masalah hari ini:</span> 3</p>
            <p><span class="font-semibold">Terakhir login:</span> {{ $profile->updated_at ?? '12/06/2025 08:30' }}</p>
        </div>
    </div>


    {{-- PENGATURAN --}}
    <div class="bg-white shadow-md rounded-xl p-6" x-data="{ notif: true }">
        <h3 class="text-xl font-semibold mb-6 border-b pb-2">
            Pengaturan
        </h3>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <span class="font-semibold text-gray-700">
                Notifikasi
            </span>

            <div class="flex rounded-lg overflow-hidden border">

                <button 
                    @click="notif = true"
                    :class="notif ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700'"
                    class="px-4 py-1 text-sm transition">
                    ON
                </button>

                <button 
                    @click="notif = false"
                    :class="!notif ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-700'"
                    class="px-4 py-1 text-sm transition">
                    OFF
                </button>

            </div>

        </div>

    </div>


    {{-- BUTTON EDIT --}}
    <div class="flex justify-end pt-6">
        <a href="{{ route('admin.edit-profil') }}"
        class="px-6 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
            Edit Profil
        </a>
    </div>

</div>

@endsection