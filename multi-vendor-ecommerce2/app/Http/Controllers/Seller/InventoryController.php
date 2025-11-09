<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminStock;
use App\Models\VendorPurchase;
use Illuminate\Support\Facades\Auth;

class InventoryController extends Controller
{
    // ✅ Purchase Form Page (Vendor sees available admin stock)
    public function index(){
        $stocks = AdminStock::with('product')->where('quantity','>',0)->get();
        return view('seller.inventory.purchase', compact('stocks'));
    }

    // ✅ Store Vendor Purchase
    public function store_purchase(Request $request)
    {
        $request->validate([
            'admin_stock_id' => 'required|exists:admin_stock,id',
            'quantity'       => 'required|integer|min:1',
        ]);

        // Get the selected admin stock
        $stock = AdminStock::findOrFail($request->admin_stock_id);

        // Check if requested quantity is available
        if ($request->quantity > $stock->quantity) {
            return back()->with('error', 'Not enough stock available!');
        }

        // Determine price (vendor_sale_price if set, otherwise purchase_price)
        $price = $stock->vendor_sale_price ?: $stock->purchase_price;

        // Create Vendor Purchase
        VendorPurchase::create([
         'vendor_id'      => Auth::id(),
         'admin_stock_id' => $request->admin_stock_id,
         'quantity'       => $request->quantity,
         'price'          => $price,
         'status'         => 'Pending' // ✅ ENUM value must match table
       ]);


        // Reduce admin stock quantity
        $stock->quantity -= $request->quantity;
        $stock->save();

        return back()->with('success', 'Purchase submitted successfully!');
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
