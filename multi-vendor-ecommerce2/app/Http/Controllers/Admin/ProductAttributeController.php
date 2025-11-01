<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductAttribute;

class ProductAttributeController extends Controller
{
    // Create form
    public function index(){
        return view('admin.product_attribute.create_attribute');
    }

    // Store attribute
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:1,0'
        ]);

        ProductAttribute::create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'status' => $request->status == 1 ? 'Active' : 'Inactive'
        ]);

        return redirect()->route('product_attribute.create_attribute')->with('success','Attribute added successfully!');
    }

    // Manage
    public function manage_attribute(){
        $attributes = ProductAttribute::all();
        return view('admin.product_attribute.manage_attribute', compact('attributes'));
    }

    // View
    public function view($id){
        $attr = ProductAttribute::findOrFail($id);
        return view('admin.product_attribute.view_attribute', compact('attr'));
    }

    // Edit
    public function edit($id){
        $attr = ProductAttribute::findOrFail($id);
        return view('admin.product_attribute.edit_attribute', compact('attr'));
    }

    // Update
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|in:1,0'
        ]);

        $attr = ProductAttribute::findOrFail($id);
        $attr->update([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
            'status' => $request->status == 1 ? 'Active' : 'Inactive'
        ]);

        return redirect()->route('product_attribute.manage_attribute')->with('success','Attribute updated successfully!');
    }

    // Delete
    public function delete($id){
        $attr = ProductAttribute::findOrFail($id);
        $attr->delete();
        return redirect()->route('product_attribute.manage_attribute')->with('success','Attribute deleted successfully!');
    }

    // Toggle status
    public function toggleStatus($id){
        $attr = ProductAttribute::findOrFail($id);
        $attr->status = $attr->status == 'Active' ? 'Inactive' : 'Active';
        $attr->save();
        return redirect()->route('product_attribute.manage_attribute')->with('success','Status updated successfully!');
    }
}
