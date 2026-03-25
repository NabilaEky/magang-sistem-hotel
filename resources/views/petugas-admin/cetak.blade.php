@extends('petugas-admin.layouts.dashboard')

@section('content')

<div class="max-w-7xl mx-auto p-8 bg-gray-100 min-h-screen">

    <!-- BOX CETAK -->
    <div class="bg-white rounded-xl shadow-md p-8">

        <!-- TITLE -->
        <div class="text-center bg-blue-800 text-white py-3 rounded mb-8">
            <h1 class="text-xl font-semibold tracking-wide">
                Daily Work
            </h1>
        </div>

        <!-- HEADER INFO -->
        <div class="mb-10">

            <h2 class="font-semibold text-lg mb-4 text-gray-700">
                ENGINEERING DEPARTMENT
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-gray-600">

                <p>
                    <span class="font-medium">Tanggal Cetak :</span>
                    {{ now()->format('d M Y') }}
                </p>
                <p><span class="font-medium">Periode :</span> -</p>
                <p><span class="font-medium">Status :</span> -</p>

            </div>

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto border rounded-lg">

            <table class="w-full text-sm">

                <!-- HEADER TABLE -->
                <thead class="bg-blue-700 text-white text-center text-xs uppercase tracking-wider">
                    <tr>
                        <th class="p-2">No</th>
                        <th class="p-2">Nama</th>
                        <th class="p-2">Jam</th>
                        <th class="p-2">Lokasi</th>
                        <th class="p-2">Problem</th>
                        <th class="p-2">Petugas</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Material</th>
                        <th class="p-2">Keterangan</th>
                        <th class="p-2">Paraf SPV</th>
                    </tr>
                </thead>

                <tbody class="bg-white text-center text-gray-700">

                    @foreach($keluhans as $k)

                    <tr class="border-t hover:bg-gray-50">

                        <td class="p-2">
                            {{ $loop->iteration }}
                        </td>

                        <td class="p-2">
                            {{ $k->jenis_masalah }}
                        </td>

                        <td class="p-2">
                            {{ $k->created_at?->format('H:i') }}
                        </td>

                        <td class="p-2">
                            {{ $k->lokasi }}
                        </td>

                        <td class="p-2">
                            {{ $k->kategori }}
                        </td>

                        <td class="p-2">
                            {{ $k->petugas }}
                        </td>

                        <td class="p-2">
                            {{ $k->status }}
                        </td>

                        <td class="p-2">
                            -
                        </td>

                        <td class="p-2">
                            {{ $k->prioritas }}
                        </td>

                        <td class="p-2">
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- BUTTON -->
        <div class="flex justify-between mt-10">

            <!-- Kembali -->
            <a href="{{ route('keluhan') }}"
                class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition shadow">
                Kembali
            </a>

            <div class="flex gap-4">

                <a href="{{ route('export-excel') }}"
                    class="bg-green-600 text-white px-6 py-2 rounded-lg">
                    Export Excel
                </a>

                <a href="{{ route('export-pdf') }}"
                    class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition shadow">
                    Export PDF
                </a>

            </div>

        </div>

    </div>

</div>

@endsection