<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerProduct;

class CartController extends Controller
{
    // Add product to cart
    public function add(Request $request)
    {
        $product = CustomerProduct::find($request->product_id);

        if (!$product || $product->quantity < 1) {
            return redirect()->back()->with('error', 'Product not available');
        }

        $cart = session()->get('cart', []);

        // If product already exists in cart, increment quantity
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "name" => $product->product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }
}
