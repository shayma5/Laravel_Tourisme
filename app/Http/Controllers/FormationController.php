<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Formateur; // Importation du modèle Formateur
use App\Models\Programme; 
use GuzzleHttp\Client; // Ajoute ceci
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FormationController extends Controller
{
    public function indexformation()
    {
        $formations = Formation::withCount('reservations')->get(); // Compte les réservations
        $labels = $formations->pluck('name'); // Noms des formations
        $data = $formations->pluck('reservations_count'); // Nombre de réservations
        
        // Appel à l'API UNESCO
        $client = new Client();
        try {
            $response = $client->get('https://api.uis.unesco.org/api/public/versions/default');
            $educationData = json_decode($response->getBody(), true);
            
            // Vérifiez si le format de la réponse est correct
            if (isset($educationData['records'])) {
                $educationData = $educationData['records'];
            } else {
                $educationData = []; // Assurez-vous d'avoir un tableau vide si aucune donnée
            }
        } catch (\Exception $e) {
            dd('Exception: ' . $e->getMessage());
        }
        $unescoApiUrl = 'https://api.uis.unesco.org/api/public/data/indicators?indicator=CR.1';
        $qrCode = QrCode::size(200)->generate($unescoApiUrl);
        return view('formation.indexformation', compact('formations', 'labels', 'data', 'educationData','qrCode'));
    }
    




    public function createformation()
    {
        $formateurs = Formateur::all(); // Récupérer tous les formateurs
        return view('formation.createformation', compact('formateurs'));    
    }

    public function storeformation(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'specialite' => 'required|max:255|string',
            'formateur_id' => 'required|exists:formateur,id', // Valider le formateur

        ]);

        Formation::create($request->only(['name', 'description', 'date_debut', 'date_fin', 'specialite', 'formateur_id']));

        return redirect('admin/dashboard/formations/createformation')->with('status','formation Created');

    }

    public function editformation(int $id)
    {
        $formation = Formation::findOrFail($id);
    $formateurs = Formateur::all(); // Fetch all formateurs for selection
    return view('formation.editformation', compact('formation', 'formateurs'));

    }

    public function updateformation(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            'description' => 'required|string',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after_or_equal:date_debut',
            'specialite' => 'required|max:255|string',
            'formateur_id' => 'required|exists:formateur,id', // Valider le formateur

        ]);

        $formation = Formation::findOrFail($id);
        $formation->update($request->only(['name', 'description', 'date_debut', 'date_fin', 'specialite']));

        return redirect()->back()->with('status','formation Update');
    }

    public function deleteformation(int $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();

        return redirect()->back()->with('status','formation delete');
    }

  
   
}
