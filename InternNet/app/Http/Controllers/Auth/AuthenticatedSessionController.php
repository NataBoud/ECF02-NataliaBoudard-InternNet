<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Vérifier si l'utilisateur authentifié est un administrateur
        if (Auth::check() && Auth::user()->isAdmin()) {
            // Si c'est un administrateur, rediriger vers une route spécifique pour les administrateurs
            return redirect()->intended(route('dashboard', absolute: false));
        } else {
            // Sinon, rediriger vers une route par défaut pour les utilisateurs normaux
            return redirect()->intended(route('opportunities.offers', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();// Utilise le garde utilisé pour l'authentification (peut être 'web' ou 'admin')

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
