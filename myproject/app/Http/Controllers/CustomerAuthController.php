<?php
namespace App\Http\Controllers;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function showRegisterForm(){ return view('customer.auth.register'); }
    public function showLoginForm(){ return view('customer.auth.login'); }

    public function register(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:customers,email',
            'password'=>'required|min:6|confirmed',
        ]);

        $customer = Customer::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
        ]);

        Auth::guard('customer')->login($customer);
        return redirect()->route('customer.dashboard');
    }

    public function login(Request $req){
        $req->validate(['email'=>'required|email','password'=>'required']);
        $credentials = $req->only('email','password');

        if(Auth::guard('customer')->attempt($credentials, $req->filled('remember'))){
            $req->session()->regenerate();
            return redirect()->intended(route('customer.dashboard'));
        }
        return back()->withErrors(['email'=>'Credentials not match']);
    }

    public function logout(Request $req){
        Auth::guard('customer')->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('customer.login');
    }
}

