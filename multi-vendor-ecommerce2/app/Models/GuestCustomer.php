<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestCustomer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name','last_name','email','phone','company_name',
        'country','street_address','street_address2','city','state',
        'postcode','order_notes'
    ];

    // Relation to order items through orders
    public function orderItems()
    {
        return $this->hasManyThrough(
            CustomerOrderItem::class,
            CustomerOrder::class,
            'guest_id',       // Foreign key on CustomerOrder
            'order_id',       // Foreign key on CustomerOrderItem
            'id',             // Local key on GuestCustomer
            'id'              // Local key on CustomerOrder
        );
    }
}


