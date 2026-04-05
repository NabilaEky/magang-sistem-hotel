@extends('petugas-eng.layouts.petugas')
@section('page_title', 'LAPORAN PROGRAM KERJA')

@section('content')

<form method="GET" id="filterForm">

    <div class="bg-white shadow-lg rounded-xl p-6 mb-6">

        <div class="flex flex-wrap items-center justify-between gap-4">

            {{-- SEARCH --}}
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari laporan..."
                class="border rounded-lg px-4 py-2 w-64">

            <div class="flex flex-wrap gap-4">

                {{-- REALISASI --}}
                <select name="realisasi" class="border rounded-lg px-4 py-2 pr-8">
                    <option value="">Semua Realisasi</option>
                    <option value="Civil" {{ request('realisasi')=='Civil'?'selected':'' }}>Civil</option>
                    <option value="ME" {{ request('realisasi')=='ME'?'selected':'' }}>ME</option>
                </select>

                {{-- JENIS --}}
                <select name="jenis" class="border rounded-lg px-4 py-2 pr-8">
                    <option value="">Semua Jenis</option>
                    <option value="Harian" {{ request('jenis')=='Harian'?'selected':'' }}>Harian</option>
                    <option value="Bulanan" {{ request('jenis')=='Bulanan'?'selected':'' }}>Bulanan</option>
                </select>

                {{-- SHIFT --}}
                <select name="shift" class="border rounded-lg px-4 py-2 pr-8">
                    <option value="">Semua Shift</option>
                    <option value="Pagi" {{ request('shift')=='Pagi'?'selected':'' }}>Pagi</option>
                    <option value="Sore" {{ request('shift')=='Sore'?'selected':'' }}>Sore</option>
                    <option value="Malam" {{ request('shift')=='Malam'?'selected':'' }}>Malam</option>
                </select>

                {{-- STATUS --}}
                <select name="status" class="border rounded-lg px-4 py-2 pr-8">
                    <option value="">Semua Status</option>
                    <option value="Draft" {{ request('status')=='Draft'?'selected':'' }}>Draft</option>
                    <option value="Proses" {{ request('status')=='Proses'?'selected':'' }}>Proses</option>
                    <option value="Selesai" {{ request('status')=='Selesai'?'selected':'' }}>Selesai</option>
                </select>


            </div>

        </div>

    </div>

</form>

{{-- TOMBOL --}}
<div class="flex justify-end mt-8 mb-3">
    <a href="{{ route('petugas.tambah-laporan') }}"
        class="px-6 py-3 bg-green-600 text-white rounded-full shadow">
        + Tambah Laporan
    </a>
</div>

{{-- TABLE --}}
<div class="bg-white shadow-lg rounded-xl overflow-hidden">

    <table class="w-full text-center">

        <thead class="bg-blue-800 text-white">
            <tr>
                <th class="p-4">Tanggal</th>
                <th class="p-4">Realisasi</th>
                <th class="p-4">Jenis</th>
                <th class="p-4">Shift</th>
                <th class="p-4">Status</th>
                <th class="p-4">Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($laporan as $item)
            <tr class="border-b hover:bg-gray-50">

                <td class="p-4">
                    {{ $item->created_at->format('d M Y') }}
                </td>

                <td class="p-4">{{ $item->realisasi }}</td>
                <td class="p-4">{{ $item->jenis }}</td>
                <td class="p-4">{{ $item->shift }}</td>
                <td class="p-4">{{ $item->status }}</td>

                <td class="p-4 flex justify-center gap-2">

                    <a href="{{ route('petugas.detail-laporan', $item->id) }}"
                        class="px-3 py-1 bg-blue-600 text-white rounded text-sm">
                        Detail
                    </a>

                    <a href="{{ route('petugas.edit-laporan', $item->id) }}"
                        class="px-3 py-1 bg-orange-500 text-white rounded text-sm">
                        Edit
                    </a>

                    <form action="{{ route('petugas.hapus-laporan',$item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Yakin hapus?')"
                            class="px-3 py-1 bg-red-500 text-white rounded text-sm">
                            Hapus
                        </button>
                    </form>

                </td>

            </tr>
            @empty
            <tr>
                <td colspan="6" class="p-6 text-gray-500">
                    Tidak ada data
                </td>
            </tr>
            @endforelse

        </tbody>

    </table>


    {{-- Pagination --}}
    <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

        {{-- LIMIT --}}
        <form method="GET" class="flex items-center gap-2 text-sm">

            {{-- bawa semua filter --}}
            @foreach(request()->except('per_page','page') as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach

            <span class="text-gray-600">Tampilkan</span>

            <select name="per_page"
                onchange="this.form.submit()"
                class="border rounded px-3 py-1 pr-8 text-sm bg-white">

                @foreach([5,10,15,20,50,100] as $size)
                <option value="{{ $size }}"
                    {{ request('per_page',10) == $size ? 'selected' : '' }}>
                    {{ $size }}
                </option>
                @endforeach

            </select>

            <span class="text-gray-600">data</span>
        </form>

        {{-- LINKS --}}
        <div class="text-sm">
            {{ $laporan->links() }}
        </div>

    </div>

</div>

{{-- JS AUTO FILTER --}}
<script>
    const form = document.getElementById('filterForm');

    // SELECT AUTO
    document.querySelectorAll('#filterForm select').forEach(el => {
        el.addEventListener('change', () => form.submit());
    });

    // SEARCH AUTO (DELAY)
    let timeout = null;
    const search = document.querySelector('input[name="search"]');

    search.addEventListener('keyup', () => {
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            form.submit();
        }, 500);
    });
</script>

@endsection