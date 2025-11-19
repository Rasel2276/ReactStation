<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorStore;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File; // File Facade for deleting files

class SellerStoreController extends Controller
{
    // --- Store Creation (Create) ---
    public function index(){
        $store = VendorStore::where('vendor_id', Auth::id())->first();
        if ($store) {
            return redirect()->route('store.manage')->with('error', 'আপনার দোকান ইতিমধ্যে তৈরি করা আছে।');
        }
        return view('seller.store.create');
    }

    // --- Handle Store Creation (POST /store/create) ---
    public function store(Request $request){
        // Validation and creation logic here (Already done)
        $request->validate([
            'store_name' => 'required|string|max:150|unique:vendor_stores,store_name',
            // ... other validation rules ...
            'store_logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'store_banner' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if (VendorStore::where('vendor_id', Auth::id())->exists()) {
             return redirect()->route('store.manage')->with('error', 'আপনি শুধুমাত্র একটি দোকান তৈরি করতে পারবেন।');
        }
        
        $logo_path = $this->uploadImage($request, 'store_logo');
        $banner_path = $this->uploadImage($request, 'store_banner');

        VendorStore::create([
            'vendor_id' => Auth::id(), 
            'store_name' => $request->store_name,
            'store_logo' => $logo_path,
            'store_banner' => $banner_path,
            // ... other fields ...
        ]);
        
        return redirect()->route('store.manage')->with('success', 'দোকানটি সফলভাবে তৈরি হয়েছে! এখন আপনি এটি পরিচালনা করতে পারেন।');
    }
    
    // --- Store Management (Read/View) ---
    public function manage(){
        // Vendor can only have one store, so we fetch it or return an empty collection/null
        $stores = VendorStore::where('vendor_id', Auth::id())->get(); // Changed to get() to handle the table view
        
        // If the vendor has no store, they should be redirected to create page.
        if ($stores->isEmpty()) {
            return redirect()->route('store.create')->with('info', 'দোকান পরিচালনা করার আগে একটি দোকান তৈরি করুন।');
        }

        return view('seller.store.manage', compact('stores'));
    }

    // --- Store Deletion (Delete) ---
    public function destroy($id){
        // Find the store and ensure it belongs to the authenticated vendor
        $store = VendorStore::where('vendor_id', Auth::id())->findOrFail($id);

        // 1. Delete associated images from the public folder
        if ($store->store_logo && File::exists(public_path($store->store_logo))) {
            File::delete(public_path($store->store_logo));
        }
        if ($store->store_banner && File::exists(public_path($store->store_banner))) {
            File::delete(public_path($store->store_banner));
        }

        // 2. Delete the record from the database
        $store->delete();

        return redirect()->route('store.manage')->with('success', 'দোকানটি সফলভাবে মুছে ফেলা হয়েছে।');
    }


    // --- Helper Method for Image Upload (Kept from previous) ---
    protected function uploadImage(Request $request, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_path = 'product_images/' . $name_gen;
            $image->move(public_path('product_images'), $name_gen);
            return $save_path;
        }
        return null;
    }
}