<?php

use App\Models\User\Boss;
use App\Models\User\FirstName;
use App\Models\User\LastName;
use App\Models\User\Salary;
use App\Models\User\User;
use App\Models\User\WorkPosition;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Generate users
        factory(User::class, 10)->create()->each(function ($user) {
            //Generate salary for that users
            $user->salary()->save(factory(Salary::class)->create([
                'user_id' => $user,
            ]));
            //Generate first name
            $user->firstName()->save(factory(FirstName::class)->create([
                'user_id' => $user,
            ]));
            //Generate last name
            $user->lastName()->save(factory(LastName::class)->create([
                'user_id' => $user,
            ]));
            //Generate work position
            $user->workPosition()->save(factory(WorkPosition::class)->create([
                'user_id' => $user,
            ]));
            //Generate boss
            $user->boss()->save(factory(Boss::class)->create([
                'user_id' => $user,
            ]));
        });;
    }
}
