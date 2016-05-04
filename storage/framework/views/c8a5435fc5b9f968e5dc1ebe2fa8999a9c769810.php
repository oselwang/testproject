<!DOCTYPE HTML>
<html>
<head>
    <?php echo $__env->yieldContent('style'); ?>

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
    <link href="<?php echo e(asset('css/combobox-bootstrap.css')); ?>" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?php echo e(asset('css/dropzone.css')); ?>" rel="stylesheet" media="all" type="text/css"/>
    <!-- js -->
    <script src="<?php echo e(asset('js/jquery-1.11.1.min.js')); ?>"></script>
    <!-- //js -->
    <!-- animation-effect -->
    <link href="<?php echo e(asset('css/animate.css')); ?>" rel="stylesheet">
    <script src="<?php echo e(asset('js/wow.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('js/jquery.flexisel.js')); ?>"></script>
    <script src="<?php echo e(asset('js/backtotop.js')); ?>"></script>
    <script src="<?php echo e(asset('js/loginmodal.js')); ?>"></script>
    <script src="<?php echo e(asset('js/combobox-bootstrap.js')); ?>"></script>
    <script src="<?php echo e(asset('js/dropzone.js')); ?>"></script>

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
                        <li><a href="/" <?php echo e((Request::is('/') ? 'class=active' : '')); ?>>Home</a></li>
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
                        <?php if(!Auth::check()): ?>
                            <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                        <?php elseif(Auth::check()): ?>
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="true" aria-expanded="false">
                                    Hello, <?php echo e(Auth::user()->firstname); ?> <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#" data-toggle="modal" data-target='#recipe-modal'><span
                                                    class="glyphicon glyphicon-pencil"
                                                    style="margin-right: 20px"></span>Write Recipe</a></li>
                                    <li><a href=""><span class="glyphicon glyphicon-tasks"
                                                         style="margin-right: 20px"></span>Order</a></li>
                                    <li><a href="account" <?php echo e((Request::is('account') ? 'class=active' : '')); ?>><span
                                                    class="glyphicon glyphicon-user" style="margin-right: 20px"></span>Account</a>
                                    </li>
                                    <li><a href="logout"><span class="glyphicon glyphicon-off"
                                                               style="margin-right: 20px"></span>Logout</a></li>
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
<?php if(!Auth::check()): ?>
<?php echo $__env->make('partial.loginmodal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php else: ?>
<?php echo $__env->make('partial.recipemodal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>
        <!-- header -->
<body>

<?php echo $__env->yieldContent('content'); ?>
</body>
<?php if(Session::has('flash_notification.message')): ?>
    <div id="flash-pop-up" class="flash-pop-up btn-success btn"><?php echo e(Session::get('flash_notification.message')); ?></div>
<?php endif; ?>
<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button"
   title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span
            class="glyphicon glyphicon-chevron-up"></span></a>
<!-- footer -->
<?php echo $__env->make('partial.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- //footer -->
<!-- for bootstrap working -->
<script src="<?php echo e(asset('js/bootstrap.js')); ?>"></script>
<!-- //for bootstrap working -->

</html>

