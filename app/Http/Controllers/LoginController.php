<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:investor,entrepreneur,admin', // Validate selected role
        ]);

        $credentials = $request->only('email', 'password');
        $selectedRole = $request->input('role');

        // Attempt authentication
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the selected role matches either role or role1
            $validRole = ($user->role === $selectedRole) || ($user->role1 === $selectedRole);

            if ($validRole) {
                if ($selectedRole === 'investor' && $user->investor && $user->investor->approved == 1) {
                    session(['selected_role' => $selectedRole]); // Store selected role in session
                    return redirect()->route('admin.dashboard');
                } elseif ($selectedRole === 'entrepreneur') {
                    session(['selected_role' => $selectedRole]); // Store selected role in session
                    return redirect()->route('entrepreneur.edit');
                } elseif ($selectedRole === 'admin') {
                    session(['selected_role' => $selectedRole]); // Store selected role in session
                    return redirect()->route('admin.dashboard');
                } elseif ($selectedRole === 'investor' && (!$user->investor || $user->investor->approved != 1)) {
                    Auth::logout();
                    return back()->withErrors(['email' => 'You are not approved. Please wait for approval.'])->withInput();
                }
            } else {
                Auth::logout();
                return back()->withErrors(['role' => 'Selected role does not match your account.'])->withInput();
            }
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->withInput();
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