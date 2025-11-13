<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerPaymentController extends Controller
{
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
