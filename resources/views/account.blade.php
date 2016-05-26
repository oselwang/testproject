@extends('layout')

@section('style')
    <link href="{{asset('css/account.css')}}" rel="stylesheet" type="text/css" media="all">
@stop

@section('content')
    <div class="row" style="margin:0">
        <div class="col-md-12 col-sm-12 col-sx-12" style="padding: 0">
            <div class="current-profile">
                <div class="user-bg @if(empty($cover_photo->photo_name)) cover-photo @endif" @if(!empty($cover_photo->photo_name)) style="background:url({{URL::asset($cover_photo->photo_name)}}) no-repeat" @endif>
                    <div class="upload-file-container-cover-photo">
                        <form method="post" action="changecoverphoto" id="change-cover-photo-form">
                            <div class="btn btn-primary container-cover-photo" id="cover-photo">
                                <input type="file" name="coverphoto" accept="image/png, image/jpeg, image/gif">
                                <span class="fa fa-camera">  Edit Cover Photo</span>
                            </div>
                        </form>
                    </div>
                    <div class="upload-file-container fa fa-camera"
                         style="position:absolute;left:46%;top:10%;z-index: 100">
                        <form method="post" action="changeprofilephoto" id="change-profile-photo-form">
                            <input type="file" name="profilephoto" style="width: 10px"
                                   accept="image/png, image/jpeg, image/gif">
                        </form>
                    </div>
                    <img src="@if(empty($profile_photo->photo_name)) {{asset('images/blank-person.png')}} @else {{asset($profile_photo->photo_name)}} @endif"
                         class="user-pic" id="profile-photo">
                    <div class="user-details" id="load-headline">
                        <h3 class="user-name">{{Auth::user()->present()->fullname}}<i>!</i></h3>
                        <h4 class="description">@if(empty(Auth::user()->headline))<a id="editheadline"
                                                                                     class="fa fa-edit"
                                                                                     style="cursor:pointer;">Edit
                                Headline</a>@else <p id="user-headline">{{Auth::user()->headline}}&nbsp;&nbsp;&nbsp;<a
                                        id="editheadline" class="fa fa-edit" style="cursor:pointer;"> </a></p>@endif
                        </h4>
                        <form method="post" action="headline" id="submit-headline">
                            <input type="text" name="headline" id="headline" class="form-control hidden">
                            <input type="submit" class="hidden">
                        </form>
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
            function redirect(url) {
                window.location = url;
            }

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profile-photo').attr('src', e.target.result);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#editheadline').click(function () {
                $(this).addClass('hidden');
                $('#user-headline').addClass('hidden');
                $('#headline').removeClass('hidden');
            });

            $('#submit-headline').on('submit', function (e) {
                e.preventDefault();
                var url = $(this).attr('action');
                $.ajax({
                    type: 'post',
                    url: url,
                    data: $(this).serializeArray(),
                    dataType: 'json',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {

                    }
                })
            });

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
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });

            $(".upload-file-container-cover-photo input:file").change(function () {
                readURL(this);
                var url = $('#change-cover-photo-form').attr('action');
                $.ajax({
                    type: 'post',
                    url: url,
                    data: new FormData($('#change-cover-photo-form')[0]),
                    contentType: false,
                    processData: false,
                    async: true,
                    dataType: 'json',
                    success: function (data) {
                        location.reload();
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            });


            $('#cover-photo').hover(function () {
                $(this).css('opacity',1);
            }).timeout(1000,function () {
                $(this).css('opacity',0.2);
            })




        </script>
@stop
