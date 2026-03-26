@extends('super-admin.layouts.app')
@section('page_title', 'SETTING')
@section('content')

<main class="flex-1 bg-gray-50 min-h-screen">

    <div class="p-4 sm:p-6 lg:p-10 space-y-10 max-w-6xl mx-auto">

        {{-- PROFILE CARD --}}
        <div class="bg-white rounded-2xl shadow-sm border p-6 sm:p-8 flex flex-col md:flex-row gap-6 md:gap-8 items-center">

            {{-- FOTO --}}
            <div class="w-28 h-28 sm:w-32 sm:h-32 md:w-36 md:h-36 rounded-full overflow-hidden shadow-md border flex-shrink-0">
                <img src="{{ asset('storage/'.$user->profile_photo_path) }}"
                    alt="Profile"
                    class="w-full h-full object-cover">
            </div>

            {{-- INFO --}}
            <div class="flex-1 space-y-2 text-center md:text-left">

                <h2 class="text-2xl sm:text-3xl font-bold text-slate-800">
                    {{ $user->name }}
                </h2>

                <p class="text-slate-500 text-sm sm:text-base">
                    {{ $user->roles->pluck('name')->join(', ') }}
                </p>

                <p class="text-sm text-blue-600 font-medium">
                    {{ $user->jabatan ?? 'Belum ada jabatan' }}
                </p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-2 text-sm text-slate-600 mt-4">
                    <div><span class="font-medium">Email:</span> {{ $user->email }}</div>
                    <div><span class="font-medium">No HP:</span> {{ $user->phone ?? '-' }}</div>
                </div>

            </div>
        </div>


        {{-- INFORMASI AKUN --}}
        <div class="bg-white rounded-2xl shadow-sm border p-6 sm:p-8">

            <h3 class="text-lg sm:text-xl font-semibold text-slate-800 mb-6">
                Informasi Akun
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-y-6 max-w-xl text-sm">

                <div class="font-medium text-slate-600">Username</div>
                <div class="sm:text-right border-b pb-1">
                    {{ $user->name }}
                </div>

                <div class="font-medium text-slate-600">Password</div>
                <div class="sm:text-right">
                    <span class="tracking-widest text-slate-400">
                        ••••••••
                    </span>
                </div>

            </div>

        </div>


        {{-- AKTIVITAS --}}
        <div class="bg-white rounded-2xl shadow-sm border p-6 sm:p-8">

            <h3 class="text-lg sm:text-xl font-semibold text-slate-800 mb-6">
                Aktivitas Singkat
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">

                <div class="bg-blue-50 p-6 rounded-xl">
                    <p class="text-sm text-slate-500">Masalah Hari Ini</p>
                    <p class="text-3xl font-bold text-blue-600">
                        {{ $user->today_tasks_count ?? 0 }}
                    </p>
                </div>

                <div class="bg-indigo-50 p-6 rounded-xl">
                    <p class="text-sm text-slate-500">Terakhir Login</p>
                    <p class="text-lg font-semibold text-indigo-600">
                        {{ $user->last_login_at
? \Carbon\Carbon::parse($user->last_login_at)->format('d M Y H:i')
: '-' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- PENGATURAN --}}
        <div class="bg-white rounded-2xl shadow-sm border p-6 sm:p-8">

            <h3 class="text-lg sm:text-xl font-semibold text-slate-800 mb-8">
                Pengaturan
            </h3>


            {{-- NOTIFIKASI --}}
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mb-8">

                <span class="font-medium text-slate-700">
                    Notifikasi
                </span>

                <form method="POST" action="{{ route('superadmin.setting.update-notification') }}">
                    @csrf

                    <div class="flex bg-gray-100 rounded-lg p-1 w-fit">

                        <button type="submit" name="notification" value="1"
                            class="px-4 sm:px-5 py-1.5 rounded-lg text-sm transition
{{ $user->notification_enabled ? 'bg-blue-600 text-white shadow' : 'text-slate-600' }}">
                            ON
                        </button>

                        <button type="submit" name="notification" value="0"
                            class="px-4 sm:px-5 py-1.5 rounded-lg text-sm transition
{{ !$user->notification_enabled ? 'bg-blue-600 text-white shadow' : 'text-slate-600' }}">
                            OFF
                        </button>

                    </div>
                </form>
            </div>


            {{-- VOLUME --}}
            <div class="space-y-4">

                <label class="font-medium text-slate-700">
                    Volume Notifikasi
                </label>

                <form method="POST" action="{{ route('superadmin.setting.update-notification') }}">
                    @csrf

                    <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">

                        <input
                            type="range"
                            name="volume"
                            min="0"
                            max="100"
                            value="{{ $user->notification_volume ?? 20 }}"
                            class="flex-1 w-full"
                            oninput="document.getElementById('volumeValue').innerText = this.value">

                        <span id="volumeValue"
                            class="font-semibold text-blue-600 w-10 text-center">
                            {{ $user->notification_volume ?? 20 }}
                        </span>

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">
                            Simpan
                        </button>

                    </div>

                </form>

            </div>
        </div>


        {{-- BUTTON EDIT --}}
        <div class="flex justify-end">

            <a href="{{ route('superadmin.setting.edit-profile') }}"
                class="flex items-center gap-2 px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">

                <ion-icon name="create-outline" class="text-lg"></ion-icon>
                Edit Profile

            </a>

        </div>

    </div>
</main>

@endsection