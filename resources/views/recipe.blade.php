@extends('layout')
@section('style')
    <link href="{{asset('css/account.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('css/recipe.css')}}" rel="stylesheet" type="text/css" media="all">
@stop
@section('content')
    <div class="row" style="margin:0">
        <div class="col-md-12 col-sm-12 col-sx-12" style="padding: 0">
            <div class="current-profile">
                <div class="user-bg @if(empty($cover_photo)) recipe-cover-photo @endif"
                     @if(!empty($cover_photo->photo_name)) style="background: url({{asset($cover_photo->photo_name)}}) no-repeat" @endif>
                    @if(Auth::user()->ownRecipe($recipe))
                    <div class="upload-file-container-cover-photo">
                        <form method="post" action="change-recipe-cover-photo" id="change-cover-photo-form">
                            <div class="btn btn-primary container-cover-photo" id="cover-photo">
                                <input type="file" name="coverphoto" accept="image/png, image/jpeg, image/gif">
                                <span class="fa fa-camera">  Edit Cover Photo</span>
                            </div>
                        </form>
                    </div>
                    <div class="upload-file-container fa fa-camera"
                         style="position:absolute;left:41%;top:6%;font-size: 18px">
                        <form method="post" action="change-recipe-profile-photo" id="change-profile-photo-form">
                            <input type="file" name="profilephoto" style="width: 10px"
                                   accept="image/png, image/jpeg, image/gif">
                        </form>
                    </div>
                    @endif
                    <img src="@if(empty($profile_photo->photo_name)) {{asset('images/blank-person.png')}} @else {{asset($profile_photo->photo_name)}} @endif"
                         class="recipe-pic" id="profile-photo">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-sx-12" style="background-color: #333333">
            <div class="container-recipe-info">
                <div class="recipe-info2">
                    <div class="col-xs-3 recipe-info2-text">
                        <div class="recipe-info2-text-separator">
                            <i class="fa fa-shopping-basket" style="margin-bottom: 5px"></i>
                            <p style="margin-bottom: 15px">Preparation</p>
                            <p class="recipe-info2-text-style">{{$recipe->preparation}} Min</p>
                        </div>
                    </div>
                    <div class="col-xs-3 recipe-info2-text">
                        <div class="recipe-info2-text-separator">
                            <i class="fa fa-hourglass" style="margin-bottom: 5px"></i>
                            <p style="margin-bottom: 15px">Cook TIme</p>
                            <p class="recipe-info2-text-style">{{$recipe->duration}} Min</p>
                        </div>
                    </div>
                    <div class="col-xs-3 recipe-info2-text">
                        <div class="recipe-info2-text-separator">
                            <i class="fa fa-group" style="margin-bottom: 5px"></i>
                            <p style="margin-bottom: 15px">Serves</p>
                            <p class="recipe-info2-text-style">{{$recipe->portion}}</p>
                        </div>
                    </div>
                    <div class="col-xs-3 recipe-info2-text">
                        <i class="fa fa-gears" style="margin-bottom: 5px"></i>
                        <p style="margin-bottom: 15px">Difficulty</p>
                        <p class="recipe-info2-text-style">{{ucwords($recipe->difficulty)}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="recipe-all-info">
        <div class="recipe-title-container">
            <div class="recipe-title">
                {{$recipe->name}} - {{$recipe->owner($recipe)}}
            </div>
            <div class="recipe-description">
                {{$recipe->description}}
            </div>
            <div class="description-separator">
            </div>
            <div class="miscellaneous-recipe-info">
                RATINGS : <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                POSTED :
                <o style="font-size: 14px">{{$recipe->created_at->toFormattedDateString()}}</o>
                &nbsp;&nbsp;&nbsp;&nbsp;
                COMMENTS :
                <o style="font-size: 14px">2</o>
                <div class="print-recipe-btn">
                    <button class="btn btn-primary"><i class="fa fa-print"> Print Ingredients & Recipe</i></button>
                </div>
            </div>
        </div>
        <div class="recipe-social-share">
            SHARE
            <div class="recipe-social-share-separator">

            </div>
            <div class="recipe-share-button">
                <button class="btn btn-facebook-share">
                    <i class="fa fa-facebook"></i>
                </button>
                <br>
                <button class="btn btn-google-plus-share">
                    <i class="fa fa-google"></i>
                </button>
                <br>
                <button class="btn btn-twitter-share">
                    <i class="fa fa-twitter"></i>
                </button>
                <br>
                <button class="btn btn-pinterest-share">
                    <i class="fa fa-pinterest-p"></i>
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="ingredient-container">
                    <div class="ingredient-title">
                        INGREDIENTS
                        <div class="ingredient-title-separator">
                        </div>
                    </div>
                    <form method="post" action="{{url('http://testproject.net/recipe/buy-ingredient')}}">
                        @foreach($ingredients as $ingredient)
                            <div class="ingredient-list">
                                <label class="control control--checkbox">1/2 cup low-sodium chicken broth
                                    <input type="checkbox" name="ingredient[]"
                                           value="{{$ingredient->amount . ' ' . $ingredient->name}}"
                                           id="ingredient-checkbox">
                                    <div class="control__indicator"></div>
                                </label>
                            </div>
                            <div class="ingredient-list-separator">
                            </div>
                        @endforeach
                        <div class="buy-ingredient">
                            <button class="btn btn-primary disabled" id="buy-ingredient" type="submit">Buy Ingredient
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="instruction-container">
                    <div class="instruction-title">
                        COOKING INSTRUCTIONS
                        <div class="instruction-title-separator"></div>
                    </div>
                    <div class="instruction-list">
                        <i class="hidden"> {{ $i = 1 }}</i>
                        @foreach($instructions as $instruction)
                            <div class="instruction-number">
                                {{$i++}}
                            </div>
                            <p class="instruction-info">
                                {{ucfirst($instruction->body)}}
                            </p>
                        @endforeach
                    </div>
                    <div class="recipe-category-title">
                        CATEGORIES
                        <div class="recipe-category-title-separator"></div>
                        @foreach($categories as $category)
                            <button class="btn btn-default recipe-category-info-btn">
                                <b class="category_name">
                                    {{$category->category_name}}
                                </b>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($related_recipes != null)
        <div class="related-container">
            <div class="related-title">
                SIMILAR RECIPES
            </div>
            <div class="related-title-separator"></div>
            <div class="row">
                @foreach($related_recipes as $recipe)
                    <a href="{{url('recipe/'.$recipe->slug)}}" style="text-decoration: none;color:black;">
                        <div class="related-item  col-xs-3 col-lg-3">
                            <div class="related-thumbnail">
                                <img src="{{url($recipe->getProfilePhoto())}}" alt=""/>
                                <div class="caption">
                                    <h4 class="= list-group-item-heading" style="margin-bottom: 20px">
                                        <b>{{$recipe->name}}</b></h4>
                                    <p class="group inner list-group-item-text" style="margin-bottom: 20px">
                                        {{$recipe->description}}
                                    </p>
                                    <div class="row">
                                        <div class="related-line-separator-account">

                                        </div>
                                        <div class="info">
                                            <div class="related-info-separator">
                                                &nbsp;&nbsp;<span
                                                        class="fa fa-user"></span> {{Auth::user()->present()->fullname}}
                                            </div>
                                            <div class="related-info-separator">
                                                <span class="fa fa-calendar"> {{$recipe->created_at->toFormattedDateString()}}</span>
                                            </div>
                                            <span class="fa fa-star related-last-info"> 112312</span>
                                        </div>
                                        <div class="related-line-separator-account">

                                        </div>
                                        <div class="col-xs-4">
                                            <div class="related-bottom-info-separator">
                                                <center><i class="fa fa-tasks" style="font-size: 14px"></i><br>
                                                    {{count($recipe)}}<br>
                                                    Quantity
                                                </center>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="related-bottom-info-separator-eye">
                                                <center><i class="fa fa-eye" style="font-size: 16px;"></i><br>

                                                    200<br>
                                                    View
                                                </center>
                                            </div>
                                        </div>
                                        <div class="col-xs-4">
                                            <div class="related-bottom-last-info">
                                                <center><i class="fa fa-comments"></i><br>{{count($recipe)}}<br>Comments
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif

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

        $("input:checkbox").change(function () {
            var $this = $(this);

            if ($this.is(":checked")) {
                $('#buy-ingredient').removeClass('disabled');
            } else {
                $('#buy-ingredient').addClass('disabled');
            }

        });

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


    </script>
@stop