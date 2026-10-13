<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('admin.package.booking.index');
        }
        return view('admin.pages.login');
    }

     public function login(Request $request)
        {
            $credentials = $request->validate([
                'email'    => 'required|email',
                'password' => 'required',
            ]);
    
            $remember = $request->has('remember'); // ← checkbox ki value lo
    
            if (Auth::attempt($credentials, $remember)) { // ← yahan pass karo
                $request->session()->regenerate();
                return redirect()->route('admin.package.booking.index');
            }
    
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ]);
        }

    public function dashboard()
    {
        return view('admin.pages.dashboard');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
