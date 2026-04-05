@extends('petugas-eng.layouts.petugas')
@section('page_title', 'Selesaikan Keluhan')

@section('content')

{{-- Informasi Keluhan --}}
<div class="bg-white shadow rounded-xl mb-8 overflow-hidden">
    <div class="bg-blue-600 text-white px-6 py-3 font-semibold">
        Informasi Keluhan
    </div>
    <div class="p-6 space-y-3 text-gray-700">
        <div class="flex gap-3">
            <span class="font-semibold w-40">Jenis Masalah</span>
            <span>: {{ $keluhan->jenis_masalah }}</span>
        </div>
        <div class="flex gap-3">
            <span class="font-semibold w-40">Lokasi</span>
            <span>: {{ $keluhan->lokasi }}</span>
        </div>
        <div class="flex gap-3">
            <span class="font-semibold w-40">Prioritas</span>
            <span>: {{ ucfirst($keluhan->prioritas) }}</span>
        </div>
    </div>
</div>

{{-- FORM (SEMUA MASUK SINI) --}}
<form action="{{ route('petugas.selesai', $keluhan->id) }}" method="POST" enctype="multipart/form-data" id="formSelesai">

    @csrf
    @method('PUT')

    {{-- Upload Foto --}}
    <div class="bg-white shadow rounded-xl mb-8 overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-3 font-semibold">
            Bukti Selesai (Maks 3 foto, JPG/JPEG/PNG)
        </div>

        <div class="p-6 flex gap-6">

            {{-- Upload Box --}}
            <div class="flex flex-col items-center justify-center p-4 border rounded-xl bg-white shadow-sm">
                <div id="uploadBox"
                    class="w-40 h-32 border-2 border-dashed rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-blue-50 transition">
                    <span class="text-3xl text-blue-600">+</span>
                    <span class="text-sm text-gray-600 mt-1">Upload</span>
                </div>

                {{-- 🔥 FIX: SEKARANG DI DALAM FORM --}}
                <input type="file" name="foto_selesai[]" id="fotoInput" accept=".jpg,.jpeg,.png" multiple class="hidden">

                <small class="text-gray-500 mt-2 block">
                    Maksimal 3 foto
                </small>
            </div>

            {{-- Preview --}}
            <div id="preview-container" class="flex flex-wrap gap-4 flex-1"></div>

        </div>
    </div>

    {{-- Form bawah --}}
    <div class="flex gap-6 mb-6 px-6">

        {{-- Catatan --}}
        <div class="flex-1">
            <label class="block font-semibold mb-1">Catatan Petugas (opsional)</label>
            <textarea name="catatan" 
                class="w-full border p-3 rounded-lg h-32 focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Tambahkan catatan...">{{ old('catatan', $keluhan->catatan) }}</textarea>
        </div>

        {{-- Status --}}
        <div class="w-1/3">
            <label class="block font-semibold mb-1">Status</label>
            <select name="status"
                class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="diproses" {{ $keluhan->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                <option value="selesai" {{ $keluhan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="pending" {{ $keluhan->status == 'pending' ? 'selected' : '' }}>Pending</option>
            </select>

            <div class="flex justify-end gap-4 mt-5">
                <a href="{{ route('petugas.daftar-keluhan') }}"
                    class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white rounded-lg transition">
                    Kembali
                </a>
                <button type="submit"
                    class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                    Selesai
                </button>
            </div>
        </div>

    </div>

</form>

{{-- JS --}}
<script>
const fotoInput = document.getElementById('fotoInput');
const previewContainer = document.getElementById('preview-container');
const uploadBox = document.getElementById('uploadBox');

let fileList = [];

// klik upload
uploadBox.addEventListener('click', () => fotoInput.click());

// pilih file
fotoInput.addEventListener('change', function () {
    const files = Array.from(this.files);

    files.forEach(file => {
        const ext = file.name.split('.').pop().toLowerCase();

        if (!['jpg', 'jpeg', 'png'].includes(ext)) {
            alert('Hanya JPG/JPEG/PNG');
            return;
        }

        if (fileList.length >= 3) {
            alert('Maksimal 3 foto');
            return;
        }

        const isDuplicate = fileList.some(f => f.name === file.name && f.size === file.size);
        if (!isDuplicate) fileList.push(file);
    });

    updatePreview();
    this.value = '';
});

// preview
function updatePreview() {
    previewContainer.innerHTML = '';

    fileList.forEach((file, index) => {
        const reader = new FileReader();

        reader.onload = e => {
            const div = document.createElement('div');

            div.className = 'w-32 h-32 border rounded-lg relative overflow-hidden flex items-center justify-center bg-gray-100';

            div.innerHTML = `
                <img src="${e.target.result}" class="object-contain w-full h-full">
                <button type="button" class="absolute top-1 right-1 bg-red-500 text-white px-1 rounded text-sm">×</button>
            `;

            previewContainer.appendChild(div);

            div.querySelector('button').addEventListener('click', () => {
                fileList.splice(index, 1);
                updatePreview();
            });
        };

        reader.readAsDataURL(file);
    });
}

// kirim file
document.getElementById('formSelesai').addEventListener('submit', function () {
    const dt = new DataTransfer();
    fileList.forEach(f => dt.items.add(f));
    fotoInput.files = dt.files;
});
</script>

@endsection