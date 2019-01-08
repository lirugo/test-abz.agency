<?php

namespace App\Models\GEO;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'geo_countries';

    public function city(){
        return $this->hasMany(City::class, 'country_id');
    }
}
