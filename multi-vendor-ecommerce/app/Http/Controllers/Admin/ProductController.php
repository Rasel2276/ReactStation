<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function add_product(){
        return view('admin.product.add_product');
    }

    public function index(){
        return view('admin.product.manage_product_reviews');
    }

     public function manage_product(){
        return view('admin.product.manage_product');
    }

    public function return_product(){
        return view('admin.product.return_product');
    }

     public function purchase_request(){
        return view('admin.product.purchase_request');
    }
}
