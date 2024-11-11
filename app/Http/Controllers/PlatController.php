<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plat;
use App\Models\Restaurant;

class PlatController extends Controller
{
    // Afficher tous les plats
    public function index(Request $request)
    {
        $search = $request->get('search');
        
        // Rechercher les plats
        $plats = Plat::when($search, function ($query, $search) {
            return $query->where('nomPlat', 'like', "%{$search}%");
        // })->get();
    })->paginate(5);
        
        // Si la requête est AJAX, retourner uniquement les lignes du tableau
        if ($request->ajax()) {
            $output = '';
            foreach ($plats as $plat) {
                $output .= '
                    <tr>
                        
                        <td>'.$plat->nomPlat.'</td>
                        <td>'.$plat->type.'</td>
                        <td>'.$plat->prix.'€</td>
                        <td>';
                if ($plat->imageUrl) {
                    $output .= '<img src="'.asset('storage/'.$plat->imageUrl).'" alt="Image" width="100">';
                } else {
                    $output .= 'Pas d\'image';
                }
                $output .= '</td>
                        <td>
                            <a href="'.route('plats.show', $plat->id).'" class="btn btn-info">Voir</a>
                            <a href="'.route('plats.edit', $plat->id).'" class="btn btn-warning">Éditer</a>
                            <form action="'.route('plats.destroy', $plat->id).'" method="POST" style="display:inline;">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>';
            }
            return $output;
        }
    
        return view('backoffice.plats.index', compact('plats', 'search'));
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
             'description' => 'required|nullable|string',
             'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
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
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation de l'image
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
        return redirect()->route('plats.index')->with('success', 'Plat supprimé avec succès.');
    }
}
