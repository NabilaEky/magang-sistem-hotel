@extends('super-admin.layouts.blank')

@section('content')

<div class="p-8 bg-gray-100 min-h-screen">

    <h1 class="text-3xl font-semibold text-slate-700 mb-8">
        Manajemen Petugas
    </h1>

    <div class="max-w-3xl mx-auto bg-white rounded shadow overflow-hidden">

        {{-- Header --}}
        <div class="bg-blue-800 text-white px-6 py-3 font-semibold text-lg">
            Edit Petugas
        </div>

        {{-- Form Edit --}}
        <form action="{{ route('superadmin.petugas.update', $petugas->id) }}" method="POST" class="p-8 space-y-6">
            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div>
                <label class="block mb-2 font-medium">Nama Lengkap</label>
                <input type="text" name="nama"
                    value="{{ old('nama', $petugas->nama) }}"
                    class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- Email --}}
            <div>
                <label class="block mb-2 font-medium">Email</label>
                <input type="email" name="email"
                    value="{{ old('email', $petugas->user->email ?? '') }}"
                    class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            {{-- Role --}}
            <div>
                <label class="block mb-2 font-medium">Role</label>
                <select name="role"
                    class="w-full border rounded px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="admin" {{ $petugas->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="petugas" {{ $petugas->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                </select>
            </div>

            {{-- Status --}}
            <div class="flex items-center gap-4 pt-2">
                <label class="font-medium">Status</label>
                <input type="checkbox" name="status" value="aktif"
                    {{ $petugas->status == 'aktif' ? 'checked' : '' }}>
                <span class="text-sm text-gray-600">Aktif</span>
            </div>

            {{-- Bottom Section --}}
            <div class="flex justify-between items-center pt-8 border-t">

                {{-- Reset Password --}}
                <a href="{{ route('superadmin.petugas.reset', $petugas->id) }}"
                    class="bg-yellow-500 hover:bg-yellow-600 text-black px-6 py-2 rounded shadow">
                    Reset Password
                </a>

                {{-- Action Buttons --}}
                <div class="flex gap-4">
                    <a href="{{ route('superadmin.petugas.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-2 rounded">
                        Batal
                    </a>

                    <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
                        Simpan
                    </button>
                </div>

            </div>

        </form>

    </div>

</div>

{{-- Notifikasi sukses --}}
@if(session('success'))
<script>
    alert("{{ session('success') }}");
</script>
@endif

@endsection