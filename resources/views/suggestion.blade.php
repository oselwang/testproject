@extends('layout')

@section('style')
    <link href="{{asset('css/suggestion.css')}}" rel="stylesheet" type="text/css" media="all">


@stop

@section('content')
    <div class="container">

        <!-- Easy -->
        <div class="info-title">
            Easy
        </div>
        <div class="horizontal-scroll-container" id="easy-scroll">
            <div class="prev hidden" id="prev-easy">
                <a class="fa fa-arrow-left" id="btn-left-easy"></a>
            </div>
            <div class="next hidden" id="next-easy">
                <a class="fa fa-arrow-right" id="btn-right-easy"></a>
            </div>
            <div class="wrapper" id="easy-wrapper"
                 style="width: @if(count($recipes) <= 4) 1000px @elseif(count($recipes) <= 10) 2500px @endif;">
                <div id="products" class="row list-group">
                    @foreach($recipes as $recipe)
                        <a href="{{url('recipe/' . $recipe->slug)}}" style="text-decoration: none;color:black;">
                            <div class="item  col-xs-5 col-lg-5">
                                <div class="thumbnail">
                                    <img class="group list-group-image" src="{{$recipe->photo_name}}" alt=""/>
                                    <div class="caption">
                                        <h4 class="= list-group-item-heading" style="margin-bottom: 20px">
                                            <b>{{$recipe->name}}</b></h4>
                                        <div class="row">
                                            <div class="line-separator-account">

                                            </div>
                                            <div class="info">
                                                <div class="info-separator">
                                                    <center style="margin-left: 20px"><span
                                                                class="fa fa-user"></span> {{Auth::user()->present()->fullname}}
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
                </div>
            </div>
        </div>

        <!-- Medium -->
        <div class="info-title">
            Medium
        </div>
        <div class="horizontal-scroll-container" id="medium-scroll">
            <div class="prev-medium hidden" id="prev-medium">
                <a class="fa fa-arrow-left" id="btn-left-medium"></a>
            </div>
            <div class="next-medium hidden" id="next-medium">
                <a class="fa fa-arrow-right" id="btn-right-medium"></a>
            </div>
            <div class="wrapper" id="medium-wrapper"
                 style="width: @if(count($recipes) <= 4) 1000px @elseif(count($recipes) <= 10) 2500px @endif;">
                <div id="products" class="row list-group">
                    @foreach($recipes as $recipe)
                        <a href="{{url('recipe/' . $recipe->slug)}}" style="text-decoration: none;color:black;">
                            <div class="item  col-xs-5 col-lg-5">
                                <div class="thumbnail">
                                    <img class="group list-group-image" src="{{$recipe->photo_name}}" alt=""/>
                                    <div class="caption">
                                        <h4 class="= list-group-item-heading" style="margin-bottom: 20px">
                                            <b>{{$recipe->name}}</b></h4>
                                        <div class="row">
                                            <div class="line-separator-account">

                                            </div>
                                            <div class="info">
                                                <div class="info-separator">
                                                    <center><span
                                                                class="fa fa-user"></span> {{Auth::user()->present()->fullname}}
                                                    </center>
                                                </div>
                                                <div class="info-separator">
                                                    <span class="fa fa-calendar"> {{$recipe->created_at->toFormattedDateString()}}</span>
                                                </div>
                                                <span class="fa fa-star last-info"> 112312</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Hard -->
        <div class="info-title">
            Hard
        </div>
        <div class="horizontal-scroll-container" id="hard-scroll">
            <div class="prev-hard hidden" id="prev-hard">
                <a class="fa fa-arrow-left" id="btn-left-hard"></a>
            </div>
            <div class="next-hard hidden" id="next-hard">
                <a class="fa fa-arrow-right" id="btn-right-hard"></a>
            </div>
            <div class="wrapper" id="hard-wrapper"
                 style="width: @if(count($recipes) <= 4) 1000px @elseif(count($recipes) <= 10) 2500px @endif;">
                <div id="products" class="row list-group">
                    @foreach($recipes as $recipe)
                        <a href="{{url('recipe/' . $recipe->slug)}}" style="text-decoration: none;color:black;">
                            <div class="item  col-xs-5 col-lg-5">
                                <div class="thumbnail">
                                    <img class="group list-group-image" src="{{$recipe->photo_name}}" alt=""/>
                                    <div class="caption">
                                        <h4 class="= list-group-item-heading" style="margin-bottom: 20px">
                                            <b>{{$recipe->name}}</b></h4>
                                        <div class="row">
                                            <div class="line-separator-account">

                                            </div>
                                            <div class="info">
                                                <div class="info-separator">
                                                    <center><span
                                                                class="fa fa-user"></span> {{Auth::user()->present()->fullname}}
                                                    </center>
                                                </div>
                                                <div class="info-separator">
                                                    <span class="fa fa-calendar"> {{$recipe->created_at->toFormattedDateString()}}</span>
                                                </div>
                                                <span class="fa fa-star last-info"> 112312</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>



    </div>

    <script src="{{asset('js/suggestion.js')}}"></script>
@stop