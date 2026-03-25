@extends('petugas-admin.layouts.dashboard')

@section('header')
<h1 class="text-2xl text-center font-semibold text-white">
    ME
</h1>
@endsection

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">

<div class="max-w-7xl mx-auto p-6">

    <!-- ✅ BUTTON KEMBALI (FIX) -->
    <div class="mb-4">
        <a href="{{ route('keluhan') }}"
            class="flex items-center gap-2 text-gray-600 hover:text-blue-600 transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-5 h-5"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor">

                <path stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7" />
            </svg>

            <span class="text-sm font-medium">
                Kembali
            </span>
        </a>
    </div>

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        <!-- FILTER + EXPORT -->
        <div class="p-4 border-b flex justify-between items-center flex-wrap gap-3">

            <!-- ✅ FILTER -->
            <form method="GET" action="{{ route('civil') }}" class="flex items-center gap-3">

                <input
                    id="monthPicker"
                    name="month"
                    value="{{ request('month') }}"
                    class="border rounded-lg px-4 py-2 shadow-sm w-48"
                    placeholder="Pilih Bulan & Tahun">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                    Filter
                </button>

            </form>

            <!-- ✅ EXPORT (IKUT FILTER) -->
            <div class="flex gap-3">

                <a href="{{ route('civil.export-excel', ['month' => request('month')]) }}"
                    class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg shadow">
                    Export Excel
                </a>

                <a href="{{ route('civil.export-pdf', ['month' => request('month')]) }}"
                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg shadow">
                    Export PDF
                </a>

            </div>

        </div>

        <!-- HEADER -->
        <div class="bg-blue-600 text-white text-center py-5">

            <h2 class="text-xl font-bold tracking-wide">
                ME REPAIR MAINTENANCE
            </h2>

            <p class="text-sm opacity-90">
                PATRA SEMARANG HOTEL & CONVENTION
            </p>

            <span id="headerMonth" class="text-xs opacity-80">
                {{ request('month') ? strtoupper(request('month')) : strtoupper(date('F Y')) }}
            </span>

        </div>

        <!-- TABLE -->
        <div class="p-4 overflow-x-auto">

            <div class="overflow-hidden rounded-xl border border-gray-200">

                <table class="w-full text-center text-sm">

                    <thead class="bg-gray-100 text-gray-700">
                        <tr>
                            <th class="p-3 border">NO</th>
                            <th class="p-3 border">TGL</th>
                            <th class="p-3 border">LOKASI</th>
                            <th class="p-3 border">PEKERJAAN</th>
                            <th class="p-3 border">GAMBAR TEMUAN</th>
                            <th class="p-3 border">GAMBAR PROGRESS</th>
                            <th class="p-3 border">SELESAI</th>
                            <th class="p-3 border">KETERANGAN</th>
                            <th class="p-3 border">PETUGAS</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($data as $i => $item)
                        <tr class="hover:bg-gray-50 transition" style="height:130px">

                            <td class="border">{{ $i + 1 }}</td>

                            <td class="border">
                                {{ \Carbon\Carbon::parse($item->tgl)->format('d-m-Y') }}
                            </td>

                            <td class="border">{{ $item->lokasi }}</td>
                            <td class="border">{{ $item->pekerjaan }}</td>

                            <td class="border">
                                @if($item->gambar_temuan)
                                <img src="{{ asset('storage/'.$item->gambar_temuan) }}"
                                    class="mx-auto rounded-lg shadow w-24">
                                @endif
                            </td>

                            <td class="border">
                                @if($item->gambar_progress)
                                <img src="{{ asset('storage/'.$item->gambar_progress) }}"
                                    class="mx-auto rounded-lg shadow w-24">
                                @endif
                            </td>

                            <td class="border">
                                @if($item->selesai)
                                <img src="{{ asset('storage/'.$item->selesai) }}"
                                    class="mx-auto rounded-lg shadow w-24">
                                @endif
                            </td>

                            <td class="border px-3 text-left">
                                {{ $item->keterangan ?? '-' }}
                            </td>

                            <td class="border font-semibold">
                                {{ $item->petugas ?? '-' }}
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="p-4 text-center text-gray-500">
                                Data belum ada
                            </td>
                        </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>

<script>
    flatpickr("#monthPicker", {
        plugins: [
            new monthSelectPlugin({
                shorthand: true,
                dateFormat: "F Y",
                altFormat: "F Y"
            })
        ],
        defaultDate: "{{ request('month') ?? now() }}",
        onChange: function(selectedDates, dateStr) {
            document.getElementById("headerMonth").innerHTML = dateStr.toUpperCase();
        }
    });
</script>

@endsection