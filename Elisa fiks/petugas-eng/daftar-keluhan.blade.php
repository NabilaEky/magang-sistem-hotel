@extends('petugas-eng.layouts.petugas')
@section('page_title', 'Daftar Keluhan')

@section('content')

<div class="space-y-6">

    {{-- ================= DIKERJAKAN ================= --}}
    <div>
        <h2 class="text-lg font-semibold mb-3">
            Yang Dikerjakan
            <span class="text-gray-500">({{ $dikerjakan->count() }})</span>
        </h2>

        {{-- FILTER DIKERJAKAN --}}
        <form method="GET" action="{{ route('petugas.daftar-keluhan') }}">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                
                <input
                    type="text"
                    name="search_dikerjakan"
                    value="{{ request('search_dikerjakan') }}"
                    placeholder="Cari..."
                    class="border rounded-xl px-4 py-2 w-full md:w-72">

                <div class="flex flex-wrap gap-3">

                {{-- PER PAGE --}}
                    <select name="per_page_dikerjakan" onchange="this.form.submit()"
                        class="border rounded-xl px-3 py-2">
                        @foreach([5,10,15,20,50,100] as $num)
                        <option value="{{ $num }}"
                            {{ request('per_page_dikerjakan',5)==$num ? 'selected' : '' }}>
                            {{ $num }}
                        </option>
                        @endforeach
                    </select>
                    
                    <select name="prioritas_dikerjakan" class="border rounded-xl px-4 py-2 pr-8">
                        <option value="">Semua Prioritas</option>
                        <option value="tinggi" {{ request('prioritas_dikerjakan')=='tinggi'?'selected':'' }}>Tinggi</option>
                        <option value="sedang" {{ request('prioritas_dikerjakan')=='sedang'?'selected':'' }}>Sedang</option>
                        <option value="rendah" {{ request('prioritas_dikerjakan')=='rendah'?'selected':'' }}>Rendah</option>
                    </select>

                    <select name="status_dikerjakan" class="border rounded-xl px-4 py-2 pr-8">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status_dikerjakan')=='pending'?'selected':'' }}>Pending</option>
                        <option value="diproses" {{ request('status_dikerjakan')=='diproses'?'selected':'' }}>Diproses</option>
                        <option value="selesai" {{ request('status_dikerjakan')=='selesai'?'selected':'' }}>Selesai</option>
                    </select>

                    <button class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="bg-white shadow-md rounded-2xl overflow-x-auto mt-6">
            <table class="min-w-full text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Masalah</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Prioritas</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y bg-gray-50">
                    @forelse($dikerjakan as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $item->id }}</td>
                        <td class="px-4 py-3">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $item->jenis_masalah }}</td>
                        <td class="px-4 py-3">{{ $item->lokasi }}</td>
                        <td class="px-4 py-3">{{ $item->prioritas }}</td>
                        <td class="px-4 py-3">{{ $item->status }}</td>
                        <td class="px-4 py-3">
                            <a href="{{ route('petugas.selesai.form', $item->id) }}"
                                class="bg-green-500 text-white px-3 py-1 rounded">
                                Selesai
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $dikerjakan->appends(request()->except('page_dikerjakan'))->links() }}
        </div>

    </div>


    {{-- ================= BELUM ================= --}}
    <div>
        <h2 class="text-lg font-semibold mt-10 mb-3">
            Belum Dikerjakan
            <span class="text-gray-500">({{ $belum->count() }})</span>
        </h2>

        {{-- FILTER BELUM --}}
        <form method="GET" action="{{ route('petugas.daftar-keluhan') }}">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                
                <input
                    type="text"
                    name="search_belum"
                    value="{{ request('search_belum') }}"
                    placeholder="Cari..."
                    class="border rounded-xl px-4 py-2 w-full md:w-72">

                <div class="flex flex-wrap gap-3">

                {{-- PER PAGE --}}
                    <select name="per_page_belum" onchange="this.form.submit()"
                        class="border rounded-xl px-3 py-2">
                        @foreach([5,10,15,20,50,100] as $num)
                        <option value="{{ $num }}"
                            {{ request('per_page_belum',5)==$num ? 'selected' : '' }}>
                            {{ $num }}
                        </option>
                        @endforeach
                    </select>
                    
                    <select name="prioritas_belum" class="border rounded-xl px-4 py-2 pr-8">
                        <option value="">Semua Prioritas</option>
                        <option value="tinggi" {{ request('prioritas_belum')=='tinggi'?'selected':'' }}>Tinggi</option>
                        <option value="sedang" {{ request('prioritas_belum')=='sedang'?'selected':'' }}>Sedang</option>
                        <option value="rendah" {{ request('prioritas_belum')=='rendah'?'selected':'' }}>Rendah</option>
                    </select>

                    <select name="status_belum" class="border rounded-xl px-4 py-2 pr-8">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status_belum')=='pending'?'selected':'' }}>Pending</option>
                        <option value="diproses" {{ request('status_belum')=='diproses'?'selected':'' }}>Diproses</option>
                        <option value="selesai" {{ request('status_belum')=='selesai'?'selected':'' }}>Selesai</option>
                    </select>

                    <button class="bg-blue-600 text-white px-5 py-2 rounded-xl">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        {{-- TABLE --}}
        <div class="bg-white shadow-md rounded-2xl overflow-x-auto mt-4">
            <table class="min-w-full text-sm">
                <thead class="bg-yellow-500 text-white">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Masalah</th>
                        <th class="px-4 py-3">Lokasi</th>
                        <th class="px-4 py-3">Prioritas</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y bg-gray-50">
                    @forelse($belum as $item)
                    <tr>
                        <td class="px-4 py-3">{{ $item->id }}</td>
                        <td class="px-4 py-3">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $item->jenis_masalah }}</td>
                        <td class="px-4 py-3">{{ $item->lokasi }}</td>
                        <td class="px-4 py-3">{{ $item->prioritas }}</td>
                        <td class="px-4 py-3">{{ $item->status }}</td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('petugas.detail-keluhan',$item->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded">
                                Detail
                            </a>

                            <form action="{{ route('petugas.kerjakan',$item->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button class="bg-green-600 text-white px-3 py-1 rounded">
                                    Kerjakan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">Kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $belum->appends(request()->except('page_belum'))->links() }}
        </div>
    </div>

</div>

@endsection