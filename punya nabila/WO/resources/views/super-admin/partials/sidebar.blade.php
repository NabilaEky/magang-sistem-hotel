<div x-data="sidebarState()" class="w-64 bg-slate-800 text-white flex flex-col justify-between min-h-screen">

    <div>

        {{-- Logo --}}
        <div class="p-6 text-lg text-center font-semibold border-b border-slate-600">
            e-WO <br>
            <span class="text-sm text-gray-300">for Patra Semarang Hotel & Convention</span>
        </div>

        {{-- Profile --}}
        @php
        $user = auth()->user();
        @endphp

        <div class="flex flex-col items-center py-6 border-b border-slate-600">

            <div class="w-20 h-20 rounded-full bg-gray-300 overflow-hidden">

                @if($user && $user->profile_photo_path)
                <img src="{{ asset('storage/'.$user->profile_photo_path) }}"
                    class="w-full h-full object-cover">
                @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600 text-white font-bold text-xl">
                    {{ strtoupper(substr($user->name ?? 'A', 0, 1)) }}
                </div>
                @endif

            </div>

            <p class="mt-3 text-sm">
                {{ $user->name ?? 'Super Admin' }}
            </p>

        </div>


        {{-- Search --}}
        <div class="p-4">
            <input type="text"
                placeholder="Search for..."
                class="w-full px-3 py-2 rounded bg-gray-200 text-black">
        </div>


        {{-- MENU --}}
        <div class="px-4 space-y-3">

            {{-- Dashboard --}}
            <a href="/super-admin/dashboard"
                class="flex items-center gap-2 px-3 py-2 rounded
{{ request()->is('super-admin/dashboard') ? 'bg-slate-700 text-white' : 'hover:bg-slate-600' }}">

                <ion-icon name="home-outline" class="text-lg"></ion-icon>
                <span>Dashboard</span>

            </a>


            {{-- Manajemen --}}
            <div>

                <button
                    @click="toggle('manajemen')"
                    class="w-full flex items-center justify-between px-3 py-2 rounded hover:bg-slate-600">

                    <div class="flex items-center gap-2">
                        <ion-icon name="briefcase-outline" class="text-lg"></ion-icon>
                        <span>Manajemen</span>
                    </div>

                    <ion-icon
                        name="chevron-down-outline"
                        :class="{'rotate-180': isOpen('manajemen')}"
                        class="text-sm transition-transform duration-200">
                    </ion-icon>

                </button>


                <div
                    x-show="isOpen('manajemen')"
                    x-transition
                    class="ml-6 pl-3 border-l border-slate-600 space-y-2">

                    <a href="/super-admin/daftar-keluhan"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-slate-600
{{ request()->is('super-admin/daftar-keluhan*') ? 'bg-slate-700 text-white' : '' }}">

                        <ion-icon name="remove-outline" class="text-xs"></ion-icon>
                        <span>Daftar Keluhan</span>

                    </a>

                    <a href="/super-admin/riwayat"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-slate-600
{{ request()->is('super-admin/riwayat*') ? 'bg-slate-700 text-white' : '' }}">

                        <ion-icon name="remove-outline" class="text-xs"></ion-icon>
                        <span>Riwayat</span>

                    </a>

                    <a href="/super-admin/petugas"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-slate-600
{{ request()->is('super-admin/petugas*') ? 'bg-slate-700 text-white' : '' }}">

                        <ion-icon name="remove-outline" class="text-xs"></ion-icon>
                        <span>Petugas</span>

                    </a>

                </div>

            </div>


            {{-- User & Role --}}
            <div>

                <button
                    @click="toggle('user')"
                    class="w-full flex items-center justify-between px-3 py-2 rounded hover:bg-slate-600">

                    <div class="flex items-center gap-2">
                        <ion-icon name="people-outline" class="text-lg"></ion-icon>
                        <span>User & Role</span>
                    </div>

                    <ion-icon
                        name="chevron-down-outline"
                        :class="{'rotate-180': isOpen('user')}"
                        class="text-sm transition-transform duration-200">
                    </ion-icon>

                </button>


                <div
                    x-show="isOpen('user')"
                    x-transition
                    class="ml-6 pl-3 border-l border-slate-600 space-y-2">

                    <a href="/super-admin/roles"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-slate-600
{{ request()->is('super-admin/roles*') ? 'bg-slate-700 text-white' : '' }}">

                        <ion-icon name="remove-outline" class="text-xs"></ion-icon>
                        <span>Role</span>

                    </a>

                    <a href="/super-admin/user-management"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-slate-600
{{ request()->is('super-admin/user-management*') ? 'bg-slate-700 text-white' : '' }}">

                        <ion-icon name="remove-outline" class="text-xs"></ion-icon>
                        <span>Manajemen User</span>

                    </a>

                </div>

            </div>


            {{-- Sistem --}}
            <div>

                <button
                    @click="toggle('system')"
                    class="w-full flex items-center justify-between px-3 py-2 rounded hover:bg-slate-600">

                    <div class="flex items-center gap-2">
                        <ion-icon name="server-outline" class="text-lg"></ion-icon>
                        <span>Sistem</span>
                    </div>

                    <ion-icon
                        name="chevron-down-outline"
                        :class="{'rotate-180': isOpen('system')}"
                        class="text-sm transition-transform duration-200">
                    </ion-icon>

                </button>


                <div
                    x-show="isOpen('system')"
                    x-transition
                    class="ml-6 pl-3 border-l border-slate-600 space-y-2">

                    <a href="/super-admin/master-data"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-slate-600
{{ request()->is('super-admin/master-data*') ? 'bg-slate-700 text-white' : '' }}">

                        <ion-icon name="remove-outline" class="text-xs"></ion-icon>
                        <span>Master Data</span>

                    </a>

                    <a href="/super-admin/audit-log"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-slate-600
{{ request()->is('super-admin/audit-log*') ? 'bg-slate-700 text-white' : '' }}">

                        <ion-icon name="remove-outline" class="text-xs"></ion-icon>
                        <span>Audit Log</span>

                    </a>

                    <a href="/super-admin/system-setting"
                        class="flex items-center gap-2 px-3 py-2 rounded text-sm hover:bg-slate-600
{{ request()->is('super-admin/system-setting*') ? 'bg-slate-700 text-white' : '' }}">

                        <ion-icon name="remove-outline" class="text-xs"></ion-icon>
                        <span>System Setting</span>

                    </a>

                </div>

            </div>


            {{-- Laporan --}}
            <a href="/super-admin/laporan"
                class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-600
{{ request()->is('super-admin/laporan*') ? 'bg-slate-700 text-white' : '' }}">

                <ion-icon name="document-text-outline" class="text-lg"></ion-icon>
                <span>Laporan</span>

            </a>


            {{-- Setting --}}
            <a href="/super-admin/setting"
                class="flex items-center gap-2 px-3 py-2 rounded hover:bg-slate-600
{{ request()->is('super-admin/setting*') ? 'bg-slate-700 text-white' : '' }}">

                <ion-icon name="settings-outline" class="text-lg"></ion-icon>
                <span>Setting</span>

            </a>

        </div>

    </div>


    {{-- Logout --}}
    <div class="p-6 border-t border-slate-600">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button
                type="submit"
                class="w-full flex items-center justify-center gap-2 bg-gray-300 text-black px-6 py-2 rounded hover:bg-gray-400 transition">

                <ion-icon name="log-out-outline" class="text-lg"></ion-icon>
                <span>Logout</span>

            </button>

        </form>

    </div>

</div>


<script>
function sidebarState() {
    return {
        openMenus: {},

        toggle(menu) {
            this.openMenus[menu] = !this.openMenus[menu];
        },

        isOpen(menu) {

            if (this.openMenus[menu] !== undefined)
                return this.openMenus[menu];

            const path = window.location.pathname;

            if (menu === 'manajemen' && ['/super-admin/daftar-keluhan','/super-admin/riwayat','/super-admin/petugas'].some(p => path.startsWith(p)))
                return true;

            if (menu === 'user' && ['/super-admin/roles','/super-admin/user-management'].some(p => path.startsWith(p)))
                return true;

            if (menu === 'system' && ['/super-admin/master-data','/super-admin/audit-log','/super-admin/system-setting'].some(p => path.startsWith(p)))
                return true;

            return false;
        }
    }
}
</script>