<?php

namespace App\Http\Controllers;

use App\Models\Programme;
use Illuminate\Http\Request;
use App\Models\Formation; // Importation du modèle Formateur

class ProgrammeController extends Controller
{
    public function index()
    {
        $programmes = Programme::all();
        return view('programmes.index', compact('programmes'));
    }

    public function create()
    {
        return view('programmes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'objectif' => 'required|string',
            'contenu' => 'nullable|string',
        ]);

        $programme = Programme::create($request->all());

        return redirect()->route('programmes.index')->with('status', 'Programme créé avec succès!');
    }

    public function show(Programme $programme)
    {
        $formations = $programme->formations; 
        return view('programmes.show', compact('programme', 'formations'));

    }

    public function edit(Programme $programme)
    {
        return view('programmes.edit', compact('programme'));
    }

    public function update(Request $request, Programme $programme)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'objectif' => 'required|string',
            'contenu' => 'nullable|string',
        ]);

        $programme->update($request->all());

        return redirect()->route('programmes.index')->with('status', 'Programme mis à jour avec succès!');
    }

    public function destroy(Programme $programme)
    {
        $programme->delete();
        return redirect()->route('programmes.index')->with('status', 'Programme supprimé avec succès!');
    }
    public function affecter(Request $request, $formationId)
{
    $formation = Formation::findOrFail($formationId);
    $programmes = Programme::all();

    return view('programmes.affecter', compact('formation', 'programmes'));
}

public function storeAffectation(Request $request, $formationId)
{
    $formation = Formation::findOrFail($formationId);
    $formation->programmes()->sync($request->programmes);

    return redirect()->route('formations.index')->with('status', 'Programmes affectés avec succès!');
}




}
