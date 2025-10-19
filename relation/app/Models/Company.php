<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    // HasManyThrough: Company থেকে সরাসরি Bus
    public function buses()
    {
        return $this->hasManyThrough(
            Bus::class,    // Final model
            Driver::class, // Intermediate model
            'company_id',  // Foreign key on drivers table
            'driver_id',   // Foreign key on buses table
            'id',          // Local key on companies table
            'id'           // Local key on drivers table
        );
    }
    
    public function drivers()
    {
        return $this->hasMany(Driver::class);
    }
}

