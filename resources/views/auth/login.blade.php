@extends('layouts.login')


@section('content')

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tourisme
    </title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100;300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/owl.theme.default.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/tooplate-gotto-job.css') }}" rel="stylesheet">


</head>

<body>
    <br />
    <br />
    <br />
    <br />
    <br />
    <div class="col-lg-8 col-12 mx-auto">
        <form class="custom-form contact-form" method="POST" action="{{ route('login') }}" role="form">
            <h2 class="text-center mb-4">Welcome to our website 👋</h2>
            @csrf
            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8 col-12">
                    <label for="first-name">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-4 col-6 mx-auto">
                    <button type="submit" class="form-control">Login</button>


                </div>
            </div>
        </form>
    </div>
</body>
@endsection