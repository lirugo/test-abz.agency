<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Employees
Route::get('/employees', 'Api\Employee\EmployeeController@employees');
Route::get('/employees/catalog', 'Api\Employee\EmployeeController@catalog');
Route::get('/employees/{employee}', 'Api\Employee\EmployeeController@show');
