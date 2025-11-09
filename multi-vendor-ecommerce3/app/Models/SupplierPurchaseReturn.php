<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierPurchaseReturn extends Model
{
    protected $table = 'supplier_purchase_returns';

    protected $fillable = [
        'admin_purchase_id',
        'admin_id',
        'supplier_id',
        'product_id',
        'quantity',
        'status',
        'reason'
    ];

    public function product() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchase() {
        return $this->belongsTo(AdminPurchase::class, 'admin_purchase_id');
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function admin() {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

