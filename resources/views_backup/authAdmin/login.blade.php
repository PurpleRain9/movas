<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MOVAS</title>
    <meta name="description" content="dica">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="manifest" href="site.webmanifest">-->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/register.css">
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
    
   {{--  <div class="container"> 
        <nav class="navbar navbar-light">
                <div class="col-md-1" style="margin-top:8px;margin-bottom:8px; margin-left: 100px;">
                    <a href=""><img src="images/DICAYangonLogo.jpg" class="img-responsive" height="100" width="100"></a>
                </div>
                <div class="col-md-10">
                    <h2 style="color: #00ab46; font-size: 30px;">Directorate of Investment and Company Administration (Yangon Branch)</h2>
                    <h3 style="color: #b69746; font-size: 30px;">Online Visa Application System</h3>
                    <div style="float: right;">
                        <a href="#" onclick="changeLanguage('mm')" style="text-decoration: none;" class="text-primary">မြန်မာ /</a>
                        <a href="#" onclick="changeLanguage('eng');" style="text-decoration: none;" class="text-primary">English</a>
                    </div>
                </div>
        </nav>
        <script type="text/javascript">
            checkLan()
        </script>
    </div> --}}

    <!-- Registration Form -->
    <div class="container">
            <section>               
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <!-- sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssSSSS -->
                <div class="row justify-content-center" style="width:80%;">
                    <div class="col-md-9">
                        
                    </div>
                <div class="col-md-3">
                    <div id="wrapper" class="mt-5">
                        <div id="login" class="animate form" style="height: 360px; margin-top: 80px;">
                            <form method="POST" action="{{ route('adminlogin') }}">
                                    @csrf
                                <h1><i class="fa fa-user"></i></h1> 

                                @if(session('error'))
                                    <p class="alert alert-danger">{{session('error')}}</p>
                                @endif
                                <p> 
                                    <label for="username" class="uname" > Admin ID </label>
                                    <input id="username" name="username" required="required" class="form-control @error('username') is-invalid @enderror" type="text" value="{{ old('username') }}" autocomplete="username" autofocus/>
                                </p>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                <p> 
                                    <label for="password" class="youpasswd"> Password </label>
                                    <input id="password" name="password" required="required" class="form-control @error('password') is-invalid @enderror" type="password"  /> 
                                </p>

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                {{-- <p class="keeplogin"> 
                                    <input type="checkbox" name="loginkeeping" id="loginkeeping" value="loginkeeping" /> 
                                    <label for="loginkeeping">Keep me logged in</label>
                                </p> --}}
                                <p class="login button"> 
                                   <button type="submit" class="btn btn-primary text-light" style="text-decoration: none;">Login</button>
                                </p>
                            </form>
                        </div>
                        
                    </div>
                </div>
                </div>

                    <!-- ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss -->
                </div>  
            </section>
        </div>

        <br><br>



<script type="text/javascript">
    checkLan();
</script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
