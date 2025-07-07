<?php

namespace App\Http\Middleware;

use App\Models\DummyEntrepreneur;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class ShareEntrepreneurStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $hasEntrepreneurEntry = false;
        if (Auth::check()) {
            $userId = Auth::id();
            $entrepreneur = DummyEntrepreneur::where('user_id', $userId)->first();
            if ($entrepreneur) {
                $hasEntrepreneurEntry = true;
            }
        }
        view()->share('hasEntrepreneurEntry', $hasEntrepreneurEntry);
        return $next($request);
        // return $next($request);
    }
}