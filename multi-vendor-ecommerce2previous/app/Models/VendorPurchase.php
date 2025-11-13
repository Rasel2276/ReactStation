<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorPurchase extends Model
{
    protected $fillable = [
        'vendor_id',
        'admin_stock_id',
        'quantity',
        'price',
        'status'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class,'vendor_id');
    }

    public function adminStock()
    {
        return $this->belongsTo(AdminStock::class,'admin_stock_id');
    }
}

