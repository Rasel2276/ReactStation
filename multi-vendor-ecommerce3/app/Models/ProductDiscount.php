<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductDiscount extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'discount_for',
        'discount_type',
        'discount_value',
        'start_date',
        'end_date',
        'status',
    ];

    // Relation with Product
    public function product(){
        return $this->belongsTo(Product::class);
    }
}

