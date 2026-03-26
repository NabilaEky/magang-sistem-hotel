@extends('super-admin.layouts.blank')

@section('content')

{{-- Page Header --}}

<div class="bg-slate-700 text-white px-8 py-5 rounded-lg mb-8 shadow flex items-center gap-3">

    <ion-icon name="person-add-outline" class="text-2xl"></ion-icon>

    <div>
        <div class="text-xl font-semibold">
            Tambah User
        </div>
        <div class="text-sm text-gray-200">
            Tambahkan user baru ke dalam sistem
        </div>
    </div>

</div>

<div class="flex justify-center">

    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg border border-gray-200">

        {{-- Card Header --}}

        <div class="bg-blue-700 text-white text-center py-4 text-lg font-semibold rounded-t-xl">
            Form User
        </div>

        <div class="p-8">

            <form
                method="POST"
                action="{{ route('superadmin.user-management.store') }}"
                class="space-y-6"
                x-data="{
showPassword:false,
showConfirm:false,
password:'',
confirmPassword:'',
get isMatch(){
if(this.password === '' && this.confirmPassword === '') return null;
return this.password === this.confirmPassword;
}
}">
                @csrf

                {{-- Nama --}}

                <div class="flex items-center gap-6">
                    <label class="w-52 font-medium text-gray-700">Nama</label>
                    <span>:</span>
                    <input type="text" name="name" required
                        class="flex-1 border border-gray-300 px-4 py-2.5 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Email --}}

                <div class="flex items-center gap-6">
                    <label class="w-52 font-medium text-gray-700">Email</label>
                    <span>:</span>
                    <input type="email" name="email" required
                        class="flex-1 border border-gray-300 px-4 py-2.5 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Password --}}

                <div class="flex items-center gap-6">
                    <label class="w-52 font-medium text-gray-700">Password</label>
                    <span>:</span>

                    <div class="flex-1 relative">

                        <input
                            :type="showPassword ? 'text' : 'password'"
                            x-model="password"
                            name="password"
                            placeholder="Masukkan password"
                            class="w-full border border-gray-300 rounded-lg bg-gray-50 px-4 py-2.5 pr-12 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        <button type="button"
                            @click="showPassword=!showPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">

                            <ion-icon x-show="!showPassword" name="eye-off-outline"></ion-icon> <ion-icon x-show="showPassword" name="eye-outline"></ion-icon>

                        </button>

                    </div>
                </div>

                {{-- Konfirmasi Password --}}

                <div class="flex items-center gap-6">
                    <label class="w-52 font-medium text-gray-700">Konfirmasi Password</label>
                    <span>:</span>

                    <div class="flex-1 relative">

                        <input
                            :type="showConfirm ? 'text' : 'password'"
                            x-model="confirmPassword"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            class="w-full border border-gray-300 rounded-lg bg-gray-50 px-4 py-2.5 pr-12 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        <button type="button"
                            @click="showConfirm=!showConfirm"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">

                            <ion-icon x-show="!showConfirm" name="eye-off-outline"></ion-icon> <ion-icon x-show="showConfirm" name="eye-outline"></ion-icon>

                        </button>

                    </div>
                </div>

                {{-- Status Password --}}

                <div class="flex items-center gap-6">
                    <div class="w-52"></div>
                    <div class="flex-1">

                        <template x-if="isMatch !== null">
                            <p
                                x-text="isMatch ? 'Password cocok' : 'Password tidak sama'"
                                :class="isMatch ? 'text-green-600 text-sm' : 'text-red-600 text-sm'">
                            </p>
                        </template>

                    </div>
                </div>

                {{-- Jabatan --}}

                <div class="flex items-center gap-6">
                    <label class="w-52 font-medium text-gray-700">Jabatan</label>
                    <span>:</span>
                    <input type="text" name="jabatan"
                        class="flex-1 border border-gray-300 px-4 py-2.5 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                {{-- Role --}}

                <div class="flex items-center gap-6">
                    <label class="w-52 font-medium text-gray-700">Role</label>
                    <span>:</span>

                    <select name="roles[]" required
                        class="flex-1 border border-gray-300 px-4 py-2.5 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                        @foreach($roles as $role)

                        <option value="{{ $role->name }}">
                            {{ ucfirst($role->name) }}
                        </option>
                        @endforeach

                    </select>
                </div>

                {{-- Button --}}

                <div class="flex justify-end gap-3 mt-10 border-t pt-6">

                    <a href="{{ route('superadmin.user-management.index') }}"
                        class="flex items-center gap-2 px-5 py-2.5 bg-gray-500 text-white rounded-lg shadow hover:bg-gray-600 transition">

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