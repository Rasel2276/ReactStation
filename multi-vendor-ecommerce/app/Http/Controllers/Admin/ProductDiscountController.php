<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductDiscount;
use App\Models\Product;

class ProductDiscountController extends Controller
{
    // Create Discount Form
    public function index(){
        $products = Product::all(); // Product list
        return view('admin.discount.create_discount', compact('products'));
    }

    // Manage Discount List
    public function manage_discount(){
        $discounts = ProductDiscount::with('product')->orderBy('id','desc')->get();
        return view('admin.discount.manage_discount', compact('discounts'));
    }

    // Store Discount
    public function store_discount(Request $request){
        $request->validate([
            'product_id'     => 'required|exists:products,id',
            'discount_for'   => 'required|in:Customer,Vendor,Supplier',
            'discount_type'  => 'required|in:Percentage,Fixed Amount',
            'discount_value' => 'required|numeric|min:0',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'status'         => 'required|in:Active,Inactive',
        ]);

        ProductDiscount::create($request->all());

        return redirect()->route('discount.manage_discount')->with('success','Discount added successfully!');
    }

    // Edit Discount Form
    public function edit_discount($id){
        $discount = ProductDiscount::findOrFail($id);
        $products = Product::all();
        return view('admin.discount.edit_discount', compact('discount','products'));
    }

    // Update Discount
    public function update_discount(Request $request, $id){
        $discount = ProductDiscount::findOrFail($id);

        $request->validate([
            'product_id'     => 'required|exists:products,id',
            'discount_for'   => 'required|in:Customer,Vendor,Supplier',
            'discount_type'  => 'required|in:Percentage,Fixed Amount',
            'discount_value' => 'required|numeric|min:0',
            'start_date'     => 'required|date',
            'end_date'       => 'required|date|after_or_equal:start_date',
            'status'         => 'required|in:Active,Inactive',
        ]);

        $discount->update($request->all());

        return redirect()->route('discount.manage_discount')->with('success','Discount updated successfully!');
    }

    // Delete Discount
    public function delete_discount($id){
        ProductDiscount::findOrFail($id)->delete();
        return redirect()->route('discount.manage_discount')->with('success','Discount deleted successfully!');
    }
}

