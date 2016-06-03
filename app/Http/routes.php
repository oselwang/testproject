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
Route::post('addrecipe', 'AjaxController@addRecipe');
Route::post('change-profile-photo', 'AjaxController@changeProfilePhoto');
Route::post('change-cover-photo', 'AjaxController@changeCoverPhoto');
    Route::post('change-recipe-profile-photo', 'AjaxController@changeRecipeProfilePhoto');
    Route::post('change-recipe-cover-photo', 'AjaxController@changeRecipeCoverPhoto');
    Route::post('recipe/buy-ingredient','RecipeController@buyIngredient');
Route::post('headline', 'AccountController@editHeadline');


/*
 * Get Request
 */
Route::get('/', 'LandingPageController@index');
Route::get('recipe/{slug}', 'RecipeController@showRecipe');
Route::get('auth/facebook', 'Auth\SocialLoginController@redirectFacebook');
Route::get('auth/facebook/callback', 'Auth\SocialLoginController@facebookCallback');
Route::get('account', 'AccountController@getAccountPage');
Route::get('recipeoftheday', 'AjaxController@recipeOfTheDay');
Route::get('register/{token}', 'Auth\AuthController@confirmToken');
Route::get('logout', 'Auth\AuthController@logout');
Route::get('user/cover-photo','AccountController@getCoverPhoto');

