<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KAK Generate - {{ config('app.name', 'PE Bapperida') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css"
        rel="stylesheet">
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

        .page-hero {
            background:
                linear-gradient(120deg, rgba(11, 53, 93, .96), rgba(15, 94, 168, .84), rgba(8, 145, 178, .72)),
                url("https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1800&q=80") center/cover;
            color: #fff;
            padding: 7rem 0 3.5rem;
        }

        .page-hero h1 {
            font-size: clamp(2rem, 4vw, 3.75rem);
            font-weight: 800;
            letter-spacing: 0;
            line-height: 1.05;
        }

        .section-title {
            color: var(--brand-blue-dark);
            font-weight: 800;
        }

        .form-panel {
            background: #fff;
            border: 1px solid #c7ddf5;
            border-radius: 8px;
            box-shadow: 0 16px 42px rgba(11, 53, 93, .1);
        }

        .form-control {
            border-color: #bfd4ea;
            border-radius: 8px;
            padding: .78rem .9rem;
        }

        .form-control:focus,
        .select2-container--bootstrap-5.select2-container--focus .select2-selection {
            border-color: var(--accent);
            box-shadow: 0 0 0 .25rem rgba(8, 145, 178, .15);
        }

        .select2-container--bootstrap-5 .select2-selection {
            border-color: #bfd4ea;
            border-radius: 8px;
            min-height: 50px;
            padding: .36rem .45rem;
        }

        .select2-container--bootstrap-5 .select2-selection--single .select2-selection__rendered {
            color: var(--ink);
            line-height: 1.75;
        }

        .info-box {
            background: var(--brand-blue-soft);
            border-radius: 8px;
            color: var(--brand-blue-dark);
        }

        footer {
            background: var(--brand-blue-dark);
        }

        @media (max-width: 767.98px) {
            .page-hero {
                padding-top: 6rem;
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
                    <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('simantap-spasial') }}">SiMantap Spasial</a>
                    </li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="{{ route('kak-generate') }}">KAK Generate</a></li>
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

    <header class="page-hero">
        <div class="container">
            <div class="row align-items-end g-4">
                <div class="col-lg-8">
                    <p class="text-uppercase fw-bold mb-3">Layanan PE Bapperida</p>
                    <h1>KAK Generate</h1>
                    <p class="fs-5 mt-4 mb-0 col-lg-10">
                        Form awal penyusunan Kerangka Acuan Kerja berdasarkan nama dinas dan judul data.
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="info-box p-4">
                        <div class="fw-bold mb-2">Kerangka Acuan Kerja</div>
                        <p class="mb-0">Pilih perangkat daerah dan isi judul data untuk menyiapkan dokumen KAK.</p>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section class="py-5 bg-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="mb-4 text-center">
                            <p class="fw-bold mb-2" style="color: var(--accent)">Form Generator</p>
                            <h2 class="section-title mb-0">Generate KAK</h2>
                        </div>

                        <form class="form-panel p-4 p-md-5" action="{{ route('kak-generate.submit') }}" method="post">
                            @csrf
                            @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                <div class="fw-bold mb-2">Input belum sesuai.</div>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif

                            <div class="mb-4">
                                <label for="master_opd_id" class="form-label fw-semibold">Nama Dinas</label>
                                <select class="form-select select2-opd" id="master_opd_id" name="master_opd_id"
                                    data-placeholder="Pilih nama dinas" required>
                                    <option></option>
                                    @foreach ($opds as $opd)
                                    <option value="{{ $opd->id }}" @selected(old('master_opd_id')==$opd->id)>
                                        {{ $opd->name }}{{ $opd->name_akronim ? ' - '.$opd->name_akronim : '' }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="judul_data" class="form-label fw-semibold">Judul Data</label>
                                <input type="text" class="form-control" id="judul_data" name="judul_data"
                                    placeholder="Contoh: Belanja Modal Perangkat Daerah Tahun 2026"
                                    value="{{ old('judul_data') }}" maxlength="150" required>
                            </div>

                            <div class="d-grid d-sm-flex justify-content-sm-end">
                                <button type="submit" class="btn btn-blue btn-lg px-4 fw-semibold">Generate KAK</button>
                            </div>
                        </form>
                    </div>
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
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $('.select2-opd').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: $('.select2-opd').data('placeholder'),
            allowClear: true
        });
    </script>
</body>

</html>
