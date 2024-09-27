<?php

namespace App\Http\Controllers;

use App\Models\Restaurant; 
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::all();
    
    // Vérifier le contenu de $restaurants
    if ($restaurants->isEmpty()) {
        return "Aucun restaurant trouvé.";
    }
    
    return view('backoffice.restaurants.index', compact('restaurants')); 
        // return response()->json($restaurants); 
    }

    public function app()
{
    $restaurants = Restaurant::all();

    // Vérifier le contenu de $restaurants
    if ($restaurants->isEmpty()) {
        return "Aucun restaurant trouvé.";
    }

    return view('app.restaurants.index', compact('restaurants'));
}

   

   

    // Afficher le formulaire de création d'un restaurant
    public function create()
    {
        return view('backoffice.restaurants.create'); // Affiche le formulaire de création
    }

     // Enregistrer un nouveau restaurant dans la base de données
     public function store(Request $request)
     {
         $request->validate([ // Validation des données
             'nom' => 'required',
             'adresse' => 'required',
             'siteWeb' => 'nullable|url',
             'telephone' => 'nullable|string',
             'description' => 'nullable|string',
             'noteMoyenne' => 'nullable|numeric',
         ]);
 
         Restaurant::create($request->all()); // Créer le restaurant
         return redirect()->route('restaurants.index')->with('success', 'Restaurant créé avec succès.');
     }

    // Afficher un restaurant spécifique
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id); // Trouver le restaurant par ID
        return view('backoffice.restaurants.show', compact('restaurant')); // Affiche les détails du restaurant
    }

    public function showFrontend($id)
    {
        $restaurant = Restaurant::with('plats')->findOrFail($id); 
        return view('app.restaurants.showrestaurant', compact('restaurant'));
    }

    

   
    // Afficher le formulaire d'édition d'un restaurant
    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id); // Trouver le restaurant par ID
        return view('backoffice.restaurants.edit', compact('restaurant')); // Affiche le formulaire d'édition
    }

    // Mettre à jour un restaurant dans la base de données
    public function update(Request $request, $id)
    {
        $request->validate([ // Validation des données
            'nom' => 'required',
            'adresse' => 'required',
            'siteWeb' => 'nullable|url',
            'telephone' => 'nullable|string',
            'description' => 'nullable|string',
            'noteMoyenne' => 'nullable|numeric',
        ]);

        $restaurant = Restaurant::findOrFail($id); // Trouver le restaurant par ID
        $restaurant->update($request->all()); // Mettre à jour le restaurant
        return redirect()->route('restaurants.index')->with('success', 'Restaurant mis à jour avec succès.');
    }

    // Supprimer un restaurant de la base de données
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id); // Trouver le restaurant par ID
        $restaurant->delete(); // Supprimer le restaurant
        return redirect()->route('restaurants.index')->with('success', 'Restaurant supprimé avec succès.');
    }
}
