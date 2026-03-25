@extends('department.layouts.department')

@section('header')
FORM KELUHAN
@endsection

@section('content')

<div class="flex justify-center py-10 px-4">
    <div class="w-full max-w-4xl bg-white rounded-2xl shadow-md overflow-hidden">

        {{-- HEADER --}}
        <div class="bg-blue-600 text-white text-center py-4 font-semibold tracking-wide ">
            Informasi Keluhan
        </div>

        <div class="p-8">

            {{-- SUCCESS --}}
            @if(session('success'))
            <div id="alert-success" class="mb-4 bg-green-100 text-green-700 p-3 rounded transition">
                {{ session('success') }}
            </div>

            <script>
                setTimeout(() => {
                    const alert = document.getElementById('alert-success');
                    if (alert) {
                        alert.style.transition = "opacity 0.5s";
                        alert.style.opacity = "0";
                        setTimeout(() => alert.remove(), 500);
                    }
                }, 3000); // 5 DETIK
            </script>
            @endif

            {{-- ERROR --}}
            @if ($errors->any())
            <div class="mb-4 bg-red-100 text-red-700 p-3 rounded">
                @foreach ($errors->all() as $error)
                <div>- {{ $error }}</div>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('form.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-2 gap-10">

                    {{-- LEFT SIDE --}}
                    <div class="space-y-5">

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Lokasi
                            </label>
                            <input type="text"
                                name="lokasi"
                                placeholder="Contoh: Kamar 201"
                                value="{{ old('lokasi') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Jenis Keluhan
                            </label>
                            <input type="text"
                                name="jenis_keluhan"
                                placeholder="Contoh: AC tidak dingin"
                                value="{{ old('jenis_keluhan') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Kategori
                            </label>
                            <input type="text"
                                name="kategori"
                                placeholder="Contoh: AC / Listrik / Kamar Mandi"
                                value="{{ old('kategori') }}"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                    </div>

                    {{-- RIGHT SIDE --}}
                    <div>
                        <div class="border border-gray-200 rounded-xl shadow-sm overflow-hidden">

                            <div class="bg-blue-600 text-white px-5 py-3 font-medium text-sm">
                                Upload Foto
                            </div>

                            <div class="p-6">

                                {{-- AREA UPLOAD --}}
                                <label for="fotoInput" class="flex flex-col items-center justify-center w-full h-36 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:bg-blue-50 transition">

                                    <svg class="w-7 h-7 text-gray-400 mb-2"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M3 16l4-4a3 3 0 014 0l4 4m-2-2l1.586-1.586a2 2 0 012.828 0L21 14m-6-10h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>

                                    <span class="text-sm text-gray-600">
                                        Klik untuk upload foto
                                    </span>

                                    <span class="text-xs text-gray-400 mt-1">
                                        JPG / PNG (Max 5MB)
                                    </span>

                                    <input type="file" name="foto[]" multiple hidden id="fotoInput">

                                </label>

                                {{-- 🔥 PREVIEW GAMBAR --}}
                                <div id="preview" class="mt-4 flex flex-wrap gap-3"></div>

                            </div>

                        </div>
                    </div>

                </div>

                {{-- BUTTONS --}}
                <div class="flex justify-end gap-3 mt-8">

                    <a href="{{ route('homee') }}"
                        class="px-5 py-2 rounded-lg bg-gray-400 text-white text-sm hover:bg-gray-500 transition">
                        Kembali
                    </a>

                    <button type="submit"
                        class="px-5 py-2 rounded-lg bg-green-600 text-white text-sm hover:bg-green-700 transition">
                        Tambah
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

{{-- 🔥 SCRIPT PREVIEW --}}
<script>
    const input = document.getElementById('fotoInput');
    const preview = document.getElementById('preview');

    let filesArray = [];

    input.addEventListener('change', function(e) {
        const files = Array.from(e.target.files);

        files.forEach(file => {
            filesArray.push(file);

            const reader = new FileReader();
            reader.onload = function(e) {

                const div = document.createElement('div');
                div.classList.add('relative');

                div.innerHTML = `
                    <img src="${e.target.result}" class="w-24 h-24 object-cover rounded-lg border">
                    <button type="button" class="absolute top-0 right-0 bg-red-500 text-white text-xs px-2 rounded-full">×</button>
                `;

                div.querySelector('button').addEventListener('click', function() {
                    filesArray = filesArray.filter(f => f !== file);
                    div.remove();
                    updateInputFiles();
                });

                preview.appendChild(div);
            };

            reader.readAsDataURL(file);
        });

        updateInputFiles();
    });

    function updateInputFiles() {
        const dataTransfer = new DataTransfer();
        filesArray.forEach(file => dataTransfer.items.add(file));
        input.files = dataTransfer.files;
    }
</script>

@endsection