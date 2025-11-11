<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
        public function index() {
             return view('admin.inventory.payment.purchase_payment');
    }
        public function admin_invoice() {
             return view('admin.inventory.payment.admin_invoice');
    }
}
