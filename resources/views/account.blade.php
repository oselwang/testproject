@extends('layout')

@section('style')
    <link href="{{asset('css/account.css')}}" rel="stylesheet" type="text/css" media="all">
@stop

@section('script')
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

        $("#uploadprofilephoto").change(function () {
            readURL(this);
        });
    </script>
@stop
@section('content')
    <div class="row">
        <div class="col-md-12 col-sm-12 col-sx-12">
            <div class="current-profile">
                <div class="user-bg" id="cover-photo"
                     style="background: url(http://lorempixel.com/1100/300/nature/5/) no-repeat;"></div>
                <form action="updateprofilephoto" method="post">
                    <label for="uploadprofilephoto">
                            <span class="glyphicon glyphicon-camera" style="color:black;cursor: pointer;"
                                  aria-hidden="true"></span>
                        <input type="file" id="uploadprofilephoto" style="display:none;">
                    </label>
                    <img src="{{asset('images/blank-person.png')}}" class="user-pic" id="profile-photo">
                </form>
                <div class="user-details">
                    <h4 class="user-name">Camilo<i>!</i></h4>
                    <h5 class="description">Hi, I'm UI Designer from Canada. I like to design web and mobile
                        applications that look good and work well.</h5>
                    <br>
                </div>
                <div class="social-list">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="row">
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
        </div>
    </div>
@stop
