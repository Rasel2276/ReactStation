<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'guest_id',
        'subtotal',
        'shipping_cost',
        'total_payment',
        'shipping_method',
        'payment_method',
        'status'
    ];

    // Relation to order items
    public function orderItems()
    {
        return $this->hasMany(CustomerOrderItem::class,'order_id');
    }
}


