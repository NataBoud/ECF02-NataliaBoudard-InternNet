<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTypeContratRequest;
use App\Models\TypeContrat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TypeContratController extends Controller
{

    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application

    {
        $user = Auth::user();
        $typeContrats = $user->typeContrat;

        return view('admin.dashboard', compact('typeContrats'));
    }

    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $typeContrats = TypeContrat::all();
        return view('admin.dashboard', compact('typeContrats'));
    }


    public function store(StoreTypeContratRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();

        $typeContrat = new TypeContrat([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        $typeContrat->save();

        return redirect()
            ->route('admin-dashboard')
            ->with('success', 'Type de contrat créé avec succès!');
    }

}
