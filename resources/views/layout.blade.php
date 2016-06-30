<!DOCTYPE HTML>
<html>
<head>
    @yield('style')

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
    <link href='//fonts.googleapis.com/css?family=Alex+Brush' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic'
          rel='stylesheet' type='text/css'>
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{asset('font-awesome/css/font-awesome.min.css')}}" type="text/css" media="all" rel="stylesheet">
    <link href="{{asset('css/loginmodal.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{asset('css/combobox-bootstrap.css')}}" rel="stylesheet" type="text/css" media="all"/>
    <link href="{{asset('css/dropzone.css')}}" rel="stylesheet" media="all" type="text/css"/>
    <link href="{{asset('css/searchbox.css')}}" rel="stylesheet" media="all" type="text/css"/>
    <!-- js -->
    <script src="{{asset('js/jquery-1.11.1.min.js')}}"></script>
    <!-- //js -->
    <!-- animation-effect -->
    <link href="{{asset('css/animate.css')}}" rel="stylesheet">
    <script src="{{asset('js/wow.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/jquery.flexisel.js')}}"></script>
    <script src="{{asset('js/backtotop.js')}}"></script>
    <script src="{{asset('js/loginmodal.js')}}"></script>
    <script src="{{asset('js/combobox-bootstrap.js')}}"></script>
    <script src="{{asset('js/dropzone.js')}}"></script>

    <script>
        new WOW().init();
    </script>
    <!-- //animation-effect -->
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
                        <li><a href="{{url('http://testproject.net//')}}" {{(Request::is('/') ? 'class=active' : '')}}>Home</a>
                        </li>
                        <li>
                            <a href="{{url('http://testproject.net/recipes')}}" {{(Request::is('recipes') ? 'class=active' : '')}}>Recipes</a>
                        </li>
                        <li>
                            <a href="{{url('http://testproject.net/suggestion')}}" {{(Request::is('suggestion') ? 'class=active' : '')}}>Suggestion</a>
                        </li>
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
                        <li><a href="" id="search-recipe"><i class="fa fa-search"></i></a></li>
                        @if(!Auth::check())
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                        @elseif(Auth::check())
                            <li role="presentation" class="dropdown-toggle" id="notification">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <input class="notification" readonly="readonly" value="@{{count}}"></a>
                                <ul class="dropdown-menu">
                                    <center>
                                        <li>
                                            <i class="fa fa-spinner fa-pulse fa-3x fa-fw notification-spinner"
                                               id="notification-spinner"></i>
                                        </li>
                                    </center>
                                </ul>
                            </li>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                    Hello, {{Auth::user()->firstname}} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target='#recipe-modal'><span
                                                    class="glyphicon glyphicon-pencil"
                                                    style="margin-right: 20px"></span>Write Recipe</a></li>
                                    <li><a href=""><span class="glyphicon glyphicon-tasks"
                                                         style="margin-right: 20px"></span>Order</a></li>
                                    <li>
                                        <a href="{{url('http://testproject.net/account/'.Auth::user()->present()->accountname)}}" {{(Request::is('account') ? 'class=active' : '')}}><span
                                                    class="fa fa-user" style="margin-right: 20px"></span>Account</a>
                                    </li>
                                    <li><a href="{{url('http://testproject.net/logout')}}"><span
                                                    class="glyphicon glyphicon-off"
                                                    style="margin-right: 20px"></span>Logout</a></li>

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
<form method="get" action="{{url('http://testproject.net/search')}}" id="search-form" autocomplete="off">
    <div class="search-container" style="{{Request::is('search') ?: 'display: none' }}">
        <div class="search-input">
            <input type="text" class="search-box" value="{{Request::is('search') ? $search : ''}}" name="q"
                   placeholder="What would you like to cook ?" id="search">
            <button type="submit" class="search-button btn">Search</button>
            <div class="suggestion-container">
            </div>
        </div>
    </div>
</form>

@if(!Auth::check())
@include('partial.loginmodal')
@else
@include('partial.recipemodal')
@include('partial.popup')
@endif
        <!-- header -->
<body>

@yield('content')
</body>

@if(Session::has('flash_notification.message'))
    <div id="flash-pop-up"
         class="flash-pop-up btn-{{Session::get('flash_notification.level')}} btn">{{Session::get('flash_notification.message')}}</div>
@endif
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"
   title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span
            class="glyphicon glyphicon-chevron-up"></span></a>
<!-- footer -->
@include('partial.footer')
        <!-- //footer -->
<!-- for bootstrap working -->
<script src="{{asset('js/bootstrap.js')}}"></script>

<script src="{{asset('js/layout.js')}}"></script>
<!-- //for bootstrap working -->

</html>

