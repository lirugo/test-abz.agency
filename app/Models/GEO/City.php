<?php

namespace App\Models\GEO;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'geo_cities';

    public function department(){
        return $this->hasMany(Department::class, 'city_id');
    }
}
