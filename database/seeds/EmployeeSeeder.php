<?php

use App\Models\Employee\Employee;
use App\Models\Employee\Name;
use App\Models\Employee\StaffPosition;
use App\Models\GEO\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $NUMBER_EMPLOYEES = (integer) env('NUMBER_EMPLOYEES_SEEDER', 50000);

        //Employee
        factory(Employee::class, $NUMBER_EMPLOYEES)->create()->each(function ($employee) {
            //Set boss
            $employee->boss_id = rand(1, Employee::count());
            $employee->save();
            //Generate name
            $employee->name()->save(factory(Name::class)->create([
                'employee_id' => $employee,
            ]));
        });

        //Add staff position
        for($i = 1; $i <= Employee::count(); $i++)
            DB::table('employee_has_staff_positions')->insert([
                'position_id' => rand(1, count(config('staffpositions'))),
                'employee_id' => $i,
            ]);

        //Add salaries for each department each staff position
        for($i = 1; $i<= Department::count(); $i++)
            for($j = 1; $j<= StaffPosition::count(); $j++)
                DB::table('employee_salaries')->insert([
                    'position_id' => $j,
                    'department_id' => $i,
                    'salary' => mt_rand(ceil(1000/100) , floor(20000/100))*100,
                ]);

    }
}
