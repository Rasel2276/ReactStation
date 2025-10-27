<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminMainController extends Controller
{
    public function index(){
        return view('admin.admin');
    } 
    public function setting(){
        return view('admin.setting');
    } 
    public function manage_user(){
        return view('admin.manage.user');
    } 
    public function manage_store(){
        return view('admin.manage.store');
    } 
    public function cart_history(){
        return view('admin.cart.cart_history');
    } 
    public function order_history(){
        return view('admin.order.order_history');
    }
    public function sales(){
        return view('admin.order.sales');
    }
    public function total_income(){
        return view('admin.order.total_income');
    } 
}

