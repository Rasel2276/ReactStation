<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\AdminPurchase;
use Illuminate\Support\Facades\Auth;

class AdminInventoryController extends Controller
{
    // ==============================
    // SUPPLIER SECTION (unchanged)
    // ==============================

    // Add Supplier Form
    public function index(){
        return view('admin.inventory.add_suplier');
    }

    // Store Supplier Data
    public function store_supplier(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:150',
            'email' => 'nullable|email|unique:suppliers,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'contact_person' => 'nullable|string|max:100',
            'status' => 'required|in:Active,Inactive',
        ]);

        Supplier::create([
            'supplier_name' => $request->supplier_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'contact_person' => $request->contact_person,
            'status' => $request->status,
        ]);

        return redirect()->route('inventory.add_suplier')->with('success', 'Supplier added successfully!');
    }

    // ==============================
    // PURCHASE / STOCK / RETURN
    // ==============================

    // Add Purchase Form
    public function purchase(){
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.inventory.purchase',compact('suppliers','products'));
    }

    // Store Purchase
    public function store_purchase(Request $request){
        $request->validate([
            'supplier_id'=>'required|exists:suppliers,id',
            'product_id'=>'required|exists:products,id',
            'quantity'=>'required|integer|min:1',
            'purchase_price'=>'required|numeric|min:0',
            'status'=>'required|in:Pending,Completed,Cancelled'
        ]);

        AdminPurchase::create([
            'admin_id'=>Auth::id() ?? 1,
            'supplier_id'=>$request->supplier_id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'purchase_price'=>$request->purchase_price,
            'status'=>$request->status
        ]);

        return redirect()->route('inventory.purchase_records')->with('success','Purchase added successfully!');
    }

    // Purchase Records
    public function purchase_records(){
        $purchases = AdminPurchase::with(['supplier','product'])->latest()->get();
        return view('admin.inventory.purchase_records',compact('purchases'));
    }

    // Edit Purchase
    public function edit_purchase($id){
        $purchase = AdminPurchase::findOrFail($id);
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.inventory.edit_purchase',compact('purchase','suppliers','products'));
    }

    // Update Purchase
    public function update_purchase(Request $request,$id){
        $purchase = AdminPurchase::findOrFail($id);

        $request->validate([
            'supplier_id'=>'required|exists:suppliers,id',
            'product_id'=>'required|exists:products,id',
            'quantity'=>'required|integer|min:1',
            'purchase_price'=>'required|numeric|min:0',
            'status'=>'required|in:Pending,Completed,Cancelled'
        ]);

        $purchase->update([
            'supplier_id'=>$request->supplier_id,
            'product_id'=>$request->product_id,
            'quantity'=>$request->quantity,
            'purchase_price'=>$request->purchase_price,
            'status'=>$request->status
        ]);

        return redirect()->route('inventory.purchase_records')->with('success','Purchase updated successfully!');
    }

    // Delete Purchase
    public function delete_purchase($id){
        AdminPurchase::findOrFail($id)->delete();
        return redirect()->route('inventory.purchase_records')->with('success','Purchase deleted successfully!');
    }

    // Add Stock
    public function add_stock(){
        return view('admin.inventory.add_stock');
    }

    // Stock Records
    public function stock_records(){
        return view('admin.inventory.stock_records');
    }

    // Purchase Return
    public function purchase_return(){
        return view('admin.inventory.purchase_return');
    }

    // Return Records
    public function return_record(){
        return view('admin.inventory.return_record');
    }

    // ==============================
    // PRODUCT SECTION (CRUD with Eloquent)
    // ==============================

    // Show create product form
    public function product(){
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $suppliers = Supplier::all();
        return view('admin.inventory.product', compact('categories','subcategories','suppliers'));
    }

    // Store product (insert)
    public function store_product(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'base_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:100',
            'size' => 'nullable|string|max:100',
            'featured' => 'nullable|in:Yes,No',
            'status' => 'required|in:Active,Inactive',
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

        return redirect()->route('inventory.product')->with('success', 'Product added successfully!');
    }

    // Manage / list products
    public function product_records()
    {
        $products = Product::with(['category','subcategory','supplier'])->orderBy('id','desc')->get();
        return view('admin.inventory.product_records', compact('products'));
    }

    // View single product
    public function view_product($id)
    {
        $product = Product::with(['category','subcategory','supplier'])->findOrFail($id);
        return view('admin.inventory.view_product', compact('product'));
    }

    // Show edit form
    public function edit_product($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $subcategories = SubCategory::all();
        $suppliers = Supplier::all();
        return view('admin.inventory.edit_product', compact('product','categories','subcategories','suppliers'));
    }

    // Update product
    public function update_product(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'product_name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:products,sku,'.$product->id,
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
            'base_price' => 'nullable|numeric',
            'description' => 'nullable|string',
            'color' => 'nullable|string|max:100',
            'size' => 'nullable|string|max:100',
            'featured' => 'nullable|in:Yes,No',
            'status' => 'required|in:Active,Inactive',
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

        $product->product_name   = $request->product_name;
        $product->sku            = $request->sku;
        $product->category_id    = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;
        $product->supplier_id    = $request->supplier_id;
        $product->base_price     = $request->base_price;
        $product->description    = $request->description;
        $product->color          = $request->color;
        $product->size           = $request->size;
        $product->featured       = $request->featured ?? 'No';
        $product->status         = $request->status;

        $product->save();

        return redirect()->route('inventory.product_records')->with('success', 'Product updated successfully!');
    }

    // Delete product
    public function delete_product($id)
    {
        $product = Product::findOrFail($id);

        if ($product->product_image && file_exists(public_path('product_images/'.$product->product_image))) {
            unlink(public_path('product_images/'.$product->product_image));
        }

        $product->delete();

        return redirect()->route('inventory.product_records')->with('success', 'Product deleted successfully!');
    }
}
