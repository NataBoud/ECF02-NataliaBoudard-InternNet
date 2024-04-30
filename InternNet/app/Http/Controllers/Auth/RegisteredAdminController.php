<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredAdminController extends Controller

{


    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register-admin');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.Admin::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Vérification du mot de passe pour définir le statut d'administrateur
        $isAdmin = $request->password === 'passwordpassword';

        // Si l'utilisateur ne saisit pas le bon mot de passe, ne créez pas un administrateur
        if (!$isAdmin) {
            return redirect()->back()->withErrors(['password' => 'You need to enter the correct password to register as an administrator.'])->withInput();
        }
        $admin = Admin::create([
            'is_admin' => $isAdmin,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($admin));

        Auth::login($admin);

        return redirect(route('dashboard', absolute: false));
    }
}
