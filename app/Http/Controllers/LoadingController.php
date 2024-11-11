<?php

namespace App\Http\Controllers;

use App\Models\Magasin;
use App\Models\Souvenir;
use Illuminate\Http\Request;

class LoadingController extends Controller
{
    public function show(Request $request)
    {
        $magasin = Magasin::find($request->magasin);
        $souvenir = Souvenir::find($request->souvenir);
        
        $souvenir->magasin_id = null;
        $souvenir->save();
        
        return view('backoffice.otherViews.loading', [
            'redirectUrl' => route('magasins.edit', $magasin->id)
        ]);
    }

    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nom' => 'required|max:255',
        'prix' => 'required|numeric',
        'description' => 'required',
        'promotion' => 'nullable|numeric',
        'nbr_restant' => 'required|integer',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'magasin_id' => 'required|exists:magasins,id',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('souvenirs', 'public');
        $validatedData['image'] = $imagePath;
    }

    Souvenir::create($validatedData);

    return view('backoffice.otherViews.loading', [
        'redirectUrl' => route('magasins.edit', $request->magasin_id)
    ]);
}

}
