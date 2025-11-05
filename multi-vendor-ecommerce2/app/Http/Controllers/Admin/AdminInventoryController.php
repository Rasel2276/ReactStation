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
       🧩 SUPPLIER SECTION
       ========================================================== */
    
     public function purchase_from_suplier() {
        return view('admin.inventory.purchase_from_suplier');
    }

    // Show Add Supplier Form
    public function index() {
        return view('admin.inventory.add_suplier');
    }

    // Store Supplier
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
       📦 PURCHASE SECTION
       ========================================================== */
    
    // Show Purchase Form
    public function purchase(){
        $suppliers = Supplier::all();
        $products  = Product::all();
        return view('admin.inventory.purchase', compact('suppliers', 'products'));
    }

    // Store Purchase Record
    public function store_purchase(Request $request){
        $request->validate([
            'supplier_id'   => 'required|exists:suppliers,id',
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
            'purchase_price'=> 'required|numeric|min:0',
            'status'        => 'required|in:Pending,Completed,Cancelled'
        ]);

        AdminPurchase::create([
            'admin_id'      => Auth::id() ?? 1,
            'supplier_id'   => $request->supplier_id,
            'product_id'    => $request->product_id,
            'quantity'      => $request->quantity,
            'purchase_price'=> $request->purchase_price,
            'status'        => $request->status
        ]);

        return redirect()->route('inventory.purchase_records')
                         ->with('success', 'Purchase added successfully!');
    }

    // View All Purchases
    public function purchase_records(){
        $purchases = AdminPurchase::with(['supplier', 'product'])->latest()->get();
        return view('admin.inventory.purchase_records', compact('purchases'));
    }

    // Edit Purchase
    public function edit_purchase($id){
        $purchase  = AdminPurchase::findOrFail($id);
        $suppliers = Supplier::all();
        $products  = Product::all();
        return view('admin.inventory.edit_purchase', compact('purchase', 'suppliers', 'products'));
    }

    // Update Purchase
    public function update_purchase(Request $request, $id){
        $purchase = AdminPurchase::findOrFail($id);

        $request->validate([
            'supplier_id'   => 'required|exists:suppliers,id',
            'product_id'    => 'required|exists:products,id',
            'quantity'      => 'required|integer|min:1',
            'purchase_price'=> 'required|numeric|min:0',
            'status'        => 'required|in:Pending,Completed,Cancelled'
        ]);

        $purchase->update($request->all());

        return redirect()->route('inventory.purchase_records')
                         ->with('success', 'Purchase updated successfully!');
    }

    // Delete Purchase
    public function delete_purchase($id){
        AdminPurchase::findOrFail($id)->delete();
        return redirect()->route('inventory.purchase_records')
                         ->with('success', 'Purchase deleted successfully!');
    }

    /* ==========================================================
       🏷️ STOCK SECTION
       ========================================================== */

    // Show Add Stock Form with remaining stock info
    public function add_stock(){
        $products = Product::all();

        // Remaining stock calculation
        foreach($products as $product){
            $totalPurchased = AdminPurchase::where('product_id', $product->id)
                                            ->where('status','Completed')
                                            ->sum('quantity');
            $currentStock = AdminStock::where('product_id', $product->id)->sum('quantity');
            $product->remaining_stock = max(0, $totalPurchased - $currentStock);
        }

        return view('admin.inventory.add_stock', compact('products'));
    }

    // Store Stock Record with purchase check
    public function store_stock(Request $request){
        $request->validate([
            'product_id'   => 'required|exists:products,id',
            'quantity'     => 'required|integer|min:1',
            'vendor_price' => 'required|numeric|min:0',
            'status'       => 'required|in:Available,Sold Out'
        ]);

        $productId = $request->product_id;

        // Total purchased quantity of this product
        $totalPurchased = AdminPurchase::where('product_id', $productId)
                            ->where('status','Completed')
                            ->sum('quantity');

        // Current stock quantity of this product
        $currentStock = AdminStock::where('product_id', $productId)->sum('quantity');

        // Check if requested stock quantity is valid
        if(($currentStock + $request->quantity) > $totalPurchased){
            return redirect()->back()->with('error', 'You cannot add more stock than purchased quantity!');
        }

        AdminStock::create($request->all());

        return redirect()->route('inventory.stock_records')
                         ->with('success','Stock added successfully!');
    }

    // View All Stocks
    public function stock_records(){
        $stocks = AdminStock::with('product')->latest()->get();
        return view('admin.inventory.stock_records', compact('stocks'));
    }

    // Delete Stock
    public function delete_stock($id){
        AdminStock::findOrFail($id)->delete();
        return redirect()->route('inventory.stock_records')
                         ->with('success','Stock deleted successfully!');
    }

    /* ==========================================================
       🔄 PURCHASE RETURN SECTION
       ========================================================== */

    // Show Purchase Return Form
    public function purchase_return(){
        $purchases = AdminPurchase::with(['product','supplier'])->get();
        $admins    = User::all();
        $suppliers = Supplier::all();
        $products  = Product::all();
        return view('admin.inventory.purchase_return', compact('purchases','admins','suppliers','products'));
    }

    // Store Purchase Return
    public function store_purchase_return(Request $request){
        $request->validate([
            'admin_purchase_id' => 'required|exists:admin_purchases,id',
            'admin_id'          => 'required|exists:users,id',
            'supplier_id'       => 'required|exists:suppliers,id',
            'product_id'        => 'required|exists:products,id',
            'quantity'          => 'required|integer|min:1',
            'reason'            => 'nullable|string',
            'status'            => 'required|in:Pending,Approved,Rejected,Completed'
        ]);

        $product = Product::find($request->product_id);

        SupplierPurchaseReturn::create([
            'admin_purchase_id' => $request->admin_purchase_id,
            'admin_id'          => $request->admin_id,
            'supplier_id'       => $request->supplier_id,
            'product_id'        => $request->product_id,
            'product_name'      => $product->product_name ?? null,
            'product_image'     => $product->product_image ?? null,
            'quantity'          => $request->quantity,
            'reason'            => $request->reason,
            'status'            => $request->status,
        ]);

        // Update Stock Quantity
        $stock = AdminStock::where('product_id', $request->product_id)->first();
        if($stock){
            $stock->quantity = max(0, $stock->quantity - $request->quantity);
            $stock->save();
        }

        return redirect()->route('inventory.return_record')
                         ->with('success','Return added successfully!');
    }

    // List All Returns
    public function return_record(){
        $returns = SupplierPurchaseReturn::with(['purchase','admin','supplier','product'])->latest()->get();
        return view('admin.inventory.return_record', compact('returns'));
    }

    // View Single Return
    public function view_return($id){
        $return = SupplierPurchaseReturn::with(['purchase','admin','supplier','product'])->findOrFail($id);
        return view('admin.inventory.view_return', compact('return'));
    }

    // Edit Return
    public function edit_return($id){
        $return     = SupplierPurchaseReturn::findOrFail($id);
        $purchases  = AdminPurchase::all();
        $admins     = User::all();
        $suppliers  = Supplier::all();
        $products   = Product::all();
        return view('admin.inventory.edit_return', compact('return','purchases','admins','suppliers','products'));
    }

    // Update Return
    public function update_return(Request $request, $id){
        $return = SupplierPurchaseReturn::findOrFail($id);

        $request->validate([
            'admin_purchase_id' => 'required|exists:admin_purchases,id',
            'admin_id'          => 'required|exists:users,id',
            'supplier_id'       => 'required|exists:suppliers,id',
            'product_id'        => 'required|exists:products,id',
            'quantity'          => 'required|integer|min:1',
            'reason'            => 'nullable|string',
            'status'            => 'required|in:Pending,Approved,Rejected,Completed'
        ]);

        $oldQty = $return->quantity;
        $newQty = (int) $request->quantity;
        $productId = $request->product_id;

        $stock = AdminStock::where('product_id', $productId)->first();

        if($stock){
            if($return->product_id != $productId){
                $oldStock = AdminStock::where('product_id', $return->product_id)->first();
                if($oldStock){
                    $oldStock->quantity += $oldQty;
                    $oldStock->save();
                }
                $stock->quantity = max(0, $stock->quantity - $newQty);
                $stock->save();
            } else {
                $diff = $newQty - $oldQty;
                $stock->quantity = max(0, $stock->quantity - $diff);
                $stock->save();
            }
        }

        $product = Product::find($productId);

        $return->update([
            'admin_purchase_id' => $request->admin_purchase_id,
            'admin_id'          => $request->admin_id,
            'supplier_id'       => $request->supplier_id,
            'product_id'        => $productId,
            'product_name'      => $product->product_name ?? null,
            'product_image'     => $product->product_image ?? null,
            'quantity'          => $newQty,
            'reason'            => $request->reason,
            'status'            => $request->status
        ]);

        return redirect()->route('inventory.return_record')
                         ->with('success','Return updated successfully!');
    }

    // Delete Return
    public function delete_return($id){
        $return = SupplierPurchaseReturn::findOrFail($id);
        $stock  = AdminStock::where('product_id', $return->product_id)->first();

        if($stock){
            $stock->quantity += $return->quantity;
            $stock->save();
        }

        $return->delete();

        return redirect()->route('inventory.return_record')
                         ->with('success','Return deleted successfully!');
    }

    /* ==========================================================
       🛒 PRODUCT SECTION
       ========================================================== */

    // Show Add Product Form
    public function product(){
        $categories   = Category::all();
        $subcategories= SubCategory::all();
        $suppliers    = Supplier::all();
        return view('admin.inventory.product', compact('categories','subcategories','suppliers'));
    }

    // Store Product
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

    // View All Products
    public function product_records() {
        $products = Product::with(['category','subcategory','supplier'])
                           ->orderBy('id','desc')->get();
        return view('admin.inventory.product_records', compact('products'));
    }

    // View Single Product
    public function view_product($id) {
        $product = Product::with(['category','subcategory','supplier'])
                          ->findOrFail($id);
        return view('admin.inventory.view_product', compact('product'));
    }

    // Edit Product
    public function edit_product($id) {
        $product      = Product::findOrFail($id);
        $categories   = Category::all();
        $subcategories= SubCategory::all();
        $suppliers    = Supplier::all();
        return view('admin.inventory.edit_product', compact('product','categories','subcategories','suppliers'));
    }

    // Update Product
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

        // Handle Image Update
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

    // Delete Product
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
