<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    protected $table = 'user_salaries';

    protected $guarded = ['id'];
}
