<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\AdminPurchase;
use App\Models\AdminStock;
use App\Models\SupplierPurchaseReturn;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminInventoryController extends Controller
{
    /* ==========================================================
       🧩 SUPPLIER SECTION START
       ========================================================== */
    public function index() {
        return view('admin.inventory.add_suplier');
    }

    public function store_supplier(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:150',
            'email'         => 'nullable|email|unique:suppliers,email',
            'phone'         => 'nullable|string|max:20',
            'address'       => 'nullable|string',
            'contact_person'=> 'nullable|string|max:100',
            'status'        => 'required|in:Active,Inactive',
        ]);

        Supplier::create($request->all());

        return redirect()->route('inventory.add_suplier')
                         ->with('success', 'Supplier added successfully!');
    }
    /* ==========================================================
       🧩 SUPPLIER SECTION END
       ========================================================== */

    /* ==========================================================
       ✅ PURCHASE FORM
       ========================================================== */
    public function purchase_from_suplier()
    {
        $suppliers = Supplier::where('status', 'Active')->get();
        $products  = Product::where('status', 'Active')->get();

        return view('admin.inventory.purchase_from_suplier', compact('suppliers','products'));
    }

    /* ==========================================================
       ✅ PURCHASE STORE + MULTIPLE PRODUCTS + STOCK UPDATE
       ========================================================== */
    public function store_purchase(Request $request)
    {
        $request->validate([
            'products' => 'required|array|min:1',
            'products.*.supplier_id'       => 'required|exists:suppliers,id',
            'products.*.product_id'        => 'required|exists:products,id',
            'products.*.quantity'          => 'required|integer|min:1',
            'products.*.purchase_price'    => 'required|numeric|min:1',
            'products.*.vendor_sale_price' => 'required|numeric|min:1',
        ],[
            'products.*.supplier_id.required' => 'The supplier field is required.',
            'products.*.product_id.required' => 'The product field is required.',
            'products.*.quantity.required' => 'The quantity field is required.',
            'products.*.purchase_price.required' => 'The purchase price field is required.',
            'products.*.vendor_sale_price.required' => 'The vendor sale price field is required.',
        ]);

        foreach ($request->products as $prod) {
            // ✅ create purchase record
            $purchase = AdminPurchase::create([
                'admin_id'          => Auth::id(),
                'supplier_id'       => $prod['supplier_id'],
                'product_id'        => $prod['product_id'],
                'quantity'          => $prod['quantity'],
                'purchase_price'    => $prod['purchase_price'],
                'vendor_sale_price' => $prod['vendor_sale_price'],
                'status'            => 'Completed',
            ]);

            // ✅ STOCK MERGE LOGIC
            $stock = AdminStock::where('product_id', $prod['product_id'])->first();

            if ($stock) {
                $stock->quantity += $prod['quantity'];
                $stock->purchase_price     = $prod['purchase_price'];
                $stock->vendor_sale_price  = $prod['vendor_sale_price'];
                $stock->status = $stock->quantity > 0 ? 'Available' : 'Sold Out';
                $stock->save();
            } else {
                AdminStock::create([
                    'product_id'        => $prod['product_id'],
                    'quantity'          => $prod['quantity'],
                    'purchase_price'    => $prod['purchase_price'],
                    'vendor_sale_price' => $prod['vendor_sale_price'],
                    'status'            => 'Available',
                ]);
            }
        }

        return back()->with('success', 'Purchase Successfully Added & Stock Updated!');
    }

    /* ==========================================================
       ✅ PURCHASE RECORD LIST
       ========================================================== */
    public function purchase_record()
    {
        $purchases = AdminPurchase::with(['supplier','product','admin'])
                    ->orderBy('id','DESC')->get();

        return view('admin.inventory.purchase_record', compact('purchases'));
    }

    /* ==========================================================
       ✅ PURCHASE EDIT
       ========================================================== */
    public function edit_purchase($id)
    {
        $purchase = AdminPurchase::findOrFail($id);
        $suppliers = Supplier::where('status','Active')->get();
        $products  = Product::where('status','Active')->get();

        return view('admin.inventory.edit_purchase', compact('purchase','suppliers','products'));
    }

    /* ==========================================================
       ✅ PURCHASE UPDATE + STOCK RECALCULATE
       ========================================================== */
    public function update_purchase(Request $request, $id)
    {
        $request->validate([
            'supplier_id'       => 'required|exists:suppliers,id',
            'product_id'        => 'required|exists:products,id',
            'quantity'          => 'required|integer|min:1',
            'purchase_price'    => 'required|numeric|min:1',
            'vendor_sale_price' => 'required|numeric|min:1',
        ]);

        $purchase = AdminPurchase::findOrFail($id);

        $old_qty = $purchase->quantity;
        $new_qty = $request->quantity;

        $purchase->update([
            'supplier_id'       => $request->supplier_id,
            'product_id'        => $request->product_id,
            'quantity'          => $new_qty,
            'purchase_price'    => $request->purchase_price,
            'vendor_sale_price' => $request->vendor_sale_price,
        ]);

        // ✅ Update Stock
        $stock = AdminStock::where('product_id', $request->product_id)->first();

        if ($stock) {
            $stock->quantity = ($stock->quantity - $old_qty) + $new_qty;
            $stock->purchase_price    = $request->purchase_price;
            $stock->vendor_sale_price = $request->vendor_sale_price;
            $stock->status = $stock->quantity > 0 ? 'Available' : 'Sold Out';
            $stock->save();
        }

        return redirect()->route('inventory.purchase_record')
                         ->with('success','Purchase Updated Successfully!');
    }

    /* ==========================================================
       ✅ PURCHASE DELETE + STOCK REDUCE
       ========================================================== */
    public function delete_purchase($id)
    {
        $purchase = AdminPurchase::findOrFail($id);

        $stock = AdminStock::where('product_id', $purchase->product_id)->first();

        if ($stock) {
            $stock->quantity -= $purchase->quantity;
            if ($stock->quantity <= 0) {
                $stock->status = 'Sold Out';
            }
            $stock->save();
        }

        $purchase->delete();

        return back()->with('success','Purchase Deleted Successfully!');
    }

    /* ==========================================================
       ✅ STOCK LIST
       ========================================================== */
    public function inventory_list()
    {
        $stocks = AdminStock::with('product')
                ->orderBy('id','DESC')->get();

        return view('admin.inventory.inventory_list', compact('stocks'));
    }

 /* ==========================================================
   🧩 SUPPLIER RETURN SECTION
   ========================================================== */

