<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Exception;
use Illuminate\Http\Request;

class ProfileController extends Controller {

    /**
     * Get user profile form
     */
    public function showProfileForm($account)
    {
        $tenant = Tenant::whereSlug($account)->first();
        if($tenant) {
            return view('tenants.profile.edit-profile', compact('tenant'));
        } else {
            abort(404);
        }
    }

    /**
     * Save user profile detail
     */
    public function saveProfile($account, Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:tenants,name,'.auth()->id().',id,deleted_at,NULL',
            'website' => 'required|max:100', 
            'license_no' => 'required|max:50', 
            'address' => 'required|max:500', 
        ]);

        try {
            $user = Tenant::whereSlug($account)->first();
            if($user) {
                $user->fill([
                    'name' => $request->name,
                    'website' => $request->website,
                    'license_no' => $request->license_no,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => $request->country,
                ])->save();

                return redirect()->route('tenants.home', $account)->with('success', 'Profile updated successfull');
            } else {
                abort(404);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}