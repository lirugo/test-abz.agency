<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\GEO\MacroRegionResource;
use App\Models\Employee\Employee;
use App\Models\GEO\MacroRegion;

class EmployeeController extends Controller
{
    public function employees(){
        //Show macro regions tree
        return MacroRegionResource::collection(MacroRegion::all());
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }
}
