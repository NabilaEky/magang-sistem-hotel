@extends('super-admin.layouts.blank')

@section('content')

<div class="min-h-screen bg-slate-700 py-10">

    <h1 class="text-3xl font-semibold text-white text-center mb-10">
        DETAIL RIWAYAT
    </h1>

    <div class="max-w-6xl mx-auto bg-gray-100 p-8 rounded shadow">

        <h2 class="bg-blue-900 text-white text-center py-3 font-semibold rounded">
            Informasi Keluhan
        </h2>

        <div class="grid grid-cols-2 gap-8 mt-6">

            {{-- LEFT SIDE --}}
            <div class="space-y-6">

                {{-- Informasi Admin --}}
                <div class="border rounded bg-white">
                    <div class="bg-gray-200 px-4 py-2 font-semibold">
                        Pengaturan Admin
                    </div>
                    <div class="p-4 text-sm space-y-2">
                        <p><strong>ID:</strong> AC-2602-001</p>
                        <p><strong>Tanggal:</strong> 19/02/2026</p>
                        <p><strong>Lokasi:</strong> 111</p>
                        <p><strong>Jenis Masalah:</strong> AC</p>
                        <p><strong>Deskripsi:</strong> AC tidak dingin</p>
                        <p><strong>Waktu Permintaan:</strong> 15.00</p>
                        <p><strong>Waktu Selesai:</strong> 22.00</p>
                    </div>
                </div>

                {{-- Foto Masalah --}}
                <div class="border rounded bg-white">
                    <div class="bg-gray-200 px-4 py-2 font-semibold">
                        Foto Masalah
                    </div>

                    <div class="p-4 flex gap-4">
                        <div class="w-24 h-20 bg-gray-300 flex items-center justify-center text-xs">
                            FOTO
                        </div>
                        <div class="w-24 h-20 bg-gray-300 flex items-center justify-center text-xs">
                            FOTO
                        </div>
                        <div class="w-24 h-20 bg-gray-300 flex items-center justify-center text-xs">
                            FOTO
                        </div>
                    </div>

                    <p class="text-center text-xs pb-3 text-gray-500">
                        (maks. 3)
                    </p>
                </div>

                {{-- Pengaturan Admin --}}
                <div class="border rounded bg-white">
                    <div class="bg-gray-200 px-4 py-2 font-semibold">
                        Pengaturan Admin
                    </div>

                    <div class="p-4 space-y-4 text-sm">
                        <div>
                            <label class="block mb-1">Petugas</label>
                            <input type="text"
                                class="w-full border rounded px-3 py-1"
                                value="Udin" readonly>
                        </div>

                        <div>
                            <label class="block mb-1">Status</label>
                            <input type="text"
                                class="w-full border rounded px-3 py-1"
                                value="Done" readonly>
                        </div>

                        <div>
                            <label class="block mb-1">Prioritas</label>
                            <input type="text"
                                class="w-full border rounded px-3 py-1"
                                value="Normal" readonly>
                        </div>
                    </div>
                </div>

            </div>

            {{-- RIGHT SIDE --}}
            <div class="space-y-6">

                {{-- Proses Pengerjaan --}}
                <div class="border rounded bg-white">
                    <div class="bg-gray-200 px-4 py-2 font-semibold text-center">
                        Proses Pengerjaan Petugas
                    </div>

                    <div class="p-4 grid grid-cols-2 gap-4">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="w-full h-24 bg-gray-300 flex items-center justify-center text-xs">
                            Bukti Proses
                    </div>
                    @endfor
                </div>

                <div class="bg-gray-100 p-4">
                    <strong>Catatan Petugas:</strong>
                    <p class="text-sm text-gray-600 mt-2">
                        AC sudah dibersihkan dan freon ditambahkan.
                    </p>
                </div>
            </div>

            {{-- Feedback --}}
            <div class="border rounded bg-white">
                <div class="bg-gray-200 px-4 py-2 font-semibold">
                    Feedback Pengunjung
                </div>

                <div class="p-4 space-y-4 text-sm">
                    <p>Rating: ⭐⭐⭐⭐☆</p>

                    <div class="border p-3 rounded bg-gray-50">
                        Pekerjaan cepat dan rapi.
                    </div>
                </div>
            </div>

            {{-- Aksi --}}
            <div class="p-4 flex gap-4 justify-center">

                <a href="{{ url()->previous() }}"
                    class="flex items-center gap-2 bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">

                    <ion-icon name="arrow-back-outline"></ion-icon>
                    <span>Kembali</span>

                </a>

                <button
                    class="flex items-center gap-2 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">

                    <ion-icon name="logo-whatsapp"></ion-icon>
                    <span>Kirim WhatsApp</span>

                </button>

                <button
                    class="flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">

                    <ion-icon name="print-outline"></ion-icon>
                    <span>Cetak</span>

                </button>

            </div>
        </div>

    </div>

</div>

</div>

</div>

@endsection