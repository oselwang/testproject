<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('index');
});

Route::get('recipeoftheday', 'AjaxController@recipeOfTheDay');

Route::post('register','AjaxController@postRegister');
Route::get('register/{token}','Auth\AuthController@confirmToken');
Route::get('logout','Auth\AuthController@logout');

Route::get('event',function(){
    return view('index');
});

