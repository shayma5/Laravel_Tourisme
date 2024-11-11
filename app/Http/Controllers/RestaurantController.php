<?php

namespace App\Http\Controllers;

use App\Models\Restaurant; 
use App\Models\Plat; 
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RestaurantController extends Controller
{
    public function index(Request $request)
{
    $search = $request->get('search');
    
    // Rechercher les restaurants
    $restaurants = Restaurant::when($search, function ($query, $search) {
        return $query->where('nom', 'like', "%{$search}%");
    })->paginate(5);
    
    // Si la requête est AJAX, retourner uniquement les lignes du tableau
    if ($request->ajax()) {
        $output = '';
        foreach ($restaurants as $restaurant) {
            $output .= '
                <tr>
                   
                    <td>'.$restaurant->nom.'</td>
                    <td>'.$restaurant->noteMoyenne.'</td>noteMoyenne
                    <td>';
            if ($restaurant->image) {
                $output .= '<img src="'.asset('storage/'.$restaurant->image).'" alt="Image" width="100">';
            } else {
                $output .= 'Pas d\'image';
            }
            $output .= '</td>
                    <td>'.$restaurant->adresse.'</td>
                    <td>
                        <a href="'.route('restaurants.show', $restaurant->id).'" class="btn btn-info">Voir</a>
                        <a href="'.route('restaurants.edit', $restaurant->id).'" class="btn btn-warning">Éditer</a>
                        <form action="'.route('restaurants.destroy', $restaurant->id).'" method="POST" style="display:inline;">
                            '.csrf_field().'
                            '.method_field('DELETE').'
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>';
        }
        return $output;
    }

    return view('backoffice.restaurants.index', compact('restaurants', 'search'));
}


    

//     public function app()
// {

//     $restaurants = Restaurant::paginate(4);
    

//     // Vérifier le contenu de $restaurants
//     if ($restaurants->isEmpty()) {
//         return "Aucun restaurant trouvé.";
//     }

//     return view('app.restaurants.index', compact('restaurants'));
// }

public function app(Request $request)
{
    $query = Restaurant::query();

    // Récupérer les types de plats uniques
    $types = Plat::distinct()->pluck('type');

    // Vérifiez si un type de plat a été spécifié dans la requête
    if ($request->has('type') && !empty($request->input('type'))) {
        $type = $request->input('type');
        if ($type !== 'all') { // Vérifiez si le type sélectionné n'est pas "all"
            // Filtrer les restaurants par type de plat
            $query->whereHas('plats', function ($q) use ($type) {
                $q->where('type', $type);
            });
        }
    }

    // Récupérer les restaurants avec pagination
    $restaurants = $query->paginate(4);

    // Vérifiez si des restaurants ont été trouvés
    if ($restaurants->isEmpty()) {
        return "Aucun restaurant trouvé.";
    }

    return view('app.restaurants.index', compact('restaurants', 'types'));
}
   

   

    // Afficher le formulaire de création d'un restaurant
    public function create()
    {
        return view('backoffice.restaurants.create'); // Affiche le formulaire de création
    }

     // Enregistrer un nouveau restaurant dans la base de données
     public function store(Request $request)
{
    // Validation des données
    $validatedData = $request->validate([
        'nom' => 'required|string|max:255',
        'adresse' => 'required|string|max:255',
        'siteWeb' => 'required|nullable|url',
        'telephone' => 'required|nullable|string|max:20',
        'description' => 'required|nullable|string|max:1000',
        'noteMoyenne' => 'required|required|numeric|min:1|max:5', // Note moyenne entre 1 et 5
        'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Gestion de l'image
    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('images/restaurants', 'public');
    } else {
        $image = null;
    }

    // Création du restaurant
    Restaurant::create([
        'nom' => $request->nom,
        'adresse' => $request->adresse,
        'siteWeb' => $request->siteWeb,
        'telephone' => $request->telephone,
        'description' => $request->description,
        'noteMoyenne' => $request->noteMoyenne,
        'image' => $image,
    ]);

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
        // Récupérer le restaurant par ID
        $restaurant = Restaurant::with('plats')->findOrFail($id);
    
        $latitude = null;
        $longitude = null;
    
        if ($restaurant->adresse) {
            $apiKey = '9Qtd9yLpa2dk4F6pq-5WMbLF543ZhoEXd8kgDrpZ4S4';
            $client = new Client();
    
            try {
                $response = $client->get("https://geocode.search.hereapi.com/v1/geocode", [
                    'query' => [
                        'q' => $restaurant->adresse,
                        'apiKey' => $apiKey,
                    ],
                    'verify' => false // Désactiver la vérification SSL (pas recommandé en production)
                ]);
    
                $data = json_decode($response->getBody(), true);
                if (isset($data['items'][0]['position'])) {
                    $latitude = $data['items'][0]['position']['lat'];
                    $longitude = $data['items'][0]['position']['lng'];
                } else {
                    \Log::warning('Aucune position trouvée pour l\'adresse : ' . $restaurant->adresse);
                }
            } catch (RequestException $e) {
                \Log::error('Erreur lors de la requête HERE API: ' . $e->getMessage());
            }
        }
    
        return view('app.restaurants.showrestaurant', compact('restaurant', 'latitude', 'longitude'));
    }
    


    

   
    // Afficher le formulaire d'édition d'un restaurant
    public function edit($id)
    {
        $restaurant = Restaurant::findOrFail($id); // Trouver le restaurant par ID
        return view('backoffice.restaurants.edit', compact('restaurant')); // Affiche le formulaire d'édition
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required',
            'adresse' => 'required',
            'siteWeb' => 'required|nullable|url',
            'telephone' => 'required|nullable|string',
            'description' => 'required|nullable|string',
            'noteMoyenne' => 'required|nullable|numeric',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $restaurant = Restaurant::findOrFail($id);
    
        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
        
            
        // Sauvegarder la nouvelle image
            $image = $request->file('image')->store('images/restaurants', 'public');
            $restaurant->image = $image; // Mettre à jour le chemin de l'image
        }
    
        // Mise à jour des autres champs
        $restaurant->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'siteWeb' => $request->siteWeb,
            'telephone' => $request->telephone,
            'description' => $request->description,
            'noteMoyenne' => $request->noteMoyenne,
            
        ]);
    
        $restaurant->save(); // Sauvegarder les modifications
    
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
