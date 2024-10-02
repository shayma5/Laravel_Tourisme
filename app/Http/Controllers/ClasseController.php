<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Classe;
use App\Models\Formateur; // Importation du modèle Formateur
use App\Models\Programme; 
class ClasseController extends Controller
{
    public function indexclasse()
    {
        $classes = Classe::all(); // Utiliser all() pour la clarté
        return view('classe.indexclasse', compact('classes'));
    }

    public function createclasse()
    {
        $programmes = Programme::all(); // Récupérer tous les programmes
        return view('classe.createclasse', compact('programmes'));    
    }

    public function storeclasse(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|string',

            'specialite' => 'required|max:255|string',
            'programme_id' => 'required|exists:programme,id', // Valider le programme

        ]);

        Classe::create($request->only(['name', 'specialite', 'programme_id']));

        return redirect('admin/dashboard/classes/createclasse')->with('status','classe Created');

    }

    public function editclasse(int $id)
    {
        $classe = Classe::findOrFail($id);
    $programmes = Programme::all(); // Fetch all programmes for selection
    return view('classe.editclasse', compact('classe', 'programmes'));

    }

    public function updateclasse(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|max:255|string',
            
            'specialite' => 'required|max:255|string',
            'programme_id' => 'required|exists:programme,id', // Valider le programme

        ]);

        $classe = Classe::findOrFail($id);
        $classe->update($request->only(['name', 'specialite']));

        return redirect()->back()->with('status','classe Update');
    }

    public function deleteclasse(int $id)
    {
        $classe = Classe::findOrFail($id);
        $classe->delete();

        return redirect()->back()->with('status','classe delete');
    }


    
  
   
}
