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
        <div class="h-100 d-flex justify-content-center">
            <div class="col-lg-6 col-6 ">
                <div id="auth-left">
                    <h1 class="auth-title">Sign Up</h1>
                    <p class="auth-subtitle mb-5">
                        Input your data to register to our website.
                    </p>

                    <form method="POST" action="{{ route('user.register') }}">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="nis" type="number"
                                class="form-control form-control-xl @error('nis') is-invalid @enderror" name="nis"
                                placeholder="Nis" required value="{{ old('nis') }}">

                            <div class="form-control-icon">
                                <i class="bi bi-123"></i>
                            </div>
                            @error('nis')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="fullname" type="text"
                                class="form-control form-control-xl @error('fullname') is-invalid @enderror"
                                name="fullname" placeholder="Fullname" required value="{{ old('fullname') }}">

                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('fullname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="username" type="text"
                                class="form-control form-control-xl @error('username') is-invalid @enderror"
                                name="username" placeholder="Username" required value="{{ old('username') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="kelas" type="text"
                                class="form-control form-control-xl @error('kelas') is-invalid @enderror" name="kelas"
                                placeholder="Kelas" required value="{{ old('kelas') }}">

                            <div class="form-control-icon">
                                <i class="bi bi-buildings"></i>
                            </div>
                            @error('kelas')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="alamat" type="text"
                                class="form-control form-control-xl @error('alamat') is-invalid @enderror"
                                name="alamat" placeholder="Alamat" required value="{{ old('alamat') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            @error('alamat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password"
                                class="form-control form-control-xl @error('password') is-invalid @enderror"
                                placeholder="Password" name="password" value="{{ old('password') }}" />
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">
                            Sign Up
                        </button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            Already have an account?
                            <a href="{{ route('login') }}" class="font-bold">Log in</a>.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>
