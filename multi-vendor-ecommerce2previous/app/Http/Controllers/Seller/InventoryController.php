<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminStock;
use App\Models\VendorPurchase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Added DB Facade for transactions

class InventoryController extends Controller
{
    // ✅ Purchase Form Page (Now handles multi-purchase form)
    public function index(){
        $stocks = AdminStock::with('product')->where('quantity','>',0)->get();
        
        // 🚨 FIX: Reverted view name to the likely existing file: purchase
        return view('seller.inventory.purchase', compact('stocks'));
    }

    // ✅ Store Vendor MULTI Purchase
    public function store_purchase(Request $request)
    {
        // 1. Validate the array structure and contents
        $request->validate([
            'purchases' => 'required|array|min:1',
            // Validate each item in the purchases array
            'purchases.*.admin_stock_id' => 'required|exists:admin_stock,id',
            'purchases.*.quantity'       => 'required|integer|min:1',
        ]);

        $vendorId = Auth::id();
        $purchases = $request->purchases;

        // 2. Start Database Transaction for Atomicity
        DB::beginTransaction();

        try {
            foreach ($purchases as $item) {
                
                // Ensure the purchase item has required fields
                if (!isset($item['admin_stock_id']) || !isset($item['quantity'])) {
                    continue; // Skip invalid rows
                }

                // 3. Get the selected admin stock
                $stock = AdminStock::findOrFail($item['admin_stock_id']);

                // 4. Check if requested quantity is available
                if ($item['quantity'] > $stock->quantity) {
                    // Throw an exception to trigger the DB::rollBack()
                    throw new \Exception('Insufficient stock available for product: ' . $stock->product->name . '. Requested: ' . $item['quantity'] . ', Available: ' . $stock->quantity);
                }

                // 5. Determine price
                $price = $stock->vendor_sale_price ?: $stock->purchase_price;

                // 6. Create Vendor Purchase record
                VendorPurchase::create([
                   'vendor_id'      => $vendorId,
                   'admin_stock_id' => $item['admin_stock_id'],
                   'quantity'       => $item['quantity'],
                   'price'          => $price,
                   'status'         => 'Pending' // Keep status as Pending
                ]);

                // 7. Reduce admin stock quantity immediately (as per your existing logic)
                $stock->quantity -= $item['quantity'];
                $stock->save();
            }

            // 8. Commit the transaction if all items are processed successfully
            DB::commit();
            return back()->with('success', 'Multiple purchase requests submitted successfully!');

        } catch (\Exception $e) {
            // 9. Rollback the transaction if any item fails
            DB::rollBack();
            // Return specific error message to the user
            return back()->with('error', 'Purchase Failed! ' . $e->getMessage());
        }
    }

    // ✅ View Vendor Purchased Product List
    public function manage_stock(){
        $purchases = VendorPurchase::with('adminStock.product')
                            ->where('vendor_id', Auth::id())
                            ->get();

        return view('seller.inventory.manage_stock', compact('purchases'));
    }

    // ✅ Purchase Return Page
    public function purchase_return(){
        return view('seller.inventory.purchase_return');
    }

    // ✅ Admin Product Stock List (Vendor can view)
    public function admin_product_list(){
        $stocks = AdminStock::with('product')->get();  
        return view('seller.inventory.admin_product_list', compact('stocks'));
    }
}