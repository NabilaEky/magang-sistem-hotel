@extends('petugas-eng.layouts.petugas')

@section('page_title', 'PROFILE')

@section('content')

<div class="max-w-5xl mx-auto space-y-8">

    {{-- NOTIF SUCCESS --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif


    {{-- Profile Card --}}
    <div class="bg-white shadow-lg rounded-xl p-8 flex items-center gap-8">

        {{-- Foto --}}
        <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
            
            @if($user->foto)
                <img src="{{ asset('storage/' . $user->foto) }}" 
                     class="w-full h-full object-cover">
            @else
                <ion-icon name="person-outline" class="text-5xl text-gray-500"></ion-icon>
            @endif

        </div>

        {{-- Info --}}
        <div class="flex-1">

            <h2 class="text-2xl font-semibold text-gray-700 mb-2">
                {{ $user->name }}
            </h2>

            <div class="space-y-1 text-gray-600">

                <p class="flex items-center gap-2">
                    <ion-icon name="briefcase-outline"></ion-icon>
                    Engineering
                </p>

                <p class="flex items-center gap-2">
                    <ion-icon name="mail-outline"></ion-icon>
                    {{ $user->email }}
                </p>

                <p class="flex items-center gap-2">
                    <ion-icon name="call-outline"></ion-icon>
                    {{ $user->phone ?? '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Informasi Akun --}}
    <div class="bg-white shadow-lg rounded-xl p-8">

        <h3 class="text-xl font-semibold text-gray-700 mb-6 flex items-center gap-2">
            <ion-icon name="person-circle-outline"></ion-icon>
            Informasi Akun
        </h3>

        <div class="space-y-4 text-gray-600">

            <div class="flex justify-between border-b pb-3">
                <span>Username</span>
                <span class="font-medium">{{ $user->username }}</span>
            </div>

            <div class="flex justify-between border-b pb-3">
                <span>Password</span>
                <span>********</span>
            </div>

        </div>

    </div>


    {{-- Aktivitas --}}
    <div class="bg-white shadow-lg rounded-xl p-8">

        <h3 class="text-xl font-semibold text-gray-700 mb-6 flex items-center gap-2">
            <ion-icon name="time-outline"></ion-icon>
            Aktivitas Singkat
        </h3>

        <div class="space-y-4 text-gray-600">

            <div class="flex justify-between border-b pb-3">
                <span>Masalah ditangani hari ini</span>
                <span class="font-medium">{{ $todayCount }}</span>
            </div>

            <div class="flex justify-between border-b pb-3">
                <span>Terakhir login</span>
                <span>
                    {{ $user->last_login_at 
                        ? \Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y H:i') 
                        : '-' }}
                </span>
            </div>

        </div>

    </div>


    {{-- Pengaturan --}}
    <div class="bg-white shadow-lg rounded-xl p-8">

        <h3 class="text-xl font-semibold text-gray-700 mb-6 flex items-center gap-2">
            <ion-icon name="settings-outline"></ion-icon>
            Pengaturan
        </h3>

        <div class="flex items-center justify-between flex-wrap gap-4">

            {{-- Notifikasi --}}
            <div class="flex items-center gap-4">

                <span class="font-medium text-gray-600">
                    Notifikasi
                </span>

                <div class="flex border rounded-lg overflow-hidden">

                    <button class="px-4 py-1 bg-green-500 text-white text-sm">
                        ON
                    </button>

                    <button class="px-4 py-1 bg-gray-200 text-sm">
                        OFF
                    </button>

                </div>

            </div>


            {{-- Edit Button --}}
            <a href="{{ route('petugas.edit-profile') }}"
               class="flex items-center gap-2 px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">

                <ion-icon name="create-outline"></ion-icon>
                Edit Profile

            </a>

        </div>

    </div>

</div>

@endsection