<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{

    public function create(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('opportunity.create');
    }

    // CREATE
    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|min:2|max:255',
            'typeContract' => 'required|string|min:2|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'description' => 'required|string'
        ]);

        $opportunity = new Opportunity([
            'title' => $validated['title'],
            'typeContract' => $validated['typeContract'],
            'description' => $validated['description'],
            'start' => $validated['start'],
            'end' => $validated['end'],
            'company' => Auth::user()->name,
            'user_id' => Auth::id(),
        ]);

        $opportunity->save();

        return redirect()
            ->route('opportunities.index')
            ->with('success', 'Opportunité créée avec succès!');
    }

    public function index(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunities = Opportunity::all();
//        dd($opportunities);
        return view('welcome', ['opportunities' => $opportunities]);
    }


    public function show($id): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunity = Opportunity::findOrFail($id);
        return view('opportunity.show', ['opportunity' => $opportunity]);
    }

    // UPDATE ARTICLE PAR ID
    public function update(Request $request, $id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $request->validate([
            'title' => 'required|string|min:2|max:255',
            'typeContract' => 'required|string|min:2|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'description' => 'required|string'
        ]);

        $opportunity = Opportunity::find($id);
        $opportunity->update($request->all());

        return redirect('/opportunity/' . $id)
            ->with('success', 'Opportunité mis à jour avec succès');
    }

    public function edit($id): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $article = Opportunity::find($id);
        return view('opportunity.edit')->with('article', $article);
    }


    public function destroy($id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $article = Opportunity::findOrFail($id);

        $article->delete();

        return redirect('/')
            ->with('success', 'Opportunité supprimé avec succès');
    }

}
