<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Boss extends Model
{
    protected $table = 'user_bosses';

    protected $guarded = ['id'];
}
