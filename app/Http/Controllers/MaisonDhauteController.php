<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\MaisonDhaute;
use Illuminate\Http\Request;


class MaisonDhauteController extends Controller
{
    public function backofficeIndex(Request $request)
    {
        $query = $request->input('search');

        if ($query) {
            $maisons = MaisonDhaute::where('name', 'LIKE', "%{$query}%")
                ->orWhere('location', 'LIKE', "%{$query}%")
                ->get();
        } else {
            $maisons = MaisonDhaute::all();
        }

        // Check if it's an AJAX request
        if ($request->ajax()) {
            return response()->json(['maisons' => $maisons]);
        }

        return view('backoffice.maisons', compact('maisons'));
    }


    // Index function for the frontoffice
    public function frontofficeIndex()
    {
        $maisons = MaisonDhaute::all();
        return view('maisonDaute', compact('maisons')); // Frontoffice view
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
        // Validate the inputs
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'number_of_rooms' => 'required|integer|min:1',
            'image' => 'image|nullable|max:2048' // Optional image validation
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        // Create the Maison d'haute record
        MaisonDhaute::create($data);

        // Redirect with success message
        return redirect()->route('backoffice.maisons.index')->with('success', 'Maison d\'haute created successfully.');
    }


    // Show function for the backoffice
    public function backofficeShow($id)
    {
        $maison = MaisonDhaute::with('rooms')->findOrFail($id); // Eager load rooms
        return view('backoffice.showMaison', compact('maison')); // Backoffice view
    }

    // Show function for the frontoffice
    public function frontofficeShow($id)
    {
        $maison = MaisonDhaute::with('rooms')->findOrFail($id); // Eager load rooms
        return view('maisonhoteRooms', compact('maison')); // Frontoffice view
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
    public function update(Request $request, $id)
    {
        // Find the Maison d'haute by its ID
        $maison = MaisonDhaute::findOrFail($id);

        // Validate the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'number_of_rooms' => 'required|integer',
            'image' => 'nullable|image'
        ]);

        // Handle the image upload, if a new image is uploaded
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        // Update the Maison d'haute with the validated data
        $maison->update($data);

        // Redirect back to the index page with a success message
        return redirect()->route('backoffice.maisons.index')->with('success', 'Maison d\'hote updated successfully.');
    }


    /**
     * Remove the specified Maison d'haute from storage.
     *
     * @param  MaisonDhaute $maison
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maison = MaisonDhaute::findOrFail($id);
        // Delete associated rooms
        $maison->rooms()->delete();
        // Delete the Maison d'haute
        $maison->delete();

        return redirect()->route('backoffice.maisons.index')->with('success', 'Maison d\'hote and all associated rooms deleted successfully.');
    }
}
