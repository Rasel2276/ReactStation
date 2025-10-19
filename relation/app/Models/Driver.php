<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }
}
