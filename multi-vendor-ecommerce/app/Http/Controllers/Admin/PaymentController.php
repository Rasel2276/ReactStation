<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
     public function index(){
        return view('admin.payment.vendor_payouts_request');
    }
     public function approve_payouts(){
        return view('admin.payment.approve_payouts');
    }

     public function payment_method(){
        return view('admin.payment.payment_method');
    }

     public function transecton(){
        return view('admin.payment.transecton');
    }

     public function report(){
        return view('admin.payment.report');
    }
}
