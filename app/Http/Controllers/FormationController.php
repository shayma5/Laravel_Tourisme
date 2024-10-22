<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Formateur; // Importation du modèle Formateur
use App\Models\Programme; 
class FormationController extends Controller
{
    public function indexformation()
{
    $formations = Formation::withCount('reservations')->get(); // Compte les réservations
    $labels = $formations->pluck('name'); // Noms des formations
    $data = $formations->pluck('reservations_count'); // Nombre de réservations

    return view('formation.indexformation', compact('formations', 'labels', 'data'));
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
