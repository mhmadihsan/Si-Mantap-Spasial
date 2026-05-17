<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - {{ config('app.name', 'PE Bapperida') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --sky: #38bdf8;
            --sky-dark: #075985;
            --sky-soft: #e0f2fe;
            --sky-muted: #f0f9ff;
            --ink: #172033;
        }

        body {
            background:
                linear-gradient(135deg, rgba(7, 89, 133, .94), rgba(56, 189, 248, .78)),
                url("https://images.unsplash.com/photo-1497215728101-856f4ea42174?auto=format&fit=crop&w=1800&q=80") center/cover;
            color: var(--ink);
            font-family: Figtree, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            min-height: 100vh;
        }

        .login-shell {
            min-height: 100vh;
            padding: 2rem 0;
        }

        .brand-mark {
            align-items: center;
            background: var(--sky-soft);
            border-radius: 8px;
            color: var(--sky-dark);
            display: inline-flex;
            font-weight: 800;
            height: 44px;
            justify-content: center;
            width: 44px;
        }

        .login-panel {
            background: rgba(255, 255, 255, .96);
            border: 1px solid rgba(255, 255, 255, .78);
            border-radius: 8px;
            box-shadow: 0 24px 70px rgba(7, 89, 133, .28);
            overflow: hidden;
        }

        .login-panel-header {
            background: var(--sky-muted);
            border-bottom: 1px solid #bae6fd;
            padding: 1.5rem;
        }

        .form-control {
            border-color: #bae6fd;
            border-radius: 8px;
            padding: .8rem .95rem;
        }

        .form-control:focus {
            border-color: var(--sky);
            box-shadow: 0 0 0 .25rem rgba(56, 189, 248, .18);
        }

        .form-check-input:checked {
            background-color: var(--sky);
            border-color: var(--sky);
        }

        .btn-sky {
            --bs-btn-bg: var(--sky-dark);
            --bs-btn-border-color: var(--sky-dark);
            --bs-btn-hover-bg: #0369a1;
            --bs-btn-hover-border-color: #0369a1;
            --bs-btn-color: #fff;
            border-radius: 8px;
            font-weight: 700;
            padding: .78rem 1rem;
        }

        .link-sky {
            color: var(--sky-dark);
            font-weight: 600;
            text-decoration: none;
        }

        .link-sky:hover {
            color: #0284c7;
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <main class="login-shell d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-sm-10 col-md-7 col-lg-5 col-xl-4">
                    <div class="login-panel">
                        <div class="login-panel-header">
                            <a href="{{ url('/') }}" class="d-inline-flex align-items-center gap-2 text-decoration-none text-reset">
                                <span class="brand-mark">PE</span>
                                <span class="fw-bold fs-5">PE Bapperida</span>
                            </a>
                            <h1 class="h3 fw-bold mt-4 mb-2">Masuk Aplikasi</h1>
                            <p class="text-secondary mb-0">Gunakan akun terdaftar untuk mengakses layanan PE Bapperida.</p>
                        </div>

                        <div class="p-4 p-sm-5">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror"
                                        name="email" value="{{ old('email') }}" required autofocus
                                        autocomplete="username" placeholder="nama@email.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label fw-semibold">Password</label>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="current-password"
                                        placeholder="Masukkan password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex flex-column flex-sm-row justify-content-between gap-3 mb-4">
                                    <div class="form-check">
                                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                        <label class="form-check-label" for="remember_me">Ingat saya</label>
                                    </div>

                                    @if (Route::has('password.request'))
                                        <a class="link-sky" href="{{ route('password.request') }}">
                                            Lupa password?
                                        </a>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-sky w-100">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
