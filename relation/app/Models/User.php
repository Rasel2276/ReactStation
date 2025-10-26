<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class User extends Authenticatable
{
    protected $fillable = ['employee_id', 'name'];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
