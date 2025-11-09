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

    // ✅ CATEGORY RELATION
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id');
    }

    // ✅ SUBCATEGORY RELATION
    public function subcategory()
    {
        return $this->belongsTo(\App\Models\SubCategory::class, 'subcategory_id');
    }

    // ✅ SUPPLIER RELATION
    public function supplier()
    {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id');
    }

    // ✅ PURCHASE RELATION (1 Product → Many Purchases)
    public function purchases()
    {
        return $this->hasMany(\App\Models\AdminPurchase::class, 'product_id');
    }

    // ✅ STOCK RELATION (1 Product → 1 Stock Row)
    public function stock()
    {
        return $this->hasOne(\App\Models\AdminStock::class, 'product_id');
    }
}


