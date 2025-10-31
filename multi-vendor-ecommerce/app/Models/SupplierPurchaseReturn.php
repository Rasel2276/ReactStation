<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierPurchaseReturn extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_purchase_id',
        'admin_id',
        'supplier_id',
        'product_id',
        'product_name',
        'product_image',
        'quantity',
        'reason',
        'status',
    ];

    public function purchase() {
        return $this->belongsTo(\App\Models\AdminPurchase::class, 'admin_purchase_id');
    }

    public function admin() {
        return $this->belongsTo(\App\Models\User::class, 'admin_id');
    }

    public function supplier() {
        return $this->belongsTo(\App\Models\Supplier::class, 'supplier_id');
    }

    public function product() {
        return $this->belongsTo(\App\Models\Product::class, 'product_id');
    }
}

