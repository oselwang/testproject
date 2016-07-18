@extends('layout')
@section('style')
    <link href="{{asset('css/account.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{asset('css/recipe.css')}}" rel="stylesheet" type="text/css" media="all">

@stop
@section('content')
    <div class="row" style="margin:0">
        <div class="col-md-12 col-sm-12 col-sx-12" style="padding: 0">
            <div class="current-profile">
                <div class="recipe-bg recipe-cover-photo">
                    <div class="recipe-title-container">
                        <div class="recipe-title">
                            {{$recipe->name}} - <a
                                    href="{{url('account/'.$user->present()->accountname)}}">{{$recipe->owner($recipe)}}</a>
                        </div>
                        <div class="recipe-description">
                            {{$recipe->description}}
                        </div>
                        <div class="description-separator">
                        </div>
                        <div class="miscellaneous-recipe-info">
                            RATINGS :
                            @if($rating != null)
                                {{$rating}}  / 5
                            @else
                                0
                            @endif&nbsp;&nbsp;&nbsp;&nbsp;
                            POSTED :
                            {{$recipe->created_at->toFormattedDateString()}}
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            REVIEWS :
                            {{count($reviews)}}
                            <div class="print-recipe-btn">
                                <button class="btn btn-primary"><i class="fa fa-print"> Print Ingredients & Recipe</i>
                                </button>
                            </div>
                        </div>
                    </div>
                    @if($user->own($recipe))
                        <div class="upload-file-container fa fa-camera">
                            <form method="post" action="{{url('change-recipe-profile-photo')}}"
                                  id="change-profile-photo-form">
                                <input type="file" name="profilephoto" style="width: 10px"
                                       accept="image/png, image/jpeg, image/gif">
                            </form>
                        </div>
                    @endif
                    <img src="{{asset($recipe->photo_name)}}"
                         class="recipe-pic" id="profile-photo">
                </div>
            </div>
        </div>
    </div>
    <div class="" style="background-color: #333333">
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


    <div class="recipe-all-info">
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
        <div class="row" style="margin-right: 0;!important;">
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
            <div class="col-md-7">
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
        <div class="row" style="margin-right: 0 !important;">
            <div>
                <div class="review-title" id="review-scroll">
                    REVIEWS
                    <div class="review-title-separator"></div>
                </div>
                <div class="review-user-text-container">
                    @if(!Auth::check() || !Auth::user()->own($recipe))
                        <div class="col-md-1">
                            <div class="review-user-photo">
                                <img src="@if(!Auth::check()) {{asset('images/blank-person.png')}}
                                @elseif(empty(Auth::user()->getProfilePhoto())) {{asset('images/blank-person.png')}}
                                @else {{asset($user->getProfilePhoto())}} @endif" class="user-pic" id="profile-photo">
                            </div>
                        </div>

                        @if(!Auth::check())
                            <div class="review-user-text">
                                <a href="#" data-toggle="modal" data-target='#login-modal'>
                                <span class="btn btn-default btn-arrow-left"
                                      style="width: 20%">Submit your review</span>
                                </a>
                            </div>
                        @elseif(!Auth::user()->own($recipe))
                            @if(Auth::user()->submittedReviewOn($recipe))

                                {{--*/ $user_review = Auth::user()->getReviewOn($recipe) /*--}}
                                @include('partial.editreviewmodal')
                                <div class="col-md-10" id="user-review">
                                    <div class="user-review-edit hidden" id="user-review-hover">
                                        <a href="#" data-toggle="modal" data-target="#edit-review-modal"><span
                                                    class="fa fa-edit"></span></a>
                                    </div>
                                    <div class="user-review-info">

                                        <div class="user-review-name">
                                            <b>{{$user_review->getUserFullName()}}</b> -
                                            <o style="font-size: 12px;">{{$user_review->created_at->diffForHumans()}}</o>
                                            <div class="reviewer-rating">
                                                @if($user_review->rating == 1)
                                                    <span class="fa fa-star"></span><span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span><span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($user_review->rating == 2)
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span class="fa fa-star-o"></span><span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($user_review->rating == 3)
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span><span class="fa fa-star-o"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @elseif($user_review->rating == 4)
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span class="fa fa-star-o"></span>
                                                @else
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span class="fa fa-star"></span>
                                                @endif
                                            </div>
                                            <div class="user-review">
                                                {{$user_review->review}}
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <div class="review-user-text">
                                            <a href="#" data-toggle="modal" data-target='#review-modal'>
                                <span class="btn btn-default btn-arrow-left"
                                      style="width: 20%">Submit your review</span>
                                            </a>
                                        </div>
                                    @endif
                                    @endif
                                </div>
                            @endif


                </div>
                <div class="col-md-8 col-md-offset-2">
                    <button class="review-info-btn review-info-btn-active" id="helpful">Helpful</button>
                    <button class="review-info-btn" id="positive">Positive</button>
                    <button class="review-info-btn" id="least-positive">Least Positive</button>
                    <button class="review-info-btn" id="newest">Newest</button>
                    <input type="hidden" value="{{$recipe->id}}" id="recipe-id">

                    <div class="row hidden" id="review-positive">

                    </div>
                    <div class="row hidden" id="review-least-positive">
                    </div>
                    <div class="row hidden" id="review-newest">
                    </div>
                    <button class='btn btn-default show-more-button hidden' id='show-more-positive'>Show More</button>
                    <button class='btn btn-default show-more-button hidden' id='show-more-least-positive'>Show More
                    </button>
                    <button class='btn btn-default show-more-button hidden' id='show-more-newest'>Show More</button>
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw review-spinner hidden" id="review-spin"></i>
                    <div id="review-helpful">
                        @foreach($reviews as $review)
                            <div class="row">
                                <div class="col-md-1">
                                    <div class="reviewer-user-photo">
                                        <img src="@if(empty($review->getUserProfilePhoto())) {{asset('images/blank-person.png')}}
                                        @else {{asset($review->getUserProfilePhoto())}} @endif" class="user-pic"
                                             id="profile-photo">
                                    </div>
                                </div>
                                <div class="col-md-11" style="padding-left: 0 !important;">
                                    <div class="reviewer-info">
                                        <div class="reviewer-name">
                                            <b>{{$review->getUserFullName()}}</b> -
                                            <o style="font-size: 12px;">{{$review->created_at->diffForHumans()}}</o>
                                            <div class="reviewer-rating">
                                                @if($review->rating == 1)
                                                    <span class="fa fa-star"></span><span class="fa fa-star-o"></span>
                                                    <span
                                                            class="fa fa-star-o"></span><span
                                                            class="fa fa-star-o"></span>
                                                    <span
                                                            class="fa fa-star-o"></span>
                                                @elseif($review->rating == 2)
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span
                                                            class="fa fa-star-o"></span><span
                                                            class="fa fa-star-o"></span>
                                                    <span
                                                            class="fa fa-star-o"></span>
                                                @elseif($review->rating == 3)
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span
                                                            class="fa fa-star"></span><span class="fa fa-star-o"></span>
                                                    <span
                                                            class="fa fa-star-o"></span>
                                                @elseif($review->rating == 4)
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span
                                                            class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span
                                                            class="fa fa-star-o"></span>
                                                @else
                                                    <span class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span
                                                            class="fa fa-star"></span><span class="fa fa-star"></span>
                                                    <span
                                                            class="fa fa-star"></span>
                                                @endif
                                            </div>
                                            <div class="reviewer-review">
                                                {{$review->review}}
                                            </div>
                                            <div>
                                                @if(!Auth::check())
                                                    <a href="#" class="review-helpful" data-toggle="modal"
                                                       data-target="#login-modal"><span
                                                                class="fa fa-thumbs-o-up"></span> This is helpful</a>
                                                @else

                                                    <div id="review-helpful-container">
                                                        @if(!$review->ownBy(Auth::user()->id))
                                                            @if($review->isAlreadyLiked())
                                                                <a href="{{$review->id}}" class="review-helpful-clicked"
                                                                   id="review-helpful{{$review->id}}"><span
                                                                            class="fa fa-thumbs-o-up"></span> {{$review->helpful}}
                                                                    This is
                                                                    helpful</a>
                                                            @else
                                                                <a href="{{$review->id}}" class="review-helpful"
                                                                   id="review-helpful{{$review->id}}"><span
                                                                            class="fa fa-thumbs-o-up"></span> {{$review->helpful != 0 ? $review->helpful : '' }}
                                                                    This is
                                                                    helpful</a>
                                                            @endif
                                                        @else
                                                            <div class="review-helpful-clicked"><span
                                                                        class="fa fa-thumbs-o-up"></span> {{$review->helpful}}
                                                                This is
                                                                helpful</div>
                                                        @endif
                                                    </div>

                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
                <div class="row" style="margin-right: 0 !important;">
                    @foreach($related_recipes as $recipe)
                        <a href="{{url('recipe/'.$recipe->slug)}}" style="text-decoration: none;color:black;">
                            <div class="related-item  col-xs-3 col-lg-3">
                                <div class="related-thumbnail">
                                    <img src="{{url($recipe->photo_name)}}" alt=""/>
                                    <div class="caption">
                                        <h4 style="margin-bottom: 20px">
                                            <b>{{$recipe->name}}</b></h4>
                                        <div class="row">
                                            <div class="related-line-separator-account">

                                            </div>
                                            <div class="info" style="padding: 0.5em">
                                                <div class="related-info-separator">
                                                    &nbsp;&nbsp;
                                                    <o style="margin-left: 20px"><span
                                                                class="fa fa-user"></span> {{$user->present()->fullname}}
                                                    </o>
                                                </div>
                                                <span class="fa fa-calendar"> {{$recipe->created_at->toFormattedDateString()}}</span>
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
        @include('partial.reviewmodal')
        <script src="{{asset('js/recipe.js')}}"></script>

@stop