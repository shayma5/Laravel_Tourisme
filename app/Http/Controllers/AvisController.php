<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avis;
use App\Models\Restaurant;


class AvisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // Charger les avis avec leurs restaurants
           $avis = Avis::with('restaurant')->get(); 
           return view('backoffice.avis.index', compact('avis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all(); // Récupérer tous les restaurants
        return view('app.avis.create', compact('restaurants')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation des données envoyées
        $request->validate([
            'nomClient' => 'required|string|max:255',
            'note' => 'required|integer|min:1|max:5', // Limiter la note entre 1 et 5 (ou 10 selon votre choix)
            'commentaire' => 'nullable|string',
            'restaurant_id' => 'required|exists:restaurants,id',
        ]);

        // Créer un nouvel avis
        $avis = Avis::create([
            'nomClient' => $request->nomClient,
            'note' => $request->note,
            'commentaire' => $request->commentaire,
            'dateAvis' => now(),
            'restaurant_id' => $request->restaurant_id,
        ]);

      
       

        // Retrieve the restaurant related to this review
    $restaurant = Restaurant::find($request->restaurant_id);

    // Calculate the new average rating
    $newAverage = $restaurant->avis()->avg('note');

    // Update the restaurant's average rating
    $restaurant->noteMoyenne = $newAverage;
    $restaurant->save();

    // Redirect back to the restaurant's page with a success message
    return redirect()->route('restaurants.app', $restaurant->id)
                     ->with('success', 'Avis ajouté avec succès et note moyenne mise à jour.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $avis = Avis::findOrFail($id); // Récupérer l'avis par ID
        $avis->delete(); // Supprimer l'avis

        return redirect()->route('avis.index')->with('success', 'Avis supprimé avec succès.');
    }
}
