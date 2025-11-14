<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorStock;
use App\Models\CustomerProduct;
use Illuminate\Support\Facades\Auth;

class SellerProductController extends Controller
{
     public function index(){
        $stocks = VendorStock::where('vendor_id', Auth::id())
                ->with('adminStock.product')
                ->get();
        return view('seller.product.create', compact('stocks'));
    }

    public function store(Request $request){
        $request->validate([
            'vendor_stock_id' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'details' => 'required',
            'product_image' => 'required|image',
        ]);

        $stock = VendorStock::findOrFail($request->vendor_stock_id);
        $product_id = $stock->adminStock->product_id;

        $fileName = time().'.'.$request->product_image->extension();
        $request->product_image->move(public_path('product_images'), $fileName);

        CustomerProduct::create([
            'vendor_stock_id' => $stock->id,
            'product_id' => $product_id,
            'vendor_id' => Auth::id(),
            'price' => $request->price,
            'quantity' => $request->quantity,
            'details' => $request->details,
            'image' => $fileName,
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function manage(){
        $products = CustomerProduct::where('vendor_id', Auth::id())->with('product')->get();
        return view('seller.product.manage', compact('products'));
    }

    public function destroy($id){
        $product = CustomerProduct::findOrFail($id);
        if($product->image && file_exists(public_path('product_images/'.$product->image))){
            unlink(public_path('product_images/'.$product->image));
        }
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully!');
    }

    public function return_product(){
        return view('seller.product.return_product');
    }

}
