<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorStock extends Model
{
    use HasFactory;

    // মডেল কোন টেবিল ব্যবহার করবে তা নির্দিষ্ট করা
    protected $table = 'vendor_stock';

    // ডাটা ইনসার্টের জন্য fillable ফিল্ড
    protected $fillable = [
        'vendor_id',
        'admin_stock_id',
        'quantity',
        'price',
        'status',
    ];

    // Vendor (User) এর সাথে সম্পর্ক
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }

    // AdminStock এর সাথে সম্পর্ক
    public function adminStock()
    {
        return $this->belongsTo(AdminStock::class, 'admin_stock_id');
    }
}
