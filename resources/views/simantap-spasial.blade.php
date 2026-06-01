<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Generate XML - {{ config('app.name', 'PE Bapperida') }}</title>
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
                url("https://images.unsplash.com/photo-1524661135-423995f22d0b?auto=format&fit=crop&w=1800&q=80") center/cover;
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

        .btn-ai {
            --bs-btn-bg: #eef7ff;
            --bs-btn-border-color: #b7d7f2;
            --bs-btn-color: var(--brand-blue-dark);
            --bs-btn-disabled-bg: #eef2f6;
            --bs-btn-disabled-border-color: #d7e0e8;
            --bs-btn-disabled-color: #7b8794;
            --bs-btn-hover-bg: #dff1ff;
            --bs-btn-hover-border-color: var(--accent);
            align-items: center;
            border-radius: 8px;
            display: inline-flex;
            font-size: .82rem;
            gap: .35rem;
            line-height: 1;
            padding: .45rem .65rem;
        }

        .captcha-box,
        .remaining-box {
            border: 1px solid #c7ddf5;
            border-radius: 8px;
        }

        .captcha-box {
            background: #f8fbff;
        }

        .captcha-code {
            background: var(--brand-blue-dark);
            border-radius: 8px;
            color: #fff;
            font-size: 1.25rem;
            font-weight: 800;
            letter-spacing: 0;
            min-width: 120px;
            padding: .7rem 1rem;
            text-align: center;
        }

        .remaining-box {
            background: linear-gradient(135deg, #eef7ff, #f7fcff);
            color: var(--brand-blue-dark);
        }

        .loading-overlay {
            align-items: center;
            background: rgba(245, 249, 255, .86);
            backdrop-filter: blur(6px);
            display: none;
            inset: 0;
            justify-content: center;
            position: fixed;
            z-index: 1080;
        }

        .loading-overlay.show {
            display: flex;
        }

        .loading-panel {
            background: #fff;
            border: 1px solid #c7ddf5;
            border-radius: 8px;
            box-shadow: 0 20px 54px rgba(11, 53, 93, .16);
            max-width: 320px;
            padding: 1.5rem;
            text-align: center;
            width: calc(100% - 2rem);
        }

        .loading-spinner {
            animation: spin .85s linear infinite;
            border: 5px solid #dbeafe;
            border-radius: 50%;
            border-top-color: var(--brand-blue);
            height: 58px;
            margin: 0 auto 1rem;
            width: 58px;
        }

        .loading-progress {
            background: #e8f2fc;
            border-radius: 999px;
            height: 6px;
            overflow: hidden;
        }

        .loading-progress-bar {
            animation: loadingProgress 2s ease-in-out forwards;
            background: linear-gradient(90deg, var(--brand-blue), var(--accent));
            border-radius: inherit;
            height: 100%;
            width: 0;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes loadingProgress {
            to {
                width: 100%;
            }
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
    <div class="loading-overlay" id="loading_overlay" aria-live="polite" aria-label="Loading">
        <div class="loading-panel">
            <div class="loading-spinner" role="status"></div>
            <div class="fw-bold mb-1" style="color: var(--brand-blue-dark)">Memproses XML</div>
            <div class="small text-secondary mb-3">Mohon tunggu sebentar.</div>
            <div class="loading-progress" aria-hidden="true">
                <div class="loading-progress-bar"></div>
            </div>
        </div>
    </div>

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
                    <li class="nav-item"><a class="nav-link active" aria-current="page"
                            href="{{ route('simantap-spasial') }}">SiMantap Spasial</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('kak-generate') }}">KAK Generate</a></li>
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
                    <p class="text-uppercase fw-bold mb-3">SiMantap Spasial</p>
                    <h1>Generate XML</h1>
                    <p class="fs-5 mt-4 mb-0 col-lg-10">
                        Form pembuatan metadata XML untuk data spasial daerah.
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="info-box p-4">
                        <div class="fw-bold mb-2">Metadata Data Spasial</div>
                        <p class="mb-0">Lengkapi informasi dasar data sebelum membuat file XML.</p>
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
                            <h2 class="section-title mb-0">Generate XML</h2>
                        </div>

                        <form class="form-panel p-4 p-md-5" id="generate_xml_form"
                            action="{{ route('simantap-spasial.generate') }}" method="post">
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
                            <div class="alert alert-success d-none" id="success_alert" role="alert">
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
                                <label for="nama_data_spasial" class="form-label fw-semibold">Nama Data Spasial</label>
                                <input type="text" class="form-control" id="nama_data_spasial"
                                    name="nama_data_spasial" placeholder="Contoh: Peta Batas Administrasi Kecamatan"
                                    value="{{ old('nama_data_spasial') }}" maxlength="100" required>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-2">
                                    <label for="deskripsi_data_spasial" class="form-label fw-semibold mb-0">Deskripsi
                                        Data Spasial</label>
                                    <button type="button" class="btn btn-ai btn-sm align-self-sm-start"
                                        id="generate_ai_button" disabled>
                                        <i class="bi bi-magic" aria-hidden="true"></i>
                                        <span>generate with AI</span>
                                    </button>
                                </div>
                                <textarea class="form-control" id="deskripsi_data_spasial"
                                    name="deskripsi_data_spasial" rows="5"
                                    placeholder="Tuliskan ringkasan isi, cakupan wilayah, dan kegunaan data spasial"
                                    required>{{ old('deskripsi_data_spasial') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <div class="d-flex flex-column flex-sm-row justify-content-between gap-2 mb-2">
                                    <label for="abstract_data_spasial" class="form-label fw-semibold mb-0">Abstract</label>
                                    <button type="button" class="btn btn-ai btn-sm align-self-sm-start"
                                        id="generate_abstract_ai_button" disabled>
                                        <i class="bi bi-magic" aria-hidden="true"></i>
                                        <span>generate with AI</span>
                                    </button>
                                </div>
                                <textarea class="form-control" id="abstract_data_spasial" name="abstract_data_spasial"
                                    rows="4" placeholder="Tuliskan abstract singkat data spasial"
                                    required>{{ old('abstract_data_spasial') }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label for="tanggal_rilis" class="form-label fw-semibold">Tanggal Rilis</label>
                                <input type="date" class="form-control" id="tanggal_rilis" name="tanggal_rilis"
                                    value="{{ old('tanggal_rilis') }}" max="{{ now()->toDateString() }}" required>
                            </div>

                            <div class="mb-4">
                                <label for="captcha_answer" class="form-label fw-semibold">Captcha</label>
                                <div class="captcha-box p-3">
                                    <div class="d-flex flex-column flex-sm-row align-items-sm-center gap-3">
                                        <div class="captcha-code" id="captcha_question">{{ $captcha['question'] }}</div>
                                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                            id="refresh_captcha_button" aria-label="Refresh captcha">
                                            <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                                        </button>
                                        <input type="number" class="form-control" id="captcha_answer"
                                            name="captcha_answer" placeholder="Masukkan hasil captcha" required>
                                    </div>
                                </div>
                            </div>

                            <div class="remaining-box p-3 mb-4">
                                <div class="d-flex flex-column flex-sm-row justify-content-between gap-2">
                                    <div>
                                        <div class="fw-bold">Remaining Generate XML</div>
                                        <div class="small text-secondary">Sisa kuota generate XML hari ini.</div>
                                    </div>
                                    <div class="fs-3 fw-bold">{{ $remainingGenerateXml }}/{{ $dailyGenerateLimit }}</div>
                                </div>
                            </div>

                            <div class="d-grid d-sm-flex justify-content-sm-end">
                                <button type="submit" class="btn btn-blue btn-lg px-4 fw-semibold">Generate XML</button>
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

        const namaDataSpasialInput = document.getElementById('nama_data_spasial');
        const generateAiButton = document.getElementById('generate_ai_button');
        const generateAbstractAiButton = document.getElementById('generate_abstract_ai_button');
        const deskripsiDataSpasialInput = document.getElementById('deskripsi_data_spasial');
        const abstractDataSpasialInput = document.getElementById('abstract_data_spasial');
        const generateXmlForm = document.getElementById('generate_xml_form');
        const loadingOverlay = document.getElementById('loading_overlay');
        const successAlert = document.getElementById('success_alert');
        const captchaQuestion = document.getElementById('captcha_question');
        const captchaAnswer = document.getElementById('captcha_answer');
        const refreshCaptchaButton = document.getElementById('refresh_captcha_button');
        const downloadUrl = @json(session('download_url'));
        const captchaUrl = @json(route('simantap-spasial.captcha'));

        function updateGenerateAiButton() {
            const disabled = namaDataSpasialInput.value.trim() === '';
            generateAiButton.disabled = disabled;
            generateAbstractAiButton.disabled = disabled;
        }

        function normalizeDatasetName() {
            return namaDataSpasialInput.value.trim().replace(/\s+/g, ' ');
        }

        function buildAiText() {
            const datasetName = normalizeDatasetName();

            return {
                description: `${datasetName} merupakan data spasial yang memuat informasi lokasi, sebaran, dan batas objek terkait. Data ini digunakan untuk mendukung analisis wilayah, perencanaan pembangunan, serta penyajian informasi geospasial daerah.`,
                abstract: `Data spasial ${datasetName} menyajikan informasi geospasial singkat untuk kebutuhan pemetaan, analisis, dan pengambilan keputusan di wilayah daerah.`
            };
        }

        function fillGeneratedText(target) {
            const datasetName = normalizeDatasetName();

            if (!datasetName) {
                namaDataSpasialInput.focus();

                return;
            }

            const aiText = buildAiText();

            if (target === 'description') {
                deskripsiDataSpasialInput.value = aiText.description;
                deskripsiDataSpasialInput.focus();
            } else {
                abstractDataSpasialInput.value = aiText.abstract;
                abstractDataSpasialInput.focus();
            }
        }

        async function refreshCaptcha() {
            captchaAnswer.value = '';
            captchaAnswer.setCustomValidity('');

            try {
                const response = await fetch(captchaUrl, {
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                if (!response.ok) {
                    throw new Error('Captcha gagal dimuat.');
                }

                const captcha = await response.json();
                captchaQuestion.textContent = captcha.question;
            } catch (error) {
                window.location.reload();
            }
        }

        namaDataSpasialInput.addEventListener('input', updateGenerateAiButton);
        generateAiButton.addEventListener('click', () => fillGeneratedText('description'));
        generateAbstractAiButton.addEventListener('click', () => fillGeneratedText('abstract'));
        refreshCaptchaButton.addEventListener('click', refreshCaptcha);
        captchaAnswer.addEventListener('input', () => captchaAnswer.setCustomValidity(''));
        generateXmlForm.addEventListener('submit', (event) => {
            loadingOverlay.classList.add('show');
        });
        updateGenerateAiButton();

        if (downloadUrl && successAlert) {
            loadingOverlay.classList.add('show');

            setTimeout(() => {
                loadingOverlay.classList.remove('show');
                successAlert.classList.remove('d-none');
                generateXmlForm.reset();
                $('.select2-opd').val(null).trigger('change');
                updateGenerateAiButton();
                refreshCaptcha();
                window.location.href = downloadUrl;
            }, 2000);
        }
    </script>
</body>

</html>
