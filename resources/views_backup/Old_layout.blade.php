<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>MOVAS</title>
	<meta name="description" content="dica">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--<link rel="manifest" href="site.webmanifest">-->
	<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('fontawesome/css/all.css') }}">
	
    
	<!-- jquery -->
	<script src="{{ asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>

	{{-- toastr --}}
	<link rel="stylesheet" href="{{ asset('css/toastr.css') }}"> 

	<style>
		body {font-family: Arial;}

		.carousel-item {
			height: 100vh;
			min-height: 350px;
			background: no-repeat center center scroll;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;
		}

		.my-nav ul li a:hover{
			background-color: #00ab46;
			color: white !important;
		}

		.my-hr {
			height: 1px;
			margin: 20px 0;
			background: -webkit-gradient(linear, 0 0, 100% 0, from(rgba(0, 0, 0, 0)), color-stop(0.5, #333333), to(rgba(0, 0, 0, 0)));
			background: -webkit-linear-gradient(left, rgba(0, 0, 0, 0), #333333, rgba(0, 0, 0, 0));
			background: -moz-linear-gradient(left, rgba(0, 0, 0, 0), #333333, rgba(0, 0, 0, 0));
			background: -o-linear-gradient(left, rgba(0, 0, 0, 0), #333333, rgba(0, 0, 0, 0));
			background: linear-gradient(left, rgba(0, 0, 0, 0), #333333, rgba(0, 0, 0, 0));
			border: 0;
		}
		.my-hr:after {
			display: block;
			content: '';
			height: 30px;
			background-image: -webkit-gradient(radial, 50% 0%, 0, 50% 0%, 116, color-stop(0%, lightgreen), color-stop(100%, rgba(255, 255, 255, 0)));
			background-image: -webkit-radial-gradient(center top, farthest-side, lightgreen 0%, rgba(255, 255, 255, 0) 100%);
			background-image: -moz-radial-gradient(center top, farthest-side, lightgreen 0%, rgba(255, 255, 255, 0) 100%);
			background-image: -o-radial-gradient(center top, farthest-side, lightgreen 0%, rgba(255, 255, 255, 0) 100%);
			background-image: radial-gradient(farthest-side at center top, lightgreen 0%, rgba(255, 255, 255, 0) 100%);
		}

		.dropdown-submenu {
			position: relative;
			width: 240px;
		}

		.dropdown-submenu>.dropdown-menu {
			top: 0;
			left: 100%;
			margin-top: -6px;
			margin-left: -1px;
			-webkit-border-radius: 0 6px 6px 6px;
			-moz-border-radius: 0 6px 6px;
			border-radius: 0 6px 6px 6px;
		}

		.dropdown-submenu:hover>.dropdown-menu {
			display: block;
		}

		.dropdown-submenu>a:after {
			display: block;
			content: " ";
			float: right;
			width: 0;
			height: 0;
			border-color: transparent;
			border-style: solid;
			border-width: 5px 0 5px 5px;
			border-left-color: #ccc;
			margin-top: 5px;
			margin-right: 5px;
		}

		.dropdown-submenu:hover>a:after {
			border-left-color: #fff;
		}

		.dropdown-submenu.pull-left {
			float: none;
		}

		.dropdown-submenu.pull-left>.dropdown-menu {
			left: -100%;
			margin-left: 10px;
			-webkit-border-radius: 6px 0 6px 6px;
			-moz-border-radius: 6px 0 6px 6px;
			border-radius: 6px 0 6px 6px;
		}

		#myBtn {
		  display: none;
		  position: fixed;
		  bottom: 20px;
		  right: 30px;
		  z-index: 99;
		  font-size: 18px;
		  border: none;
		  outline: none;
		  background-color: #00ab46;
		  color: white;
		  cursor: pointer;
		  padding: 15px;
		  border-radius: 4px;
		}

		#myBtn:hover {
		  background-color: #555;
		}
	</style>

	<script type="text/javascript">
		function changeLanguage(val) {
			sessionStorage.setItem("language", val)

			$('.mm').hide();
			$('.eng').hide();

			if (val == "eng") {
				$('.eng').show();

			} else {
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

		//Disable enterKey
		function stopRKey(evt) {
			var evt = (evt) ? evt : ((event) ? event : null);
			var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
			if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
		}

document.onkeypress = stopRKey;
</script>
</head>
<body>
	<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>


	<div class="container">	
		<nav class="navbar navbar-light">
			<div class="col-md-1" style="margin-top:8px;margin-bottom:8px; margin-left: 100px;">
				<a href=""><img src="{{asset('images/DICAYangonLogo.jpg')}}" class="img-responsive" height="100" width="100"></a>
			</div>
			<div class="col-md-10">
				
				<h3 style="color: #00ab46;">Directorate of Investment and Company Administration (Yangon Branch)</h3>
				<h4 style="color: #b69746;">MIC Permitted Companies Online Visa Application System</h4>
				<div style="float: right;">
					<a href="#" onclick="changeLanguage('mm')" style="text-decoration: none;" class="text-reset">မြန်မာ /</a>
					<a href="#" onclick="changeLanguage('eng');" style="text-decoration: none;" class="text-reset">English</a>

					&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
					<a style="text-decoration: none;" href="{{ route('logout') }}" class="text-reset ml-5"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
				</div>

			</div>
		</nav>
		<script type="text/javascript">
			checkLan();
		</script>

	</div>

	@if (Auth::user()->email_verified_at && Auth::user()->Status == 2)
		<nav class="navbar navbar-expand-lg navbar-light my-nav" style="background-color: #00ab46;">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown" style="margin-left: 30px;">
			<ul class="navbar-nav" style="font-weight: bold; text-transform: uppercase;">
				<li class="nav-item" style="margin-right: 30px;">
					<a class="nav-link" href="{{ route('home') }}" style="color: white;"><span class="mm">မူလစာမျက်နှာ</span><span class="eng">Home</span></a>
				</li>
				<li class="nav-item" style="margin-right: 30px;">
					<a class="nav-link" href="{{ route('editprofile') }}" style="color: white;"><span class="mm">ကုမ္ပဏီအချက်အလက်</span><span class="eng">Profile</span></a>
				</li>
				
				<li class="nav-item" style="margin-right: 30px;">
                    <a class="nav-link" href="{{ route('applyform') }}" style="color: white;"><span class="mm">လျှောက်လွှာတင်ရန်</span><span class="eng">Visa Application</span></a>
				</li>

				<li class="nav-item" style="margin-right: 30px;">
                    <a class="nav-link" href="{{ route('FT.show') }}" style="color: white;"><span class="mm">နိုင်ငံခြားသားပညာရှင်</span><span class="eng">Foreign Technician / Skilled Labour</span></a>
				</li>

				<!--<li class="dropdown nav-item" style="margin-right: 10px;">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
						<span class="mm">အစီရင်ခံစာ</span><span class="eng">Report</span>
					</a>
					<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
						<li>
							<a tabindex="-1" href="#" class="nav-link text-nowrap mm">Report 1</a>
							<a tabindex="-1" href="#" class="nav-link text-nowrap eng">Report 1</a>
						</li>
						<div class="dropdown-divider"></div>
						<li>
							<a tabindex="-1" href="#" class="nav-link text-nowrap mm">Report 2</a>
							<a tabindex="-1" href="#" class="nav-link text-nowrap eng">Report 2</a>
						</li>
						<div class="dropdown-divider"></div>
						<li>
							<a tabindex="-1" href="#" class="nav-link text-nowrap mm">Report 3</a>
							<a tabindex="-1" href="#" class="nav-link text-nowrap eng">Report 3</a>
						</li>
					</ul>
				</li>-->
			</ul>
		</div>
	</nav>
	@endif
	
	<div>	
		@yield('content')
	</div>

	<script type="text/javascript">

		//Get the button
		var mybutton = document.getElementById("myBtn");

		// When the user scrolls down 20px from the top of the document, show the button
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
		  if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
		    mybutton.style.display = "block";
		  } else {
		    mybutton.style.display = "none";
		  }
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
		  document.body.scrollTop = 0;
		  document.documentElement.scrollTop = 0;
		}

		checkLan();
	</script>

	<script src="{{asset('https://code.jquery.com/jquery-3.2.1.slim.min.js')}}" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<!--<script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js')}}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->
	<script src="{{asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js')}}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

	{{-- toastr --}}
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script src="{{ asset('js/toastr.js') }}"></script>
	{!! Toastr::message() !!}
</body>
</html>