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

        {{-- ================= FILTER ================= --}}
        <form method="GET" action="{{ route('petugas.daftar-keluhan') }}">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari..."
                    class="border rounded-xl px-4 py-2 w-full md:w-72 focus:ring-2 focus:ring-blue-500">

                <div class="flex flex-wrap gap-3">
                    <select name="prioritas" class="border rounded-xl px-4 py-2 pr-8">
                        <option value="">Semua Prioritas</option>
                        <option value="tinggi" {{ request('prioritas')=='tinggi'?'selected':'' }}>Tinggi</option>
                        <option value="sedang" {{ request('prioritas')=='sedang'?'selected':'' }}>Sedang</option>
                        <option value="rendah" {{ request('prioritas')=='rendah'?'selected':'' }}>Rendah</option>
                    </select>

                    <select name="status" class="border rounded-xl px-4 py-2 pr-7">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">
                        Cari
                    </button>
                </div>
            </div>
        </form>

        <div class="bg-white shadow-md rounded-2xl overflow-x-auto mt-6">
            <table class="min-w-full text-sm">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-3 text-left w-16">ID</th>
                        <th class="px-4 py-3 text-left w-32">Tanggal</th>
                        <th class="px-4 py-3 text-left">Masalah</th>
                        <th class="px-4 py-3 text-left">Lokasi</th>
                        <th class="px-4 py-3 text-center w-32">Prioritas</th>
                        <th class="px-4 py-3 text-center w-32">Status</th>
                        <th class="px-4 py-3 text-center w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y bg-gray-50">
                    @forelse($dikerjakan as $item)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-3 font-semibold text-gray-700">{{ $item->id }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $item->created_at->format('d M Y') }}</td>

                        <td class="px-4 py-3 text-gray-800 max-w-xs truncate" title="{{ $item->jenis_masalah }}">
                            {{ $item->jenis_masalah }}
                        </td>

                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate" title="{{ $item->lokasi }}">
                            {{ $item->lokasi }}
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($item->prioritas == 'tinggi')
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">Tinggi</span>
                            @elseif($item->prioritas == 'sedang')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-semibold">Sedang</span>
                            @else
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">Rendah</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($item->status == 'diproses')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-semibold">Diproses</span>
                            @elseif($item->status == 'selesai')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">Selesai</span>
                            @elseif($item->status == 'pending')
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                            @endif
                        </td>

                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('petugas.selesai.form', $item->id) }}"
                                class="inline-block bg-green-500 hover:bg-green-600 text-white px-4 py-1.5 rounded-lg text-xs font-medium shadow">
                                Selesai
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ================= BELUM DIKERJAKAN ================= --}}
    
    <div>
        <h2 class="text-lg font-semibold mb-3 mt-10">
            Belum Dikerjakan
            <span class="text-gray-500">({{ $belum->count() }})</span>
        </h2>
        
        {{-- ================= FILTER ================= --}}
        <form method="GET" action="{{ route('petugas.daftar-keluhan') }}">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari..."
                    class="border rounded-xl px-4 py-2 w-full md:w-72 focus:ring-2 focus:ring-blue-500">

                <div class="flex flex-wrap gap-3">
                    <select name="prioritas" class="border rounded-xl px-4 py-2 pr-8">
                        <option value="">Semua Prioritas</option>
                        <option value="tinggi" {{ request('prioritas')=='tinggi'?'selected':'' }}>Tinggi</option>
                        <option value="sedang" {{ request('prioritas')=='sedang'?'selected':'' }}>Sedang</option>
                        <option value="rendah" {{ request('prioritas')=='rendah'?'selected':'' }}>Rendah</option>
                    </select>

                    <select name="status" class="border rounded-xl px-4 py-2 pr-7">
                        <option value="">Semua Status</option>
                        <option value="pending">Pending</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow">
                        Cari
                    </button>
                </div>
            </div>
        </form>
    </div>

        <div class="bg-white shadow-md rounded-2xl overflow-x-auto mt-3">
            <table class="min-w-full text-sm">
                <thead class="bg-yellow-500 text-white text-center">
                    <tr>
                        <th class="px-4 py-3 text-left w-16">ID</th>
                        <th class="px-4 py-3 text-left w-32">Tanggal</th>
                        <th class="px-4 py-3 text-left">Masalah</th>
                        <th class="px-4 py-3 text-left">Lokasi</th>
                        <th class="px-4 py-3 text-center w-32">Prioritas</th>
                        <th class="px-4 py-3 text-center w-32">Status</th>
                        <th class="px-4 py-3 text-center w-32">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y bg-gray-50">
                    @forelse($belum as $item)
                    <tr class="hover:bg-gray-100 transition">
                        <td class="px-4 py-3 font-semibold text-gray-700">{{ $item->id }}</td>
                        <td class="px-4 py-3 text-gray-500">{{ $item->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3 font-medium text-gray-800 max-w-xs truncate" title="{{ $item->jenis_masalah }}">
                            {{ $item->jenis_masalah }}
                        </td>
                        <td class="px-4 py-3 text-gray-600 max-w-xs truncate" title="{{ $item->lokasi }}">
                            {{ $item->lokasi }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="capitalize bg-gray-100 px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $item->prioritas }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-center">
                            @if($item->status == 'diproses')
                            <span class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-full text-xs font-semibold">Diproses</span>
                            @elseif($item->status == 'selesai')
                            <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full text-xs font-semibold">Selesai</span>
                            @elseif($item->status == 'pending')
                            <span class="bg-red-100 text-red-600 px-3 py-1 rounded-full text-xs font-semibold">Pending</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 flex justify-center gap-2 mt-2">
                            <a href="{{ route('petugas.detail-keluhan',$item->id) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                Detail
                            </a>
                            <form action="{{ route('petugas.kerjakan',$item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button class="bg-green-600 hover:bg-green-800 text-white px-3 py-1 rounded-lg text-xs font-semibold">
                                    Kerjakan
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-6 text-gray-500">Kosong</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection