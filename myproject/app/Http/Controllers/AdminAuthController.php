<?php
namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $req){
        $req->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);

        $credentials = $req->only('email','password');

        if(Auth::guard('admin')->attempt($credentials, $req->filled('remember'))){
            $req->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors(['email'=>'Credentials do not match.']);
    }

    public function logout(Request $req){
        Auth::guard('admin')->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}

