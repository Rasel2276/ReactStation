<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    // Show create sub-category form
    public function index(){
        $categories = Category::all();
        return view('admin.sub_category.create_sub_category', compact('categories'));
    }



    // Store sub-category
    public function store(Request $request){
        $request->validate([
            'parent_category' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|in:1,0'
        ]);

        $slug = $request->slug ?: strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));

        $imageName = null;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('sub_category_images'), $imageName);
        }

        SubCategory::create([
            'parent_category_id' => $request->parent_category,
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'image' => $imageName,
            'status' => $request->status == 1 ? 'Active' : 'Inactive'
        ]);

        return redirect()->route('sub_category.create_sub_category')->with('success','Sub-Category added successfully!');
    }




    // Manage sub-categories
    public function manage_sub_category(){
        $sub_categories = SubCategory::with('category')->get();
        return view('admin.sub_category.manage_sub_category', compact('sub_categories'));
    }




    // Toggle status
    public function toggleStatus($id){
        $sub = SubCategory::findOrFail($id);
        $sub->status = $sub->status == 'Active' ? 'Inactive' : 'Active';
        $sub->save();
        return redirect()->route('sub_category.manage_sub_category')->with('success','Status updated successfully!');
    }



    // Delete
    public function delete($id){
        $sub = SubCategory::findOrFail($id);
        if($sub->image && file_exists(public_path('sub_category_images/'.$sub->image))){
            unlink(public_path('sub_category_images/'.$sub->image));
        }
        $sub->delete();
        return redirect()->route('sub_category.manage_sub_category')->with('success','Sub-Category deleted successfully!');
    }

    

    // View sub-category (modal content)
    public function view($id){
        $sub = SubCategory::with('category')->findOrFail($id);
        return view('admin.sub_category.view_sub_category', compact('sub'));
    }
}
