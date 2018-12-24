<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class LastName extends Model
{
    protected $table = 'user_last_names';

    protected $guarded = ['id'];
}
