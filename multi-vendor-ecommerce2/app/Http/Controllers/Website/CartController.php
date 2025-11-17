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
                "id" => $product->id,                   // ✅ Add id here for safety
                "name" => $product->product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    // Remove product from cart
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    // Update all product quantities at once
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        if($request->has('quantities') && is_array($request->quantities)) {
            foreach ($request->quantities as $id => $quantity) {
                if(isset($cart[$id])) {
                    $cart[$id]['quantity'] = max(1, (int)$quantity); // ensure minimum 1
                }
            }
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully!');
    }

    // Optional: Clear entire cart
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared!');
    }
}
