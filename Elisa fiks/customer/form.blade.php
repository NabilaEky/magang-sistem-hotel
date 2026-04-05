@extends('customer.layouts.customer')

@section('page-content')

<div class="w-full max-w-6xl bg-white rounded-2xl shadow-lg overflow-hidden">

    <!-- HEADER -->
    <div class="bg-blue-600 text-white text-center py-3 font-semibold">
        Informasi Keluhan
    </div>

    <div class="p-12">

        {{-- ERROR --}}
        @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-4 mb-6 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('customer.form.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="grid md:grid-cols-2 gap-16">

                {{-- LEFT --}}
                <div class="space-y-8">

                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Lokasi</label>
                        <input type="text" value="Otomatis" readonly
                            class="w-full md:w-3/4 rounded-lg border px-4 py-3 bg-gray-100">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Jenis Keluhan</label>
                        <input type="text" name="jenis_keluhan"
                            class="w-full md:w-3/4 rounded-lg border px-4 py-3 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Kategori</label>
                        <select name="kategori"
                            class="w-full md:w-3/4 rounded-lg border px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            <option>AC</option>
                            <option>Kamar Mandi</option>
                            <option>Listrik</option>
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2 text-gray-700">Pemeriksaan</label>
                        <select name="pemeriksaan"
                            class="w-full md:w-3/4 rounded-lg border px-4 py-3 focus:ring-2 focus:ring-blue-500">
                            <option value="" disabled selected>-- Pilih Pemeriksaan --</option>
                            <option>Perlu Dicek</option>
                            <option>Urgent</option>
                        </select>
                    </div>

                </div>

                {{-- RIGHT --}}
                <div>

                    <div class="border rounded-xl shadow-sm">

                        <div class="bg-blue-600 text-white px-6 py-4 rounded-t-xl font-semibold">
                            Upload Foto (Max 3)
                        </div>

                        <div class="p-8">

                            {{-- 🔹 Upload Button --}}
                            <label for="fotoInput"
                                class="w-32 h-28 border-2 border-dashed border-gray-300 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-blue-50 transition">

                                <span class="text-xl text-blue-600">+</span>
                                <span class="text-sm text-gray-600 mt-1">Upload</span>
                            </label>

                            <input id="fotoInput"
                                type="file"
                                name="foto[]"
                                multiple
                                accept="image/png, image/jpeg"
                                class="hidden">

                            {{-- 🔹 Preview --}}
                            <div id="preview-container" class="flex flex-wrap gap-6 mt-6"></div>


                        </div>

                    </div>

                </div>

            </div>

            {{-- BUTTON --}}
            <div class="flex justify-end gap-6 mt-14">
                <a href="{{ route('customer.history') }}"
                    class="px-8 py-3 rounded-lg bg-gray-400 text-white hover:bg-gray-500 shadow">
                    Kembali
                </a>

                <button type="submit"
                    class="px-8 py-3 rounded-lg bg-green-600 text-white hover:bg-green-700 shadow">
                    Tambah
                </button>
            </div>

        </form>

    </div>

</div>

{{-- 🔥 SCRIPT FIX (TANPA BUG) --}}
<script>
    const input = document.querySelector('input[name="foto[]"]');
    const previewContainer = document.getElementById('preview-container');
    const maxFiles = 3;

    let selectedFiles = [];

    input.addEventListener('change', function() {

        const newFiles = Array.from(this.files);

        for (let file of newFiles) {
            if (!['image/jpeg', 'image/png'].includes(file.type)) {
                alert('Hanya JPG / PNG!');
                return;
            }
        }

        selectedFiles = [...selectedFiles, ...newFiles];

        if (selectedFiles.length > maxFiles) {
            alert('Maksimal 3 foto!');
            selectedFiles = selectedFiles.slice(0, maxFiles);
        }

        updatePreview();
    });

    function updatePreview() {
        previewContainer.innerHTML = '';

        const dataTransfer = new DataTransfer();

        selectedFiles.forEach((file, index) => {
            dataTransfer.items.add(file);

            const reader = new FileReader();

            reader.onload = function(e) {

                const wrapper = document.createElement('div');
                wrapper.className = "relative";

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = "w-32 h-28 object-cover rounded-xl border";

                // 🔥 tombol hapus
                const btn = document.createElement('button');
                btn.innerHTML = '✕';
                btn.type = 'button';
                btn.className = "absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 text-xs";

                btn.onclick = function() {
                    selectedFiles.splice(index, 1);
                    updatePreview();
                };

                wrapper.appendChild(img);
                wrapper.appendChild(btn);
                previewContainer.appendChild(wrapper);
            };

            reader.readAsDataURL(file);
        });

        input.files = dataTransfer.files;
    }
</script>
@endsection