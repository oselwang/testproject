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
Route::post('recipe/buy-ingredient', 'RecipeController@buyIngredient');
Route::post('headline', 'AccountController@editHeadline');
Route::post('suggest-search', 'AjaxController@suggestSearch');
    Route::post('review','AjaxController@addReview');



/*
 * Get Request
 */
Route::get('/', 'LandingPageController@index');
Route::get('suggestion', 'RecipeController@suggestion');
Route::get('recipes', 'LandingPageController@allRecipe');
Route::get('recipe/{slug}', 'RecipeController@showRecipe');
Route::get('auth/facebook', 'Auth\SocialLoginController@redirectFacebook');
Route::get('auth/facebook/callback', 'Auth\SocialLoginController@facebookCallback');
Route::get('recipeoftheday', 'AjaxController@recipeOfTheDay');
Route::get('register/{token}', 'Auth\AuthController@confirmToken');
Route::get('logout', 'Auth\AuthController@logout');
Route::get('user/cover-photo', 'AccountController@getCoverPhoto');
Route::get('search', 'SearchController@show');
Route::get('account/{accountname}','AccountController@showAccountPage');
    Route::get('review/positive/{recipe_id}','ReviewController@getPositive');
Route::get('review/least-positive/{recipe_id}','ReviewController@getLeastPositive');
Route::get('review/newest/{recipe_id}','ReviewController@getNewest');

Route::get('mapping', function () {
    $client = \Elasticsearch\ClientBuilder::create()
        ->setHosts([ 'http://localhost:9200' ])
        ->build();

    $paramsdel = [
        'index' => 'recipe',
    ];
    $params = [
        'index' => 'recipe',
        'body'  => [
            'settings' => [
                'number_of_shards'   => 1,
                'number_of_replicas' => 0,
                "analysis"           => [
                    "analyzer"        => [
                        "ngram_analyzer" => [
                            "type"      => "custom",
                            "tokenizer" => "mynGram"
                        ]
                    ],
                    "search_analyzer" => [
                        "my_search_analyzer" => [
                            "type"      => "custom",
                            "tokenizer" => "mynGram",
                        ]
                    ],
                    "tokenizer"       => [
                        "mynGram" => [
                            "type"     => "nGram",
                            "min_gram" => 2,
                            "max_gram" => 5
                        ]
                    ]
                ]
            ],
            'mappings' => [
                'recipe' => [
                    'properties' => [
                        'name'        => [
                            'type'     => 'string',
                            'analyzer' => 'ngram_analyzer'
                        ],
                        'description' => [
                            'type'     => 'string',
                            'analyzer' => 'ngram_analyzer'
                        ],
                        'difficulty'  => [
                            'type'     => 'string',
                            'analyzer' => 'ngram_analyzer'
                        ],
                        "timestamp"   => [
                            "type"   => "date",
                            "format" => "yyyy-MM-dd HH=>mm=>ss.SSS",
                        ]
                    ],
                ]
            ],
        ]
    ];
    $client->indices()->delete($paramsdel);

    $client->indices()->create($params);
});

