@extends('layout')

@section('style')
    <link href="{{asset('css/allrecipe.css')}}" rel="stylesheet" type="text/css" media="all">


@stop

@section('content')
    <div class="container">
        <div class="easy-title">
            Easy
        </div>
        <div class="title-separator"></div>
        <div class="horizontal-scroll-container">
            <div class="wrapper">
                <div id="products" class="row list-group">
                    <div class="arrow-left">

                    </div>
                    @foreach($recipes as $recipe)
                        <a href="recipe/{{$recipe->slug}}" style="text-decoration: none;color:black;">
                            <div class="item  col-xs-3 col-lg-3">
                                <div class="thumbnail">
                                    <img class="group list-group-image" src="{{$recipe->getProfilePhoto()}}" alt=""/>
                                    <div class="caption">
                                        <h4 class="= list-group-item-heading" style="margin-bottom: 20px">
                                            <b>{{$recipe->name}}</b></h4>
                                        <p class="group inner list-group-item-text" style="margin-bottom: 20px">
                                            {{$recipe->description}}
                                        </p>
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
@stop