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
        $sortBy = is_null(Input::get('sortBy')) ? 'first_name' : Input::get('sortBy');
        $descending = Input::get('descending') == 'true' ? 'DESC' : 'ASC';

        //Sorting
        $employees = Employee::
                        join('employee_names', 'employees.id', '=', 'employee_names.employee_id')
                        ->join('geo_departments', 'employees.department_id', '=', 'geo_departments.id')
                        ->join('geo_cities', 'geo_departments.city_id', '=', 'geo_cities.id')
                        ->join('employee_has_staff_positions', 'employees.id', '=', 'employee_has_staff_positions.employee_id')
                        ->join('employee_staff_positions', 'employee_has_staff_positions.position_id', '=', 'employee_staff_positions.id')
                        ->join('employee_salaries', function($join)
                        {
                            $join->on('employee_salaries.position_id', '=',  'employee_has_staff_positions.position_id');
                            $join->on('employee_salaries.department_id', '=', 'employees.department_id');
                        })
                        ->select(
                            'employees.*',
                            'employee_names.first as first_name',
                            'geo_departments.name as dep',
                            'geo_cities.name as city',
                            'employee_staff_positions.name as staff_positions',
                            'employee_salaries.salary as getSalary'
                        )
                        ->orderBy($sortBy, $descending)
                        ->paginate($pageSize);

        return new EmployeeCollection($employees);
    }

    public function catalog(){
        $macroRegions = MacroRegionResource::collection(MacroRegion::orderBy('id')->get());
        return $macroRegions;
    }

    public function show(Employee $employee){
        return new EmployeeResource($employee);
    }
}
