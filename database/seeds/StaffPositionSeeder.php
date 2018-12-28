<?php

use App\Models\Employee\StaffPosition;
use Illuminate\Database\Seeder;

class StaffPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('staffpositions') as $key => $position)
            StaffPosition::create([
                'name' => $position,
                'slug' => $key,
            ]);
    }
}
