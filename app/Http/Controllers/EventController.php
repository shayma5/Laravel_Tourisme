<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
class EventController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Events::all();
        return view ('backoffice.events.index')->with('events', $events);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.events.create');
    }
 
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Règles de validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'nbParticipant' => 'required|integer|min:0',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Traitement de l'image
        $fileName = time().$request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');
        $validatedData["photo"] = '/storage/'.$path;

        // Enregistrement des données validées
        Events::create($validatedData);
        
        return redirect('event')->with('flash_message', 'Event ajouté avec succès!');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Events::find($id);
        return view('backoffice.events.show')->with('events', $event);
    }
 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Events::find($id);
        return view('backoffice.events.edit')->with('events', $event);
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
        // Règles de validation
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'nbParticipant' => 'required|integer|min:0',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $event = Events::find($id);

        // Si une nouvelle photo est fournie, on la traite
        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $validatedData["photo"] = '/storage/'.$path;
        }

        // Mise à jour des données validées
        $event->update($validatedData);
        
        return redirect('event')->with('flash_message', 'Événement mis à jour avec succès!');
    }

 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Events::destroy($id);
        return redirect('event')->with('flash_message', 'Event deleted!');  
    }


    public function indexFrontOffice()
    {
        $events = Events::all(); // Récupérer tous les événements
        return view('layouts.events.index', compact('events')); // Passer les événements à la vue
    }
    public function showFrontOffice($id)
    {
        $event = Events::findOrFail($id); // Récupère l'événement ou lance une erreur 404
        return view('layouts.events.show', compact('event'));
    }
}