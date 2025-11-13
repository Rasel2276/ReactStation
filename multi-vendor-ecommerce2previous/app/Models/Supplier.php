<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'email',
        'phone',
        'address',
        'contact_person',
        'status'
    ];

    // ✅ RELATIONSHIP WITH PURCHASE
    public function purchases()
    {
        return $this->hasMany(\App\Models\AdminPurchase::class, 'supplier_id');
    }

    // ✅ RELATIONSHIP WITH PRODUCT
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class, 'supplier_id');
    }
}


