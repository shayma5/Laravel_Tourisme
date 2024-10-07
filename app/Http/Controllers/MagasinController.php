<?php

namespace App\Http\Controllers;

use App\Models\Magasin;
use Illuminate\Http\Request;
use App\Models\Promotion;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class MagasinController extends Controller
{
    public function index()
    {
        $magasins = Magasin::all();
        return view('backoffice.magasins.index', compact('magasins'));
    }


    public function publicIndex()
    {
        $magasins = Magasin::all();
        return view('layouts.SouvenirsArtisanat.magasins.index', compact('magasins'));
    }

    public function create()
    {
        $promotions = Promotion::where('date_fin', '>=', Carbon::now()->toDateString())->get();
        return view('backoffice.magasins.create', compact('promotions'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomMagasin' => 'required|max:255',
            'type' => 'required',
            'adresse' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('magasins', 'public');
            $validatedData['image'] = $imagePath;
        }

        $magasin = Magasin::create($validatedData);

        if ($request->has('promotions')) {
            $magasin->promotions()->attach($request->promotions);
        }   

        return redirect()->route('magasins.index')->with('success', 'Magasin créé avec succès.');
    }

    public function show(Magasin $magasin)
    {
        return view('backoffice.magasins.show', compact('magasin'));
    }

    public function edit(Magasin $magasin)
    {
        return view('backoffice.magasins.edit', compact('magasin'));
    }

    public function update(Request $request, Magasin $magasin)
    {
        $validatedData = $request->validate([
            'nomMagasin' => 'required|max:255',
            'type' => 'required',
            'adresse' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('magasins', 'public');
            $validatedData['image'] = $imagePath;
        }

        $magasin->update($validatedData);

        return redirect()->route('magasins.index')->with('success', 'Magasin mis à jour avec succès.');
    }

    public function destroy(Magasin $magasin)
    {
        $magasin->delete();

        return redirect()->route('magasins.index')->with('success', 'Magasin supprimé avec succès.');
    }


    public function searchPromotions(Request $request)
{
    $query = $request->get('query');

    console.log($query);
    
    $promotions = Promotion::where('nom', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->get();

    console.log(json($promotions));

    return response()->json($promotions);
}





 /*    public function searchPromotions(Request $request)
{
    $query = $request->get('query');
    

    
    $promotions = Promotion::where('nom', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->orWhere('date_debut', 'LIKE', "%{$query}%")
                           ->orWhere('date_fin', 'LIKE', "%{$query}%")
                           ->get();
                           \Log::info(json($promotions));
    
    return response()->json($promotions);
} */

}
