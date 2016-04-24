<!DOCTYPE HTML>
<html>
<head>
    <title>Cooks a Hotels and Restaurants Category Flat Bootstrap Responsive Website Template | Events ::
        w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Cooks Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design"/>
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);
        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- Custom Theme files -->
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{asset('css/loginmodal.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <!-- js -->
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <!-- //js -->
    <!-- animation-effect -->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet">
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    <script src="{{asset('js/loginmodal.js')}}"></script>
    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->
    <link href='//fonts.googleapis.com/css?family=Alex+Brush' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic'
          rel='stylesheet' type='text/css'>
</head>

<!-- header -->
<div class="header">
    <div class="container">
        <nav class="navbar navbar-default">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="logo">
                    <a class="navbar-brand" href="/">Cooks</a>
                </div>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
                <nav class="cl-effect-13" id="cl-effect-13">
                    <ul class="nav navbar-nav">
                        <li><a href="/" {{(Request::url('') ? 'class=active' : '')}}>Home</a></li>
                        <li><a href="">News & Events</a></li>
                        <li><a href="">Short Codes</a></li>
                        <li role="presentation" class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">
                                Services <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="">Door Delivery</a></li>
                                <li><a href="">Direct Delivery</a></li>
                            </ul>
                        </li>
                        <li><a href="">Mail Us</a></li>

                    </ul>
                </nav>
                <nav class="cl-effect-13" id="cl-effect-13">
                    <ul class="nav navbar-nav right">
                        @if(!Auth::check())
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                        @elseif(Auth::check())
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                    Hello, {{Auth::user()->name}} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="">Door Delivery</a></li>
                                    <li><a href="">Direct Delivery</a></li>
                                </ul>
                            </li>
                    </ul>
                </nav>
                @endif

            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
</div>
@include('partial.loginmodal')
<!-- header -->
<body>
@yield('content')
</body>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"
   title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span
            class="glyphicon glyphicon-chevron-up"></span></a>
<!-- footer -->
@include('partial.footer')
        <!-- //footer -->
<!-- for bootstrap working -->
<script src="{{asset('js/bootstrap.js')}}"></script>
<!-- //for bootstrap working -->

</html>