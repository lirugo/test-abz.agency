<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = [
        'email', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function salary(){
        return $this->hasOne(Salary::class);
    }

    public function firstName(){
        return $this->hasOne(FirstName::class);
    }

    public function lastName(){
        return $this->hasOne(LastName::class);
    }

    public function workPosition(){
        return $this->hasOne(WorkPosition::class);
    }

    public function boss(){
        return $this->hasOne(Boss::class);
    }

}
