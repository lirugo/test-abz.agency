<?php

namespace App\Models\GEO;

use App\Models\Employee\Employee;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'geo_departments';

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function employees(){
        return $this->hasMany(Employee::class, 'department_id');
    }
}
