<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;

class FullEventCalendarController extends Controller
{
    public function loadEvents()
    {
        $events = Events::all();  // Récupérer tous les événements
        $eventList = [];

        foreach ($events as $event) {
            $eventList[] = [
                'title' => $event->name,
                'start' => $event->start_date,
                'end' => $event->end_date,
                'url' =>  url('/event/' . $event->id) ,
            ];
        }

        return response()->json($eventList);
    }
}
