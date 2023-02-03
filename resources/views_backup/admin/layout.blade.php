<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MOVAS</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}" />
    <link rel="stylesheet" href="{{asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico') }}" />

    <!-- jquery -->
    <script src="{{asset('https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js') }}"></script>

    {{-- toastr --}}
  <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">

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
<style>
    
    
</style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background: green;">
          <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}" style="color: lightgreen;font-family:arial;font-size:1em;">MOVAS</a>
          <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}" style="color: #67d467;"><i class="mdi mdi-cube menu-icon"></i></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch" style="background: #e4f7eb;border-bottom: 1px solid lightblue;">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>

          <ul class="navbar-nav navbar-nav-right">
            <!--<li class="nav-item nav-language dropdown">-->
            <!--  <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">-->
            <!--    <div class="nav-language-icon">-->
            <!--      <i class="fa fa-language" aria-hidden="true"></i>-->
            <!--    </div>-->
            <!--    <div class="nav-language-text">-->
            <!--      <p class="mb-1 text-black">Language</p>-->
            <!--    </div>-->
            <!--  </a>-->
            <!--  <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">-->
            <!--    <a class="dropdown-item" href="#" onclick="changeLanguage('mm')">-->
            <!--      <div class="nav-language-icon mr-2">-->
            <!--        <img src="{{ asset('mmflag.png') }}" width="25" height="18">-->
            <!--      </div>-->
            <!--      <div class="nav-language-text">-->
            <!--        <p class="mb-1 text-black">Myanmar</p>-->
            <!--      </div>-->
            <!--    </a>-->
            <!--    <div class="dropdown-divider"></div>-->
            <!--    <a class="dropdown-item" href="#" onclick="changeLanguage('eng')">-->
            <!--      <div class="nav-language-icon mr-2">-->
            <!--        <i class="flag-icon flag-icon-gb"></i>-->
            <!--      </div>-->
            <!--      <div class="nav-language-text">-->
            <!--        <p class="mb-1 text-black">English</p>-->
            <!--      </div>-->
            <!--    </a>-->
            <!--  </div>-->
            <!--</li>-->

           <a href="{{ route('downloadSql') }}" class="btn btn-sm btn-outline-success my-3" style=" font-size:15px;"><i class="fa fa-download"></i> Download Database</a>
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <!--<div class="nav-profile-img">-->
                <!--  <img src="{{ asset('assets/images/faces/face28.png') }}" alt="image">-->
                <!--</div>-->
                <div class="nav-profile-text">
                  <span style="font-family: arial;">Welcome: {{Auth::user()->username}}</span>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="profileDropdown" data-x-placement="bottom-end">
                <!--<div class="p-3 text-center bg-primary">-->
                <!--  <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('assets/images/faces/face28.png') }}" alt="">-->
                <!--</div>-->
                <div class="p-2">
                  <!--<h5 class="dropdown-header text-uppercase pl-2 text-dark">Options</h5>-->
                  <!--<a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="#">-->
                  <!--  <span>Profile</span>-->
                  <!--  <span class="p-0">-->
                  <!--    <i class="mdi mdi-account-outline ml-1"></i>-->
                  <!--  </span>-->
                  <!--</a>-->
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="{{ url('change-adminpassword') }}">
                    <span>Change Password</span>
                    <i class="mdi mdi-settings"></i>
                  </a>
                  <div role="separator" class="dropdown-divider"></div>
                  <!--<h5 class="dropdown-header text-uppercase  pl-2 text-dark mt-2">Actions</h5>-->
                  <a class="dropdown-item py-1 d-flex align-items-center justify-content-between" href="{{ route('admin.logout') }}">
                    <span>Log Out</span>
                    <i class="mdi mdi-logout ml-1"></i>
                  </a>
                </div>
              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: #e4f7eb;border-right: 1px solid lightblue;">
          <ul class="nav">
            <li class="nav-item nav-category"></li>
            @if (Auth::user()->rank_id <= 5 && Auth::user()->id!=1)
            <li class="nav-item">
                  <a class="nav-link" href="{{ route('dashboard') }}">
                    <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                    {{-- <span class="menu-title mm">User Registration</span> --}}
                    <span class="menu-title">Dashboard</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('inbox') }}">
                    <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                    {{-- <span class="menu-title mm">User Registration</span> --}}
                    <span class="menu-title">Inbox</span>
                  </a>
                </li>
              @if (Auth::user()->rank_id == 1)
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('approveprofile') }}">
                    <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                    {{-- <span class="menu-title mm">User Registration</span> --}}
                    <span class="menu-title">User Registration</span>
                  </a>
                </li>
              @endif
               
              <li class="nav-item">
                <a class="nav-link" href="{{ route('outboxform') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">Outbox</span> --}}
                  <span class="menu-title">Outbox</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('inprocessform') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">In-Process</span> --}}
                  <span class="menu-title">In-Proces</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('approvedform') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">Approved Form</span> --}}
                  <span class="menu-title">Approved Form</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('rejectedform') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">Rejected Form</span> --}}
                  <span class="menu-title">Rejected Form</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ route('turnDownForm') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">Turn Down</span> --}}
                  <span class="menu-title">Turn Down</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('report.Form') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  <span class="menu-title">Report</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('GraphForm') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  <span class="menu-title">Graph</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('GraphTable') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  <span class="menu-title">Graph-Table</span>
                </a>
              </li>

 		
            @endif
            
            @if (Auth::user()->rank_id > 5)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('approvedform') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">Approved Form</span> --}}
                  <span class="menu-title">Approved Form</span>
                </a>
              </li>
            @endif
           
           

            @if (Auth::user()->id==1)
              <li class="nav-item">
                <a class="nav-link" href="{{ route('admintable') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">Admin Management</span> --}}
                  <span class="menu-title">Admin Management</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('adminsector') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">Admin Sector</span> --}}
                  <span class="menu-title">Admin Sector</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('nationalityform') }}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">Nationality</span> --}}
                  <span class="menu-title">Nationality</span>
                </a>
              </li>

             <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index')}}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">User Management</span> --}}
                  <span class="menu-title">User Management</span>
                </a>
              </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ route('user.email')}}">
                  <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                  {{-- <span class="menu-title mm">User Email Verify</span> --}}
                  <span class="menu-title">User Email Verify</span>
                </a>
              </li>
            @endif
            
            {{-- <li class="nav-item">
              <a class="nav-link" href="{{ url('change-adminpassword') }}">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title mm">Change Password</span>
                <span class="menu-title eng">Change Password</span>
              </a>
            </li> --}}
            <!--<li class="nav-item">
              <a class="nav-link" href="{{ route('notesheet') }}">
                <span class="icon-bg"><i class="mdi mdi-cube menu-icon"></i></span>
                <span class="menu-title mm">Note Sheet</span>
                <span class="menu-title eng">Note Sheet</span>
              </a>
            </li>-->
          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper bg-white">
          
          @yield('content')  

          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         {{--  <footer class="footer">
            <div class="footer-inner-wraper">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2021</span>
                <!-- <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Unity IT</span> -->
              </div>
            </div>
          </footer> --}}
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    {{-- Language --}}
    <script type="text/javascript">
      checkLan();
    </script>
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/jquery-circle-progress/js/circle-progress.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

    {{-- toastr --}}
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <script src="{{ asset('js/toastr.js') }}"></script>
  {!! Toastr::message() !!}
  </body>
</html>