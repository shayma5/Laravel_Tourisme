<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\MaisonDhaute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = Room::with('maisonDhaute')->get();
        return view('backoffice.room.rooms', compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maisons = MaisonDhaute::all(); // Fetch all MaisonDhaute records
        return view('backoffice.room.createRoom', compact('maisons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  MaisonDhaute $maisonDhaute
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate inputs with proper rules
        $data = $request->validate([
            'maison_id' => 'required|exists:maison_dhautes,id', // Validate the maison_id exists
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0', // Ensure price is a positive number
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048', // Image must be optional, max size 2MB
        ]);

        // Handle image upload if present
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images/rooms', 'public');
        }

        // Set available to true by default
        $data['available'] = true;

        // Create a new Room for the selected Maison d'haute
        $maisonDhaute = MaisonDhaute::findOrFail($data['maison_id']);
        $maisonDhaute->rooms()->create($data);

        // Redirect with success message
        return redirect()->route('backoffice.room.index', $maisonDhaute)->with('success', 'Room created successfully.');
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  MaisonDhaute $maisonDhaute
     * @param  Room $room
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('backoffice.room.editRoom', compact('room'));
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  MaisonDhaute $maisonDhaute
     * @param  Room $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $data = $request->validate([
            'type' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'image' => 'nullable|image',
            'available' => 'required|boolean',
        ]);

        // Handle image upload and delete old image if a new one is uploaded
        if ($request->hasFile('image')) {
            if ($room->image) {
                Storage::delete('public/' . $room->image);
            }
            $data['image'] = $request->file('image')->store('images/rooms', 'public');
        }

        // Update the room with validated data
        $room->update($data);

        return redirect()->route('backoffice.room.index')->with('success', 'Room updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  MaisonDhaute $maisonDhaute
     * @param  Room $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $room = Room::findOrFail($id);

        // Delete room
        $room->delete();

        return redirect()->route('backoffice.room.index')->with('success', 'Room deleted successfully.');
    }
}
