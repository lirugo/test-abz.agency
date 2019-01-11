<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Employee\EmployeeCollection;
use App\Http\Resources\Employee\EmployeeResource;
use App\Http\Resources\GEO\MacroRegionResource;
use App\Models\Employee\Employee;
use App\Models\GEO\MacroRegion;
use Illuminate\Support\Facades\Input;

class EmployeeController extends Controller
{
    public function employees(){
        //Get sort params
        $pageSize = Input::get('rowsPerPage');

        $employees = new EmployeeCollection(Employee::orderBy('id')->paginate($pageSize));

        return $employees;
    }

    public function catalog(){
        $macroRegions = MacroRegionResource::collection(MacroRegion::orderBy('id')->get());
        return $macroRegions;
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }
}
