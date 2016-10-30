@extends('layout')

@section('style')
    <link href="{{asset('css/account.css')}}" rel="stylesheet" type="text/css" media="all">
@stop

@section('content')
    <div class="row" style="margin:0">
        <div class="col-md-12 col-sm-12 col-sx-12" style="padding: 0">
            <div class="current-profile">
                <div class="user-bg @if(empty($cover_photo)) cover-photo @endif"
                     @if(!empty($cover_photo->photo_name)) style="background: url({{asset($cover_photo->photo_name)}}) no-repeat" @endif>
                    <div class="upload-file-container-cover-photo">
                        <form method="post" action="{{url('change-cover-photo')}}" id="change-cover-photo-form">
                            <div class="btn btn-primary container-cover-photo" id="cover-photo">
                                <input type="file" name="coverphoto" accept="image/png, image/jpeg, image/gif">
                                <span class="fa fa-camera">  Edit Cover Photo</span>
                            </div>
                        </form>
                    </div>
                    @if(!Auth::check()))
                    @elseif(Auth::user()->is($user))
                        <div class="upload-file-container fa fa-camera"
                             style="position:absolute;left:46%;top:10%;z-index: 100">
                            <form method="post" action="{{url('change-profile-photo')}}" id="change-profile-photo-form">
                                <input type="file" name="profilephoto" style="width: 10px"
                                       accept="image/png, image/jpeg, image/gif">
                            </form>
                        </div>
                    @endif
                    <img src="@if(empty($profile_photo->photo_name)) {{asset('images/blank-person.png')}} @else {{asset($profile_photo->photo_name)}} @endif"
                         class="user-pic" id="profile-photo">
                    <div class="user-details" id="load-headline">
                        <h3 class="user-name">{{$user->present()->fullname}}<i>!</i></h3>
                        <h4 class="description">
                            @if(!Auth::check())
                            @elseif(!Auth::user()->is($user))
                                <form method="post" action="{{url('account/follow-user')}}" id="follow-user-form">
                                    {{csrf_field()}}
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <span class="follow-wrap">
                                        <button class="btn btn-success follow-button @if($already_followed = Auth::user()->alreadyFollowed($user->id)) followed @endif"
                                                id="follow-button">
                                            @if($already_followed)
                                                Following
                                            @else
                                                Follow
                                            @endif
                                        </button>
                                    </span>
                                </form>
                            @elseif(empty($user->headline))<a id="editheadline"
                                                              class="fa fa-edit"
                                                              style="cursor:pointer;">Edit
                                Headline</a>@else <p id="user-headline">{{$user->headline}}&nbsp;&nbsp;&nbsp;<a
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
                            <div class="col-md-4 col-sm-5 col-xs-5 center-align-text">
                                <center><h3>{{count($recipes)}}</h3></center>
                                <center>
                                    <small>Recipes</small>
                                </center>
                            </div>

                            <div class="col-md-4 col-sm-5 col-xs-5 center-align-text">
                                @if(!Auth::check())
                                    <center><h3>{{count($followers)}}</h3></center>
                                    <center>
                                        <small>Follower</small>
                                    </center>
                                @else
                                    @if(count($followers) != 0)
                                        <a href="#" data-toggle="modal" data-target='#follower-modal'
                                           id="follower-modal-click">
                                            <center><h3>{{count($followers)}}</h3></center>
                                            <center>
                                                <small>Follower</small>
                                            </center>
                                        </a>
                                        @include('partial.followermodal')
                                    @else
                                        <center><h3>{{count($followers)}}</h3></center>
                                        <center>
                                            <small>Follower</small>
                                        </center>
                                    @endif
                                @endif
                            </div>

                            <div class="col-md-4 col-sm-5 col-xs-5 center-align-text">
                                @if(!Auth::check())
                                    <center><h3>{{count($followings)}}</h3></center>
                                    <center>
                                        <small>Following</small>
                                    </center>
                                @else
                                    @if(count($followings) != 0)
                                        <a href="#" data-toggle="modal" data-target='#following-modal'
                                           id="following-modal-click">
                                            <center><h3>{{count($followings)}}</h3></center>
                                            <center>
                                                <small>Following</small>
                                            </center>
                                        </a>
                                        @include('partial.followingmodal')
                                    @else
                                        <center><h3>{{count($followings)}}</h3></center>
                                        <center>
                                            <small>Following</small>
                                        </center>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="well well-sm">
            <center><strong><h3>Recipe List</h3></strong></center>
        </div>

        <div id="products" class="row list-group">
            @if(count($recipes) <= 0)
                You haven't create any recipe yet
            @else
                @foreach($recipes as $recipe)

                    <a href="{{url('recipe/'.$recipe->slug)}}" style="text-decoration: none;color:black;">
                        <div class="item  col-xs-3 col-lg-3">
                            <div class="thumbnail">
                                <img class="group list-group-image" src="{{asset($recipe->photo_name)}}" alt=""/>
                                <div class="caption">
                                    <h4 class="= list-group-item-heading">
                                        <b>{{$recipe->name}}</b></h4>
                                    <div class="row">
                                        <div class="line-separator-account">

                                        </div>
                                        <div class="info">
                                            <div class="info-separator">
                                                <center style="margin-left: 20px"><span
                                                            class="fa fa-user"></span> {{$user->present()->fullname}}
                                                </center>
                                            </div>
                                            <span class="fa fa-calendar"> {{$recipe->created_at->toFormattedDateString()}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>

    <script>
        function redirect(url) {
            window.location = url;
        }

        function unfollow(x) {
            x.style.backgroundColor = 'red';
            x.style.borderColor = 'red';
            x.textContent = "Unfollow";
        }

        function following(x) {
            x.style.color = '#fff';
            x.style.backgroundColor = '#449d44';
            x.style.borderColor = '#398439';
            x.textContent = 'Following';
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
            $(this).css('opacity', 1);
        });

        $('#follow-button').click(function (e) {
            e.preventDefault();
            var _ = $(this);
            _.html("<div style='padding-left: 1.3em;padding-right: 1.3em'><i class='fa fa-spinner fa-pulse fa-1x fa-fw'></i></div>");
            _.prop('disabled', true);
            var url = $('#follow-user-form').attr('action');
            $.ajax({
                type: 'post',
                url: url,
                data: {
                    'user_id' : $('#follow-user-form input[name=user_id]').val(),
                    '_token' : $("#follow-user-form input[name='_token']").val()
                },
                dataType: 'json',
                success: function (data) {
                    _.prop('disabled', false);
                    if (data == 'Following') {
                        _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                        _.mouseenter(function () {
                            _.css({'background-color': 'red', 'border-color': 'red'});
                            _.html('Unfollow');
                        }).mouseleave(function () {
                            _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                            _.html('Following');
                        });
                        _.html(data);
                    } else if (data = 'Follow') {
                        _.html(data);
                        _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                        _.mouseenter(function () {
                            _.css({'color': '#fff', 'background-color': '#449d44', 'border-color': '#398439'});
                            _.html(data);
                        }).mouseleave(function () {
                            _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                            _.html(data);
                        })

                    }
                },
                error: function (data) {

                }

            });
        });

        $('.followed').on({
            mouseenter: function () {
                var _ = $(this);
                _.css({'background-color': 'red', 'border-color': 'red'});
                _.html('Unfollow');
            },
            mouseleave: function () {
                var _ = $(this);
                _.css({'color': '#fff', 'background-color': '#5cb85c', 'border-color': '#4cae4c'});
                _.html('Following');
            }
        })


    </script>
@stop
