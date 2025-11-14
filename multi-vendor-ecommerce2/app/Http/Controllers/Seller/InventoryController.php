<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminStock;
use App\Models\VendorStock;
use App\Models\VendorPurchase;
use App\Models\VendorReturn;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{
    /* ======================================================
     |  VENDOR PRODUCT PURCHASE (STEP – 1: SHOW STOCK)
     ======================================================= */
    public function index()
    {
        $stocks = AdminStock::with('product')
                    ->where('quantity', '>', 0)
                    ->get();

        return view('seller.inventory.purchase', compact('stocks'));
    }



    /* ======================================================
     |  VENDOR MULTIPLE PURCHASE (STEP – 2: STORE)
     ======================================================= */
    public function store_purchase(Request $request)
    {
        $request->validate([
            'purchases'                       => 'required|array|min:1',
            'purchases.*.admin_stock_id'      => 'required|exists:admin_stock,id',
            'purchases.*.quantity'            => 'required|integer|min:1',
        ]);

        $vendorId   = Auth::id();
        $purchases  = $request->purchases;

        DB::beginTransaction();
        try {
            foreach ($purchases as $item) {

                if (!isset($item['admin_stock_id']) || !isset($item['quantity'])) {
                    continue;
                }

                $stock = AdminStock::findOrFail($item['admin_stock_id']);

                if ($item['quantity'] > $stock->quantity) {
                    throw new \Exception('Insufficient stock for: ' . $stock->product->product_name);
                }

                $price = $stock->vendor_sale_price ?: $stock->purchase_price;

                VendorPurchase::create([
                    'vendor_id'       => $vendorId,
                    'admin_stock_id'  => $item['admin_stock_id'],
                    'quantity'        => $item['quantity'],
                    'price'           => $price,
                    'status'          => 'Pending',
                ]);
            }

            DB::commit();

            return redirect()
                ->route('purchase.payment')
                ->with('success', 'Multiple purchase requests submitted. Proceed to payment.');

        } catch (\Exception $e) {

            DB::rollBack();
            return back()->with('error', 'Purchase Failed! ' . $e->getMessage());
        }
    }



    /* ======================================================
     |  VENDOR PURCHASED PRODUCT LIST
     ======================================================= */
    public function manage_stock()
    {
        $purchases = VendorPurchase::with('adminStock.product')
                        ->where('vendor_id', Auth::id())
                        ->get();

        return view('seller.inventory.manage_stock', compact('purchases'));
    }



    /* ======================================================
     |  DELETE PURCHASE RECORD
     ======================================================= */
    public function delete_manage_stock($id)
    {
        VendorPurchase::findOrFail($id)->delete();

        return redirect()
            ->route('inventory.manage_stock')
            ->with('success', 'Purchase deleted successfully!');
    }



    /* ======================================================
     |  PURCHASE RETURN FORM (SHOW ONLY VENDOR STOCK)
     ======================================================= */
    public function purchase_return()
    {
        $stocks = VendorStock::with('adminStock.product')
                    ->where('vendor_id', Auth::id())
                    ->where('quantity', '>', 0)
                    ->get();

        return view('seller.inventory.purchase_return', compact('stocks'));
    }



    /* ======================================================
     |  STORE PURCHASE RETURN
     ======================================================= */
    public function store_purchase_return(Request $request)
    {
        $request->validate([
            'vendor_stock_id' => 'required|exists:vendor_stock,id',
            'quantity'        => 'required|integer|min:1',
            'reason'          => 'required|string|max:500',
        ]);

        $vendorStock = VendorStock::with('adminStock')
                        ->findOrFail($request->vendor_stock_id);

        $vendorId = Auth::id();

        if ($vendorStock->vendor_id != $vendorId) {
            return back()->with('error', 'Unauthorized purchase return!');
        }

        if ($request->quantity > $vendorStock->quantity) {
            return back()->with('error', 'Return quantity cannot exceed available stock!');
        }

        // Deduct vendor stock
        $vendorStock->quantity -= $request->quantity;
        $vendorStock->save();

        // Increase admin stock
        $adminStock = AdminStock::find($vendorStock->admin_stock_id);
        $adminStock->quantity += $request->quantity;
        $adminStock->save();

        // Save Return Record
        VendorReturn::create([
            'vendor_id'   => $vendorId,
            'admin_id'    => $adminStock->admin_id ?? 1,
            'product_id'  => $adminStock->product_id,
            'quantity'    => $request->quantity,
            'reason'      => $request->reason,
            'status'      => 'Completed',
            'return_date' => now(),
        ]);

        return back()->with('success', 'Product return successful! Stock updated.');
    }



    /* ======================================================
     |  VENDOR RETURN RECORD LIST
     ======================================================= */
    public function vendor_return_record()
    {
        $returns = VendorReturn::with('product')
                    ->where('vendor_id', Auth::id())
                    ->orderBy('id', 'DESC')
                    ->get();

        return view('seller.inventory.vendor_return_record', compact('returns'));
    }



    /* ======================================================
     |  DELETE RETURN RECORD
     ======================================================= */
    public function delete_vendor_return($id)
    {
        $return = VendorReturn::where('id', $id)
                    ->where('vendor_id', Auth::id())
                    ->firstOrFail();

        $return->delete();

        return back()->with('success', 'Return record deleted successfully!');
    }



    /* ======================================================
     |  ADMIN STOCK LIST (FOR VENDOR)
     ======================================================= */
    public function admin_product_list()
    {
        $stocks = AdminStock::with('product')->get();

        return view('seller.inventory.admin_product_list', compact('stocks'));
    }



    /* ======================================================
     |  VENDOR MY STOCK
     ======================================================= */
    public function my_stock()
    {
        $stocks = VendorStock::with('adminStock.product')
                    ->where('vendor_id', Auth::id())
                    ->get();

        return view('seller.inventory.my_stock', compact('stocks'));
    }



    /* ======================================================
     |  DELETE VENDOR STOCK
     ======================================================= */
    public function delete_stock($id)
    {
        VendorStock::findOrFail($id)->delete();

        return redirect()
            ->route('inventory.my_stock')
            ->with('success', 'Stock deleted successfully!');
    }
}
