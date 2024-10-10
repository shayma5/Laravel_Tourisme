<?php

namespace App\Http\Controllers;

use App\Models\Souvenir;
use Illuminate\Http\Request;
use App\Models\Magasin;

class SouvenirController extends Controller
{
    public function index()
    {
        $souvenirs = Souvenir::all();
        return view('backoffice.souvenirs.index', compact('souvenirs'));
    }

    public function publicIndex(Request $request)
    {
        $query = Souvenir::query();
    
        // Si des magasins sont sélectionnés via le filtre
        if ($request->has('magasins') && !empty($request->magasins)) {
            $query->whereIn('magasin_id', $request->magasins);
        }
    
        $souvenirs = $query->get();
        
        // Récupérer les magasins avec le compte de souvenirs
        $magasins = Magasin::withCount('souvenirs')->having('souvenirs_count', '>', 0)->get(); // Seuls les magasins ayant des souvenirs
    
        return view('layouts.SouvenirsArtisanat.souvenirs.index', compact('souvenirs', 'magasins'));
    }
    

    



    public function souvenirsParMagasin(Magasin $magasin)
    {
        return view('layouts.SouvenirsArtisanat.magasins.indexSouvenirMagasin', compact('magasin'));
    }

    public function create()
{
    $magasins = Magasin::all();
    return view('backoffice.souvenirs.create', compact('magasins'));
}

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prix' => 'required|numeric',
            'description' => 'required',
            'promotion' => 'nullable|numeric',
            'nbr_restant' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'magasin_id' => 'required|exists:magasins,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('souvenirs', 'public');
            $validatedData['image'] = $imagePath;
        }

        Souvenir::create($validatedData);

        return redirect()->route('souvenirs.index')->with('success', 'Souvenir créé avec succès.');
    }

    public function show(Souvenir $souvenir)
    {
        return view('backoffice.souvenirs.show', compact('souvenir'));
    }

    public function showPublic(Souvenir $souvenir)
{
    return view('layouts.SouvenirsArtisanat.souvenirs.show', compact('souvenir'));
}


    public function edit(Souvenir $souvenir)
    {
        $magasins = Magasin::all();
    
        return view('backoffice.souvenirs.edit', compact('souvenir','magasins'));
    }

    public function update(Request $request, Souvenir $souvenir)
    {
        $validatedData = $request->validate([
            'nom' => 'required|max:255',
            'prix' => 'required|numeric',
            'description' => 'required',
            'promotion' => 'nullable|numeric',
            'nbr_restant' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'magasin_id' => 'required|exists:magasins,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('souvenirs', 'public');
            $validatedData['image'] = $imagePath;
        }

        $souvenir->update($validatedData);

        return redirect()->route('souvenirs.index')->with('success', 'Souvenir mis à jour avec succès.');
    }

    public function destroy(Souvenir $souvenir)
    {
        $souvenir->delete();

        return redirect()->route('souvenirs.index')->with('success', 'Souvenir supprimé avec succès.');
    }
}
