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
        <img src="{{ asset('images/DICAYangonLogo.jpg') }}" class="img-responsive" height="70"
            width="70" style="float: left; opicity: 1 !important;">
        <p style="color: white;">&nbsp;&nbsp;Directorate of Investment and Company Administration (Yangon Branch)</p>
        <p style="color: gold;">&nbsp;&nbsp;MIC Permitted Companies Online Visa Application System</p>
    </div>

    {{-- <div class="container"> 
        <nav class="navbar navbar-light">
            <div class="col-md-1" style="margin-top:8px;margin-bottom:8px; margin-left: 100px;">
                <a href=""><img src="images/DICAYangonLogo.jpg" class="img-responsive" height="100" width="100"></a>
            </div>
            <div class="col-md-10">
                <h3 style="color: #29a329; font-size: 30px;">Directorate of Investment and Company Administration (Yangon Branch)</h3>
                <h4 style="color: #b69746; font-size: 30px;">Online Visa Application System</h4>    
            </div>
        </nav>
        <script type="text/javascript">
            checkLan();
        </script>
    </div> --}}

    <div class="container mt-5" style="margin-left:50px;">


        <div class="row justify-content-center" style="width:100%;">
            <!--  Start row  -->
            <!-- Start Left -->
            <div class="col-md-3 bg-success" style="opacity: .8; height: 620px;">
                <p class="text-white mt-3" style="font-size: 17px;"><b>Only Companies with MIC Permit or MIC Endorsement
                        or Region/State Endorsement are Allowed to Register.<br><br>Only for whom with a Business Visa
                        can be Apply.</b></p><br>
                <p class="text-white mt-3" style="font-size: 17px;"><b>MIC ခွင့်ပြုမိန့် သို့မဟုတ် MIC အတည်ပြုမိန့်
                        သို့မဟုတ် တိုင်းဒေသကြီး/ပြည်နယ် အတည်ပြုမိန့် ရရှိထားသော ကုမ္ပဏီများသာ
                        မှတ်ပုံတင်ရန်။<br><br>လုပ်ငန်းဗီဇာရှိသူများအတွက်သာ လျှောက်ထားနိုင်သည်။<br><br>MOVAS စနစ်
                        အသုံးပြုရန်အတွက် Account မရှိသေးလျှင် Join Us ကို နှိပ်ပါ။</b></p>

                <label style="font-size: 20px; color: white; margin-top: 7px;">* User Guide (PDF File) *</label>
                <div>

                    <a href="{{ url('public/user_guide/MOVAS User Guide (Myanmar).pdf') }}"
                        class="btn btn-info " target="_blank">Myanmar</a>
                    /
                    <a href="{{ url('public/user_guide/MOVAS User Guide (English).pdf') }}"
                        class="btn btn-info " target="_blank">English</a>
                </div>
            </div><!-- end left -->
            <div class="col-md-5 bg-success ml-5"
                style="opacity: .8; height: 350px; margin-left:60px; margin-top: 40px;">
                <p class="text-white" style="font-size: 17px; padding:10px;line-height: 1.6;">
                    <b>
                        မြန်မာနိုင်ငံရင်းနှီးမြှုပ်နှံမှုဥပဒေအရ မြန်မာနိုင်ငံရင်းနှီးမြှုပ်နှံမှုကော်မရှင်၊
                        တိုင်းဒေသကြီး/ပြည်နယ် ရင်းနှီးမြှုပ်နှံမှုကော်မတီတို့မှ ခွင့်ပြုမိန့်/အတည်ပြုမိန့်တို့ဖြင့်
                        လုပ်ငန်းဆောင်ရွက်လျက်ရှိသော ကုမ္ပဏီများသည် MOVAS စနစ်၌ နိုင်ငံခြားသား ပညာရှင်များ၏ နေထိုင်ခွင့်
                        သက်တမ်းတိုးထောက်ခံချက် လျှောက်ထားရာတွင် အလုပ်သမားမှတ်ပုံတင်ကတ်ကို ပူးတွဲလျှောက်ထားရန်နှင့်
                        ဒုတိယအကြိမ် နေထိုင်ခွင့်သက်တမ်းတိုးမြှင့် ထောက်ခံချက်လျှောက်ထားလာပါက သက်တမ်းရှိသည့်
                        အလုပ်သမားမှတ်ပုံတင်ကတ်ရှိသော နိုင်ငံခြားသား ပညာရှင်များ၏ နေထိုင်ခွင့်ကိုသာ ထောက်ခံချက်
                        ဆောင်ရွက်ပေးမည် ဖြစ်ပါသဖြင့် အလုပ်သမား မှတ်ပုံတင်ကတ်များအား ပြုလုပ်ထားရန်နှင့် သက်တမ်းတိုးထားရန်
                        လိုအပ်ပါကြောင်း၊ အလုပ်သမား မှတ်ပုံတင်ကတ် လျှောက်ထားခြင်းမရှိပါက MOVAS System မှ အလိုအလျောက်
                        ငြင်းပယ်မည်ဖြစ်ကြောင်း အသိပေးအပ်ပါသည်။
                    </b>    
                </p>
            </div>
         

            <div class="col-md-3">
                <div id="wrapper">

                    <div id="login" class="animate form">
                        <h1>Login</h1>
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- <div class="form-group row"> -->
                            <!-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                            @if(Session::has('alert'))

                                <div class="alert alert-success form-group">

                                    {{ Session::get('alert') }}

                                    @php

                                        Session::forget('alert');

                                    @endphp
                                </div>

                            @endif

                            <p>
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required
                                    autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </p>
                            <!-- </div>
                        -->
                            <!-- <div class="form-group row mt-3"> -->
                            <P>
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>


                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </P>
                            <!--                         </div> -->

                            {{-- <div class="form-group row">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                    </div>
                </div>
            </div> --}}

            <!-- <div class="form-group row mb-0 mt-3"> -->
            <!-- <div class="col-md-8 offset-md-4"> -->
            <p style="margin-left:79px;">

                @if(Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>

                @endif



                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>


            </p>

            <!-- </div> -->

            <div class="col-md-8 offset-md-4">
                <p class="change_link text-center mb-2" style="width:; height: 58px;">
                    Not a member yet ?
                    <a href="{{ route('register') }}" class="to_register btn btn-outline-info">Join
                        us</a>
                </p>
            </div>
            <!-- </div> -->

            <div class="form-group row mt-3">

            </div>
            </form>
        </div>

    </div>
    </div>
    </div> <!-- end row --> 

    <div class="row justify-content-center text-light mt-3 text-center bg-danger"
        style="padding-top: 20px; padding-bottom: 20px;opacity: .9;width:1500px;">
        <!--  Start row  -->
        <p style="font-weight: bold; font-size: 18px;">၂၀၂၁ ခုနှစ်၊ နိုဝင်ဘာလ (၁) ရက်နေ့မှ စတင်၍ အွန်လိုင်းမှ
            လျှောက်ထားခြင်းကိုသာ လက်ခံတော့မည် ဖြစ်ပါသည်။</p>
    </div>
    <br>
    </div>


    <script type="text/javascript">
        checkLan();

    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>
