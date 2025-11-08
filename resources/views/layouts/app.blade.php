<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aplikasi') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-100 text-gray-800">

    {{-- Sidebar --}}
    @include('layouts.navigation')

    {{-- Main Content --}}
    <main class="flex-1 ml-64 p-6">
        {{ $slot }}
    </main>

</body>

</html>