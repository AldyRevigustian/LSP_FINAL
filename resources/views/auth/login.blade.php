<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="stylesheet" href="/assets/css/main/app.css" />
    <link rel="stylesheet" href="/assets/css/pages/auth.css" />
    <link rel="shortcut icon" href="/assets/images/logo/favicon.svg" type="image/x-icon" />
    <link rel="shortcut icon" href="/assets/images/logo/favicon.png" type="image/png" />
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12" style="display: flex; flex-direction:column; justify-content:center">
                <div id="auth-left">
                    <center>
                        <img src="{{ '/assets/images/logo/logo.png' }}" width="130px" height="130px"
                            style="margin-bottom:2rem" alt="Logo" />
                    </center>

                    <h1 class="auth-title">Log in.</h1>

                    @if (session('status'))
                        <div class="alert alert-{{ session('status') }}" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="username" type="text"
                                class="form-control @error('username') is-invalid @enderror form-control-xl"
                                name="username" value="{{ old('username') }}" required autocomplete="username"
                                placeholder="Username" autofocus>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password" type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit">
                            Log in
                        </button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            Don't have an account?
                            <a href="{{ route('register') }}" class="font-bold">Sign up</a>.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img src="{{ '/assets/images/samples/perpus.jpg' }}" alt="" style="height: 100%"
                        width="100%">
                </div>
            </div>
        </div>
    </div>
</body>

</html>
