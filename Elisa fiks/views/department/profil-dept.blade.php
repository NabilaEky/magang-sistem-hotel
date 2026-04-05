@extends('department.layouts.department')

@section('header')
PROFILE
@endsection

@section('content')

<div class="flex justify-center py-10 px-6">
    <div class="w-full max-w-5xl space-y-10">

        {{-- PROFILE CARD --}}
        <div class="bg-white rounded-xl shadow-md p-8 border border-gray-200">

            <h2 class="text-xl font-semibold text-center mb-6">
                {{ $data->nama ?? 'Belum ada data' }}
            </h2>

            <div class="flex items-center gap-8">

                {{-- FOTO --}}
                <div class="w-32 h-32 bg-gray-200 rounded-xl flex items-center justify-center text-gray-400 text-5xl">
                    @if($data && $data->logo)
                    <img src="{{ asset('logo/' . $data->logo) }}"
                        class="w-full h-full object-cover">
                    @else
                    <span class="text-gray-400 text-5xl">👤</span>
                    @endif
                </div>

                {{-- INFO --}}
                <div class="space-y-3 text-sm">

                    <div>
                        <span class="font-semibold">Role:</span>
                        <span class="ml-2">{{ $data->role ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="font-semibold">Email:</span>
                        <span class="ml-2">{{ $data->email ?? '-' }}</span>
                    </div>

                    <div>
                        <span class="font-semibold">No HP:</span>
                        <span class="ml-2">{{ $data->no_hp ?? '-' }}</span>
                    </div>

                </div>

            </div>

        </div>

        {{-- INFORMASI AKUN --}}
        <div class="bg-white rounded-xl shadow-md p-8 border border-gray-200 space-y-6">

            <h3 class="text-lg font-semibold border-b pb-2">
                Informasi Akun
            </h3>

            <div class="space-y-4 text-sm">

                <div>
                    <span class="font-semibold">Username:</span>
                    <div class="border-b mt-1">
                        {{ $data->username ?? '-' }}
                    </div>
                </div>

                <div>
                    <span class="font-semibold">Password:</span>
                    <div class="border-b mt-1">
                        ********
                    </div>
                </div>

            </div>

        </div>

        {{-- AKTIVITAS --}}
        <div class="bg-white rounded-xl shadow-md p-8 border border-gray-200 space-y-6">

            <h3 class="text-lg font-semibold border-b pb-2">
                Aktivitas Singkat
            </h3>

            <div class="space-y-4 text-sm">

                <div>
                    <span class="font-semibold">Masalah ditangani hari ini:</span>
                    <div class="border-b mt-1">
                        {{ $jumlahHariIni ?? 0 }}
                    </div>
                </div>

                <div>
                    <span class="font-semibold">Terakhir login:</span>
                    <div class="border-b mt-1">
                        {{ $data->last_login ?? '-' }}
                    </div>
                </div>

            </div>

        </div>

        {{-- PENGATURAN --}}
        <div class="bg-white rounded-xl shadow-md p-8 border border-gray-200 space-y-6">

            <h3 class="text-lg font-semibold border-b pb-2">
                Pengaturan
            </h3>

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-4 text-sm">
                    <span class="font-semibold">Notifikasi</span>

                    {{-- 🔥 FORM ON --}}
                    <form action="{{ route('dept.notif.on') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-1 {{ $data->notifikasi ? 'bg-green-500 text-white' : 'bg-gray-200' }}">
                            ON
                        </button>
                    </form>

                    {{-- 🔥 FORM OFF --}}
                    <form action="{{ route('dept.notif.off') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-1 {{ !$data->notifikasi ? 'bg-red-500 text-white' : 'bg-gray-200' }}">
                            OFF
                        </button>
                    </form>

                </div>

                <div class="flex justify-end gap-4 mt-6">

                    <a href="{{ route('dept.homee') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded-lg text-sm shadow transition">
                        Kembali
                    </a>

                    <a href="{{ route('dept.profil-edit') }}"
                        class="bg-yellow-400 hover:bg-yellow-500 px-6 py-2 rounded-lg text-sm font-medium shadow transition">
                        EDIT
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>

@endsection