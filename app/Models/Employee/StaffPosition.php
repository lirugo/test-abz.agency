<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;

class StaffPosition extends Model
{
    protected $table = 'employee_staff_positions';
    public $timestamps = false;

    /**
     * Get salary for position and specific department
     * @param $departmentId
     * @return int
     */
    public function salary($departmentId){
        return $this->hasMany(Salary::class, 'position_id')->where('department_id', $departmentId)->first()->salary;
    }
}
