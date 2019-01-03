<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee\Employee;

class EmployeeController extends Controller
{
    public function employees(){
        return new EmployeeCollection(Employee::all());
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }
}
