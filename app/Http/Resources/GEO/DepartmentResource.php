<?php

namespace App\Http\Resources\GEO;

use App\Http\Resources\Employee\EmployeeCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class DepartmentResource extends JsonResource
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
            'name' => $this->name,
            'employees' => new EmployeeCollection($this->employees)
        ];
    }
}
