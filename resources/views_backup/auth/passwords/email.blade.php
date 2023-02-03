<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MOVAS</title>
    <meta name="description" content="dica">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('path') }}images/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/register.css') }}">
    <!-- jquery -->
    <script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>
    <style>
        .card{
            width: 600px !important;
            justify-content: center;
        }
    </style>
    <script type="text/javascript">
        function changeLanguage(val) {
            sessionStorage.setItem("language", val);

            if (val == "eng") {
                $('.mm').hide();
                $('.eng').show();

            } else {
                $('.eng').hide();
                $('.mm').show();
            }
        }

        function checkLan() {
            var lan = sessionStorage.getItem("language");
            if (lan) {
                changeLanguage(lan);
            } else {
                changeLanguage("eng");
            }
        }

        

    </script>
</head>
<body>
    <div style="background: #1a944e; opacity: 0.9; font-family: tahoma; font-size: 1.2em; font-weight: bold;line-height: 2em;">
        <img src="{{ asset('images/DICAYangonLogo.jpg') }}" class="img-responsive" height="70" width="70" style="float: left; opicity: 1 !important;">
        <p style="color: white;">&nbsp;&nbsp;Directorate of Investment and Company Administration (Yangon Branch)</p>
        <p style="color: gold;">&nbsp;&nbsp;MIC Permitted Companies Online Visa Application System</p>
    </div>
    
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Get Password Reset Link') }}
                                </button>
                                <a href="{{ route('login') }}" class="btn btn-outline-info">
                                    {{ __('Back') }}
                                </a>
                            </div>
                            <div class="col-md-6 offset-md-4">
                                
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>