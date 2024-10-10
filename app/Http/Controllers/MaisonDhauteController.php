<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MaisonDhaute;
use Illuminate\Http\Request;


class MaisonDhauteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maisons = MaisonDhaute::all();

        if (request()->route()->named('backoffice.maisons')) {
            // Return the backoffice view
            return view('backoffice.maisons', compact('maisons'));
        } else {
            // Return the frontoffice view
            return view('maisonDaute', compact('maisons'));
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backoffice.createMaison');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'number_of_rooms' => 'required|integer',
            'image' => 'image|nullable'
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        MaisonDhaute::create($data);
        return redirect()->route('backoffice.maisons')->with('success', 'Maison d\'haute created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Display the specified Maison d'haute
    public function show($id)
{
    $maison = MaisonDhaute::with('rooms')->findOrFail($id); // Use with() to eager load rooms

    if (request()->route()->named('backoffice.maisons.show')) {
        // Return the backoffice view
        return view('backoffice.showMaison')->with('maison', $maison);
    } else {
        // Return the frontoffice view
        return view('maisonhoteRooms')->with('maison', $maison);
    }
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Show the form for editing the specified Maison d'haute
    public function edit($id)
    {
        $maison = MaisonDhaute::find($id);
        return view('backoffice.editMaison')->with('maisons', $maison);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Update the specified Maison d'haute in storage
    public function update(Request $request, MaisonDhaute $maison)
    {
        $data = $request->validate([
            'name' => 'required',
            'location' => 'required',
            'description' => 'required',
            'number_of_rooms' => 'required|integer',
            'image' => 'image|nullable'
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {

            $data['image'] = $request->file('image')->store('images', 'public');
        }

        $maison->update($data);
        return redirect()->route('backoffice.maisons')->with('success', 'Maison d\'haute updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Remove the specified Maison d'haute from storage
    public function destroy(MaisonDhaute $maison)
    {

        // Cascade delete rooms
        $maison->rooms()->delete();

        $maison->delete();
        return redirect()->route('backoffice.maisons')->with('success', 'Maison d\'haute deleted successfully.');
    }
}
