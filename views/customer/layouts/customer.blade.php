@extends('customer.layouts.blank')

@section('content')

<div class="min-h-screen flex flex-col">

    {{-- Navbar --}}
    <div class="bg-[#3f4f6b] px-16 py-6 flex justify-between items-center shadow-md">
        <div class="flex items-center space-x-6">
            {{-- Logo Patra Semarang --}}
            <img src="{{ asset('images/RS RTBL.png') }}" alt="Patra Semarang Logo" class="h-12 w-auto ml-4">

            <div class="flex flex-col px-4">
                {{-- Judul e-WO --}}
                <h1 class="text-white text-2xl tracking-wide font-semibold">
                    @yield('page-title', 'e-WO')
                </h1>
                {{-- Subjudul --}}
                <span class="text-sm text-slate-300">
                    for Patra Semarang Hotel & Convention
                </span>
            </div>
        </div>

        {{-- Avatar + Logout --}}
        <div class="flex items-center space-x-4">
           
            {{-- Logout Button --}}
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Logout
                </button>
            </form>
        </div>
    </div>

    {{-- Content --}}
    <div class="flex-1 flex justify-center py-14">
        @yield('page-content')
    </div>

</div>

@endsection