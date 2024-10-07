<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use App\Models\CampagnePromotionnelle;
use Carbon\Carbon;


class PromotionController extends Controller
{
    public function index()
    {
        $promotions = Promotion::all();
        return view('backoffice.promotions.index', compact('promotions'));
    }

    public function create()
    {
        $dateNow = Carbon::now();
        // Récupérer les campagnes non expirées
        $campagnes = CampagnePromotionnelle::where('date_fin', '>', $dateNow)->get();
    
        // Passer les campagnes à la vue (qu'elles soient vides ou non)
        return view('backoffice.promotions.create', compact('campagnes'));
    }

public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|max:255',
        'description' => 'required',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
        'campagne_promotionnelle_id' => 'required|exists:campagne_promotionnelles,id',
    ]);

    Promotion::create($validatedData);

    return redirect()->route('promotions.index')->with('success', 'Promotion créée avec succès.');
}


public function show(Promotion $promotion)
{
    return view('backoffice.promotions.show', compact('promotion'));
}

public function edit(Promotion $promotion)
{
    $campagnes = CampagnePromotionnelle::all();
    return view('backoffice.promotions.edit', compact('promotion', 'campagnes'));
}





public function update(Request $request, Promotion $promotion)
{
    $validatedData = $request->validate([
        'nom' => 'required|max:255',
        'description' => 'required',
        'date_debut' => 'required|date',
        'date_fin' => 'required|date|after:date_debut',
        'campagne_promotionnelle_id' => 'required|exists:campagne_promotionnelles,id',
    ]);

    $promotion->update($validatedData);

    return redirect()->route('promotions.index')->with('success', 'Promotion mise à jour avec succès.');
}

    public function destroy(Promotion $promotion)
    {
        $promotion->delete();

        return redirect()->route('promotions.index')->with('success', 'Promotion supprimée avec succès.');
    }
}
