<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPurchase extends Model
{
    protected $fillable = [
        'admin_id',
        'supplier_id',
        'product_id',
        'quantity',
        'purchase_price',
        'vendor_sale_price',
        'status',
        'payment_method',
        'total'
    ];

    // RELATIONSHIP
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}

