<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

//Employees
Route::get('/employees', 'Api\Employee\EmployeeController@employees');
Route::get('/employees/{employee}', 'Api\Employee\EmployeeController@show');