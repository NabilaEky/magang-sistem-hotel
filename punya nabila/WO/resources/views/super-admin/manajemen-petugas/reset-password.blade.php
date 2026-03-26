@extends('super-admin.layouts.blank')

@section('content')

    <div class="max-w-4xl mx-auto">

        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">

            {{-- Header --}}
            <div class="bg-slate-700 text-white px-6 py-4 text-lg font-semibold flex items-center gap-2">
                Reset Password
            </div>

            {{-- Body --}}
            <div class="p-8 space-y-7">

                {{-- Grid 2 Kolom --}}
                <div class="grid md:grid-cols-2 gap-6">

                    <div>
                        <label class="block mb-2 font-medium text-slate-700 text-sm">
                            Nama Petugas
                        </label>
                        <input type="text"
                            placeholder="Masukkan Nama Petugas"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                            transition duration-200 outline-none shadow-sm">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-slate-700 text-sm">
                            Email
                        </label>
                        <input type="email"
                            placeholder="Masukkan email Petugas"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                            transition duration-200 outline-none shadow-sm">
                    </div>

                    <div>
                        <label class="block mb-2 font-medium text-slate-700 text-sm">
                            No HP
                        </label>
                        <input type="text"
                            placeholder="ex. 62xxxx"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5
                            focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                            transition duration-200 outline-none shadow-sm">
                    </div>

                </div>

                {{-- PASSWORD SECTION --}}
                <div
                    x-data="{
                        showPassword: false,
                        showConfirm: false,
                        password: '',
                        confirmPassword: '',
                        get isMatch() {
                            if (this.confirmPassword.length === 0) return null
                            return this.password === this.confirmPassword
                        }
                    }"
                    class="space-y-6 pt-2">

                    {{-- Password Baru --}}
                    <div>
                        <label class="block mb-2 font-medium text-slate-700 text-sm">
                            Password Baru
                        </label>

                        <div class="relative">
                            <input
                                :type="showPassword ? 'text' : 'password'"
                                x-model="password"
                                placeholder="Masukkan password baru"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 pr-14
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                transition duration-200 outline-none shadow-sm">

                            <button type="button"
                                @click="showPassword = !showPassword"
                                class="absolute right-3 top-1/2 -translate-y-1/2
                                p-2 rounded-md text-gray-400
                                hover:text-gray-600 hover:bg-gray-100
                                transition duration-200">

                                <!-- Eye OFF -->
                                <svg x-show="!showPassword"
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

                                <!-- Eye -->
                                <svg x-show="showPassword" x-cloak
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

                    {{-- Konfirmasi Password --}}
                    <div>
                        <label class="block mb-2 font-medium text-slate-700 text-sm">
                            Konfirmasi Password
                        </label>

                        <div class="relative">
                            <input
                                :type="showConfirm ? 'text' : 'password'"
                                x-model="confirmPassword"
                                name="password_confirmation"
                                placeholder="Konfirmasi password baru"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 pr-14
                                focus:ring-2 focus:ring-blue-500 focus:border-blue-500
                                transition duration-200 outline-none shadow-sm"
                                required>

                            <button type="button"
                                @click="showConfirm = !showConfirm"
                                class="absolute right-3 top-1/2 -translate-y-1/2
                                p-2 rounded-md text-gray-400
                                hover:text-gray-600 hover:bg-gray-100
                                transition duration-200">

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

                        {{-- Status Match --}}
                        <template x-if="isMatch !== null">
                            <p
                                x-text="isMatch ? 'Password cocok' : 'Password tidak sama'"
                                :class="isMatch 
                                    ? 'text-green-600 mt-2 text-sm font-medium' 
                                    : 'text-red-600 mt-2 text-sm font-medium'"></p>
                        </template>

                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-4 pt-6 border-t">

                    <a href="/super-admin/petugas"
                        class="bg-gray-500 hover:bg-gray-600
                        text-white px-6 py-2.5 rounded-lg
                        transition duration-200 shadow-sm">
                        Batal
                    </a>

                    <button
                        class="bg-green-600 hover:bg-green-700
                        text-white px-6 py-2.5 rounded-lg
                        transition duration-200 shadow-sm">
                        Simpan
                    </button>

                </div>

            </div>
        </div>

    </div>

@endsection