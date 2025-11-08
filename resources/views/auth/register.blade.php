<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md mt-10">
        <h2 class="text-2xl font-bold text-center mb-6">Daftar Akun</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="name" :value="__('Nama Lengkap')" />
                <x-text-input id="name" type="text" name="name" required autofocus class="w-full"/>
            </div>

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" required class="w-full"/>
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required class="w-full"/>
            </div>

            <div class="mb-4">
                <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                <x-text-input id="password_confirmation" type="password" name="password_confirmation" required class="w-full"/>
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Daftar') }}
            </x-primary-button>

            <p class="mt-4 text-center text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
            </p>
        </form>
    </div>
</x-guest-layout>
