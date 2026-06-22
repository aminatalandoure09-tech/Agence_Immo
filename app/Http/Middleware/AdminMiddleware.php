<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // 1. On vérifie si l'utilisateur est connecté
        // 2. On vérifie si son rôle est bien 'admin'
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Accès accordé !
        }

        // Si ce n'est pas un admin, on le redirige vers l'accueil avec un message d'erreur
        return redirect('/')->with('error', 'Accès refusé. Vous devez être administrateur.');
    }
}