<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CustomerProduct;

class WebsitePagesController extends Controller
{
    public function shop(){

    $customerProducts = CustomerProduct::with(['product','vendor'])->get();
    
    return view('front_end.websitepages.shop', compact('customerProducts'));
    }
}
