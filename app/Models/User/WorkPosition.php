<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class WorkPosition extends Model
{
    protected $table = 'user_work_positions';

    protected $guarded = ['id'];
}
