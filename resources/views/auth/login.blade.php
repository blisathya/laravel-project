<x-guest-layout>
    <div class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-md mt-10">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" required autofocus class="w-full"/>
            </div>

            <div class="mb-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required class="w-full"/>
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="mr-2"> Remember me
                </label>
                <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot password?</a>
            </div>

            <x-primary-button class="w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>

            <p class="mt-4 text-center text-sm">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Daftar sekarang</a>
            </p>
        </form>
    </div>
</x-guest-layout>
