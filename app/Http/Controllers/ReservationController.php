<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Formation;
use App\Models\Formateur;
use App\Models\Classe;
use App\Models\Programme;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
{
    $reservations = Reservation::with(['formation', 'formateur', 'classe', 'programme'])->get();
    return view('reservation.indexA_R', compact('reservations'));
}


    public function create()
    {
        $formations = Formation::all();
        $formateurs = Formateur::all();
        $classes = Classe::all();
        $programmes = Programme::all();
        
        return view('reservation.createR', compact('formations', 'formateurs', 'classes', 'programmes'));
    }
    public function createe($formation_id)
    {
        $formations = Formation::all();
        $formateurs = Formateur::all();
        $classes = Classe::all();
        $programmes = Programme::all();
        $formation = Formation::findOrFail($formation_id); // Récupérer la formation par ID
        
        return view('reservation.createR', compact('formations', 'formateurs', 'classes', 'programmes', 'formation'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'formation_id' => 'required|exists:formation,id',
            'formateur_id' => 'required|exists:formateur,id',
            'classe_id' => 'required|exists:classe,id',
            'programme_id' => 'required|exists:programme,id',

        ]);
 // Ajouter user_id automatiquement
        $data = $request->all();
        $data['user_id'] = auth()->id();
        Reservation::create($data);

        return redirect()->route('reservations.indexA_R')->with('success', 'Réservation créée avec succès!');
    }
    public function edit(Reservation $reservation)
    {
        $formations = Formation::all();
        $formateurs = Formateur::all();
        $classes = Classe::all();
        $programmes = Programme::all();
    
        return view('reservation.edit', compact('reservation', 'formations', 'formateurs', 'classes', 'programmes'));
    }
    

    public function update(Request $request, Reservation $reservation)
{
    $request->validate([
        'formation_id' => 'required|exists:formation,id',
        'formateur_id' => 'required|exists:formateur,id',
        'classe_id' => 'required|exists:classe,id',
        'programme_id' => 'required|exists:programme,id',
    ]);

    $reservation->update($request->all());

    return redirect()->route('reservations.indexA_R')->with('status', 'Réservation mise à jour avec succès!');
}


public function destroy(Reservation $reservation)
{
    $reservation->delete();
    return redirect()->route('reservations.indexA_R')->with('status', 'Reservation supprimée avec succès!');
}




    public function indexFor()
{
    $formations = Formation::with(['programmes.classes', 'formateur'])->get();

    return view('reservation.indexR', compact('formations'));
}


}
