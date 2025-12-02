<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Category;

class CategoryController extends Controller
{
    // Show create category form
    public function index(){
        return view('admin.category.create_category');
    }


    // Show manage category page
    public function manage_category(){
        $categories = Category::all(); // Eloquent fetch all categories
        return view('admin.category.manage_category', compact('categories'));
    }



    // Store category data using Eloquent
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|in:Active,Inactive'
        ]);

        // Generate slug if empty
        $slug = $request->slug;
        if(empty($slug)){
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name)));
        }

        // Upload image if exists
        $imageName = null;
        if ($request->hasFile('category_image')) {
            $image = $request->file('category_image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('category_images'), $imageName);
        }

        // Insert using Eloquent
        Category::create([
            'category_name' => $request->category_name,
            'slug' => $slug,
            'description' => $request->description,
            'category_image' => $imageName,
            'status' => $request->status
        ]);

        return redirect()->route('category.create_category')->with('success', 'Category added successfully!');
    }



    // Delete category
    public function delete($id){
        $category = Category::findOrFail($id);
        
        // Delete image from folder if exists
        if($category->category_image && file_exists(public_path('category_images/'.$category->category_image))){
            unlink(public_path('category_images/'.$category->category_image));
        }

        $category->delete();

        return redirect()->route('category.manage_category')->with('success', 'Category deleted successfully!');
    }

    

    // Show edit form
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.category.edit_category', compact('category'));
    }

    // Update category
    public function update(Request $request, $id){
        $category = Category::findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category_image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'status' => 'required|in:Active,Inactive'
        ]);

        // Generate slug if empty
        $slug = $request->slug ?: strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->category_name)));

        // Upload new image if exists
        if ($request->hasFile('category_image')) {
            // Delete old image
            if($category->category_image && file_exists(public_path('category_images/'.$category->category_image))){
                unlink(public_path('category_images/'.$category->category_image));
            }

            $image = $request->file('category_image');
            $imageName = time().'_'.$image->getClientOriginalName();
            $image->move(public_path('category_images'), $imageName);
            $category->category_image = $imageName;
        }

        $category->update([
            'category_name' => $request->category_name,
            'slug' => $slug,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('category.manage_category')->with('success', 'Category updated successfully!');
    }
}

