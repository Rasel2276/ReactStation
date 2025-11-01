<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    // Home page
    public function home()
    {
        return view('front_end.home.website'); // tumi already website home blade ache
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

