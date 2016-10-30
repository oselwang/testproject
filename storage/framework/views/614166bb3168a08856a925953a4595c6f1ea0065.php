<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-4">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                        <div class="col-xs-4">
                            <a href="#" id="forgot-form-link">Forgot Password</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="<?php echo e(url('login')); ?>" method="post" role="form"
                                  style="display: block;">
                                <?php echo e(csrf_field()); ?>

                                <div class="col-xs-12 col-sm-12">
                                    <a href="<?php echo e(url('auth/facebook')); ?>" class="btn btn-block btn-social btn-facebook">
                                        <i class="fa fa-facebook"></i> Sign in with Facebook
                                    </a>
                                </div>
                                <div class="col-xs-12 col-sm-12">
                                    <a class="btn btn-block btn-social btn-google-plus">
                                        <i class="fa fa-google-plus"></i> Sign in with Google
                                    </a>
                                </div>
                                <div class="col-xs-5 col-sm-5 line-separator">

                                </div>
                                <div id="flash-error-login" class="alert alert-danger hidden col-lg-12">
                                    <ul id="error-login" style="margin-left: 1em">
                                    </ul>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                           placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2"
                                           class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group text-center">
                                    <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                    <label for="remember"> Remember Me</label>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                                   class="form-control btn btn-login" value="Log In">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="http://phpoll.com/recover" tabindex="5"
                                                   class="forgot-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="register-form" action="<?php echo e(url('register')); ?>" method="post"
                                  role="form" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                                <div id="flash-error-register" class="alert alert-danger hidden">
                                    <ul id="error-register" style="margin-left: 1em">
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="firstname" tabindex="1" class="form-control"
                                           placeholder="Firstname">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="lastname" tabindex="1" class="form-control"
                                           placeholder="Lastname">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone" tabindex="1" class="form-control"
                                           placeholder="Phone">
                                </div>

                                <div class="form-group" data-toggle="buttons">
                                    <div class="btn btn-default active">
                                        <input type="radio" name="gender" value="Male" checked>
                                        Male
                                    </div>

                                    <div class="btn btn-default">
                                        <input type="radio" name="gender" value="Female">
                                        Female
                                    </div>

                                </div>

                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                           placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="1"
                                           class="form-control" placeholder="Password" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" id="confirm-password"
                                           tabindex="2"
                                           class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit"
                                                   tabindex="4" class="form-control btn btn-register"
                                                   value="Register Now">
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form id="forgot-form" action="<?php echo e(url('forgot')); ?>" method="post" role="form"
                                  style="display: none;">
                                <?php echo e(csrf_field()); ?>

                                <div id="flash-success-forgot" class="alert alert-success hidden">
                                    <ul id="success-forgot" style="margin-left: 1em">
                                    </ul>
                                </div>
                                <div id="flash-error-forgot" class="alert alert-danger hidden">
                                    <ul id="error-forgot">
                                    </ul>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control"
                                           placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="forgot-submit" id="forgot-submit" tabindex="4"
                                                   class="form-control btn btn-login" value="Resend Password">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function redirect(url) {
        window.location = url;
    }

    $('#login-submit').click(function (e) {
        e.preventDefault();
        $('#error-login').text('');
        var url = $('#login-form').attr('action');
        $.ajax({
            type: 'post',
            url: url,
            data: {
                _token: $("input[name='_token']").val(),
                username: $('#login-form #username').val(),
                password: $('#login-form #password').val()
            },
            dataType: 'json',
            success: function (data) {
                redirect(window.location.href);
            },
            error: function (data) {
                $('#flash-error-login').removeClass('hidden');
                $('#error-login').append("<li>We cannot identify these credentials</li>");
            }
        });
    });
    $('#register-submit').click(function (e) {
        e.preventDefault();
        $('#error-register').text('');
        var url = $('#register-form').attr('action');
        $.ajax({
            type: 'post',
            url: url,
            data: {
                _token: $("input[name='_token']").val(),
                firstname: $("input[name='firstname']").val(),
                lastname: $("input[name='lastname']").val(),
                email: $("input[name='email']").val(),
                username: $("#register-form input[name=username]").val(),
                password: $("#register-form input[name=password]").val(),
                password_confirmation: $("input[name='password_confirmation']").val(),
                phone: $("input[name='phone']").val(),
                gender: $("input[name='gender']").val(),
            },
            dataType: 'json',
            success: function (data) {
                redirect(window.location.href);
            },
            error: function (data) {
                errors = $.parseJSON(data.responseText);
                $('#flash-error-register').removeClass('hidden');
                $.each(errors, function (index, value) {
                    $('#error-register').append("<li>" + value + "</li>")
                })
            }
        });
    });

    $('#forgot-submit').click(function (e) {
        e.preventDefault();
        $('#flash-error-forgot').addClass('hidden');
        $('#error-forgot').text('');
        $('#flash-success-forgot').addClass('hidden');
        var data = $('#forgot-form').serializeArray();
        var url = $('#forgot-form').attr('action');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function (data) {
                $('#flash-success-forgot').removeClass('hidden');
                $('#success-forgot').text('Please check your email for new password');
            },
            error: function (data) {
                $('#flash-error-forgot').removeClass('hidden');
                $('#error-forgot').append("<li>We cannot identify these credentials</li>");
            }
        });
    });
</script>