<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
          'id' => $this->id,
          'name' => $this->name->first.' '.$this->name->middle.' '.$this->name->last,
          'department' => $this->department->name,
          'city' => $this->department->city->name,
          'email' => $this->email,
          'salary' => $this->getTotalSalary(),
          'employment_date' => $this->employment_date,
          'staff_positions' => $this->arrayStaffPositions(),
          'boss_id' => $this->boss_id,
        ];
    }
}
