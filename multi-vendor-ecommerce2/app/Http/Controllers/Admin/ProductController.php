<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorPurchase; 
use App\Models\VendorStock;
use App\Models\AdminStock;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Pending Purchase Requests দেখাবে
     */
    public function purchase_request()
    {
        $pendingRequests = VendorPurchase::where('status', 'Completed') 
                                         ->with(['vendor', 'adminStock.product']) 
                                         ->orderBy('purchase_date', 'desc')
                                         ->get();
        return view('admin.product.purchase_request', compact('pendingRequests'));
    }

    /**
     * Admin Accept Purchase (Stock Allocation)
     */
    public function acceptPurchase(VendorPurchase $purchase)
    {
        if ($purchase->status !== 'Completed') {
            return redirect()->back()->with('error', 'This purchase is not ready for stock allocation (Status: '.$purchase->status.').');
        }

        $quantity = $purchase->quantity;
        $adminStock = AdminStock::find($purchase->admin_stock_id);

        if (!$adminStock || $adminStock->quantity < $quantity) {
            return redirect()->back()->with('error', 'Cannot accept: Insufficient stock in Admin Inventory.');
        }

        try {
            DB::beginTransaction();

            // VendorStock update / create
            $vendorStock = VendorStock::firstOrNew([
                'vendor_id' => $purchase->vendor_id,
                'admin_stock_id' => $purchase->admin_stock_id,
            ]);

            if (!$vendorStock->exists) {
                $vendorStock->price = $purchase->price ?? 0;
            }

            // Null-safe quantity update
            $vendorStock->quantity = ($vendorStock->quantity ?? 0) + $quantity;
            $vendorStock->save();

            // AdminStock থেকে quantity কমানো
            $adminStock->quantity -= $quantity;
            $adminStock->save();

            // VendorPurchase স্ট্যাটাস final করা
            $purchase->status = 'Allocated';
            $purchase->save();

            DB::commit();

            return redirect()->back()->with('success', 'Purchase accepted! Stock moved to Vendor Inventory.');

        } catch (\Exception $e) {
            DB::rollBack();
            // Full debug message
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ' at line ' . $e->getLine());
        }
    }

    /**
     * Admin Reject Purchase
     */
    public function rejectPurchase(VendorPurchase $purchase)
    {
        if ($purchase->status !== 'Completed') {
            return redirect()->back()->with('error', 'Only Completed purchases can be rejected for allocation.');
        }

        $purchase->status = 'Cancelled';
        $purchase->save();

        return redirect()->back()->with('success', 'Purchase request cancelled. Vendor will be notified.');
    }

    // --- অন্যান্য Admin CRUD ফাংশন ---
    public function add_product(){ return view('admin.product.add_product'); }
    public function index(){ return view('admin.product.manage_product_reviews'); }
    public function manage_product(){ return view('admin.product.manage_product'); }
    public function return_product(){ return view('admin.product.return_product'); }
}
