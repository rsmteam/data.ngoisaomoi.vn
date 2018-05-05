<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">    
    <title></title>
    
    <!-- Font awesome -->
    <link href="{{ url('public/frontend/css/font-awesome.css') }}" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="{{ url('public/frontend/css/bootstrap.css') }}" rel="stylesheet">   
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="{{ url('public/frontend/css/jquery.smartmenus.bootstrap.css') }}" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/frontend/css/jquery.simpleLens.css') }}">    
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/frontend/css/slick.css') }}">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="{{ url('public/frontend/css/nouislider.css') }}">
    <!-- Theme color -->
    <link id="switcher" href="{{ url('public/frontend/css/theme-color/green-theme.css') }}" rel="stylesheet">
    <!-- <link id="switcher" href="css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="{{ url('public/frontend/css/sequence-theme.modern-slide-in.css') }}" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="{{ url('public/frontend/css/style.css') }}" rel="stylesheet">    

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href="{{ url('public/frontend/magiczoomplus/magiczoomplus.css') }}" rel="stylesheet">
    <script src="{{ url('public/frontend/magiczoomplus/magiczoomplus.js') }}"></script>
  </head>
  <body> 
     <!-- wpf loader Two -->
    <!-- <div id="wpf-loader-two">          
      <div class="wpf-loader-two-inner">
        <span>Đang tải</span>
      </div>
    </div>  -->
    <!-- / wpf loader Two -->       
 <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->
  
    <!-- Start header section -->
	<header id="aa-header">
    <!-- start header top  -->
    <div class="aa-header-top">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="aa-header-top-area">
            <!-- start header top left -->
              <div class="aa-header-top-left">
                <!-- start language -->
                
                
                <!-- / language -->

                <!-- start cellphone -->
                
                <!-- / cellphone -->
              </div>
              <!-- / header top left -->
              <div class="aa-header-top-right">
                <ul class="aa-head-top-nav-right">
                  @if (Auth::check())
                    <li class="hidden-xs">{{ Auth::user()->name }}</li>
                    <li class="hidden-xs"><a href="{{ url('/logout') }}">Thoát</a></li>
                  @else
                    <li class="hidden-xs"><a href="{{ url('/register') }}">Đăng kí</a></li>
                    <li class="hidden-xs"><a href="{{ url('/login') }}">Đăng nhập</a></li>
                  @endif
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- / header top  -->

    <!-- start header bottom  -->
    
    <!-- / header bottom  -->
  </header>
  <!-- / header section -->
    <!-- menu -->
  
  <!-- / menu -->
  <!-- Content pages -->
  
    @yield('content')

  <!-- / Content pages -->

  <!-- / product category -->
    <!-- jQuery library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ url('public/frontend/js/bootstrap.js') }}"></script>  
  <!-- SmartMenus jQuery plugin -->
  <script type="text/javascript" src="{{ url('public/frontend/js/jquery.smartmenus.js') }}"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="{{ url('public/frontend/js/jquery.smartmenus.bootstrap.js') }}"></script>  
  <!-- To Slider JS -->
  <script src="{{ url('public/frontend/js/sequence.js') }}"></script>
  <script src="{{ url('public/frontend/js/sequence-theme.modern-slide-in.js') }}"></script>  
  <!-- Product view slider -->
  <script type="text/javascript" src="{{ url('public/frontend/js/jquery.simpleGallery.js') }}"></script>
  <script type="text/javascript" src="{{ url('public/frontend/js/jquery.simpleLens.js') }}"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="{{ url('public/frontend/js/slick.js') }}"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="{{ url('public/frontend/js/nouislider.js') }}"></script>
  <!-- Custom js -->
  <script src="{{ url('public/frontend/js/custom.js') }}"></script> 

  <!-- My scripts -->
  <script src="{{ url('public/frontend/js/myscript.js') }}"></script> 
  </body>
</html>