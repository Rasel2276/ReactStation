<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{

    public function user()
    {
        return $this->hasManyThrough(User::class,Post::class);
       
    }

}

