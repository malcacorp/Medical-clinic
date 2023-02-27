<!DOCTYPE html>
<html lang="en">


<!-- login23:11-->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="public/assets/img/favicon.ico">
    <title> Telemedicina </title>
    <link rel="stylesheet" type="text/css" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="public/assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="public/assets/js/html5shiv.min.js"></script>
		<script src="public/assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
			<div class="account-center">
				<div class="account-box">
                    <form action="{{ route('login') }}" method="post" class="form-signin">
                        @csrf
						<div class="account-logo">
                            <a href="index-2.html"><img src="public/assets/img/logo-dark.png" alt=""></a>
                        </div>
                        <div class="form-group">
                            <label>Correo electronico</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Contrase&ntilde;a</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Recordarme') }}
                            </label>
                        </div>
                        <div class="form-group text-right">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Ha olvidado su contraseña?') }}
                            </a>
                        @endif
                        </div>
                        <div class="form-group text-center">
                      
                        <button type="submit" class="btn btn-primary account-btn">Iniciar Sesión</button>
                        <div class="text-center register-link">
                            No tienes Cuenta? <a href="{{ route('register') }}">Crear Cuenta</a>
                        </div>
                    </form>
                </div>
			</div>
        </div>
    </div>
    <script src="public/assets/js/jquery-3.2.1.min.js"></script>
	<script src="public/assets/js/popper.min.js"></script>
    <script src="public/assets/js/bootstrap.min.js"></script>
    <script src="public/assets/js/app.js"></script>
</body>


<!-- login23:12-->
</html>