<x-guest-layout>
    <style>
        * { font-family: 'Inter', 'Nunito', sans-serif; }

        .clinic-login-wrapper {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f0f0f 0%, #1a0000 50%, #111111 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            position: relative;
            overflow: hidden;
        }

        .clinic-login-wrapper::before {
            content: '';
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(185, 28, 28, 0.15) 0%, transparent 70%);
            top: -100px;
            right: -100px;
            border-radius: 50%;
        }

        .clinic-login-wrapper::after {
            content: '';
            position: absolute;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(185, 28, 28, 0.08) 0%, transparent 70%);
            bottom: -100px;
            left: -100px;
            border-radius: 50%;
        }

        .login-card {
            display: flex;
            width: 100%;
            max-width: 1000px;
            min-height: 600px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(255,255,255,0.05);
            position: relative;
            z-index: 2;
        }

        /* Left Panel - Brand Side */
        .login-brand-panel {
            flex: 1;
            background-image: url({{ asset('images/login-img.jpeg') }});
            background-size: cover;
            background-position: center;
            position: relative;
            min-height: 400px;
        }

        .login-brand-panel::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(185, 28, 28, 0.4) 100%);
        }

        .brand-panel-content {
            position: relative;
            z-index: 2;
            padding: 3rem 2.5rem;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .brand-panel-content h2 {
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 0.75rem;
        }

        .brand-panel-content p {
            color: rgba(255,255,255,0.75);
            font-size: 0.95rem;
            line-height: 1.7;
        }

        .brand-accent-line {
            width: 50px;
            height: 4px;
            background: #b91c1c;
            border-radius: 2px;
            margin-bottom: 1.5rem;
        }

        /* Right Panel - Form Side */
        .login-form-panel {
            flex: 1;
            background: #ffffff;
            padding: 3.5rem 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-logo {
            max-height: 90px;
            width: auto;
            object-fit: contain;
            margin-bottom: 2rem;
        }

        .login-welcome {
            font-size: 1.6rem;
            font-weight: 800;
            color: #111827;
            margin-bottom: 0.4rem;
        }

        .login-subtitle {
            color: #6b7280;
            font-size: 0.9rem;
            margin-bottom: 2rem;
        }

        .login-form-panel .form-control,
        .login-form-panel input[type="email"],
        .login-form-panel input[type="password"] {
            border: 1.5px solid #e5e7eb;
            border-radius: 10px;
            padding: 0.75rem 1.25rem;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background: #f9fafb;
            color: #111827;
            height: auto !important;
            line-height: 1.5 !important;
        }

        .login-form-panel .form-control:focus,
        .login-form-panel input[type="email"]:focus,
        .login-form-panel input[type="password"]:focus {
            border-color: #b91c1c;
            box-shadow: 0 0 0 3px rgba(185, 28, 28, 0.12);
            background: #fff;
            outline: none;
        }

        .btn-login {
            background: linear-gradient(135deg, #b91c1c 0%, #991b1b 100%);
            border: none;
            border-radius: 10px;
            padding: 0.8rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: #fff;
            width: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 14px rgba(185, 28, 28, 0.35);
            letter-spacing: 0.3px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(185, 28, 28, 0.5);
            background: linear-gradient(135deg, #991b1b 0%, #7f1d1d 100%);
            color: #fff;
        }

        .btn-login:active {
            transform: translateY(0px);
        }

        .login-divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
            color: #d1d5db;
            font-size: 0.8rem;
        }

        .login-divider::before,
        .login-divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e7eb;
        }

        .forgot-link {
            color: #b91c1c;
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #991b1b;
            text-decoration: underline;
        }

        .remember-label {
            font-size: 0.85rem;
            color: #6b7280;
        }

        @media (max-width: 767px) {
            .login-card { flex-direction: column; max-width: 480px; }
            .login-brand-panel { min-height: 200px; }
            .login-form-panel { padding: 2rem 1.75rem; }
        }
    </style>

    <div class="clinic-login-wrapper">
        <div class="login-card">

            {{-- Left Panel --}}
            <div class="login-brand-panel d-none d-md-block">
                <div class="brand-panel-content">
                    <div class="brand-accent-line"></div>
                    <h2>Clínica La<br>Esperanza</h2>
                    <p>Sistema de gestión clínica<br>para el equipo de salud.</p>
                </div>
            </div>

            {{-- Right Panel (Form) --}}
            <div class="login-form-panel">

                <div class="text-center">
                    <img src="{{ asset('images/LOGO123.png') }}" alt="Clínica La Esperanza" class="login-logo">
                </div>

                <h1 class="login-welcome">{{ __('Bienvenido') }}</h1>
                <p class="login-subtitle">Ingresa tus credenciales para continuar</p>

                <x-validation-errors class="mb-3" />

                @if (session('status'))
                    <div class="alert alert-success mb-3" role="alert" style="border-radius: 10px; font-size: 0.85rem;">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            type="email" name="email" value="{{ old('email') }}"
                            placeholder="Correo electrónico" required autofocus />
                        <x-input-error for="email"></x-input-error>
                    </div>

                    <div class="mb-4">
                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                            type="password" name="password"
                            placeholder="Contraseña" required autocomplete="current-password" />
                        <x-input-error for="password"></x-input-error>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember_me" name="remember">
                            <label class="remember-label form-check-label" for="remember_me">
                                {{ __('Recordarme') }}
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn-login">
                        {{ __('Iniciar Sesión') }}
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-guest-layout>
