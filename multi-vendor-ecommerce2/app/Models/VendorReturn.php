<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorReturn extends Model
{
    use HasFactory;

    protected $table = 'vendor_returns';

    // Allowed fields
    protected $fillable = [
        'vendor_id',
        'admin_id',
        'product_id',
        'quantity',
        'reason',
        'status',
        'return_date',
    ];

    // Disable Laravel timestamps because migration has no created_at/updated_at
    public $timestamps = false;

    /* ============================
     |   RELATIONSHIPS
     ============================ */

    // Return product relation
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Vendor relation
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    // Admin relation
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}

