<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthClient
{
    public function handle(Request $request, Closure $next)
    {
        if (!Session::has('client_id')) {
            return redirect()->route('client.login')
                             ->with('error', 'Veuillez vous connecter.');
        }

        return $next($request);
    }
}