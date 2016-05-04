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


/*
 * Post Request
 */
Route::post('forgot', 'AjaxController@forgotPassword');
Route::post('login', 'AjaxController@postLogin');
Route::post('register', 'AjaxController@postRegister');
    Route::post('addrecipe','AjaxController@addRecipe');
    Route::post('changeprofilephoto','AjaxController@changeProfilePhoto');


/*
 * Get Request
 */
Route::get('/', function () {
    return view('index');
});
Route::get('account', 'AccountController@getAccountPage');
Route::get('recipeoftheday', 'AjaxController@recipeOfTheDay');
Route::get('register/{token}', 'Auth\AuthController@confirmToken');
Route::get('logout', 'Auth\AuthController@logout');

