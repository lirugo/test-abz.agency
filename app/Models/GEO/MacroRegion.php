<?php

namespace App\Models\GEO;

use Illuminate\Database\Eloquent\Model;

class MacroRegion extends Model
{
    protected $table = 'geo_macro_regions';

    public function country(){
        return $this->hasMany(Country::class, 'macro_region_id');
    }
}
