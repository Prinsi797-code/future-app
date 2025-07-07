<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class OtpController extends Controller {
    public function send(Request $request) {
        $validator = Validator::make($request->all(), [
            'country_code' => 'required|string',
            'phone_number' => 'required|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $fullMobile = $request->country_code . $request->phone_number;

        // Generate random 6-digit OTP
        $otp = rand(100000, 999999);

        // Find or create user by mobile number
        $user = User::firstOrNew(['phone_number' => $fullMobile]);
        $user->otp = $otp;
        $user->role = null; // reset role if you want
        $user->save();

        // TODO: Send OTP SMS here with your SMS gateway
        // For now, just flash OTP for demo
        session()->flash('otp_demo', "Your OTP is: $otp");

        return view('otp', ['phone_number' => $fullMobile]);
    }

    // Verify OTP entered by user
    public function verify(Request $request) {
        $request->validate([
            'phone_number' => 'required|string',
            'otp' => 'required|string',
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['phone_number' => 'Mobile number not found']);
        }

        if ($user->otp != $request->otp) {
            return redirect()->back()->withErrors(['otp' => 'Invalid OTP']);
        }

        // OTP verified - clear OTP and redirect to role selection
        $user->otp = null;
        $user->save();

        // Log user in or store user id in session for form steps
        session(['user_id' => $user->id]);

        return redirect()->route('choose.role');
    }
}