@extends('petugas-eng.layouts.petugas')
@section('page_title', 'EDIT PROFIL')

@section('content')

<div class="max-w-5xl mx-auto">

    <form action="{{ route('petugas.update-profile') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- PROFIL DASAR --}}
        <div class="bg-white shadow-lg rounded-xl p-8">

            <h2 class="text-xl font-semibold text-gray-700 mb-8 flex items-center gap-2">
                <ion-icon name="person-outline"></ion-icon>
                Profil Dasar
            </h2>

            <div class="flex gap-10 flex-wrap">

                {{-- Foto --}}
                <div class="flex flex-col items-center gap-4">

                    <div class="w-32 h-32 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        <ion-icon name="person-outline" class="text-5xl text-gray-500"></ion-icon>
                    </div>

                    <input type="file" name="foto" class="hidden" id="inputFoto">

                    <button type="button"
                        onclick="document.getElementById('inputFoto').click()"
                        class="flex items-center gap-2 px-4 py-2 bg-gray-200 rounded-lg">

                        <ion-icon name="image-outline"></ion-icon>
                        Ubah Foto
                    </button>

                </div>


                {{-- Form --}}
                <div class="flex-1 space-y-5">

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            Nama
                        </label>

                        <input type="text" name="name" value="{{ $user->name }}"
                            class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-orange-400">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ $user->email }}"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">
                            No HP
                        </label>

                        <input type="text" name="phone" value="{{ $user->phone }}"
                            class="w-full border rounded-lg px-4 py-2">
                    </div>

                </div>

            </div>

        </div>


        {{-- AKUN --}}
        <div class="bg-white shadow-lg rounded-xl p-8">

            <h2 class="text-xl font-semibold text-gray-700 mb-8 flex items-center gap-2">
                <ion-icon name="lock-closed-outline"></ion-icon>
                Akun
            </h2>

            <div class="space-y-5">

                <div>
                    <label class="block text-sm text-gray-600 mb-1">
                        Username
                    </label>

                    <input type="text" name="username" value="{{ $user->username }}"
                        class="w-full border rounded-lg px-4 py-2">
                </div>


                {{-- PASSWORD --}}
                <div>
                    <label class="block text-sm text-gray-600 mb-1">
                        Password
                    </label>

                    <div class="relative">

                        <input type="password" name="password" id="password"
                            class="w-full border rounded-lg px-4 py-2">

                        <ion-icon
                            name="eye-off-outline"
                            id="togglePassword"
                            class="absolute right-3 top-3 text-gray-500 cursor-pointer hover:text-gray-700 text-lg">
                        </ion-icon>

                    </div>
                </div>


                {{-- KONFIRM PASSWORD --}}
                <div>
                    <label class="block text-sm text-gray-600 mb-1">
                        Konfirmasi Password
                    </label>

                    <div class="relative">

                        <input type="password" name="password_confirmation" id="confirmPassword"
                            class="w-full border rounded-lg px-4 py-2">
                        <ion-icon
                            name="eye-off-outline"
                            id="toggleConfirmPassword"
                            class="absolute right-3 top-3 text-gray-500 cursor-pointer hover:text-gray-700 text-lg">
                        </ion-icon>

                    </div>
                </div>

            </div>

        </div>


        {{-- BUTTON --}}
        <div class="flex justify-end gap-4">

            <a href="{{ route('petugas.profile') }}"
                class="flex items-center gap-2 px-6 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition">

                <ion-icon name="arrow-back-outline"></ion-icon>
                Kembali

            </a>


            <button type="submit"
                class="flex items-center gap-2 px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">

                <ion-icon name="save-outline"></ion-icon>
                Simpan

            </button>

        </div>

    </form>

</div>


{{-- SCRIPT TOGGLE PASSWORD --}}
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function() {

        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        this.setAttribute(
            "name",
            type === "password" ? "eye-off-outline" : "eye-outline"
        );

    });


    const toggleConfirm = document.querySelector("#toggleConfirmPassword");
    const confirmPassword = document.querySelector("#confirmPassword");

    toggleConfirm.addEventListener("click", function() {

        const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
        confirmPassword.setAttribute("type", type);

        this.setAttribute(
            "name",
            type === "password" ? "eye-off-outline" : "eye-outline"
        );

    });
</script>

@endsection