<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee\Employee;

class EmployeeController extends Controller
{
    public function employees(){
        return Employee::all();
    }

    public function show(Employee $employee){
//        $employee = Employee::find(3);
//        dd($employee->getName);
        return new EmployeeResource($employee);
    }
}
