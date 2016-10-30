@extends('layout')
@section('style')
    <link href="{{asset('css/ingredient.css')}}" rel="stylesheet" type="text/css" media="all">
@stop

@section('content')
    <body>
    <div class="buyingredient-container-body">
        <div class="buyingredient-container">
            <form id="ingredient-form" method="post" action="{{url('finish-buy-ingredient')}}">
            <input id="origin-input" class="controls" type="text"
                   placeholder="Enter location" required>

            <div class="map-wrapper">
                <div id="map"></div>
            </div>

                {{csrf_field()}}
                <div class="clearfix">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-bordered table-hover table-sortable" id="tab_logic"
                               style="background-color: white">
                            <thead>
                            <tr>
                                <th class="text-center">
                                    Ingredient
                                </th>
                                <th class="text-center">
                                    Amount
                                </th>
                                <th class="text-center">
                                    Price
                                </th>
                                <th class="text-center">
                                    <a id="add_row" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Row</a>
                                </th>
                            </tr>
                            </thead>
                            <tbody id="ingredient-wrapper">
                            @foreach($ingredients as $ingredient)
                                    <tr>
                                        <td>
                                            <input id="ingredient" type="text" name='ingredient[]' placeholder='Ingredient'
                                                   value="{{$ingredient['name']}}"
                                                   class="form-control" required autocomplete="off">
                                            <div class="ingredient-suggestion-container hidden"></div>
                                        <td style="width: 42%;">
                                        </td>
                                            <input type="number" name='amount[]' placeholder='Amount' value="{{$ingredient['amount']}}"
                                                   class="form-control" style="width:80%;display: inline-block" autocomplete="off" min="1">
                                            <input type="text" value="gram" disabled class="form-control" style="width: 19%;display: inline-block"/>
                                        </td>
                                        <td>
                                            <input type="text" disabled class="form-control" >
                                        </td>
                                        <td id="remove-row">
                                            <button class='btn btn-danger glyphicon glyphicon-remove row-remove'
                                                    style="position: relative;left:20%"></button>
                                        </td>
                                    </tr>
                            @endforeach
                            </tbody>
                            <tr>
                                <td colspan="3">
                                    <button class="btn btn-success" id="buy-ingredient-button">Submit</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{asset('js/buyingredient.js')}}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCLQSziGK4NEJtJVpMS2JILAHuclqMFEDI&signed_in=true&libraries=places&region=ID&callback=initMap"
            async defer></script>
    </body>
@stop