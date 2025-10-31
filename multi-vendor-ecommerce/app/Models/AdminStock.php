<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class AdminStock extends Model
{
    use HasFactory;

    // Table name
    protected $table = 'admin_stock';

    // Mass assignable fields
    protected $fillable = [
        'product_id',
        'quantity',
        'vendor_price',
        'status'
    ];

    // Product relation
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
