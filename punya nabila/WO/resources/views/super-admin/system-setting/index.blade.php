@extends('super-admin.layouts.app')
@section('page_title', 'SYSTEM SETTING')
@section('content')

<div class="px-6 py-10 flex justify-center">

    <div class="w-full max-w-4xl bg-white border border-gray-200 rounded-2xl shadow-sm">

        {{-- Header --}}
        <div class="px-10 py-8 border-b">
            <h2 class="text-2xl font-semibold text-gray-800">
                System Configuration
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Pengaturan umum sistem dan layanan
            </p>
        </div>

        {{-- Form --}}
        <form action="#" method="POST" class="px-10 py-10">
            @csrf

            <div class="space-y-8">

                {{-- Maintenance Mode --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-lg font-medium text-gray-700">
                            Maintenance Mode
                        </label>
                        <p class="text-sm text-gray-500">
                            Nonaktifkan sementara sistem untuk perawatan
                        </p>
                    </div>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-12 h-6 bg-gray-300 rounded-full peer 
                                    peer-checked:bg-blue-600
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                    after:bg-white after:rounded-full after:h-5 after:w-5
                                    after:transition-all
                                    peer-checked:after:translate-x-6">
                        </div>
                    </label>
                </div>

                <hr>

                {{-- Notification --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-lg font-medium text-gray-700">
                            Notification
                        </label>
                        <p class="text-sm text-gray-500">
                            Aktifkan notifikasi sistem untuk pengguna
                        </p>
                    </div>

                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer" checked>
                        <div class="w-12 h-6 bg-gray-300 rounded-full peer 
                                    peer-checked:bg-blue-600
                                    after:content-[''] after:absolute after:top-[2px] after:left-[2px]
                                    after:bg-white after:rounded-full after:h-5 after:w-5
                                    after:transition-all
                                    peer-checked:after:translate-x-6">
                        </div>
                    </label>
                </div>

                <hr>

                {{-- SLA Setting --}}
                <div class="flex items-center justify-between">
                    <div>
                        <label class="text-lg font-medium text-gray-700">
                            SLA Setting
                        </label>
                        <p class="text-sm text-gray-500">
                            Batas waktu penyelesaian maksimal setiap keluhan
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <input type="number"
                            name="sla_days"
                            min="1"
                            placeholder="5"
                            class="border border-gray-300 rounded-lg px-4 py-2 w-32
                                   focus:ring focus:ring-blue-200 focus:outline-none">

                        <span class="text-gray-600 font-medium">
                            Hari
                        </span>
                    </div>
                </div>

            </div>

            {{-- Buttons --}}
            <div class="flex justify-end gap-4 mt-12">

                <button type="reset"
                    class="flex items-center gap-2 px-6 py-3 bg-yellow-500 text-white rounded-lg
               hover:bg-yellow-600 transition">

                    <ion-icon name="refresh-outline"></ion-icon>
                    Reset

                </button>

                <button type="submit"
                    class="flex items-center gap-2 px-6 py-3 bg-blue-600 text-white rounded-lg
               hover:bg-blue-700 transition">

                    <ion-icon name="save-outline"></ion-icon>
                    Simpan

                </button>

            </div>
        </form>

    </div>

</div>

@endsection