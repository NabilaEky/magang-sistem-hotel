@extends('petugas-eng.layouts.petugas')
@section('page_title', 'Dashboard')

@section('content')

{{-- Summary Cards --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
        <div class="bg-red-100 text-red-600 p-3 rounded-lg">
            <ion-icon name="alert-circle-outline" class="text-2xl"></ion-icon>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Keluhan Aktif</p>
            <h3 class="text-2xl font-bold">{{ $keluhanAktif }}</h3>
        </div>
    </div>

    <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
        <div class="bg-yellow-100 text-yellow-600 p-3 rounded-lg">
            <ion-icon name="construct-outline" class="text-2xl"></ion-icon>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Task Hari Ini</p>
            <h3 class="text-2xl font-bold">{{ $taskHariIni }}</h3>
        </div>
    </div>

    <div class="bg-white shadow rounded-xl p-6 flex items-center gap-4">
        <div class="bg-green-100 text-green-600 p-3 rounded-lg">
            <ion-icon name="checkmark-done-outline" class="text-2xl"></ion-icon>
        </div>
        <div>
            <p class="text-gray-500 text-sm">Selesai</p>
            <h3 class="text-2xl font-bold">{{ $selesai }}</h3>
        </div>
    </div>

</div>


{{-- Section Title --}}
<div class="flex items-center justify-between mb-4">
    <h2 class="text-xl font-semibold text-gray-700">
        Keluhan yang Harus Dikerjakan
    </h2>
</div>


{{-- Table --}}
<div class="bg-white shadow rounded-xl overflow-hidden">

    <table class="w-full text-sm text-left">

        <thead class="bg-blue-700 text-white">
            <tr>
                <th class="p-4">Waktu</th>
                <th class="p-4">Lokasi</th>
                <th class="p-4">Jenis Masalah</th>
                <th class="p-4">Prioritas</th>
                <th class="p-4">Status</th>
                <th class="p-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y">

            @forelse($keluhan as $item)

            <tr class="hover:bg-gray-50">

                <td class="p-4">
                    {{ $item->created_at->format('H:i') }}
                </td>

                <td class="p-4">
                    {{ $item->lokasi }}
                </td>

                <td class="p-4">
                    {{ $item->jenis_masalah }}
                </td>

                <td class="p-4">

                    @if($item->prioritas == 'tinggi')
                    <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs">
                        Tinggi
                    </span>

                    @elseif($item->prioritas == 'sedang')
                    <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs">
                        Sedang
                    </span>

                    @else
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                        Rendah
                    </span>
                    @endif

                </td>

                <td class="p-4">

                    @if($item->status == 'pending')
                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                        Pending
                    </span>
                    @elseif($item->status == 'diproses')
                    <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs">
                        Diproses
                    </span>
                    @else
                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs">
                        Selesai
                    </span>
                    @endif

                </td>

                <td class="p-4 text-center">
                    <form action="{{ route('petugas.kerjakan', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                            Kerjakan
                        </button>
                    </form>
                </td>

            </tr>

            @empty

            <tr>
                <td colspan="6" class="p-10 text-center text-gray-500">
                    <div class="flex flex-col items-center gap-2">

                        <ion-icon name="document-outline" class="text-4xl text-gray-300"></ion-icon>

                        <p class="text-gray-500 font-medium">
                            Belum ada keluhan yang masuk
                        </p>

                        <p class="text-sm text-gray-400">
                            Data keluhan akan muncul di sini ketika tamu mengirim laporan.
                        </p>

                    </div>
                </td>
            </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection