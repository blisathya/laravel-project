<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Aplikasi') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen bg-gray-50 text-gray-800">

    {{-- Sidebar --}}
    @include('layouts.navigation')

    {{-- Konten utama (form login/register, dll) --}}
    <main class="flex-1 ml-64 flex items-center justify-center p-6">
        {{ $slot }}
    </main>

</body>

</html>