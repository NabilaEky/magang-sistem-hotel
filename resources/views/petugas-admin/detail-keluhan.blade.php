@extends('petugas-admin.layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto p-8 bg-gray-100 min-h-screen">

    <!-- TITLE -->
    <div class="bg-blue-700 text-white text-center py-4 rounded-t-xl shadow">
        <h1 class="text-xl font-semibold tracking-wide">
            DETAIL DAFTAR KELUHAN
        </h1>
    </div>

    <!-- CONTENT BOX -->
    <div class="bg-white shadow-md p-8 rounded-b-xl">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- KIRI -->
            <div class="space-y-6">

                <!-- Informasi -->
                <div class="bg-white rounded-lg shadow-sm border">

                    <div class="bg-gray-100 px-4 py-2 font-semibold border-b">
                        Informasi Keluhan
                    </div>

                    <div class="p-4 text-sm space-y-2 text-gray-700">
                        <p><span class="font-medium">ID</span> : {{ $keluhan->id }}</p>

                        <p><span class="font-medium">Tanggal</span> :
                            {{ $keluhan->created_at->format('d M Y') }}
                        </p>

                        <p><span class="font-medium">Lokasi</span> : {{ $keluhan->lokasi }}</p>

                        <p><span class="font-medium">Jenis Masalah</span> : {{ $keluhan->jenis_masalah }}</p>

                        <p><span class="font-medium">Deskripsi</span> : {{ $keluhan->deskripsi }}</p>

                        <p><span class="font-medium">Waktu Permintaan</span> : {{ $keluhan->created_at }}</p>

                        <p><span class="font-medium">Waktu Selesai</span> : {{ $keluhan->updated_at }}</p>
                    </div>

                </div>


                <!-- Foto Masalah -->
                <div class="bg-white rounded-lg shadow-sm border">

                    <div class="bg-gray-100 px-4 py-2 font-semibold border-b">
                        Foto Masalah
                    </div>

                    <div class="p-6 flex gap-4 justify-center">

                        @if($keluhan->foto1)
                            <img src="{{ asset('storage/'.$keluhan->foto1) }}" class="w-24 h-20 object-cover rounded border">
                        @endif

                        @if($keluhan->foto2)
                            <img src="{{ asset('storage/'.$keluhan->foto2) }}" class="w-24 h-20 object-cover rounded border">
                        @endif

                        @if($keluhan->foto3)
                            <img src="{{ asset('storage/'.$keluhan->foto3) }}" class="w-24 h-20 object-cover rounded border">
                        @endif

                    </div>

                </div>


                <!-- Pengaturan -->
                <div class="bg-white rounded-lg shadow-sm border">

                    <div class="bg-gray-100 px-4 py-2 font-semibold border-b">
                        Pengaturan Admin
                    </div>

                    <div class="p-4 space-y-4 text-sm">

                        <div class="flex justify-between items-center">
                            <span class="font-medium">Petugas</span>
                            <input 
                                value="{{ $keluhan->petugas ?? '-' }}"
                                class="border rounded px-3 py-1 w-40 bg-gray-100"
                                readonly>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="font-medium">Status</span>
                            <input 
                                value="{{ $keluhan->status ?? '-' }}"
                                class="border rounded px-3 py-1 w-40 bg-gray-100"
                                readonly>
                        </div>

                        <div class="flex justify-between items-center">
                            <span class="font-medium">Prioritas</span>
                            <input 
                                value="{{ $keluhan->prioritas ?? '-' }}"
                                class="border rounded px-3 py-1 w-40 bg-gray-100"
                                readonly>
                        </div>

                    </div>

                </div>

            </div>


            <!-- KANAN -->
            <div class="space-y-6">

                <!-- Bukti Proses -->
                <div class="bg-white rounded-lg shadow-sm border">

                    <div class="bg-gray-100 px-4 py-2 font-semibold border-b">
                        Proses Pengerjaan Petugas
                    </div>

                    <div class="p-6 grid grid-cols-2 gap-6">

                        @for($i=1;$i<=6;$i++)
                            @php $field = 'proses_foto'.$i; @endphp

                            @if($keluhan->$field)
                                <img src="{{ asset('storage/'.$keluhan->$field) }}" class="h-24 w-full object-cover rounded border">
                            @else
                                <div class="bg-gray-200 border rounded h-24 flex items-center justify-center text-xs">
                                    FOTO
                                </div>
                            @endif
                        @endfor

                    </div>

                    <div class="border-t p-4 text-sm text-gray-700">
                        <span class="font-medium">Catatan Petugas :</span><br>
                        {{ $keluhan->catatan_admin ?? '-' }}
                    </div>

                </div>


                <!-- Feedback -->
                <div class="bg-white rounded-lg shadow-sm border">

                    <div class="bg-gray-100 px-4 py-2 font-semibold border-b">
                        Feedback Pengunjung
                    </div>

                    <div class="p-4 text-sm space-y-3 text-gray-700">
                        <p><span class="font-medium">Rating :</span> ⭐⭐⭐⭐⭐</p>

                        <input type="text"
                            value="{{ $keluhan->feedback ?? '' }}"
                            class="border rounded w-full px-3 py-2 bg-gray-100"
                            readonly>
                    </div>

                </div>


                <!-- AKSI -->
                <div class="p-4 flex justify-end">

                    <a href="{{ route('keluhan') }}"
                        class="bg-gray-500 text-white px-5 py-2 rounded-lg hover:bg-gray-600 transition text-sm">
                        Kembali
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection