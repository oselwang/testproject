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
    <link href="<?php echo e(asset('css/bootstrap.css')); ?>" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo e(asset('css/loginmodal.css')); ?>" rel="stylesheet" type="text/css" media="all"/>
    <!-- js -->
    <script src="<?php echo e(asset('js/jquery-1.11.1.min.js')); ?>"></script>
    <!-- //js -->
    <!-- animation-effect -->
    <link href="<?php echo e(asset('css/animate.min.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('js/script.js')); ?>"></script>
    <script src="<?php echo e(asset('js/loginmodal.js')); ?>"></script>
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
                        <li><a href="/" <?php echo e((Request::url('') ? 'class=active' : '')); ?>>Home</a></li>
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
                        <li><a href="mail.html">Mail Us</a></li>

                    </ul>
                </nav>
                <nav class="cl-effect-13" id="cl-effect-13">
                    <ul class="nav navbar-nav right">
                        <?php if(!Auth::check()): ?>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                        <?php elseif(Auth::check()): ?>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                    Hello, <?php echo e(Auth::user()->name); ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="">Door Delivery</a></li>
                                    <li><a href="">Direct Delivery</a></li>
                                </ul>
                            </li>
                    </ul>
                </nav>
                <?php endif; ?>

            </div>
            <!-- /.navbar-collapse -->
        </nav>
    </div>
</div>
<?php echo $__env->make('partial.loginmodal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- header -->
<body>
<?php echo $__env->yieldContent('content'); ?>
</body>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"
   title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span
            class="glyphicon glyphicon-chevron-up"></span></a>

<!-- footer -->
<?php echo $__env->make('partial.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- //footer -->
<!-- for bootstrap working -->
<script src="js/bootstrap.js"></script>
<!-- //for bootstrap working -->
</body>
</html>