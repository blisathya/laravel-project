<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
        <div class="w-full max-w-md bg-white rounded-2xl shadow-lg p-8">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-800">Login</h2>
                <p class="text-gray-500 text-sm mt-2">Silakan masuk untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" type="email" name="email" required autofocus
                        class="w-full mt-1 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" type="password" name="password" required
                        class="w-full mt-1 border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 rounded-lg" />
                </div>

                <!-- Remember & Forgot Password -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center">
                        <input type="checkbox" name="remember" class="rounded text-blue-600 focus:ring-blue-500 mr-2">
                        <span class="text-gray-600">Remember me</span>
                    </label>
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        Lupa password?
                    </a>
                </div>

                <!-- Button -->
                <x-primary-button class="w-full justify-center py-3 bg-blue-600 hover:bg-blue-700 rounded-lg">
                    {{ __('Masuk') }}
                </x-primary-button>

                <!-- Register link -->
                <p class="text-center text-sm text-gray-600 mt-4">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                        Daftar sekarang
                    </a>
                </p>
            </form>
        </div>
    </div>
</x-guest-layout>