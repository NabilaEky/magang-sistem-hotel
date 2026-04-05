@extends('petugas-admin.layouts.dashboard')

@section('content')

@section('header')
<h1 class="text-2xl text-center font-semibold text-white">
    DAFTAR KELUHAN
</h1>
@endsection

<div class="max-w-7xl mx-auto">

    <!-- FILTER BOX -->
    <div class="bg-white border rounded-xl shadow p-6 mb-10">
        <form method="GET" action="{{ route('admin.keluhan') }}">

            <div class="grid grid-cols-4 gap-4 mb-6">

                <input type="date" name="tanggal_awal"
                    value="{{ request('tanggal_awal') }}"
                    class="border rounded-lg p-2">

                <input type="date" name="tanggal_akhir"
                    value="{{ request('tanggal_akhir') }}"
                    class="border rounded-lg p-2">

                <select name="departemen" class="border rounded-lg p-2">
                    <option value="">Pilih Departemen</option>
                    <option {{ request('departemen')=='Engineering'?'selected':'' }}>Engineering</option>
                    <option {{ request('departemen')=='Housekeeping'?'selected':'' }}>Housekeeping</option>
                    <option {{ request('departemen')=='Front Office'?'selected':'' }}>Front Office</option>
                    <option {{ request('departemen')=='IT'?'selected':'' }}>IT</option>
                </select>

                <button class="bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Filter
                </button>

            </div>

            <div class="grid grid-cols-4 gap-4">

                <select name="petugas" class="border rounded-lg p-2">
                    <option value="">Petugas</option>
                    <option {{ request('petugas')=='Andi'?'selected':'' }}>Andi</option>
                    <option {{ request('petugas')=='Budi'?'selected':'' }}>Budi</option>
                    <option {{ request('petugas')=='Rudi'?'selected':'' }}>Rudi</option>
                </select>

                <select name="status" class="border rounded-lg p-2">
                    <option value="">Status</option>
                    <option {{ request('status')=='Pending'?'selected':'' }}>Pending</option>
                    <option {{ request('status')=='Diproses'?'selected':'' }}>Diproses</option>
                    <option {{ request('status')=='Selesai'?'selected':'' }}>Selesai</option>
                </select>

                <select name="prioritas" class="border rounded-lg p-2">
                    <option value="">Prioritas</option>
                    <option {{ request('prioritas')=='Low'?'selected':'' }}>Low</option>
                    <option {{ request('prioritas')=='Medium'?'selected':'' }}>Medium</option>
                    <option {{ request('prioritas')=='High'?'selected':'' }}>High</option>
                </select>

                <select name="kategori" class="border rounded-lg p-2">
                    <option value="">Kategori</option>
                    <option {{ request('kategori')=='Elektrikal'?'selected':'' }}>Elektrikal</option>
                    <option {{ request('kategori')=='AC'?'selected':'' }}>AC</option>
                    <option {{ request('kategori')=='Plumbing'?'selected':'' }}>Plumbing</option>
                    <option {{ request('kategori')=='Internet'?'selected':'' }}>Internet</option>
                    <option {{ request('kategori')=='Furniture'?'selected':'' }}>Furniture</option>
                </select>

            </div>
        </form>
    </div>

    <!-- BUTTON CETAK -->
    <div class="flex justify-end mb-4 relative">
        <button onclick="toggleCetak()"
            class="bg-green-600 text-white px-6 py-2 rounded-lg shadow hover:bg-green-700 flex items-center gap-2">
            Cetak <span>▼</span>
        </button>

        <div id="dropdownCetak"
            class="hidden absolute right-0 mt-12 w-48 bg-white border rounded-lg shadow">

            <a href="{{ route('admin.civil') }}" class="block px-4 py-2 hover:bg-gray-100">Civil</a>
            <a href="{{ route('admin.me') }}" class="block px-4 py-2 hover:bg-gray-100">ME</a>
            <a href="{{ route('admin.cetak') }}" class="block px-4 py-2 hover:bg-gray-100">Daftar Keluhan</a>

        </div>
    </div>

    <script>
        function toggleCetak() {
            document.getElementById("dropdownCetak").classList.toggle("hidden")
        }
        document.addEventListener("click", function(e) {
            let dropdown = document.getElementById("dropdownCetak")
            if (!e.target.closest(".relative")) {
                dropdown.classList.add("hidden")
            }
        })
    </script>

    <!-- DROPDOWN JUMLAH DATA -->
    <div class="flex justify-between items-center mb-4">

        <form method="GET" action="{{ route('admin.keluhan') }}">

            <input type="hidden" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
            <input type="hidden" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
            <input type="hidden" name="departemen" value="{{ request('departemen') }}">
            <input type="hidden" name="petugas" value="{{ request('petugas') }}">
            <input type="hidden" name="status" value="{{ request('status') }}">
            <input type="hidden" name="prioritas" value="{{ request('prioritas') }}">
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">

            <select name="perPage" onchange="this.form.submit()"
                class="border rounded-lg px-3 py-1 text-sm">

                <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                <option value="200" {{ request('perPage') == 200 ? 'selected' : '' }}>200</option>

            </select>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white shadow rounded-xl overflow-hidden">

        <table class="w-full">
            <thead class="bg-blue-800 text-white">
                <tr class="text-center text-sm">
                    <th class="p-3">ID</th>
                    <th class="p-3">Waktu</th>
                    <th class="p-3">Jenis Keluhan</th>
                    <th class="p-3">Kategori</th>
                    <th class="p-3">Lokasi</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Prioritas</th>
                    <th class="p-3">Petugas</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-center text-sm">
                @foreach($keluhans as $k)
                <tr class="border-t hover:bg-gray-50 transition">

                    <td class="p-3">{{ $k->id }}</td>
                    <td class="p-3">{{ $k->created_at->format('d M Y H:i') }}</td>
                    <td class="p-3">{{ $k->jenis_masalah }}</td>
                    <td class="p-3">{{ $k->kategori }}</td>
                    <td class="p-3">{{ $k->lokasi }}</td>

                    <td class="p-3">
                        @php
                        $color = match($k->status){
                        'Pending'=>'bg-yellow-500',
                        'Diproses'=>'bg-blue-500',
                        'Selesai'=>'bg-green-500',
                        default=>'bg-gray-500'};
                        @endphp
                        <span class="{{ $color }} text-white px-3 py-1 rounded-full text-xs">
                            {{ $k->status }}
                        </span>
                    </td>

                    <td class="p-3 font-semibold text-red-500">{{ $k->prioritas }}</td>
                    <td class="p-3">{{ $k->petugas }}</td>

                    <td class="p-3">
                        <div class="flex gap-2 justify-center">
                            <a href="{{ route('admin.detail-keluhan', $k->id) }}" class="bg-gray-500 text-white px-3 py-1 rounded">Detail</a>
                            <a href="{{ route('admin.edit-keluhan', $k->id) }}" class="bg-orange-500 text-white px-3 py-1 rounded">Edit</a>
                            <a href="#" class="px-3 py-1 bg-green-500 text-white rounded">WhatsApp</a>
                        </div>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- PAGINATION -->
        <div class="p-4 border-t flex justify-center">
            <nav class="flex items-center gap-2 text-sm">

                <a href="{{ $keluhans->previousPageUrl() }}"
                   class="px-3 py-1 border rounded-lg {{ $keluhans->onFirstPage() ? 'opacity-50 pointer-events-none' : '' }}">
                   Previous
                </a>

                @for ($i = 1; $i <= $keluhans->lastPage(); $i++)
                    <a href="{{ $keluhans->url($i) }}"
                       class="px-3 py-1 rounded-lg {{ $keluhans->currentPage()==$i ? 'bg-blue-600 text-white' : 'border' }}">
                       {{ $i }}
                    </a>
                @endfor

                <a href="{{ $keluhans->nextPageUrl() }}"
                   class="px-3 py-1 border rounded-lg {{ !$keluhans->hasMorePages() ? 'opacity-50 pointer-events-none' : '' }}">
                   Next
                </a>

            </nav>
        </div>

    </div>

</div>

@endsection