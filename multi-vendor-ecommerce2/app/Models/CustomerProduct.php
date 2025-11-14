<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerProduct extends Model
{
    use HasFactory;

    protected $table = 'customer_products';

    protected $fillable = [
        'vendor_stock_id',
        'product_id',
        'vendor_id',
        'price',
        'quantity',
        'details',
        'image',
        'status',
    ];

    // ❌ Disable default timestamps
    public $timestamps = false;

    public function vendorStock()
    {
        return $this->belongsTo(\App\Models\VendorStock::class, 'vendor_stock_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }

    public function vendor()
    {
        return $this->belongsTo(\App\Models\User::class, 'vendor_id');
    }
}
