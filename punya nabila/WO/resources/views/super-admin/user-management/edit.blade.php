@extends('super-admin.layouts.blank')

@section('content')

{{-- Page Header --}}

<div class="bg-slate-700 text-white px-8 py-5 rounded-lg mb-8 shadow flex items-center">
    <div class="flex items-center gap-3">
        <ion-icon name="person-circle-outline" class="text-2xl"></ion-icon>

        <div>
            <div class="text-xl font-semibold">
                Edit User
            </div>
            <div class="text-sm text-gray-200">
                Perbarui data pengguna dan atur role akses
            </div>
        </div>
    </div>
</div>

<div class="flex justify-center">

    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
        {{-- Card Header --}}
        <div class="bg-slate-600 text-white text-center py-3 font-semibold tracking-wide">
            User Management
        </div>

        <div class="p-8">

            <form
                x-data="{
            showPassword: false,
            showConfirm: false,
            password: '',
            confirmPassword: '',
            get isMatch() {
                if (this.password === '' && this.confirmPassword === '') return null;
                return this.password === this.confirmPassword;
            }
        }"
                action="{{ route('superadmin.user-management.update', $user->id) }}"
                method="POST"
                class="space-y-6">
                @csrf
                @method('PUT')

                <!-- Nama -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" name="name"
                        value="{{ old('name', $user->name) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Username -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">Username</label>
                    <input type="text" name="username"
                        value="{{ old('username', $user->username) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Email -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Jabatan -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">Jabatan</label>
                    <input type="text" name="jabatan"
                        value="{{ old('jabatan', $user->jabatan ?? '') }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <!-- Role -->
                <div>
                    <label class="block font-medium text-gray-700 mb-2">Role</label>
                    <select name="role"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">-- Pilih Role --</option>
                        <option value="super_admin" {{ $user->hasRole('super_admin') ? 'selected' : '' }}>
                            Super Admin
                        </option>
                        <option value="petugas" {{ $user->hasRole('petugas') ? 'selected' : '' }}>
                            Petugas
                        </option>
                    </select>
                </div>

                <!-- Password Baru -->
                <div>
                    <label class="block mb-2 font-medium text-gray-700">
                        Password Baru (Opsional)
                    </label>

                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'"
                            x-model="password"
                            name="password"
                            placeholder="Masukkan password baru"
                            class="w-full border rounded-lg px-4 py-2 pr-12
                                          focus:ring-2 focus:ring-blue-500
                                          focus:outline-none">

                        <button type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-3 top-1/2 -translate-y-1/2
           p-1.5 rounded-md
           text-gray-400 hover:text-gray-a600
           hover:bg-gray-100 transition">

                            <!-- Mata dicoret (DEFAULT) -->
                            <svg x-show="showPassword === false"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19
            c-4.478 0-8.268-2.943-9.542-7
            a9.956 9.956 0 012.293-3.95m3.11-2.348
            A9.953 9.953 0 0112 5c4.477 0 8.268 2.943
            9.542 7a9.97 9.97 0 01-4.043 5.174M15 12
            a3 3 0 11-6 0 3 3 0 016 0zm6 6L3 3" />
                            </svg>

                            <!-- Mata terbuka -->
                            <svg x-show="showPassword === true" x-cloak
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 
            2.943 9.542 7-1.274 4.057-5.065 7-9.542 
            7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>

                    </div>
                </div>

                {{-- Confirm --}}
                <div>
                    <label class="block mb-2 text-sm font-medium text-slate-700">
                        Konfirmasi Password
                    </label>

                    <div class="relative">
                        <input :type="showConfirm ? 'text' : 'password'"
                            x-model="confirmPassword"
                            name="password_confirmation"
                            placeholder="Ulangi password"
                            class="w-full border rounded-lg px-4 py-2 pr-12
                                          focus:ring-2 focus:ring-blue-500
                                          focus:outline-none">

                        <button type="button"
                            @click="showConfirm = !showConfirm"
                            class="absolute right-3 top-1/2 -translate-y-1/2
                                       p-1.5 rounded-md
                                       text-gray-400 hover:text-gray-600
                                       hover:bg-gray-100 transition">

                            {{-- Eye --}}
                            <svg x-show="showConfirm === true" x-cloak
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 
            2.943 9.542 7-1.274 4.057-5.065 7-9.542 
            7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>

                            {{-- Eye Off --}}
                            <svg x-show="showConfirm === false"
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.875 18.825A10.05 10.05 0 0112 19
            c-4.478 0-8.268-2.943-9.542-7
            a9.956 9.956 0 012.293-3.95m3.11-2.348
            A9.953 9.953 0 0112 5c4.477 0 8.268 2.943
            9.542 7a9.97 9.97 0 01-4.043 5.174M15 12
            a3 3 0 11-6 0 3 3 0 016 0zm6 6L3 3" />
                            </svg>

                        </button>
                    </div>

                    <template x-if="isMatch !== null">
                        <p
                            x-text="isMatch ? 'Password cocok' : 'Password tidak sama'"
                            :class="isMatch ? 'text-green-600 mt-2 text-sm' : 'text-red-600 mt-2 text-sm'">
                        </p>
                    </template>
                </div>


                        <!-- Button -->

                        <div class="mt-10 flex justify-between">

                            <a href="{{ route('superadmin.user-management.index') }}"
                                class="flex items-center gap-2 px-5 py-2.5 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">

                                <ion-icon name="arrow-back-outline"></ion-icon>
                                Kembali
                            </a>

                            <button type="submit"
                                class="flex items-center gap-2 px-5 py-2.5 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">

                                <ion-icon name="save-outline"></ion-icon>
                                Simpan
                            </button>

                        </div>


            </form>

        </div>
    </div>

</div>

@endsection