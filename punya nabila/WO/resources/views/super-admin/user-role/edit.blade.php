@extends('super-admin.layouts.blank')

@section('content')

{{-- Page Header --}}

<div class="bg-slate-700 text-white px-8 py-5 rounded-lg mb-8 shadow flex items-center justify-between">

<div class="flex items-center gap-3">
    <ion-icon name="shield-checkmark-outline" class="text-2xl"></ion-icon>

    <div>
        <div class="text-xl font-semibold">
            Edit Role
        </div>
        <div class="text-sm text-gray-200">
            Kelola nama role dan hak akses pengguna
        </div>
    </div>
</div>

</div>

<div class="flex justify-center">

<div class="w-full max-w-5xl bg-white rounded-xl shadow-md border border-gray-200">

<div class="p-10">

    <form action="{{ route('superadmin.roles.update', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Role --}}
        <div class="mb-6">
            <label class="block mb-2 font-medium text-gray-700">
                Nama Role
            </label>

            <input type="text"
                name="name"
                value="{{ $role->name }}"
                class="w-full max-w-md border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Deskripsi --}}
        <div class="mb-10">
            <label class="block mb-2 font-medium text-gray-700">
                Deskripsi
            </label>

            <input type="text"
                class="w-full max-w-md border border-gray-300 rounded-lg px-4 py-3 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- Permission Table --}}
        <div class="overflow-x-auto">

            <table class="w-full border border-gray-200 rounded-lg overflow-hidden">

                <thead>
                    <tr class="bg-slate-700 text-white text-center text-sm">
                        <th class="px-6 py-3 text-left">Module</th>
                        <th class="px-6 py-3">View</th>
                        <th class="px-6 py-3">Create</th>
                        <th class="px-6 py-3">Edit</th>
                        <th class="px-6 py-3">Delete</th>
                        <th class="px-6 py-3">Assign</th>
                    </tr>
                </thead>

                <tbody class="text-center text-sm bg-white">

                    @php
                    $modules = ['dashboard', 'keluhan', 'petugas', 'laporan', 'role'];
                    $actions = ['view', 'create', 'edit', 'delete', 'assign'];
                    @endphp

                    @foreach ($modules as $module)
                    <tr class="border-t hover:bg-gray-50">

                        <td class="px-6 py-4 font-medium text-left capitalize">
                            {{ ucfirst($module) }}
                        </td>

                        @foreach ($actions as $action)
                        @php
                        $permissionName = $module . '_' . $action;
                        @endphp

                        <td class="py-4">
                            <input type="checkbox"
                                name="permissions[]"
                                value="{{ $permissionName }}"
                                class="w-4 h-4 accent-blue-600"
                                {{ $role->hasPermissionTo($permissionName) ? 'checked' : '' }}>
                        </td>
                        @endforeach

                    </tr>
                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- Buttons --}}
        <div class="flex justify-end gap-4 mt-10">

            <a href="{{ route('superadmin.roles.index') }}"
                class="flex items-center gap-2 px-6 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">

                <ion-icon name="arrow-back-outline"></ion-icon>
                Kembali
            </a>

            <button type="submit"
                class="flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">

                <ion-icon name="save-outline"></ion-icon>
                Simpan
            </button>

        </div>

    </form>

</div>

</div>

</div>

@endsection
