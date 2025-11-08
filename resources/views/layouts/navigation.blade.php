<aside class="fixed top-0 left-0 h-full w-64 bg-white shadow-md border-r border-gray-200 flex flex-col">
    <div class="p-6 border-b">
        <h1 class="text-2xl font-bold text-blue-600">{{ config('app.name', 'AplikasiKu') }}</h1>
    </div>

    <nav class="flex-1 p-4 space-y-2">
        <a href="{{ url('/') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 font-medium">🏠 Dashboard</a>
        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 font-medium">👤 Profil</a>
        <a href="#" class="block px-4 py-2 rounded-lg hover:bg-blue-100 text-gray-700 font-medium">⚙️ Pengaturan</a>

        <form method="POST" action="{{ route('logout') }}" class="mt-6">
            @csrf
            <button type="submit" class="w-full text-left px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600">
                🚪 Logout
            </button>
        </form>
    </nav>

    <footer class="p-4 border-t text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ config('app.name', 'AplikasiKu') }}
    </footer>
</aside>