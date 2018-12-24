<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class FirstName extends Model
{
    protected $table = 'user_first_names';

    protected $guarded = ['id'];
}
