<?php

namespace App\Http\Controllers;

use App\Models\Souvenir;
use Illuminate\Http\Request;
use App\Models\Magasin;
use App\Models\Promotion;
use App\Services\StripeService;


class SouvenirController extends Controller
{
    public function index(Request $request)
{
    $query = Souvenir::query();

    if ($request->has('magasin_filter')) {
        switch ($request->magasin_filter) {
            case 'assigned':
                // Group by magasin and paginate the magasins
                $magasins = Magasin::whereHas('souvenirs')
                    ->with('souvenirs')
                    ->paginate(5);
                return view('backoffice.souvenirs.index', compact('magasins'));
                
            case 'unassigned':
                $query->whereNull('magasin_id');
                break;
        }
    }

    // For other cases, paginate souvenirs
    if ($request->has('stock_filter')) {
        switch ($request->stock_filter) {
            case 'low':
                $query->where('nbr_restant', '<=', 20);
                break;
            case 'high':
                $query->where('nbr_restant', '>', 20);
                break;
        }
    }

    $souvenirs = $query->paginate(5);
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
    $promotions = Promotion::all();
    return view('backoffice.souvenirs.create', compact('magasins', 'promotions'));
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
            'magasin_id' => 'nullable|exists:magasins,id',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/souvenirs');
            $validatedData['image'] = str_replace('public/', '', $imagePath);
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



    public function payment($id)
{
    $souvenir = Souvenir::find($id);
    return view('layouts.SouvenirsArtisanat.souvenirs.payment.payment', compact('souvenir'));
}



}
