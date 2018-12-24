<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('workposition') as $key => $value) {
            DB::table('work_positions')->insert([
                'name' => $key,
                'display_name' => $value,
            ]);
        }
    }
}
