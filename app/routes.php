<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/',[
	'as' => 'frontpage',
	'uses' => 'PageController@pageFrontpage',
]);

Route::post('/', [
	'as' => 'poemFormSubmit',
	'uses' => 'PoemController@formSubmit',
]);

Route::get('/les',[
    'as' => 'randomPoem',
    'uses' => 'PageController@pageRandomPoem',
]);