<?php

namespace App\Http\Controllers;

use App\Models\CampagnePromotionnelle;
use Illuminate\Http\Request;

class CampagnePromotionnelleController extends Controller
{
    public function index()
    {
        $campagnes = CampagnePromotionnelle::all();
        return view('backoffice.campagnePromotionnelle.index', compact('campagnes'));

    }

    public function create()
    {
        return view('backoffice.campagnePromotionnelle.create');
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|max:255',
        'budget' => 'required|numeric',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
    ]);

    CampagnePromotionnelle::create($validatedData);

    return redirect()->route('campagnes.index')->with('success', 'Campagne promotionnelle créée avec succès.');
}


    public function show(CampagnePromotionnelle $campagne)
    {
        return view('backoffice.campagnePromotionnelle.show', compact('campagne'));
    }

    public function edit(CampagnePromotionnelle $campagne)
    {
        return view('backoffice.campagnePromotionnelle.edit', compact('campagne'));
    }

    public function update(Request $request, CampagnePromotionnelle $campagne)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'budget' => 'required|numeric',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ]);

        $campagne->update($validatedData);

        return redirect()->route('campagnes.index')->with('success', 'Campagne promotionnelle mise à jour avec succès.');
    }

    public function destroy(CampagnePromotionnelle $campagne)
    {
        $campagne->delete();

        return redirect()->route('campagnes.index')->with('success', 'Campagne promotionnelle supprimée avec succès.');
    }
}
