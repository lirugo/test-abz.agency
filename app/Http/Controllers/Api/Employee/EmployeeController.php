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
        $sort = Input::get('sort');
        $type = Input::get('type');

        //Sorting
        if($sort == 'catalog')
            if($type == 'desc')
                $employees = MacroRegionResource::collection(MacroRegion::orderByDesc('id')->paginate(10));
            else
                $employees = MacroRegionResource::collection(MacroRegion::orderBy('id')->paginate(10));
        else
            if($type == 'desc')
                $employees = new EmployeeCollection(Employee::orderByDesc('id')->paginate(10));
            else
                $employees = new EmployeeCollection(Employee::orderBy('id')->paginate(10));

        return $employees;
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }
}
