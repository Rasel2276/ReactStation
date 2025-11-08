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
       🧩 SUPPLIER SECTION END
       ========================================================== */
    
     public function purchase_from_suplier() {
        return view('admin.inventory.purchase_from_suplier');
    }

     public function purchase_record() {
        return view('admin.inventory.purchase_record');
    }

     public function inventory_list() {
        return view('admin.inventory.inventory_list');
    }

     public function suplier_return() {
        return view('admin.inventory.suplier_return');
    }

      public function suplier_return_record() {
        return view('admin.inventory.suplier_return_record');
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
