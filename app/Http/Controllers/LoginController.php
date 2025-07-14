<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    public function Login(Request $request)
    {
        return view('Auth.login');
    }
    // public function loginProcess(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         if ($user->role === 'admin' || $user->role === 'investor') {
    //             return redirect()->route('admin.dashboard');
    //         } elseif ($user->role === 'entrepreneur') {
    //             return redirect()->route('entrepreneur.edit');
    //         } else {
    //             Auth::logout();
    //             return back()->withErrors(['email' => 'Access denied.']);
    //         }
    //     }

    //     return back()->withErrors(['email' => 'Invalid Credentials'])->withInput();
    // }
    public function loginProcess(Request $request)
    {
        Log::info("loginProcess", []); // Context as empty array for simple message

        // Check if role is provided in request (for non-admin users)
        $roleRequired = $request->has('role');
        Log::info("role", ['roleRequired' => $roleRequired]);
        if ($roleRequired) {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                'role' => 'required|in:investor,entrepreneur',
            ]);
        } else {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);
        }

        $credentials = $request->only('email', 'password');

        Log::info("data", ['credentials' => $credentials]); // Wrap credentials in array


        // Attempt authentication
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if user is admin (no role selection needed)
            if ($user->role === 'admin' || $user->role1 === 'admin') {
                session(['selected_role' => 'admin']);
                return redirect()->route('admin.dashboard');
            }

            // For non-admin users, role selection is required
            if (!$roleRequired) {
                Auth::logout();
                return back()->withErrors(['role' => 'Please select your role to continue.'])->withInput();
            }

            $selectedRole = $request->input('role');

            // Check if the selected role matches either role or role1
            $validRole = ($user->role === $selectedRole) || ($user->role1 === $selectedRole);

            Log::info("validate role", ['validRole' => $validRole]); // Wrap boolean in array

            if ($validRole) {
                if ($selectedRole === 'investor' && $user->investor && $user->investor->approved == 1) {
                    session(['selected_role' => $selectedRole]);
                    return redirect()->route('admin.dashboard');
                } elseif ($selectedRole === 'entrepreneur') {
                    session(['selected_role' => $selectedRole]);
                    if (!$user->entrepreneur) {
                        // Profile not complete, redirect to form
                        return redirect()->route('entrepreneur.form', ['user_id' => $user->id]);
                    }
                    // Profile is complete, redirect to edit page
                    return redirect()->route('entrepreneur.edit');
                } elseif ($selectedRole === 'investor') {
                    session(['selected_role' => $selectedRole]);
                    Log::info('ROLE', ['selectedRole' => $selectedRole]);
                    if (!$user->investor) {
                        // Redirect to investor edit page if not approved or no investor profile
                        return redirect()->route('investor.form', ['user_id' => $user->id]);
                    }
                    return redirect()->route('investor.edit');
                }
            } else {
                Auth::logout();
                return back()->withErrors(['role' => 'Selected role does not match your account.'])->withInput();
            }
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->withInput();
    }
    /**
     * Check if entrepreneur profile is complete
     */
    private function isEntrepreneurProfileComplete($entrepreneur)
    {
        if (!$entrepreneur) {
            return false;
        }

        // Add your conditions here to check if profile is complete
        // Example: check if required fields are filled
        return !empty($entrepreneur->company_name) &&
            !empty($entrepreneur->business_type) &&
            !empty($entrepreneur->description);

        // You can add more fields as per your requirements
        // return $entrepreneur->is_profile_complete === 1; // if you have a flag
    }
    // change password 
    public function showChangePasswordForm()
    {
        return view('Auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'The current password field is required.',
            'new_password.required' => 'The new password field is required.',
            'new_password.min' => 'The new password must be at least 8 characters.',
            'new_password.confirmed' => 'The new password confirmation does not match.',
        ]);

        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('admin.dashboard')->with('success', 'Password changed successfully!');
    }
}