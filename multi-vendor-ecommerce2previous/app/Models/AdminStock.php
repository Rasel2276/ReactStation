<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminStock extends Model
{
    protected $table = "admin_stock";

    protected $fillable = [
        'product_id',
        'quantity',
        'purchase_price',
        'vendor_sale_price',
        'status'
    ];

    // Relation to Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Accessor for available quantity (currently same as total quantity)
    public function getAvailableQuantityAttribute()
    {
        return $this->quantity;
    }
}

