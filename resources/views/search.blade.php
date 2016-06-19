@extends('layout')

@section('style')
    <link href="{{asset('css/search.css')}}" rel="stylesheet" media="all" type="text/css">
    <link href="{{asset('css/suggestion.css')}}" rel="stylesheet" media="all" type="text/css">
@stop
@section('content')
    @if($hits == null)
        <div class="search-not-found-container">
            "No recipe found for this term "{{$search}}"
        </div>
        <div class="try-popular">
            Search again or try one of our popular searches for this month:
        </div>
    @else
        <div class="recipe-found-container">
            <div class="count-recipe-found">
                {{count($hits)}} results for <b>{{$search}}</b>

            </div>
            <div id="products" class="row list-group">
                @for($i = 0;$i < count($hits);$i++)

                    <a href="{{url('recipe/' . $hits[$i]['_source']['slug'])}}" style="text-decoration: none;color:black;">
                        <div class="item  col-xs-3 col-lg-3">
                            <div class="thumbnail">
                                <img class="group list-group-image" src="{{$hits[$i]['_source']['photo_name']}}" alt=""/>
                                <div class="caption">
                                    <h4 class="= list-group-item-heading" style="margin-bottom: 20px">
                                        <b>{{$hits[$i]['_source']['name']}}</b></h4>
                                    <div class="row">
                                        <div class="line-separator-account">

                                        </div>
                                        <div class="info">
                                            <div class="info-separator">
                                                <center><span
                                                            class="fa fa-user"></span>osel wang
                                                </center>
                                            </div>
                                            <div class="info-separator">
                                                <span class="fa fa-calendar"></span>asdadasdasa
                                            </div>
                                            <span class="fa fa-star last-info"> 112312</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                @endfor
            </div>
        </div>


    @endif
@stop