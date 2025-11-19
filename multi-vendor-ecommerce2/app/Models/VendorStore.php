<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorStore extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'store_name',
        'store_logo',
        'store_banner',
        'store_description',
        'store_address',
        'store_email',
        'store_phone',
        'store_status',
    ];

    // Define relationship with the User model (assuming a vendor is a user)
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
