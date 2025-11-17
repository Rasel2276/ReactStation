<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use App\Models\GuestCustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        return view('front_end.home.navbar.check_out', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'country'=>'required',
            'street_address'=>'required',
            'city'=>'required',
            'state'=>'required',
            'postcode'=>'required'
        ]);

        DB::beginTransaction();
        try {
            $cart = session()->get('cart', []);
            if(empty($cart)) return redirect()->back()->with('error','Cart is empty');

            $subtotal = collect($cart)->sum(fn($item)=> $item['price'] * $item['quantity']);
            $shippingCost = 0;
            $totalPayment = $subtotal + $shippingCost;

            $orderData = [
                'subtotal'=>$subtotal,
                'shipping_cost'=>$shippingCost,
                'total_payment'=>$totalPayment,
                'shipping_method'=>'Free Shipping',
                'payment_method'=>'Direct Bank Transfer',
                'status'=>'Pending'
            ];

            if(Auth::check()){
                $orderData['customer_id'] = Auth::id();
            } else {
                $guest = GuestCustomer::create($request->only(
                    'first_name','last_name','email','phone','company_name',
                    'country','street_address','street_address2','city','state','postcode','order_notes'
                ));
                $orderData['guest_id'] = $guest->id;
            }

            $order = CustomerOrder::create($orderData);

            foreach($cart as $item){
                CustomerOrderItem::create([
                    'order_id'=>$order->id,
                    'customer_product_id'=>$item['id'],
                    'quantity'=>$item['quantity'],
                    'price'=>$item['price']
                ]);
            }

            session()->forget('cart');
            DB::commit();

            return redirect()->route('website.home')->with('success','Order placed successfully');
        } catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
