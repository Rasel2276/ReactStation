<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VendorPurchase; // VendorPurchase মডেল ব্যবহার হচ্ছে
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // DB Facade ব্যবহার হচ্ছে

class SellerPaymentController extends Controller
{
    /**
     * ✅ NEW CORE LOGIC: Purchase Payment Submission and Status Update
     * এটি Vendor-এর পেমেন্ট ফর্ম থেকে সাবমিট হবে এবং Status 'Pending' থেকে 'Completed'-এ পরিবর্তন করবে।
     */
    public function submitPurchasePayment(Request $request) 
    {
        $request->validate([
            // purchase_ids_string থেকে আইডিগুলি অ্যারেতে নেওয়া হবে
            'purchase_ids_string' => 'required|string', 
            'payment_method' => 'required|string|max:50',
            // 'total_amount' এর ভ্যালিডেশন এখানে ঐচ্ছিক, তবে ভালো প্র্যাকটিস
        ]);

        $purchaseIds = explode(',', $request->purchase_ids_string);
        // কমা সেপারেটেড স্ট্রিংকে ইনটিজার অ্যারেতে রূপান্তর করা
        $purchaseIds = array_map('intval', $purchaseIds);
        
        $vendorId = Auth::id();

        DB::beginTransaction();
        try {
            // 1. Pending Purchase রিকোয়েস্টগুলি খুঁজে বের করা
            $purchases = VendorPurchase::whereIn('id', $purchaseIds)
                                       ->where('vendor_id', $vendorId)
                                       ->where('status', 'Pending') 
                                       ->get();

            if ($purchases->isEmpty()) {
                DB::rollBack();
                return back()->with('error', 'No valid pending purchase requests found for payment processing.');
            }

            // 2. প্রতিটি রিকোয়েস্টের স্ট্যাটাস 'Completed' (Paid) এ আপডেট করা
            foreach ($purchases as $purchase) {
                // স্ট্যাটাস Completed মানে Payment Successful এবং Stock Allocation এর জন্য প্রস্তুত
                $purchase->status = 'Completed'; 
                // $purchase->payment_method = $request->payment_method; // যদি VendorPurchase মডেলে এই ফিল্ড থাকে
                $purchase->save();
            }

            DB::commit();

            return back()->with('success', 'Payment successful! Requests are now awaiting Admin stock allocation.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment processing failed: ' . $e->getMessage());
        }
    }
    
    /**
     * ✅ UPDATED DYNAMIC VIEW FUNCTION
     * পেমেন্ট পেজ দেখানোর জন্য Vendor-এর Pending purchase ডাটা লোড করে।
     */
    public function seller_purchase_payment(){
        $vendorId = Auth::id();
        
        // Vendor-এর Pending purchase রিকোয়েস্টগুলি Fetch করা
        $pendingPurchases = VendorPurchase::where('vendor_id', $vendorId)
                                         ->where('status', 'Pending')
                                         // রিলেশন লোড করা, যা Blade ফাইলে product->name অ্যাক্সেস করতে সাহায্য করবে
                                         ->with('adminStock.product') 
                                         ->get();
                                         
        // সমস্ত pending purchase-এর মোট মূল্য গণনা করা
        $totalPayable = $pendingPurchases->sum('total'); 

        // ডাটা View ফাইলে পাঠানো
        return view('seller.inventory.payment.seller_payment', compact('pendingPurchases', 'totalPayable'));
    }

    // --- অন্যান্য সাধারণ ফাংশন ---

    public function index(){
        return view('seller.payment.payout_request');
    }

    public function payout_paid_list(){
        return view('seller.payment.payout_paid_list');
    }

    public function payout_pending_list(){
        return view('seller.payment.payout_pending_list');
    }

    public function refund(){
        return view('seller.payment.refund');
    }
}