// Show Supplier Return Form
public function suplier_return()
{
    $purchases = AdminPurchase::with('product')->get();
    $admins    = User::all();
    $suppliers = Supplier::all();

    return view('admin.inventory.suplier_return', compact('purchases','admins','suppliers'));
}

// Store Supplier Return
public function store_supplier_return(Request $request)
{
    $request->validate([
        'admin_purchase_id' => 'required|exists:admin_purchases,id',
        'admin_id'          => 'required|exists:users,id',
        'supplier_id'       => 'required|exists:suppliers,id',
        'product_id'        => 'required|exists:products,id',
        'quantity'          => 'required|integer|min:1',
        'status'            => 'required|in:Pending,Approved,Rejected,Completed',
        'reason'            => 'nullable|string|max:500',
    ]);

    // ✅ Check stock
    $stock = AdminStock::where('product_id', $request->product_id)->first();

    if (!$stock || $stock->quantity <= 0) {
        return back()->with('error', 'Stock not available for this product!');
    }

    if ($request->quantity > $stock->quantity) {
        return back()->with('error', 'Return quantity cannot exceed available stock!');
    }

    // Create Supplier Return
    $return = SupplierPurchaseReturn::create($request->all());

    // Update stock if status is Completed
    if($request->status == 'Completed'){
        $stock->quantity -= $request->quantity;
        $stock->status = $stock->quantity > 0 ? 'Available' : 'Sold Out';
        $stock->save();
    }

    return redirect()->route('inventory.suplier_return')
                     ->with('success','Supplier return submitted successfully!');
}

// Show Supplier Return Records
public function suplier_return_record()
{
    $returns = SupplierPurchaseReturn::with(['product','purchase','supplier','admin'])->get();
    return view('admin.inventory.suplier_return_record', compact('returns'));
}

