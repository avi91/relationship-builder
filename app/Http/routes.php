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

Route::get('/', 'AngularController@serveApp');
Route::get('/unsupported-browser', 'AngularController@unsupported');
Route::group(['prefix' => 'api'], function(){
  Route::resource('users','UserController', ['only' => ['index','store']]);
  Route::resource('tags','TagController', ['only' => ['index','store']]);
  Route::get('relationships','RelationshipController@index');
  Route::get('relationships/{id}','RelationshipController@show');
  Route::post('relationships/add','RelationshipController@add');
  Route::get('path/{id1}/to/{id2}','RelationshipController@path');
});
