<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'PE Bapperida') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --brand-blue: #0f5ea8;
            --brand-blue-dark: #0b355d;
            --brand-blue-soft: #dbeafe;
            --accent: #0891b2;
            --ink: #172033;
        }

        body {
            background: #f5f9ff;
            color: var(--ink);
            font-family: Figtree, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .navbar {
            background: rgba(11, 53, 93, .95);
            backdrop-filter: blur(12px);
        }

        .navbar-brand-mark {
            align-items: center;
            background: #fff;
            border-radius: 8px;
            color: var(--brand-blue);
            display: inline-flex;
            font-weight: 800;
            height: 38px;
            justify-content: center;
            width: 38px;
        }

        .btn-blue {
            --bs-btn-bg: var(--brand-blue);
            --bs-btn-border-color: var(--brand-blue);
            --bs-btn-hover-bg: #0b4c86;
            --bs-btn-hover-border-color: #0b4c86;
            --bs-btn-color: #fff;
        }

        .hero {
            background:
                linear-gradient(120deg, rgba(11, 53, 93, .96), rgba(15, 94, 168, .82), rgba(8, 145, 178, .72)),
                url("https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1800&q=80") center/cover;
            color: #fff;
            min-height: 58vh;
            padding: 7rem 0 3rem;
        }

        .hero h1 {
            font-size: clamp(2.25rem, 5vw, 4.75rem);
            font-weight: 800;
            letter-spacing: 0;
            line-height: 1;
        }

        .stat-box {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .22);
            border-radius: 8px;
            padding: 1rem;
        }

        .section-title {
            color: var(--brand-blue-dark);
            font-weight: 800;
        }

        .menu-card {
            background: #fff;
            border: 1px solid #c7ddf5;
            border-radius: 8px;
            box-shadow: 0 12px 36px rgba(11, 53, 93, .08);
            min-height: 150px;
        }

        .menu-card .badge {
            background: var(--brand-blue-soft);
            color: var(--brand-blue-dark);
        }

        .carousel-item img {
            height: 440px;
            object-fit: cover;
        }

        .carousel-caption {
            background: rgba(11, 53, 93, .82);
            border-radius: 8px;
            left: 8%;
            padding: 1rem 1.25rem;
            right: auto;
            text-align: left;
        }

        footer {
            background: var(--brand-blue-dark);
        }

        @media (max-width: 767.98px) {
            .hero {
                min-height: auto;
                padding-top: 6rem;
            }

            .carousel-item img {
                height: 320px;
            }

            .carousel-caption {
                bottom: 1rem;
                left: 1rem;
                right: 1rem;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ url('/') }}">
                <span class="navbar-brand-mark">PE</span>
                PE Bapperida
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
                aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('simantap-spasial') }}">SiMantap Spasial</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('kak-generate') }}">KAK Generate</a></li>
                    {{-- <li class="nav-item"><a class="nav-link" href="#">Profil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Aplikasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Publikasi</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Kontak</a></li> --}}
                    @auth
                    <li class="nav-item ms-lg-3"><a class="btn btn-light btn-sm fw-semibold"
                            href="{{ route('dashboard') }}">Dashboard</a></li>
                    @else
                    <li class="nav-item ms-lg-3"><a class="btn btn-light btn-sm fw-semibold"
                            href="{{ route('login') }}">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <header class="hero">
        <div class="container">
            <div class="row align-items-end g-4">
                <div class="col-lg-8">
                    <p class="text-uppercase fw-bold mb-3">Portal Pengendalian dan Evaluasi Bapperida</p>
                    <h1>PE Bapperida</h1>
                    <p class="fs-5 mt-4 mb-0 col-lg-10">
                        Pusat akses layanan data capaian Pembagunan Monev
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="fs-3 fw-bold">06</div>
                                <div class="small">Layanan Digital</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-box">
                                <div class="fs-3 fw-bold">12</div>
                                <div class="small">Publikasi</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="py-5 bg-white">
            <div class="container">
                <div class="d-flex flex-column flex-lg-row justify-content-between gap-3 mb-4">
                    <div>
                        <p class="fw-bold mb-2" style="color: var(--accent)">Aplikasi</p>
                        <h2 class="section-title mb-0">Layanan PE Bapperida</h2>
                    </div>
                    <a href="{{ route('login') }}" class="btn btn-blue align-self-lg-end">Masuk Aplikasi</a>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('simantap-spasial') }}"
                            class="menu-card p-4 h-100 d-block text-decoration-none text-reset">
                            <span class="badge rounded-pill mb-3">Dummy</span>
                            <h5 class="fw-bold">SiMantap Spasial</h5>
                            <p class="mb-0 text-secondary">Salah satu aplikasi pendukung pengelolaan informasi
                                pembangunan daerah.</p>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <a href="{{ route('kak-generate') }}"
                            class="menu-card p-4 h-100 d-block text-decoration-none text-reset">
                            <span class="badge rounded-pill mb-3">Layanan</span>
                            <h5 class="fw-bold">KAK Generate</h5>
                            <p class="mb-0 text-secondary">Layanan pendukung penyusunan Kerangka Acuan Kerja secara
                                digital.</p>
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <section class="py-5">
            <div class="container">
                <div class="mb-4">
                    <p class="fw-bold mb-2" style="color: var(--accent)">Galeri</p>
                    <h2 class="section-title mb-0">Aktivitas Perencanaan</h2>
                </div>
                <div id="appCarousel" class="carousel slide shadow" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#appCarousel" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#appCarousel" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#appCarousel" data-bs-slide-to="2"
                            aria-label="Slide 2"></button>
                    </div>
                    <div class="carousel-inner rounded">
                        <div class="carousel-item active">
                            <img src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1600&q=80"
                                class="d-block w-100" alt="Ruang kerja perencanaan">
                            <div class="carousel-caption">
                                <h5 class="fw-bold mb-1">Ruang Kerja Digital</h5>
                                <p class="mb-0"> untuk layanan dan informasi perencanaan.</p>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1600&q=80"
                                class="d-block w-100" alt="Dashboard data">
                            <div class="carousel-caption">
                                <h5 class="fw-bold mb-1">Informasi Kinerja</h5>
                                <p class="mb-0"> untuk ringkasan data dan publikasi pembangunan.</p>
                            </div>
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#appCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#appCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>
    </main>

    <footer class="py-4 text-white">
        <div class="container d-flex flex-column flex-md-row justify-content-between gap-2">
            <div class="fw-bold">PE Bapperida</div>
            <div>created by PE Bapperida</div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
