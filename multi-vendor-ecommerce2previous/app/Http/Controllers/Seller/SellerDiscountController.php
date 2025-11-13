<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerDiscountController extends Controller
{
     public function index(){
        return view('seller.discount.create_discount');
    }
    public function manage_discount(){
        return view('seller.discount.manage_discount');
    }
}
