<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participation;
use App\Models\Events;

class ParticipatioEventController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    // Charger les participations avec les informations de l'utilisateur et de l'événement
    $participations = Participation::with('event', 'participant')->get();
    return view('backoffice.participations.index')->with('participations', $participations);
}

    // public function reserve(Request $request, $eventId)
    // {
    //     $validated = $request->validate([
    //         'participants' => 'required|integer|min:1',
    //         'option' => 'required|string',
    //     ]);
    
    //     $event = Events::findOrFail($eventId);
        
    //     // Vérifier s'il y a assez de places disponibles
    //     if ($validated['participants'] > $event->nbParticipant) {
    //         return back()->with('error', 'Nombre de participants trop élevé');
    //     }
    
    //     // Diminuer le nombre de places disponibles
    //     $event->nbParticipant -= $validated['participants'];
    //     $event->save();
    
    //     // Ajouter la participation pour l'utilisateur connecté
    //     Participation::create([
    //         'participant_id' => auth()->user()->id,
    //         'event_id' => $event->id,
            
    //     ]);
    
    //     // Logique pour rediriger en fonction de l'option
    //     if ($validated['option'] == 'pay') {
    //         // Rediriger vers la page de paiement en ligne
    //         return redirect()->route('payment', $event->id)->with('success', 'Redirection vers la page de paiement');
    //     }
    
    //     // Si la réservation est sans paiement
    //     return back()->with('success', 'Réservation effectuée avec succès');
    // }
    public function reserve(Request $request, $eventId)
{
    $validated = $request->validate([
        'participants' => 'required|integer|min:1',
        'option' => 'required|string',
    ]);

    $event = Events::findOrFail($eventId);
    
    // Vérifier s'il y a assez de places disponibles
    if ($validated['participants'] > $event->nbParticipant) {
        return back()->with('error', 'Nombre de participants trop élevé');
    }

    // Diminuer le nombre de places disponibles
    $event->nbParticipant -= $validated['participants'];
    $event->save();

    // Ajouter la participation avec le nombre de places réservées
    Participation::create([
        'participant_id' => auth()->user()->id,
        'event_id' => $event->id,
        'reserved_places' => $validated['participants'],  // Enregistrer le nombre de participants
    ]);

    // Logique pour rediriger en fonction de l'option
    if ($validated['option'] == 'pay') {
        return redirect()->route('payment', $event->id)->with('success', 'Redirection vers la page de paiement');
    }

    // Si la réservation est sans paiement
    return back()->with('success', 'Réservation effectuée avec succès');
}


}
