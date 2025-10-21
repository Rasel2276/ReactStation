<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerHistoryController extends Controller
{
    public function index(){
        return view('seller.history.total_income');
    }

     public function sales_report(){
        return view('seller.history.sales_report');
    }

     public function transection(){
        return view('seller.history.transection');
    }

     public function account_setting(){
        return view('seller.history.account_setting');
    }
}
