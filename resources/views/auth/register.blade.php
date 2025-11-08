<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Daftar Akun</h2>
                <p class="text-gray-500 text-sm mt-2">Buat akun baru untuk memulai</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Nama -->
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <x-text-input id="name" type="text" name="name" required autofocus
                        class="w-full mt-1 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" required
                        class="w-full mt-1 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required
                        class="w-full mt-1 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg" />
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />
                    <x-text-input id="password_confirmation" type="password" name="password_confirmation" required
                        class="w-full mt-1 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg" />
                </div>

                <!-- Tombol -->
                <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 rounded-lg">
                    {{ __('Daftar') }}
                </x-primary-button>

                <!-- Link Login -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        Login di sini
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>