// Delete Supplier Return
public function delete_supplier_return($id)
{
    $return = SupplierPurchaseReturn::findOrFail($id);

    // Adjust stock if already Completed
    if($return->status == 'Completed'){
        $stock = AdminStock::where('product_id', $return->product_id)->first();
        if($stock){
            $stock->quantity += $return->quantity;
            $stock->status = $stock->quantity > 0 ? 'Available' : 'Sold Out';
            $stock->save();
        }
    }

    $return->delete();

    return back()->with('success','Supplier return deleted successfully!');
}

    /* ==========================================================
       ✅ PRODUCT SECTION
       ========================================================== */
    public function product()
    {
        $categories   = Category::all();
        $subcategories= SubCategory::all();
        $suppliers    = Supplier::all();

        return view('admin.inventory.product', compact('categories','subcategories','suppliers'));
    }

    public function store_product(Request $request)
    {
        $request->validate([
            'product_name'  => 'required|string|max:255',
            'sku'           => 'nullable|string|max:100|unique:products,sku',
            'category_id'   => 'required|exists:categories,id',
            'subcategory_id'=> 'nullable|exists:sub_categories,id',
            'supplier_id'   => 'nullable|exists:suppliers,id',
            'base_price'    => 'nullable|numeric',
            'description'   => 'nullable|string',
            'color'         => 'nullable|string|max:100',
            'size'          => 'nullable|string|max:100',
            'featured'      => 'nullable|in:Yes,No',
            'status'        => 'required|in:Active,Inactive',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
        ]);

        $imageName = null;
        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('product_images'), $imageName);
        }

        Product::create([
            'product_name'   => $request->product_name,
            'sku'            => $request->sku,
            'category_id'    => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'supplier_id'    => $request->supplier_id,
            'base_price'     => $request->base_price,
            'description'    => $request->description,
            'product_image'  => $imageName,
            'color'          => $request->color,
            'size'           => $request->size,
            'featured'       => $request->featured ?? 'No',
            'status'         => $request->status,
        ]);

        return redirect()->route('inventory.product')
                         ->with('success', 'Product added successfully!');
    }

    public function product_records()
    {
        $products = Product::with(['category','subcategory','supplier'])
                           ->orderBy('id','desc')->get();

        return view('admin.inventory.product_records', compact('products'));
    }

    public function view_product($id)
    {
        $product = Product::with(['category','subcategory','supplier'])
                          ->findOrFail($id);

        return view('admin.inventory.view_product', compact('product'));
    }

    public function edit_product($id)
    {
        $product      = Product::findOrFail($id);
        $categories   = Category::all();
        $subcategories= SubCategory::all();
        $suppliers    = Supplier::all();

        return view('admin.inventory.edit_product', compact('product','categories','subcategories','suppliers'));
    }

    public function update_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name'  => 'required|string|max:255',
            'sku'           => 'nullable|string|max:100|unique:products,sku,'.$product->id,
            'category_id'   => 'required|exists:categories,id',
            'subcategory_id'=> 'nullable|exists:sub_categories,id',
            'supplier_id'   => 'nullable|exists:suppliers,id',
            'base_price'    => 'nullable|numeric',
            'description'   => 'nullable|string',
            'color'         => 'nullable|string|max:100',
            'size'          => 'nullable|string|max:100',
            'featured'      => 'nullable|in:Yes,No',
            'status'        => 'required|in:Active,Inactive',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:4096',
        ]);

        if ($request->hasFile('product_image')) {
            if ($product->product_image && file_exists(public_path('product_images/'.$product->product_image))) {
                unlink(public_path('product_images/'.$product->product_image));
            }
            $file = $request->file('product_image');
            $imageName = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('product_images'), $imageName);
            $product->product_image = $imageName;
        }

        $product->fill($request->except('product_image'));
        $product->save();

        return redirect()->route('inventory.product_records')
                         ->with('success', 'Product updated successfully!');
    }

    public function delete_product($id)
    {
        $product = Product::findOrFail($id);

        if ($product->product_image && file_exists(public_path('product_images/'.$product->product_image))) {
            unlink(public_path('product_images/'.$product->product_image));
        }

        $product->delete();

        return redirect()->route('inventory.product_records')
                         ->with('success', 'Product deleted successfully!');
    }
}
