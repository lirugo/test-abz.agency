<?php

namespace App\Models\GEO;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'geo_departments';

    public function city(){
        return $this->belongsTo(City::class);
    }
}
