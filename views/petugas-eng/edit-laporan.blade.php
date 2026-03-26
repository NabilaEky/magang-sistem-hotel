@extends('petugas-eng.layouts.petugas')
@section('page_title', 'EDIT LAPORAN')

@section('content')

<div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl overflow-hidden">

    {{-- Header --}}
    <div class="bg-blue-700 text-white text-center py-5 font-semibold text-lg">
        Edit Laporan Engineering
    </div>

    <form action="{{ route('petugas.update-laporan', $laporan->id) }}" method="POST" enctype="multipart/form-data" class="p-10">
        @csrf
        @method('PUT')

        {{-- ERROR --}}
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 mb-4 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        <div class="space-y-6 mb-10">

            {{-- realisasi --}}
            <div class="flex items-center gap-6">
                <label class="w-40 font-semibold text-gray-700">realisasi</label>

                <select name="realisasi" class="border rounded-lg px-4 py-2 w-64">
                    <option value="Civil" {{ $laporan->realisasi == 'Civil' ? 'selected' : '' }}>Civil</option>
                    <option value="ME" {{ $laporan->realisasi == 'ME' ? 'selected' : '' }}>ME</option>
                </select>
            </div>

            {{-- Jenis --}}
            <div class="flex items-center gap-6">
                <label class="w-40 font-semibold text-gray-700">Jenis Laporan</label>

                <select name="jenis" class="border rounded-lg px-4 py-2 w-64">
                    <option value="Harian" {{ $laporan->jenis == 'Harian' ? 'selected' : '' }}>Harian</option>
                    <option value="Bulanan" {{ $laporan->jenis == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                </select>
            </div>

            {{-- Shift --}}
            <div class="flex items-center gap-6">
                <label class="w-40 font-semibold text-gray-700">Shift</label>

                <select name="shift" class="border rounded-lg px-4 py-2 w-64">
                    <option value="Pagi" {{ $laporan->shift == 'Pagi' ? 'selected' : '' }}>Pagi</option>
                    <option value="Sore" {{ $laporan->shift == 'Sore' ? 'selected' : '' }}>Sore</option>
                    <option value="Malam" {{ $laporan->shift == 'Malam' ? 'selected' : '' }}>Malam</option>
                </select>
            </div>

            {{-- Status --}}
            <div class="flex items-center gap-6">
                <label class="w-40 font-semibold text-gray-700">Status</label>

                <select name="status" class="border rounded-lg px-4 py-2 w-64">
                    <option value="draft" {{ $laporan->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    <option value="proses" {{ $laporan->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $laporan->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

        </div>

        {{-- LIST PEKERJAAN --}}
        <h3 class="font-semibold text-gray-700 mb-4">
            Progress Pekerjaan
        </h3>

        <div class="space-y-6">

            @foreach($laporan->items ?? [] as $index => $item)

            <div class="border rounded-lg p-6 bg-gray-50">

                {{-- Nama pekerjaan --}}
                <input
                    type="text"
                    name="items[]"
                    value="{{ $item['nama'] ?? '' }}"
                    class="border rounded-lg px-4 py-2 w-full mb-4"
                />

                {{-- FOTO --}}
                <div class="grid md:grid-cols-3 gap-4">

                    {{-- BEFORE --}}
                    <div>
                        <p class="text-sm mb-2">Before</p>

                        @if(!empty($item['before']))
                            <img src="{{ asset('storage/'.$item['before']) }}" class="mb-2 rounded">
                        @endif

                        <input type="file" name="before[]">
                    </div>

                    {{-- PROGRESS --}}
                    <div>
                        <p class="text-sm mb-2">Progress</p>

                        @if(!empty($item['progress']))
                            <img src="{{ asset('storage/'.$item['progress']) }}" class="mb-2 rounded">
                        @endif

                        <input type="file" name="progress[]">
                    </div>

                    {{-- AFTER --}}
                    <div>
                        <p class="text-sm mb-2">After</p>

                        @if(!empty($item['after']))
                            <img src="{{ asset('storage/'.$item['after']) }}" class="mb-2 rounded">
                        @endif

                        <input type="file" name="after[]">
                    </div>

                </div>

            </div>

            @endforeach

        </div>

        {{-- BUTTON --}}
        <div class="flex justify-end gap-4 mt-10">

            <a href="{{ route('petugas.laporan') }}"
                class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                ← Kembali
            </a>

            <button type="submit"
                class="px-6 py-3 bg-orange-500 text-white rounded-lg hover:bg-orange-600">
                Update Laporan
            </button>

        </div>

    </form>

</div>

@endsection