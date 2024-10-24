<?php

namespace App\Http\Controllers;

use App\Models\CampagnePromotionnelle;
use Illuminate\Http\Request;

class CampagnePromotionnelleController extends Controller
{
    public function index()
    {
        $campagnes = CampagnePromotionnelle::paginate(5);
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
        'budget' => 'required|numeric|min:0',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
    ], [
        'date_debut.required' => 'La date de début est obligatoire.',
        'date_debut.date' => 'La date de début doit être une date valide.',
        'date_fin.required' => 'La date de fin est obligatoire.',
        'date_fin.date' => 'La date de fin doit être une date valide.',
        'date_fin.after' => 'La date de fin doit être postérieure à la date de début.',
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
            'budget' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
        ], [
            'date_debut.required' => 'La date de début est obligatoire.',
            'date_debut.date' => 'La date de début doit être une date valide.',
            'date_fin.required' => 'La date de fin est obligatoire.',
            'date_fin.date' => 'La date de fin doit être une date valide.',
            'date_fin.after' => 'La date de fin doit être postérieure à la date de début.',
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
