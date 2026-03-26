@extends('super-admin.layouts.app')
@section('page_title', 'MANAJEMENT PETUGAS')

@section('content')

<div class="mt-10">

    {{-- Header Card --}}
    <div class="bg-white rounded-xl shadow-sm border p-6 mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Data Petugas
            </h2>
            <p class="text-sm text-gray-500">
                Total {{ $petugas->count() }} petugas terdaftar
            </p>
        </div>

        <a href="{{ route('superadmin.petugas.create') }}"
            class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow flex items-center gap-2 transition">

            <ion-icon name="person-add-outline"></ion-icon>
            <span>Tambah Petugas</span>

        </a>
    </div>


    {{-- Table Card --}}
    <div class="bg-white rounded-xl shadow-sm border overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                <thead class="bg-blue-800 text-white text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-3">No</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Total Penanganan</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse($petugas as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-700">
                            {{ $loop->iteration }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $item->nama }}
                        </td>

                        <td class="px-6 py-4 text-gray-600">
                            {{ $item->user->email ?? '-' }}
                        </td>

                        <td class="px-6 py-4 capitalize">
                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                {{ $item->role }}
                            </span>
                        </td>

                        <td class="px-6 py-4">
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                Aktif
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center font-semibold text-gray-700">
                            0
                        </td>

                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- Edit --}}
                                <a href="{{ route('superadmin.petugas.edit', $item->id) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-xs transition flex items-center gap-1">

                                    <ion-icon name="create-outline"></ion-icon>
                                    <span>Edit</span>
                                       

                                </a>

                                {{-- Hapus --}}
                                <form action="{{ route('superadmin.petugas.destroy', $item->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin hapus petugas ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-xs transition flex items-center gap-1">

                                        <ion-icon name="trash-outline"></ion-icon>
                                        <span>Hapus</span>

                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <span class="text-4xl mb-2">📭</span>
                                <p class="font-semibold">
                                    Tidak ada data petugas
                                </p>
                                <p class="text-xs">
                                    Silakan tambahkan petugas baru
                                </p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

                {{-- pilihan jumlah data --}}
                <form method="GET" class="flex items-center gap-2 text-sm">

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
                    {{ $petugas->links() }}
                </div>
            </div>
        </div>

    </div>

</div>

@endsection