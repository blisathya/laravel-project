<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title', 'Data Mahasiswa')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
        }

        .wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #007bff 0%, #0056d6 100%);
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.15);
        }

        .sidebar .brand {
            font-size: 1.3rem;
            font-weight: 700;
            padding: 1.2rem;
            text-align: center;
            background: rgba(255, 255, 255, 0.15);
        }

        .sidebar .menu {
            flex-grow: 1;
            padding-top: 0.5rem;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0.85rem 1.2rem;
            border-left: 4px solid transparent;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: rgba(255, 255, 255, 0.15);
            border-left-color: #fff;
        }

        .sidebar i {
            font-size: 1.2rem;
        }

        .copyright {
            text-align: center;
            font-size: 0.85rem;
            padding: 1rem;
            color: rgba(255, 255, 255, 0.8);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Konten utama */
        .main-content {
            flex-grow: 1;
            background-color: #f8fafc;
            padding: 2rem;
            overflow-y: auto;
        }

        /* Responsif (mobile) */
        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                flex-direction: row;
                justify-content: space-around;
                align-items: center;
                padding: 0.5rem 0;
            }

            .sidebar .brand {
                display: none;
            }

            .sidebar .menu {
                display: flex;
                flex-direction: row;
                gap: 0.5rem;
            }

            .sidebar a {
                padding: 0.6rem;
                border: none;
                border-bottom: 3px solid transparent;
            }

            .sidebar a.active {
                border-bottom-color: #fff;
            }

            .copyright {
                display: none;
            }

            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div>
                <div class="brand">Data Mahasiswa</div>
                <div class="menu">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i> Dashboard
                    </a>
                    <a href="{{ route('students.index') }}" class="{{ request()->routeIs('students.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i> Mahasiswa
                    </a>
                    <a href="{{ route('attendances.index') }}" class="{{ request()->routeIs('attendances.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar-check-fill"></i> Absensi
                    </a>
                    <a href="{{ route('faker.index') }}" class="{{ request()->routeIs('faker.*') ? 'active' : '' }}">
                        <i class="bi bi-database-fill-gear"></i> Data Faker
                    </a>
                </div>
            </div>
            <div class="copyright">
                © 2025 <strong>blisathya</strong>
            </div>
        </nav>

        <!-- Konten utama -->
        <main class="main-content">
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>