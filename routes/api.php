<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Users
Route::get('users', 'Api\User\UserController@index');
Route::get('users/{user}', 'Api\User\UserController@show');
Route::post('users', 'Api\User\UserController@store');
Route::put('users/{user}', 'Api\User\UserController@update');
Route::delete('users/{user}', 'Api\User\UserController@delete');