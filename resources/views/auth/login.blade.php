<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>
        :root {
            --primary: #5289b5;
            --secondary: #afd8f2;
            --light: #ffffff;
            --dark: #1f3541;
            --hover-color: #417ba1;
        }
        body {
            background-color: var(--light);
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 100px;
        }
        .card {
            background-color: var(--light);
            border: none;
            box-shadow: 0 0 15px rgba(31, 53, 65, 0.5);
            border-radius: 15px;
            width: 100%;
            max-width: 600px;
            margin: auto;
        }
        .card-header {
            background-color: var(--primary);
            height: 50px;
            color: var(--light);
            border-radius: 15px 15px 0 0;
            border: none;
            text-align: center;
            font-weight: bold;
        }
        .form-control {
            background-color: var(--light);
            border: none;
            border-radius: 25px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(31, 53, 65, 0.5);
            outline: none;
        }
        .btn{
            background-color: white;
        }
        .btn{
            background-color: white;
            color: var(--dark);
        }
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--light);
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--hover-color);
        }
        .btn-link {
            color: var(--dark);
            transition: color 0.3s ease;
        }
        .btn-link:hover {
            color: var(--primary);
        }
        .input-group-text {
            background-color: var(--primary);
            color: var(--light);
            border: none;
            border-radius: 25px 0 0 25px;
        }
        .invalid {
            width: 100%;
            margin-top: .25rem;
            font-size: .875em;
            color: #dc3545;

        }
    </style>
</head>
<body>
    @include('layouts.nav')

    <div class="container">
        <div class="card">
            <div class="card-header">
                {{ __('Login') }}
            </div>

            <div class="card-body" style="color: var(--dark);">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="col-form-label" style="color: var(--dark);">{{ __('Email Address') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Enter your email"   autofocus>
                        </div>
                        @error('email')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="col-form-label" style="color: var(--dark);">{{ __('Password') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter your password"  >
                        </div>
                        @error('password')
                            <span class="invalid" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember" style="color: var(--dark);">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>

                    <div class="mb-0 text-center">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>
                        
                        <a href="{{ route('register') }}" class="btn btn-primary">
                            {{ __('register') }}
                      
                      
                        <a href="{{ route('auth.github') }}" class="btn btn-primary">
                            {{ __('Login with Github') }}
                       
                         
                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}" style="background-color: none">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
<br>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>