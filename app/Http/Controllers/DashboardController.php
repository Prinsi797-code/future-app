<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $investorCount = \App\Models\Investor::count();
    //     $entrepreneurCount = \App\Models\Entrepreneur::count();

    //     return view('Auth.dashboard', compact('investorCount', 'entrepreneurCount'));
    // }
    public function index()
    {
        $userRole = session('selected_role') ?? Auth::user()->role; // Fallback to Auth::user()->role if session is not set

        if ($userRole === 'admin') {
            // For admins: Count approved and unapproved investors and entrepreneurs
            $investorCountApproved = \App\Models\Investor::where('approved', 1)->count();
            $investorCountUnapproved = \App\Models\Investor::where('approved', 0)->count();
            $entrepreneurCountApproved = \App\Models\Entrepreneur::where('approved', 1)->count();
            $entrepreneurCountUnapproved = \App\Models\Entrepreneur::where('approved', 0)->count();
        } else {
            // For investors: Only count approved entrepreneurs
            $investorCountApproved = 0; // Not shown for investors
            $investorCountUnapproved = 0; // Not shown for investors
            $entrepreneurCountApproved = \App\Models\Entrepreneur::where('approved', 1)->count();
            $entrepreneurCountUnapproved = 0; // Not shown for investors
        }

        return view('Auth.dashboard', compact(
            'investorCountApproved',
            'investorCountUnapproved',
            'entrepreneurCountApproved',
            'entrepreneurCountUnapproved',
            'userRole'
        ));
    }
}