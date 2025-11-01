<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'sku',
        'category_id',
        'subcategory_id',
        'supplier_id',
        'base_price',
        'description',
        'product_image',
        'color',
        'size',
        'featured',
        'status'
    ];

    // Relations (if Category/SubCategory/Supplier models exist)
    public function category(){
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(\App\Models\SubCategory::class, 'subcategory_id');
    }

    public function supplier(){
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id');
    }
}

