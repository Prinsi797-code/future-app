<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $investorCount = \App\Models\Investor::count();
        $entrepreneurCount = \App\Models\Entrepreneur::count();

        return view('Auth.dashboard', compact('investorCount', 'entrepreneurCount'));
    }
}