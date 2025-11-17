<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','customer_product_id','quantity','price'
    ];

    // Relation to order
    public function order()
    {
        return $this->belongsTo(CustomerOrder::class,'order_id');
    }

    // Relation to product
    public function customerProduct()
    {
        return $this->belongsTo(CustomerProduct::class, 'customer_product_id');
    }
}

