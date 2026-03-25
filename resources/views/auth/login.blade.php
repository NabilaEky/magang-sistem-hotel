<x-guest-layout>

<div class="w-[420px]">

<h1 class="text-2xl font-bold text-center mb-8 leading-relaxed">
SISTEM KELUHAN CUSTOMER<br>
HOTEL PATRA JASA SEMARANG
</h1>

<h2 class="text-xl font-semibold text-center mb-10">
LOGIN
</h2>

<form method="POST" action="{{ route('login') }}">
@csrf

<div class="mb-6">
<label class="block mb-2 text-sm">ID Pengguna</label>
<input type="text" name="email"
class="w-full bg-gray-200 rounded px-4 py-3">
</div>

<div class="mb-10">
<label class="block mb-2 text-sm">Password</label>
<input type="password" name="password"
class="w-full bg-gray-200 rounded px-4 py-3">
</div>

<div class="flex justify-end">
<button class="bg-gray-300 px-10 py-3 rounded-lg">
Log In
</button>
</div>

</form>

</div>

</x-guest-layout>