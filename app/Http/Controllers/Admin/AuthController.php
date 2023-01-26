<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    /**
     * Get login form
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * Check login 
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:16|min:8'
        ]);
        
        if(Auth::guard('admin')->attempt(['email' => trim($request->email), 'password' => trim($request->password)])) {
            return redirect()->route('admin.dashboard')->with('success', 'You are logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Whoops! invalid email or password');
        }
    }

    /**
     * AAdmin logout
     */
    public function logout()
    {
        auth()->guard('admin')->logout();
        session()->flush();
        return redirect()->route('admin.login')->with('success', 'You are logged out successfully');
    }
}