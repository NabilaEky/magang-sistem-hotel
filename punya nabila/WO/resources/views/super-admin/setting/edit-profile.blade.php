@extends('super-admin.layouts.blank')

@section('content')

{{-- Page Header --}}
<div class="bg-slate-700 text-white px-8 py-5 rounded-lg mb-8 shadow flex items-center">
    <div class="flex items-center gap-3">

        <ion-icon name="person-circle-outline" class="text-2xl"></ion-icon>

        <div>
            <div class="text-xl font-semibold">
                Edit Profile Admin
            </div>
            <div class="text-sm text-gray-200">
                Perbarui informasi akun dan keamanan Anda
            </div>
        </div>

    </div>
</div>


<div class="flex justify-center">

    <div class="w-full max-w-4xl bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">

        {{-- Card Header --}}
        <div class="bg-slate-600 text-white text-center py-3 font-semibold tracking-wide">
            Profile Setting
        </div>

        <div class="p-8">

            <form action="{{ route('superadmin.setting.update-profile') }}"
                method="POST"
                enctype="multipart/form-data"
                class="space-y-8">

                @csrf


                {{-- ================= ERROR MESSAGE ================= --}}
                @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-4 rounded">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif



                {{-- ================= PROFIL DASAR ================= --}}
                <div>

                    <h2 class="text-lg font-semibold text-slate-800 mb-6">
                        Profil Dasar
                    </h2>

                    <div class="grid md:grid-cols-3 gap-10">

                        {{-- FOTO --}}
                        <div
                            x-data="{
photoPreview: '{{ $user->profile_photo_path ? asset('storage/'.$user->profile_photo_path) : '' }}'
}"
                            class="flex flex-col items-center gap-4">

                            <div class="w-32 h-32 rounded-full overflow-hidden shadow border">

                                <template x-if="photoPreview">
                                    <img :src="photoPreview" class="w-full h-full object-cover">
                                </template>

                                <template x-if="!photoPreview">
                                    <div class="w-full h-full bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center text-white text-4xl font-bold">
                                        {{ strtoupper(substr($user->name,0,1)) }}
                                    </div>
                                </template>

                            </div>

                            <label class="cursor-pointer text-sm text-blue-600 hover:underline">
                                Ubah Foto
                                <input type="file"
                                    name="photo"
                                    class="hidden"
                                    accept="image/*"
                                    @change="
const file = $event.target.files[0];
if(file){
photoPreview = URL.createObjectURL(file);
}">
                            </label>

                        </div>


                        {{-- FORM --}}
                        <div class="md:col-span-2 space-y-6">

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Nama Admin
                                </label>

                                <input type="text"
                                    name="name"
                                    value="{{ old('name',$user->name) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>


                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    Email
                                </label>

                                <input type="email"
                                    name="email"
                                    value="{{ old('email',$user->email) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>


                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">
                                    No HP
                                </label>

                                <input type="text"
                                    name="phone"
                                    value="{{ old('phone',$user->phone) }}"
                                    class="w-full border border-gray-300 rounded-lg px-4 py-2 bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            </div>

                        </div>

                    </div>

                </div>



                {{-- ================= KEAMANAN ================= --}}
                <div class="pt-8 border-t">

                    <h2 class="text-lg font-semibold text-slate-800 mb-6">
                        Keamanan Akun
                    </h2>

                    <div
                        x-data="{
showPassword:false,
showConfirm:false,
password:'',
confirmPassword:'',
get isMatch(){
if(this.confirmPassword.length===0) return null;
return this.password===this.confirmPassword;
}
}"
                        class="space-y-6 max-w-xl">

                        {{-- Password --}}
                        <div>

                            <label class="block mb-2 font-medium text-gray-700">
                                Password Baru
                            </label>

                            <div class="relative">

                                <input :type="showPassword ? 'text' : 'password'"
                                    x-model="password"
                                    name="password"
                                    placeholder="Masukkan password baru"
                                    class="w-full border rounded-lg px-4 py-2 pr-12 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                                <button type="button"
                                    @click="showPassword=!showPassword"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">

                                    <ion-icon name="eye-outline" x-show="!showPassword"></ion-icon>
                                    <ion-icon name="eye-off-outline" x-show="showPassword"></ion-icon>

                                </button>

                            </div>

                        </div>


                        {{-- Confirm --}}
                        <div>

                            <label class="block mb-2 font-medium text-gray-700">
                                Konfirmasi Password
                            </label>

                            <div class="relative">

                                <input :type="showConfirm ? 'text' : 'password'"
                                    x-model="confirmPassword"
                                    name="password_confirmation"
                                    placeholder="Ulangi password"
                                    class="w-full border rounded-lg px-4 py-2 pr-12 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                                <button type="button"
                                    @click="showConfirm=!showConfirm"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-md text-gray-400 hover:text-gray-600 hover:bg-gray-100 transition">

                                    <ion-icon name="eye-outline" x-show="!showConfirm"></ion-icon>
                                    <ion-icon name="eye-off-outline" x-show="showConfirm"></ion-icon>

                                </button>

                            </div>

                            <template x-if="isMatch!==null">
                                <p x-text="isMatch ? 'Password cocok' : 'Password tidak sama'"
                                    :class="isMatch ? 'text-green-600 mt-2 text-sm':'text-red-600 mt-2 text-sm'">
                                </p>
                            </template>

                        </div>

                    </div>

                </div>



                {{-- ================= BUTTON ================= --}}
                <div class="mt-10 flex justify-between">

                    <a href="{{ route('superadmin.setting.index') }}"
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