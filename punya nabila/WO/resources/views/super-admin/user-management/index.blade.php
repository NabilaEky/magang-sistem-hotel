@extends('super-admin.layouts.app')
@section('page_title', 'MANAJEMENT USER')

@section('content')

<div class="mt-10 px-6">

    {{-- Header --}}
    <div class="bg-white border rounded-xl shadow-sm p-6 mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Daftar User
            </h2>
            <p class="text-sm text-gray-500">
                Total {{ $users->total() }} user terdaftar
            </p>
        </div>

        <a href="{{ route('superadmin.user-management.create') }}"
            class="flex items-center gap-2 px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition">

            <ion-icon name="person-add-outline" class="text-lg"></ion-icon>
            Tambah User

        </a>
    </div>

    {{-- Table Card --}}
    <div class="bg-white border rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                {{-- Header --}}
                <thead class="bg-blue-800 text-white text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-4 text-center">No</th>
                        <th class="px-6 py-4">Nama</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-center">Jabatan</th>
                        <th class="px-6 py-4 text-center">Role</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse($users as $user)
                    <tr class="hover:bg-gray-50 transition">

                        <td class="px-6 py-4 text-center text-gray-600">
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        {{-- Nama --}}
                        <td class="px-6 py-4 font-medium text-gray-800">
                            {{ $user->name }}
                        </td>

                        {{-- Username --}}
                        <td class="px-6 py-4 text-gray-600">
                            {{ $user->username }}
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-4 text-gray-600">
                            {{ $user->email }}
                        </td>

                        {{-- Jabatan --}}
                        <td class="px-6 py-4 text-center">
                            <span class="text-gray-600">
                                {{ $user->jabatan ?? '-' }}
                            </span>
                        </td>

                        {{-- Role --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-1 flex-wrap">
                                @forelse($user->roles as $role)
                                <span
                                    class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $role->name }}
                                </span>
                                @empty
                                <span class="text-xs text-gray-400 italic">
                                    No Role
                                </span>
                                @endforelse
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- EDIT --}}
                                <a href="{{ route('superadmin.user-management.edit', $user->id) }}"
                                    class="flex items-center gap-1 px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs transition">

                                    <ion-icon name="create-outline" class="text-sm"></ion-icon>
                                    Edit
                                </a>

                                {{-- PROTECTED --}}
                                @if($user->hasRole('super_admin'))

                                <span
                                    class="flex items-center gap-1 px-3 py-1.5 bg-gray-400 text-white rounded-md text-xs cursor-not-allowed">

                                    <ion-icon name="lock-closed-outline"></ion-icon>
                                    Protected
                                </span>

                                @else

                                {{-- DELETE --}}
                                <form action="{{ route('superadmin.user-management.destroy', $user->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus user ini?')"
                                        class="flex items-center gap-1 px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs transition">

                                        <ion-icon name="trash-outline"></ion-icon>
                                        Delete
                                    </button>
                                </form>

                                @endif

                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-10">
                            <div class="flex flex-col items-center text-gray-400">
                                <span class="text-4xl mb-2">👥</span>
                                <p class="font-semibold">Tidak ada user</p>
                                <p class="text-xs">Silakan tambahkan user baru</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse

                </tbody>

            </table>

            {{-- Pagination --}}
            <div class="flex flex-wrap items-center justify-between gap-4 p-4 border-t bg-gray-50">

                {{-- pilihan jumlah data --}}
                <form method="GET" class="flex items-center gap-2 text-sm">

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
                    {{ $users->links() }}
                </div>

            </div>

        </div>
    </div>

    @endsection