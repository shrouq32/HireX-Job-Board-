<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">


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
            margin-top: 80px;
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
            border-radius: 15px 15px 0 0 !important;
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
                Register
            </div>

            <div class="card-body" style="color: var(--dark);">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                  

                    <div class="mb-3">
                        <label for="name" class="col-form-label" style="color: var(--dark);">Name</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                name="name" value="{{ old('name') }}" placeholder="Enter your name" autocomplete="name"
                                autofocus>
                        </div>
                        @error('name')
                        <span class="invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label for="email" class="col-form-label" style="color: var(--dark);">Email Address</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" placeholder="Enter your email"
                                autocomplete="email">
                        </div>
                        @error('email')
                        <span class="invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="img" class="col-form-label" style="color: var(--dark);">Profile Image</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input id="img" type="file" class="form-control @error('img') is-invalid @enderror" name="img" value="{{ old('img') }}" autofocus>
                        </div>
                        @error('img')
                        <span class="invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="col-form-label" style="color: var(--dark);">Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Enter your password" autocomplete="new-password">
                        </div>
                        @error('password')
                        <span class="invalid" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="col-form-label" style="color: var(--dark);">Confirm
                            Password</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password-confirm" type="password" class="form-control"
                                name="password_confirmation" placeholder="Confirm your password"
                                autocomplete="new-password">
                        </div>
                    </div>

                    <div class="mb-0 text-center">
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>