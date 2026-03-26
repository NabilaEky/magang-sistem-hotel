{{-- Sidebar --}}
<aside class="w-64 bg-slate-800 text-white min-h-screen flex flex-col">

    {{-- Logo --}}
    <div class="px-6 py-6 border-b border-slate-700 text-center">
        <h1 class="text-2xl font-bold leading-tight">
            e-WO
            <span class="block text-sm font-light text-slate-300">
                for Patra Semarang Hotel & Convention
            </span>
        </h1>
    </div>

    {{-- Profile --}}
    <div class="px-6 py-6 border-b border-slate-700 flex flex-col items-center text-center">

        {{-- Foto --}}
        <div class="w-20 h-20 rounded-full overflow-hidden mb-3">
    @if(Auth::check() && Auth::user()->foto)
        <img src="{{ asset('storage/' . Auth::user()->foto) }}" class="w-full h-full object-cover">
    @else
        <div class="w-full h-full bg-gray-500 flex items-center justify-center">
            <ion-icon name="person-outline" class="text-3xl"></ion-icon>
        </div>
    @endif
</div>

        {{-- Nama --}}
        <h2 class="text-sm font-semibold">
            {{ Auth::user()->username ?? Auth::user()->name }}
        </h2>

        {{-- Role --}}
        <p class="text-xs text-slate-300 mt-1">
            {{ Auth::user()->getRoleNames()->first() ?? 'Petugas' }}
        </p>

    </div>

    {{-- Menu --}}
    <nav class="flex-1 px-4 py-6 space-y-2 text-sm">

        <a href="{{ route('petugas.dashboard') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->routeIs('petugas.dashboard') 
                ? 'bg-white text-slate-800 font-semibold' 
                : 'hover:bg-slate-700 text-slate-200' }}">

            <ion-icon name="home-outline" class="text-lg"></ion-icon>
            Dashboard
        </a>

        <a href="{{ route('petugas.daftar-keluhan') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->routeIs('petugas.daftar-keluhan') 
                ? 'bg-white text-slate-800 font-semibold' 
                : 'hover:bg-slate-700 text-slate-200' }}">

            <ion-icon name="list-outline" class="text-lg"></ion-icon>
            Daftar Keluhan
        </a>

        <a href="{{ route('petugas.laporan') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->routeIs('petugas.laporan-engineering') 
                ? 'bg-white text-slate-800 font-semibold' 
                : 'hover:bg-slate-700 text-slate-200' }}">

            <ion-icon name="document-text-outline" class="text-lg"></ion-icon>
            Laporan Engineering
        </a>

        <a href="{{ route('petugas.riwayat') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->routeIs('petugas.riwayat') 
                ? 'bg-white text-slate-800 font-semibold' 
                : 'hover:bg-slate-700 text-slate-200' }}">

            <ion-icon name="time-outline" class="text-lg"></ion-icon>
            Riwayat
        </a>

        <a href="{{ route('petugas.profile') }}"
            class="flex items-center gap-3 px-4 py-2 rounded-lg transition
           {{ request()->routeIs('petugas.profile') 
                ? 'bg-white text-slate-800 font-semibold' 
                : 'hover:bg-slate-700 text-slate-200' }}">

            <ion-icon name="person-circle-outline" class="text-lg"></ion-icon>
            Profile
        </a>

    </nav>

    {{-- Logout --}}
    <div class="p-4 border-t border-slate-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="w-full flex items-center justify-center gap-2 bg-slate-600 hover:bg-slate-500 text-white py-2 rounded-lg transition text-sm">

                <ion-icon name="log-out-outline"></ion-icon>
                Logout
            </button>
        </form>
    </div>

</aside>