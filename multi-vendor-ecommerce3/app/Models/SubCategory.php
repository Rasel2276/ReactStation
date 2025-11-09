<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_category_id',
        'name',
        'slug',
        'description',
        'image',
        'status'
    ];

    // Relationship (optional)
    public function category(){
        return $this->belongsTo(\App\Models\Category::class, 'parent_category_id');
    }
}

