<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'supplier_id',
        'product_id',
        'quantity',
        'purchase_price',
        'status',
    ];

    public function supplier(){
        return $this->belongsTo(\App\Models\Supplier::class);
    }

    public function product(){
        return $this->belongsTo(\App\Models\Product::class);
    }

    public function admin(){
        return $this->belongsTo(\App\Models\User::class,'admin_id');
    }
}

