<?php
namespace App\Http\Controllers;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorAuthController extends Controller
{
    public function showRegisterForm(){ return view('vendor.auth.register'); }
    public function showLoginForm(){ return view('vendor.auth.login'); }

    public function register(Request $req){
        $req->validate([
            'name'=>'required',
            'email'=>'required|email|unique:vendors,email',
            'password'=>'required|min:6|confirmed',
            'company_name'=>'nullable|string',
        ]);

        $vendor = Vendor::create([
            'name'=>$req->name,
            'email'=>$req->email,
            'company_name'=>$req->company_name,
            'password'=>Hash::make($req->password),
        ]);

        Auth::guard('vendor')->login($vendor);
        return redirect()->route('vendor.dashboard');
    }

    public function login(Request $req){
        $req->validate(['email'=>'required|email','password'=>'required']);
        $credentials = $req->only('email','password');

        if(Auth::guard('vendor')->attempt($credentials, $req->filled('remember'))){
            $req->session()->regenerate();
            return redirect()->intended(route('vendor.dashboard'));
        }
        return back()->withErrors(['email'=>'Credentials not match']);
    }

    public function logout(Request $req){
        Auth::guard('vendor')->logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect()->route('vendor.login');
    }
}
