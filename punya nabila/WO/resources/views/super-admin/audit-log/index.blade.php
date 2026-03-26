@extends('super-admin.layouts.app')
@section('page_title', 'AUDIT LOG')

@section('content')

<div class="mt-10 px-6">

    {{-- Header --}}
    <div class="bg-white border rounded-xl shadow-sm p-6 mb-6
            flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        {{-- Title --}}
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Audit Log
            </h2>
            <p class="text-sm text-gray-500">
                Riwayat aktivitas dan tindakan pengguna dalam sistem
            </p>
        </div>

        {{-- Filter --}}
        <form method="GET" action="{{ route('superadmin.audit-log.index') }}">
            <div class="flex flex-wrap items-center gap-3">

                {{-- Date --}}
                <input
                    type="date"
                    name="date"
                    value="{{ request('date') }}"
                    placeholder="Pilih tanggal..."
                    class="border border-gray-300 rounded-lg px-4 py-2 text-sm focus:ring focus:ring-blue-200 focus:outline-none">

                {{-- Action --}}
                <select
                    name="action"
                    class="border border-gray-300 rounded-lg px-4 py-2 pr-8 text-sm focus:ring focus:ring-blue-200 focus:outline-none">
                    <option value="">Pilih Action</option>
                    <option value="created" {{ request('action') == 'created' ? 'selected' : '' }}>Create</option>
                    <option value="updated" {{ request('action') == 'updated' ? 'selected' : '' }}>Update</option>
                    <option value="deleted" {{ request('action') == 'deleted' ? 'selected' : '' }}>Delete</option>
                </select>

                {{-- Button Filter --}}
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow transition text-sm">
                    Filter
                </button>

            </div>
        </form>
    </div>

    {{-- Table Card --}}
    <div class="bg-white border rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                {{-- Header --}}
                <thead class="bg-blue-800 text-white text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-4 text-center w-20">ID</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Action</th>
                        <th class="px-6 py-4 text-center">Tanggal</th>
                        <th class="px-6 py-4 text-center">Waktu</th>
                        <th class="px-6 py-4 text-center">IP Address</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-200 bg-white">

                    @if($logs->count() > 0)
                    @foreach($logs as $log)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-center font-medium text-gray-700">
                            {{ $log->id }}
                        </td>

                        <td class="px-6 py-4 text-gray-800">
                            {{ $log->user->username ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-medium">
                                @if($log->action == 'created')
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-medium">
                                    Create
                                </span>

                                @elseif($log->action == 'updated')
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-medium">
                                    Update
                                </span>

                                @elseif($log->action == 'deleted')
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-medium">
                                    Delete
                                </span>

                                @else
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ ucfirst($log->action) }}
                                </span>
                                @endif
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center text-gray-700">
                            {{ $log->created_at->format('d M Y') }}
                        </td>

                        <td class="px-6 py-4 text-center text-gray-700">
                            {{ $log->created_at->format('H:i') }}
                        </td>

                        <td class="px-6 py-4 text-center text-gray-700">
                            {{ $log->ip_address ?? '-' }}
                        </td>

                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="py-12 text-center">

                            @if(request()->hasAny(['date', 'action']))
                            {{-- FILTER ADA TAPI HASIL KOSONG --}}
                            <div class="flex flex-col items-center text-gray-400">
                                <span class="text-4xl mb-2">🔍</span>
                                <p class="font-semibold">Data tidak ditemukan</p>
                                <p class="text-xs">Coba ubah filter pencarian</p>
                            </div>
                            @else
                            {{-- BELUM ADA AKTIVITAS --}}
                            <div class="flex flex-col items-center text-gray-400">
                                <span class="text-4xl mb-2">📂</span>
                                <p class="font-semibold">Belum ada aktivitas</p>
                                <p class="text-xs">Audit log akan muncul setelah ada tindakan pengguna</p>
                            </div>
                            @endif

                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

                {{-- pilihan jumlah data --}}
                <form method="GET" class="flex items-center gap-2 text-sm">

                    {{-- pertahankan filter saat ganti pagination --}}
                    @foreach(request()->except('per_page','page') as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach

                    <span class="text-gray-600">Tampilkan</span>

                    <select name="per_page"
                        onchange="this.form.submit()"
                        class="border rounded px-3 py-1 pr-8 text-sm appearance-none bg-white">

                        @foreach([5,10,25,50,100] as $size)

                        <option value="{{ $size }}"
                            {{ request('per_page',10) == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>

                        @endforeach

                    </select>

                    <span class="text-gray-600">data</span>

                </form>

                {{-- pagination --}}
                <div class="text-sm">
                    {{ $logs->links() }}
                </div>

            </div>
        </div>

    </div>

</div>

@endsection