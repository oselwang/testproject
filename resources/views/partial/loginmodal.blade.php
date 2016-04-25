<div class="container modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6">
                            <a href="#" class="active" id="login-form-link">Login</a>
                        </div>
                        <div class="col-xs-6">
                            <a href="#" id="register-form-link">Register</a>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="login" method="post" role="form"
                                  style="display: block;">

                                <div id="flash-error-register" class="alert alert-danger hidden">
                                    <ul id="error-login">
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
                            <form id="register-form" action="register" method="post"
                                  role="form" style="display: none;">
                                {{csrf_field()}}
                                <div id="flash-error-register" class="alert alert-danger hidden">
                                    <ul id="error-register">
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="name" id="name" tabindex="1" class="form-control"
                                           placeholder="Name" value="{{old('name')}}">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control"
                                           placeholder="Email Address" value="{{old('email')}}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone" tabindex="1" class="form-control"
                                           placeholder="Phone" value="{{old('phone')}}">
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
                                           placeholder="Username" value="{{old('username')}}">
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

    $('#login-submit').click(function(e){
        e.preventDefault();
        $('#error-login').text('');
        var data = $('#login-form').serializeArray();
        var url = $('#login-form').attr('action');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function () {
                redirect(window.location.href);
            },
            error: function () {

            }
        })
    });
    $('#register-submit').click(function (e) {
        e.preventDefault();
        $('#error-regiter').text('');
        var data = $('#register-form').serializeArray();
        var url = $('#register-form').attr('action');
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            dataType: 'json',
            success: function (data) {
                window.redirect(window.location.href);
            },
            error: function (data) {
                errors = $.parseJSON(data.responseText);
                $('#flash-error-register').removeClass('hidden');
                $.each(errors, function (index, value) {
                    $('#errors').append("<li>" + value + "</li>")
                })
            }
        });
    });
</script>