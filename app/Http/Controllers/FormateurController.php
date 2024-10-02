<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formateur;
use App\Models\Classe;

class FormateurController extends Controller
{
    public function index(){
        $formateur = Formateur::get();
        //return $formateur;
        return view('formateur.index' , compact('formateur'));
    }
    public function createformateur()
    {
        return view('formateur.createformateur');
    }

        public function storeformateur(Request $request)
        {
            $request->validate([
                'name' => 'required|max:255|string',
                'specialite' => 'required|max:255|string',
            ]);

            Formateur::create([
                'name'=>$request->name,
                'specialite'=>$request->specialite,

            ]);
            return redirect('admin/dashboard/formateurs/createformateur')->with('status','formateur Created');
        }

        public function editformateur (int $id){
            $formateur = Formateur::findOrFail($id); //findOrFail
            return view('formateur.editformateur' , compact('formateur') );
        }

        public function updateformateur(Request $request, int $id){
            $request->validate([
                'name' => 'required|max:255|string',
                'specialite' => 'required|max:255|string',
            ]);

            Formateur::findOrFail($id)->update([
                'name'=>$request->name,
                'specialite'=>$request->specialite,

            ]);
            return redirect()->back()->with('status','formateur Update');
        }

        public function deleteformateur(int $id)
        {
            $formateur = Formateur::findOrFail($id);
            $formateur->delete();
            return redirect()->back()->with('status','formateur delete');

        }

        public function affecterCP(Request $request, $classeId)
{
    $classe = Classe::findOrFail($classeId);
    $formateurs = Formateur::all(); // Récupérer tous les formateurs
    return view('formateur.affecterCP', compact('classe', 'formateurs'));
    
}


public function storeAffectationCP(Request $request, $classeId)
{
    $classe = Classe::findOrFail($classeId);
    $classe->formateurs()->sync($request->formateurs); // Assurez-vous que `formateurs` est bien défini dans le modèle `Classe`

    return redirect()->route('classes.indexclasse')->with('status', 'Formateurs affectés avec succès!');
}

public function showCP(Formateur $formateur)
    {
        $classes = $formateur->classes; 
        return view('formateur.showCP', compact('formateur', 'classes'));

    }

}
