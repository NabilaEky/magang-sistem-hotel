<x-guest-layout>

    <div>

        <!-- TITLE -->
        <div class="text-center mb-8">

            <h2 class="text-2xl font-bold text-gray-800">
                Login
            </h2>

            <p class="text-sm text-gray-500 mt-1">
                Masuk ke sistem
            </p>

        </div>


        @error('username')
        <div class="mb-5 p-3 rounded-lg bg-red-100 border border-red-300 text-red-700 text-sm text-center">
            ID Pengguna atau Password salah
        </div>
        @enderror


        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf


            <!-- USERNAME -->
            <div>

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    ID Pengguna
                </label>

                <div class="relative">

                    <ion-icon name="person-outline"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></ion-icon>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username') }}"
                        required
                        class="w-full pl-10 pr-4 py-3 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-slate-600 focus:outline-none">

                </div>

            </div>


            <!-- PASSWORD -->
            <div x-data="{ showPassword:false }">

                <label class="block text-sm font-medium text-gray-600 mb-2">
                    Password
                </label>

                <div class="relative">

                    <ion-icon name="lock-closed-outline"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></ion-icon>

                    <input
                        :type="showPassword ? 'text' : 'password'"
                        name="password"
                        required
                        class="w-full pl-10 pr-14 py-3 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-slate-600 focus:outline-none">

                    <button
                        type="button"
                        @click="showPassword=!showPassword"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">

                        <ion-icon x-show="!showPassword" name="eye-off-outline"></ion-icon>
                        <ion-icon x-show="showPassword" name="eye-outline"></ion-icon>

                    </button>

                </div>

            </div>


            <button
                type="submit"
                class="w-full bg-slate-700 hover:bg-slate-800 text-white font-semibold py-3 rounded-lg shadow hover:shadow-lg transition">

                <ion-icon name="log-in-outline" class="mr-2"></ion-icon>

                Log In

            </button>

        </form>

    </div>

</x-guest-layout>