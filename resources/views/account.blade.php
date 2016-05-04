@extends('layout')

@section('style')
    <link href="{{asset('css/account.css')}}" rel="stylesheet" type="text/css" media="all">
@stop

@section('content')
    <div class="row" style="margin:0">
        <div class="col-md-12 col-sm-12 col-sx-12" style="padding: 0">
            <div class="current-profile">
                <div class="user-bg" id="cover-photo"
                     style="background: url(http://lorempixel.com/1366/300/nature/5/) no-repeat;"></div>
                <div class="upload-file-container glyphicon glyphicon-camera"
                     style="position:absolute;left:46%;top:10%;z-index: 100;">
                    <form method="post" action="changeprofilephoto" id="change-profile-photo-form">
                        <input type="file" name="profilephoto" accept="image/png, image/jpeg, image/gif">
                    </form>
                </div>
                <img src="{{asset('images/blank-person.png')}}" class="user-pic" id="profile-photo">
                <div class="user-details">
                    <h4 class="user-name">Camilo<i>!</i></h4>
                    <h5 class="description">Hi, I'm UI Designer from Canada. I like to design web and mobile
                        applications that look good and work well.</h5>
                    <br>
                </div>
                <div class="social-list">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="col-md-3 col-sm-3 col-xs-3 center-align-text">
                            <h3>2359</h3>
                            <small>Posts</small>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 center-align-text">
                            <h3>1278</h3>
                            <small>Followers</small>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 center-align-text">
                            <h3>7315</h3>
                            <small>Likes</small>
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-3 center-align-text">
                            <h3>189</h3>
                            <small>Contacts</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-photo').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

        $(".upload-file-container input:file").change(function () {
            readURL(this);
            var url = $('#change-profile-photo-form').attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: new FormData($('#change-profile-photo-form')[0]),
                contentType: false,
                processData: false,
                async: true,
                dataType: 'json',
                success: function (data) {
                    redirect(window.location.href);
                },
                error: function (data) {
                    errors = $.parseJSON(data.responseText);
                    $('#flash-error-recipe').removeClass('hidden');
                    $.each(errors, function (index, value) {
                        $('#error-recipe').append("<li>" + value + "</li>")
                    })
                }
            });
        });
    </script>
@stop
