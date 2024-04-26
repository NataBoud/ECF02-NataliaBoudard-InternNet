<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOpportunityRequest;
use App\Models\Opportunity;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OpportunityController extends Controller
{

    public function index(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunities = Opportunity::orderBy('created_at', 'desc')->get();
//        dd($opportunities);
        return view('welcome', compact('opportunities'));
    }


    public function create(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('opportunity.create');
    }

    // CREATE
    public function store(StoreOpportunityRequest $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validated();
        $opportunity = new Opportunity([
            ...$validated,
            'user_id' => Auth::id(),
            'company_id' => Auth::user()->company->id,
        ]);

        $opportunity->save();

        return redirect()
            ->route('opportunities.offers')
            ->with('success', 'Opportunité créée avec succès!');
    }

    public function showUserOffers(): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunities = Opportunity::where('user_id', auth()->id())->get();
        return view('opportunity.offers', compact('opportunities'));
    }


    public function show($id): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunity = Opportunity::findOrFail($id);
//      return view('opportunity.show', ['opportunity' => $opportunity]);
        return view('opportunity.show', compact('opportunity'));
    }

    // UPDATE ARTICLE PAR ID

    public function edit($id): View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $opportunity = Opportunity::findOrFail($id);
        return view('opportunity.edit')->with('opportunity', $opportunity);
    }

    public function update(Request $request, $id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $request->validate([
            'title' => 'required|string|min:2|max:255',
            'typeContract' => 'required|string|min:2|max:255',
            'start' => 'required|date',
            'end' => 'nullable|date',
            'description' => 'required|string'
        ]);

        $opportunity = Opportunity::findOrFail($id);
        $opportunity->update($request->all());

        return redirect()
            ->route('opportunities.show', $opportunity->id)
            ->with('success', 'Opportunité mis à jour avec succès');
    }



    public function destroy($id): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $article = Opportunity::findOrFail($id);

        $article->delete();

        return redirect('/')
            ->with('success', 'Opportunité supprimé avec succès');
    }

}
