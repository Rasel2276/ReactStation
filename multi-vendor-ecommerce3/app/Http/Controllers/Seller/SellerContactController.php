<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SellerContactController extends Controller
{
    public function index(){
        return view('seller.contact.chat_with_customer');
    }

     public function chat_with_admin(){
        return view('seller.contact.chat_with_admin');
    }
}
