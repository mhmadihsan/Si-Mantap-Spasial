<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - {{ config('app.name', 'Laravel') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        :root {
            --admin-sidebar-width: 265px;
            --admin-sidebar-bg: #1f2937;
            --admin-sidebar-accent: #0ea5e9;
            --admin-body-bg: #f4f6f9;
        }

        body {
            min-height: 100vh;
            background: var(--admin-body-bg);
            color: #1f2937;
        }

        .admin-shell {
            min-height: 100vh;
            display: flex;
        }

        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background: var(--admin-sidebar-bg);
            color: #cbd5e1;
            position: fixed;
            inset: 0 auto 0 0;
            z-index: 1030;
            box-shadow: 0 0 24px rgba(15, 23, 42, .24);
        }

        .admin-brand {
            min-height: 58px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            color: #fff;
        }

        .admin-menu-label {
            color: #94a3b8;
            font-size: .72rem;
            letter-spacing: .08em;
        }

        .admin-nav-link {
            color: #cbd5e1;
            border-radius: .45rem;
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: .72rem .85rem;
            text-decoration: none;
        }

        .admin-nav-link:hover,
        .admin-nav-link.active {
            color: #fff;
            background: rgba(14, 165, 233, .18);
        }

        .admin-nav-link.active {
            box-shadow: inset 3px 0 0 var(--admin-sidebar-accent);
        }

        .admin-content {
            margin-left: var(--admin-sidebar-width);
            min-width: 0;
            flex: 1;
        }

        .admin-topbar {
            min-height: 58px;
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .content-header {
            border-bottom: 1px solid #e5e7eb;
        }

        .info-box {
            border: 1px solid #e5e7eb;
            border-radius: .5rem;
            background: #fff;
            min-height: 92px;
        }

        .info-box-icon {
            width: 52px;
            height: 52px;
            border-radius: .45rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.45rem;
        }

        .card {
            border-color: #e5e7eb;
            border-radius: .5rem;
        }

        .card-header {
            background: #fff;
            border-bottom-color: #e5e7eb;
        }

        .chart-wrap {
            height: 360px;
        }

        @media (max-width: 991.98px) {
            .admin-sidebar {
                width: 100%;
                position: static;
                min-height: auto;
            }

            .admin-shell {
                display: block;
            }

            .admin-content {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-brand d-flex align-items-center px-3">
                <span class="d-inline-flex align-items-center justify-content-center bg-info rounded me-2" style="width: 34px; height: 34px;">
                    <i class="bi bi-layers"></i>
                </span>
                <span class="fw-semibold">SiMantap Spasial</span>
            </div>

            <nav class="p-3">
                <div class="admin-menu-label text-uppercase fw-semibold mb-2">Menu</div>
                <a href="{{ route('dashboard') }}" class="admin-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="admin-nav-link">
                    <i class="bi bi-building"></i>
                    <span>Master OPD</span>
                </a>
                <a href="#" class="admin-nav-link">
                    <i class="bi bi-database-check"></i>
                    <span>Walidata</span>
                </a>
            </nav>
        </aside>

        <div class="admin-content">
            <header class="admin-topbar d-flex align-items-center justify-content-between px-3 px-lg-4">
                <div class="fw-semibold">@yield('page-title', 'Dashboard')</div>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-secondary small d-none d-sm-inline">{{ auth()->user()?->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i>Keluar
                        </button>
                    </form>
                </div>
            </header>

            <main>
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
