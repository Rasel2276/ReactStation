<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminInventoryController extends Controller
{
    public function index(){
        return view('admin.inventory.add_suplier');
    }
    public function purchase(){
        return view('admin.inventory.purchase');
    }
    public function purchase_records(){
        return view('admin.inventory.purchase_records');
    }
    public function add_stock(){
        return view('admin.inventory.add_stock');
    }
    public function stock_records(){
        return view('admin.inventory.stock_records');
    }
    public function purchase_return(){
        return view('admin.inventory.purchase_return');
    }
    public function return_record(){
        return view('admin.inventory.return_record');
    }
    public function product(){
        return view('admin.inventory.product');
    }
    public function product_records(){
        return view('admin.inventory.product_records');
    }
}
