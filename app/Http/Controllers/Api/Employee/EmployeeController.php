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
        //Get page size
        if(!is_null(Input::get('page_size')))
            $pageSize = Input::get('page_size');
        else $pageSize = 10;

        //Sorting
        if($sort == 'catalog')
            if($type == 'desc')
                $employees = MacroRegionResource::collection(MacroRegion::orderByDesc('id')->paginate($pageSize));
            else
                $employees = MacroRegionResource::collection(MacroRegion::orderBy('id')->paginate($pageSize));
        else
            if($type == 'desc')
                $employees = new EmployeeCollection(Employee::orderByDesc('id')->paginate($pageSize));
            else
                $employees = new EmployeeCollection(Employee::orderBy('id')->paginate($pageSize));

        return $employees;
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }
}
