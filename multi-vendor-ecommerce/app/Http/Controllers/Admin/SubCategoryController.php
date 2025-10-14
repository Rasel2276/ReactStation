<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index(){
        return view('admin.sub_category.create_sub_category');
    }
     public function manage_sub_category(){
        return view('admin.sub_category.manage_sub_category');
    }
}
