<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('geo') as $regionKey => $region){
            //Macro Regions
            DB::table('geo_macro_regions')->insert([
                'name' => $region['name'],
                'slug' => $regionKey,
            ]);
            $mrgId = DB::getPdo()->lastInsertId();
            //Countries
            foreach ($region['countries'] as $countryKey => $country){
                DB::table('geo_countries')->insert([
                    'macro_region_id' => $mrgId,
                    'name' => $country['name'],
                    'slug' => $countryKey,
                ]);
                $cntrId = DB::getPdo()->lastInsertId();
                //Cities
                foreach ($country['cities'] as $cityKey => $city){
                    DB::table('geo_cities')->insert([
                        'country_id' => $cntrId,
                        'name' => $city['name'],
                        'slug' => $cityKey,
                    ]);
                    $dpId = DB::getPdo()->lastInsertId();
                    //Department
                    foreach ($city['departments'] as $departmentKey => $department){
                        DB::table('geo_departments')->insert([
                            'city_id' => $dpId,
                            'name' => $department,
                            'slug' => $departmentKey,
                        ]);
                    }
                }
            }
        }
    }
}
