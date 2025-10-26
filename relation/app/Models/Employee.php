<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name'];

   
    public function clients()
    {
        return $this->hasManyThrough(
            Client::class, 
            User::class,   
            'employee_id', 
            'user_id',     
            'id',         
            'id'           
        );
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}

