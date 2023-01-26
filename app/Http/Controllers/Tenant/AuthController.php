<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Jobs\TenantDbJob;
use App\Models\Tenant;
use App\Models\TenantDbDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller {

    /**
     * store user data
     */
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:tenants,name,NULL,id,deleted_at,NULL',
            'email' => 'required|email|max:100|unique:tenants,email,NULL,id,deleted_at,NULL',
            'password' => 'required|max:16|min:8',
            'website' => 'required|max:100', 
            'license_no' => 'required|max:50', 
            'address' => 'required|max:500', 
        ]);

        try {
            $tenant = Tenant::create([
                'name' => $request->name,
                'slug' => \Str::slug($request->name),
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'website' => $request->website,
                'license_no' => $request->license_no,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'country' => $request->country,
            ]);
 
            event(new Registered($tenant));

            return redirect()->back()->with('success', 'Registred successfully');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    
    /**
     * Verify tenants email
     */
    public function verifyEmail($id, Request $request)
    {
        // return $id;
        $user = Tenant::whereId($id)->first();
        if($user) {
            if(empty($user->email_verified_at)) {
                $user->markEmailAsVerified();

                event(new Verified($user));

                $this->dispatch(new TenantDbJob($user));

                $message = 'Your e-mail is verified. You can now login.';
            } else {
                $message = "Your e-mail is already verified. You can now login.";
            }
            return redirect()->route('tenants.login', $user->slug)->with('success', $message);
        } else {
            abort(404);
        }
    }

    /**
     * Login of tenats and users
     */
    public function showLoginForm($account)
    {
        $tenant = Tenant::where('slug', $account)->first();
        if($tenant) {
            return view('tenants.auth.login', compact('tenant'));
        } else {
            return redirect()->route('home')->with('error', 'You are not registered with us');
        }
    }

    /**
     * Check login
     */
    public function login($account, Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|max:16|min:8'
        ]);

        if(Auth::attempt(['email' => trim($request->email), 'password' => trim($request->password)])) {
            $user = auth()->user();
            return redirect()->route('tenants.home', $user->slug)->with('success', 'You are logged in successfully');
        } else {
            return redirect()->back()->with('error', 'Whoops! invalid email or password');
        }
    }

    /**
     * AAdmin logout
     */
    public function logout($account)
    {
        auth()->guard('web')->logout();
        session()->flush();
        return redirect()->route('tenants.login', $account)->with('success', 'You are logged out successfully');
    }
}