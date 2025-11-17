<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerOrder;
use App\Models\CustomerOrderItem;
use App\Models\GuestCustomer;

class SellerMainController extends Controller
{
    // Vendor Dashboard
    public function index(){
        return view('seller.dashboard');
    }

    // Vendor-specific Order List
    public function order_list(){
        $vendorId = auth()->id();

        $orders = CustomerOrder::whereHas('orderItems.customerProduct', function($query) use ($vendorId){
            $query->where('vendor_id', $vendorId);
        })->latest()->get();

        return view('seller.order.order_list', compact('orders'));
    }

    // Vendor-specific Customer Order Items
    public function customer_order_items(){
        $vendorId = auth()->id();

        $order_items = CustomerOrderItem::with('customerProduct','order')
            ->whereHas('customerProduct', function($query) use ($vendorId){
                $query->where('vendor_id', $vendorId);
            })
            ->latest()
            ->get();

        return view('seller.order.customer_order_items', compact('order_items'));
    }

    // Vendor-specific Guest Customer Information
    public function guest_customer_information(){
        $vendorId = auth()->id();

        $guests = GuestCustomer::whereHas('orderItems.customerProduct', function($query) use ($vendorId){
            $query->where('vendor_id', $vendorId);
        })->latest()->get();

        return view('seller.order.guest_customer', compact('guests'));
    }

    // --- Delete Methods ---
    public function delete_order($id){
        CustomerOrder::findOrFail($id)->delete();
        return redirect()->back()->with('success','Order deleted successfully.');
    }

    public function delete_order_item($id){
        CustomerOrderItem::findOrFail($id)->delete();
        return redirect()->back()->with('success','Order item deleted successfully.');
    }

    public function delete_guest($id){
        GuestCustomer::findOrFail($id)->delete();
        return redirect()->back()->with('success','Guest customer deleted successfully.');
    }
}
