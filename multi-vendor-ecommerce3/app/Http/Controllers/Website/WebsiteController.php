<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebsiteController extends Controller
{
    // Home page
    public function home()
    {
        return view('front_end.home.website');
    }

    public function checkout()
    {
        return view('front_end.home.navbar.check_out');
    }

    public function view_cart()
    {
        return view('front_end.home.navbar.view_cart');
    }

    // Show login form (Breeze)
    public function loginForm()
    {
        return view('auth.login'); // Breeze login
    }

    // Show registration form (Breeze)
    public function registerForm()
    {
        return view('auth.register'); // Breeze registration
    }
}
