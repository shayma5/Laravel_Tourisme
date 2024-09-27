<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plat;
use App\Models\Restaurant;

class PlatController extends Controller
{
    // Afficher tous les plats
    public function index()
    {
        $plats = Plat::all();
        return view('backoffice.plats.index', compact('plats'));
    }

    


     // Afficher le formulaire pour créer un plat
     public function create()
     {   
        $restaurants = Restaurant::all(); 
        return view('backoffice.plats.create', compact('restaurants'));
     }

     public function store(Request $request)
     {
         // Validation des données
         $request->validate([
             'nomPlat' => 'required|string|max:255',
             'type' => 'required|string|max:255',
             'prix' => 'required|numeric',
             'description' => 'nullable|string',
             'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
             'restaurant_id' => 'required|exists:restaurants,id', // Validation de l'association avec restaurant
         ]);
     
         // Gestion de l'upload de l'image
         if ($request->hasFile('image')) {
             $imagePath = $request->file('image')->store('images/plats', 'public');
         }
     
         // Création du plat
         Plat::create([
             'nomPlat' => $request->nomPlat,
             'type' => $request->type,
             'prix' => $request->prix,
             'description' => $request->description,
             'imageUrl' => $imagePath ?? null, // Stocker le chemin de l'image si elle existe
             'restaurant_id' => $request->restaurant_id, // Associer le plat au restaurant
         ]);
     
         return redirect()->route('plats.index')->with('success', 'Plat créé avec succès.');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $plat = Plat::findOrFail($id); // Trouver le restaurant par ID
        return view('backoffice.plats.show', compact('plat')); 
    }

    // Méthode pour afficher les détails du restaurant pour le front-office
    public function viewRestaurantFront($id)
    {
        $restaurant = Restaurant::with('plats')->findOrFail($id);
        return view('app.restaurants.show', compact('restaurant'));
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $plat = Plat::findOrFail($id);
        $restaurants = Restaurant::all(); // Trouver le restaurant par ID
        return view('backoffice.plats.edit', compact('plat','restaurants'));  // Affiche le formulaire d'édition
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
        $request->validate([
            'nomPlat' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'prix' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
            'restaurant_id' => 'required|exists:restaurants,id', // Validation de l'association avec restaurant
        ]);

        $plat = Plat::findOrFail($id); // Trouver le restaurant par ID
        $plat->update($request->all()); // Mettre à jour le restaurant
        return redirect()->route('plats.index')->with('success', 'Restaurant mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plat = Plat::findOrFail($id); // Trouver le restaurant par ID
        $plat->delete(); // Supprimer le restaurant
        return redirect()->route('plats.index')->with('success', 'Restaurant supprimé avec succès.');
    }
}
