<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminPurchase; 
use Illuminate\Support\Facades\DB; 

class PaymentController extends Controller
{
    /**
     * Display the purchase payment form.
     */
    public function index(Request $request) 
    {
        $purchase_ids_string = $request->query('purchase_ids');
        $total_amount        = $request->query('total_amount', 0);

        if (!$purchase_ids_string) {
            return redirect()->route('inventory.purchase_record')->with('error', 'Invalid payment request.');
        }

        $purchase_ids = explode(',', $purchase_ids_string);
        
        // Load pending purchases for the payment form view
        $purchases = AdminPurchase::whereIn('id', $purchase_ids)
                                    ->with(['supplier', 'product'])
                                    ->get();

        return view('admin.inventory.payment.purchase_payment', compact('purchases', 'total_amount', 'purchase_ids_string'));
    }

    /**
     * Handle payment submission, update status, and redirect to invoice.
     */
    public function submit_payment(Request $request)
    {
        $request->validate([
            'purchase_ids_string' => 'required|string',
            'payment_method'      => 'required|string|max:50',
        ]);

        $purchase_ids = explode(',', $request->purchase_ids_string);
        $payment_method = $request->payment_method;

        try {
            DB::beginTransaction();

            // Update status and payment method for all purchases
            AdminPurchase::whereIn('id', $purchase_ids)
                ->update([
                    'status' => 'Completed', 
                    'payment_method' => $payment_method,
                ]);

            DB::commit(); 

            // পেমেন্ট সফল হলে ইনভয়েস পেজে রিডাইরেক্ট করা হচ্ছে
            return redirect()->route('admin_invoice', [
                'purchase_ids' => $request->purchase_ids_string
            ])->with('success', 'Purchase Completed! Invoice Generated.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Payment failed! Please try again.');
        }
    }

    /**
     * Load data and display the purchase invoice.
     */
    public function admin_invoice(Request $request) {
        $purchase_ids_string = $request->query('purchase_ids');
        
        if (!$purchase_ids_string) {
            return redirect()->route('inventory.purchase_record')->with('error', 'No invoice found.');
        }

        $purchase_ids = explode(',', $purchase_ids_string);

        // Load purchases with necessary relationships
        $purchases = AdminPurchase::whereIn('id', $purchase_ids)
                                    ->with(['supplier', 'product', 'admin'])
                                    ->get();

        if ($purchases->isEmpty()) {
             return redirect()->route('inventory.purchase_record')->with('error', 'No purchase data found for invoice.');
        }

        // Calculate totals
        $total_amount = $purchases->sum('total');
        $total_quantity = $purchases->sum('quantity');
        
        return view('admin.inventory.payment.admin_invoice', compact('purchases', 'total_amount', 'total_quantity'));
    }
}