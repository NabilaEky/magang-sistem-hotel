@extends('super-admin.layouts.app')
@section('page_title', 'MANAJEMENT ROLE')

@section('content')

<div class="mt-10 px-6">

    {{-- Header --}}
    <div class="bg-white border rounded-xl shadow-sm p-6 mb-6 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-800">
                Daftar Role
            </h2>
            <p class="text-sm text-gray-500">
                Total {{ $roles->total() }} role tersedia
            </p>
        </div>

        <a href="{{ route('superadmin.roles.create') }}"
            class="flex items-center gap-2 px-5 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow transition">

            <ion-icon name="shield-checkmark-outline" class="text-lg"></ion-icon>
            Tambah Role

        </a>
    </div>


    {{-- Table Card --}}
    <div class="bg-white border rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">

                {{-- Header --}}
                <thead class="bg-blue-800 text-white text-xs uppercase tracking-wide">
                    <tr>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4 text-center">Users</th>
                        <th class="px-6 py-4 text-center">Permissions</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- Body --}}
                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse($roles as $role)
                    <tr class="hover:bg-gray-50 transition">

                        {{-- Role Name --}}
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $role->name }}
                        </td>

                        {{-- Users Count --}}
                        <td class="px-6 py-4 text-center">
                            @php
                            $totalUser = $role->users_count ?? 0;
                            @endphp

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-medium">
                                {{ $totalUser }} {{ $totalUser == 1 ? 'User' : 'Users' }}
                            </span>
                        </td>

                        {{-- Permissions Count --}}
                        <td class="px-6 py-4 text-center">
                            @php
                            $totalPermission = $role->permissions_count ?? 0;
                            @endphp

                            <span class="bg-purple-100 text-purple-700 px-3 py-1 rounded-full text-xs font-medium">
                                {{ $totalPermission }} {{ $totalPermission == 1 ? 'Permission' : 'Permissions' }}
                            </span>
                        </td>

                        {{-- Actions --}}
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center gap-2">

                                {{-- EDIT --}}
                                <a href="{{ route('superadmin.roles.edit', $role->id) }}"
                                    class="flex items-center gap-1 px-3 py-1.5 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md text-xs transition">

                                    <ion-icon name="create-outline"></ion-icon>
                                    Edit
                                </a>

                                {{-- DELETE --}}
                                @if($role->name !== 'super_admin')

                                <form action="{{ route('superadmin.roles.destroy', $role->id) }}"
                                    method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus role ini?')"
                                        class="flex items-center gap-1 px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md text-xs transition">

                                        <ion-icon name="trash-outline"></ion-icon>
                                        Delete
                                    </button>
                                </form>

                                @else

                                <span
                                    class="flex items-center gap-1 px-3 py-1.5 bg-gray-400 text-white rounded-md text-xs cursor-not-allowed">

                                    <ion-icon name="lock-closed-outline"></ion-icon>
                                    Protected
                                </span>

                                @endif

                            </div>
                        </td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-10">
                            <div class="flex flex-col items-center text-gray-400">
                                <span class="text-4xl mb-2">📂</span>
                                <p class="font-semibold">Tidak ada role tersedia</p>
                                <p class="text-xs">Silakan tambahkan role baru</p>
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
                        class="border rounded px-3 py-1 pr-8 text-sm bg-white">

                        @foreach([5,10,25,50,100] as $size)

                        <option value="{{ $size }}"
                            {{ request('per_page',10) == $size ? 'selected' : '' }}>
                            {{ $size }}
                        </option>

                        @endforeach

                    </select>

                    <span class="text-gray-600">data</span>

                </form>

                {{-- links --}}
                <div class="text-sm">
                    {{ $roles->links() }}
                </div>

            </div>

        </div>
    </div>
    @endsection