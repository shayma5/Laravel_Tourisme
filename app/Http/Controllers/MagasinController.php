<?php

namespace App\Http\Controllers;

use App\Models\Magasin;
use Illuminate\Http\Request;
use App\Models\Promotion;
use App\Models\Souvenir;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class MagasinController extends Controller
{
    public function index(Request $request)
    {
        $query = Magasin::query();
    
        // Filtre Promotions
        if ($request->promotion_filter === 'no_promo') {
            $query->whereDoesntHave('promotions');
        } elseif ($request->promotion_filter === 'with_promo') {
            $query->has('promotions');
        }

    
        // Filtre Souvenirs
        switch ($request->souvenir_filter) {
            case '0':
                $query->has('souvenirs', '=', 0);
                break;
            case '1-5':
                $query->has('souvenirs', '>=', 1)
                     ->has('souvenirs', '<=', 5);
                break;
            case '6-10':
                $query->has('souvenirs', '>=', 6)
                     ->has('souvenirs', '<=', 10);
                break;
            case '10+':
                $query->has('souvenirs', '>', 10);
                break;
        }
        $perPage = $request->get('per_page', 10);
        $magasins = $query->paginate($perPage);

       
        return view('backoffice.magasins.index', compact('magasins'));
    }
    


    public function publicIndex()
    {
        $magasins = Magasin::all();
        return view('layouts.SouvenirsArtisanat.magasins.index', compact('magasins'));
    }

    public function create()
    {
        $promotions = Promotion::where('date_fin', '>=', Carbon::now()->toDateString())->get();
        return view('backoffice.magasins.create', compact('promotions'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nomMagasin' => 'required|max:255',
            'type' => 'required',
            'adresse' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/magasins');
            $validatedData['image'] = str_replace('public/', '', $imagePath);
        }

        $magasin = Magasin::create($validatedData);

        if ($request->has('promotions')) {
            $magasin->promotions()->attach($request->promotions);
        }   

        return redirect()->route('magasins.index')->with('success', 'Magasin créé avec succès.');
    }

    public function show(Magasin $magasin)
    {
        return view('backoffice.magasins.show', compact('magasin'));
    }



    public function showPublic(Magasin $magasin)
    {
        // Charger seulement les souvenirs du magasin
        $magasin->load('souvenirs');

        return view('layouts.SouvenirsArtisanat.magasins.show', compact('magasin'));
    }





    public function edit(Magasin $magasin)
    {
        $promotions = Promotion::where('date_fin', '>=', Carbon::now()->toDateString())->get();
        
        // Get only available souvenirs (unassigned or belonging to current magasin)
        $souvenirs = Souvenir::where('magasin_id', null)
            ->orWhere('magasin_id', $magasin->id)
            ->orderBy('magasin_id', 'asc')
            ->get();
        
        $ownedSouvenirs = $souvenirs->filter(function($souvenir) use ($magasin) {
            return $magasin->souvenirs->contains($souvenir->id);
        });
        
        $notOwnedSouvenirs = $souvenirs->filter(function($souvenir) use ($magasin) {
            return !$magasin->souvenirs->contains($souvenir->id);
        });
        
        return view('backoffice.magasins.edit', compact('magasin', 'promotions', 'souvenirs', 'ownedSouvenirs', 'notOwnedSouvenirs'));
    }
    
    
    
    
    public function update(Request $request, Magasin $magasin)
    {
        $validatedData = $request->validate([
            'nomMagasin' => 'required|max:255',
            'type' => 'required',
            'adresse' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('magasins', 'public');
            $validatedData['image'] = $imagePath;
        }

        $magasin->update($validatedData);

        

        return redirect()->route('magasins.index')->with('success', 'Magasin mis à jour avec succès.');
    }


    public function unassignSouvenir(Magasin $magasin, Souvenir $souvenir)
    {
        $magasin->souvenirs()->where('id', $souvenir->id)->update(['magasin_id' => null]);
        return view('backoffice.loading', [
            'redirectUrl' => route('magasins.edit', $magasin->id)
        ]);
    }
    
    
    



    // public function editSouvenirs(Magasin $magasin)
    // {
    //     // Get only souvenirs that are unassigned (magasin_id is null) or belong to this magasin
    //     $availableSouvenirs = Souvenir::where(function($query) use ($magasin) {
    //         $query->whereNull('magasin_id')
    //               ->orWhere('magasin_id', $magasin->id);
    //     })->get();
    
    //     return view('backoffice.magasins.souvenirs-edit', compact('magasin', 'availableSouvenirs'));
    // }
    


    public function updateSouvenirs(Request $request, Magasin $magasin)
    {
        $selectedSouvenirs = $request->input('souvenirs', []);

        // First, unassign all current souvenirs from this magasin
        Souvenir::where('magasin_id', $magasin->id)
            ->update(['magasin_id' => null]);

        // Then, assign selected souvenirs to this magasin
        if (!empty($selectedSouvenirs)) {
            Souvenir::whereIn('id', $selectedSouvenirs)
                ->update(['magasin_id' => $magasin->id]);
        }

        return view('backoffice.otherViews.loading', [
            'redirectUrl' => route('magasins.edit', $magasin->id)
        ]);
    }


    public function unassignMultiple(Request $request, Magasin $magasin)
    {
        $selectedSouvenirs = $request->input('souvenirs_to_unassign', []);
    
        if (!empty($selectedSouvenirs)) {
            Souvenir::whereIn('id', $selectedSouvenirs)
                ->where('magasin_id', $magasin->id)
                ->update(['magasin_id' => null]);
        }
    
        return view('backoffice.otherViews.loading', [
            'redirectUrl' => route('magasins.edit', $magasin->id)
        ]);
    }
    

    


    
    
    



    public function destroy(Magasin $magasin)
    {
        $magasin->delete();

        return redirect()->route('magasins.index')->with('success', 'Magasin supprimé avec succès.');
    }


    public function searchPromotions(Request $request)
{
    $query = $request->get('query');

    console.log($query);
    
    $promotions = Promotion::where('nom', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->get();

    console.log(json($promotions));

    return response()->json($promotions);
}





 /*    public function searchPromotions(Request $request)
{
    $query = $request->get('query');
    

    
    $promotions = Promotion::where('nom', 'LIKE', "%{$query}%")
                           ->orWhere('description', 'LIKE', "%{$query}%")
                           ->orWhere('date_debut', 'LIKE', "%{$query}%")
                           ->orWhere('date_fin', 'LIKE', "%{$query}%")
                           ->get();
                           \Log::info(json($promotions));
    
    return response()->json($promotions);
} */

}
