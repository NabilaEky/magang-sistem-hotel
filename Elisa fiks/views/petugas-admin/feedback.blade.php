@extends('petugas-admin.layouts.dashboard')

@section('header')
<h1 class="text-2xl text-center font-semibold text-white">
    FEEDBACK PETUGAS
</h1>
@endsection

@section('content')

<div class="p-10">

    <!-- FILTER -->
    <form method="GET" action="{{ route('admin.feedback') }}">
        <div class="flex flex-wrap justify-center items-center gap-4 mb-10">

            <!-- TANGGAL -->
            <input 
                type="date"
                name="tanggal"
                value="{{ request('tanggal') }}"
                class="w-44 h-10 border border-gray-300 rounded px-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

            <!-- PETUGAS -->
            <select name="petugas"
                class="w-40 h-10 border border-gray-300 rounded px-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Petugas</option>
                <option value="Andi" {{ request('petugas') == 'Andi' ? 'selected' : '' }}>Andi</option>
                <option value="Budi" {{ request('petugas') == 'Budi' ? 'selected' : '' }}>Budi</option>
                <option value="Rudi" {{ request('petugas') == 'Rudi' ? 'selected' : '' }}>Rudi</option>
            </select>

            <!-- RATING -->
            <select name="rating"
                class="w-40 h-10 border border-gray-300 rounded px-3 bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">Rating</option>
                <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>⭐⭐⭐⭐⭐</option>
                <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>⭐⭐⭐⭐</option>
                <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>⭐⭐⭐</option>
                <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>⭐⭐</option>
                <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>⭐</option>
            </select>

            <!-- BUTTON -->
            <button 
                class="w-32 h-10 bg-blue-600 text-white rounded hover:bg-blue-700 transition shadow">
                Filter
            </button>

        </div>
    </form>

    <!-- TABLE -->
    <div class="bg-white shadow-lg rounded-lg overflow-hidden border">

        <table class="w-full text-sm text-center">

            <!-- HEADER -->
            <thead class="bg-blue-700 text-white">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Lokasi</th>
                    <th class="p-3">Petugas</th>
                    <th class="p-3">Rating</th>
                    <th class="p-3">Komentar</th>
                    <th class="p-3">Tanggal</th>
                </tr>
            </thead>

            <!-- BODY -->
            <tbody>

                @forelse($feedbacks as $f)
                <tr class="border-t hover:bg-gray-50 transition">

                    <td class="p-3">{{ $f->kode_feedback }}</td>
                    <td class="p-3">{{ $f->lokasi }}</td>
                    <td class="p-3">{{ $f->petugas }}</td>

                    <!-- RATING BINTANG -->
                    <td class="p-3">
                        @for($i=1; $i<=5; $i++)
                            <span class="{{ $i <= $f->rating ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                        @endfor
                    </td>

                    <td class="p-3">{{ $f->komentar }}</td>

                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($f->tanggal)->format('d M Y') }}
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="6" class="p-4 text-gray-500">
                        Data tidak ditemukan
                    </td>
                </tr>
                @endforelse

            </tbody>

        </table>

        <!-- PAGINATION -->
        <div class="p-4 flex justify-center">
            {{ $feedbacks->links() }}
        </div>

    </div>

</div>

@endsection