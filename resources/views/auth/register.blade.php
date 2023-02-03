<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MOVAS</title>
    <meta name="description" content="dica">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <link rel="manifest" href="site.webmanifest"> --}}
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .card {
            width: 600px !important;
            justify-content: center;
        }

        #wrapper {
            width: 600px;
            margin-right: 700px;

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
    <div
        style="background: #1a944e; opacity: 0.9; font-family: tahoma; font-size: 1.2em; font-weight: bold;line-height: 2em;">
        <img src="{{ asset('images/DICAYangonLogo.jpg') }}" class="img-responsive" height="70" width="70"
            style="float: left; opicity: 1 !important;">
        <p style="color: white;">&nbsp;&nbsp;Directorate of Investment and Company Administration (Yangon Branch)</p>
        <p style="color: gold;">&nbsp;&nbsp;MIC Permitted Companies Online Visa Application System</p>
    </div>

    <div class="container mt-5">
        <div class="row justify-content-center" style="width:80%;">
            <div class="col-md-3 bg-success" style="opacity: .8; height: 630px;">
                <p class="text-white mt-3" style="font-size: 17px;"><b>Only Companies with MIC Permit or MIC Endorsement
                        or Region/State Endorsement are Allowed to Register.<br><br>Only for whom with a Business Visa
                        can be Apply.</b></p><br>
                <p class="text-white mt-3" style="font-size: 17px;"><b>MIC ခွင့်ပြုမိန့် သို့မဟုတ် MIC အတည်ပြုမိန့်
                        သို့မဟုတ် တိုင်းဒေသကြီး/ပြည်နယ် အတည်ပြုမိန့် ရရှိထားသော ကုမ္ပဏီများသာ
                        မှတ်ပုံတင်ရန်။<br><br>လုပ်ငန်းဗီဇာရှိသူများအတွက်သာ လျှောက်ထားနိုင်သည်။<br><br>MOVAS စနစ်
                        အသုံးပြုရန်အတွက် Account မရှိသေးလျှင် Join Us ကို နှိပ်ပါ။</b></p>


                <div class="mt-3">
                    <label style="font-size: 20px; color: white;">User Guide (PDF File) :</label>
                    <a href="{{ route('download.Myanmar') }}" class="btn btn-info ">Myanmar</a>
                    /
                    <a href="{{ route('download.English') }}" class="btn btn-info ">English</a>
                </div>
            </div>
            <div class="col-md-6">

            </div>
            <div class="col-md-3">
                <div id="wrapper">
                    <!-- <div class="card-header">{{ __('Register') }}</div> -->

                    <div id="login" class="animate form">
                        <h1>
                            Register
                        </h1>
                        <form method="POST" action="{{ route('register') }}" style="font-size: 18px">
                            @csrf


                            <div class="form-group row">
                                <label for="name"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Contact Person') }}</label>

                                <div class="col-md-7">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="form-group row mt-1">
                                <label for="phone_no"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                                <div class="col-md-7">
                                    <input id="phone_no" type="text"
                                        class="form-control @error('phone_no') is-invalid @enderror" name="phone_no"
                                        value="{{ old('phone_no') }}" required autocomplete="phone_no" autofocus>

                                    @error('phone_no')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Company Email') }}</label>

                                <div class="col-md-7">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-7">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-1">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                                <div class="col-md-7">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>  

                            {{-- <div class="form-group row mt-1">
                                <div class="col-md-4">
                                    <label for="">Captcha</label>
                                </div>
                                <div class="col-md-7">
                                    @captcha
                                    <input type="text" id="captcha" name="captcha" autocomplete="off" required>
                                    @error('captcha')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }} row">
                                <label for="password" class="col-md-4 control-label">Captcha</label>

                                <div class="col-md-7">
                                    <div class="captcha d-flex gap-2 align-items-center">
                                        <span style="width: 120px; height: 36px">{!! captcha_img() !!}</span>
                                        <button type="button" class="btn btn-success btn-sm btn-refresh" id="captchaBtn"><i
                                                class="fa fa-refresh"></i></button>
                                    </div>
                                    <input id="captcha" type="text" class="form-control"
                                        placeholder="Enter Captcha" name="captcha">
                                    @if ($errors->has('captcha'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <!--  <div class="form-group row mb-0 mt-1">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div> -->
                            
                        <div class="form-group text-end mt-3">
                            
                            
                                <button type="submit" class="btn btn-primary me-4">
                                    {{ __('Register') }}
                                </button>
                            
                        </div>
                        

                            

                            <div class="form-group row mt-1">
                                <p class="change_link text-center mb-5"
                                    style="width: 600px !important; height: 70px;">
                                    Already a member ?
                                    <a href="{{ route('login') }}" class="to_register btn btn-outline-info"> Go and
                                        log in </a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
        $("#captchaBtn").click(function() {
            $.ajax({
                type: 'GET',
                url: '/refresh_captcha',
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
</body>

</html>
