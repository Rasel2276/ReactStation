<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsitePagesController extends Controller
{
    public function shop(){
        return view('front_end.websitepages.shop');
    }
}
