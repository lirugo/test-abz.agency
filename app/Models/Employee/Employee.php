<?php

namespace App\Models\Employee;

use App\Models\GEO\Department;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Employee extends Model
{
    use Searchable;

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return [
            'name' => $this->name->first.' '.$this->name->middle.' '.$this->name->last,
            'department' => $this->department->name,
            'city' => $this->department->city->name,
            'email' => $this->email,
            'salary' => $this->getTotalSalary(),
            'employment_date' => $this->employment_date,
            'staff_positions' => $this->arrayStaffPositions(),
        ];
    }

    public function name()
    {
        return $this->hasOne(Name::class);
    }

    public function staffPositions(){
        return $this->belongsToMany(StaffPosition::class, 'employee_has_staff_positions', 'employee_id', 'position_id');
    }

    public function boss(){
        return $this->hasOne(Employee::class, 'boss_id', 'id');
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    /**
     * Get total salary for employee
     * @return int
     */
    public function getTotalSalary(){
        $salary = 0;
        //Count salary from all staff position
        foreach ($this->staffPositions as $position)
            $salary += $position->salary($this->department_id);

        //Add employee unique salary
        $salary += $this->salary;
        return $salary;
    }

    /**
     * Get array with staff positions for employee
     * @return array
     */
    public function arrayStaffPositions(){
        $staffPositions = [];
        foreach ($this->staffPositions as $position)
            array_push($staffPositions, $position->name);
        return $staffPositions;
    }
}
