<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminStock;

class InventoryController extends Controller
{
    public function index(){
        return view('seller.inventory.purchase');
    }

    public function purchase_return(){
        return view('seller.inventory.purchase_return');
    }

    public function manage_stock(){
        return view('seller.inventory.manage_stock');
    }

    // ✅ Vendor will see Admin Product Stock List
    public function admin_product_list(){
        $stocks = AdminStock::with('product')->get();  
        return view('seller.inventory.admin_product_list', compact('stocks'));
    }
}


