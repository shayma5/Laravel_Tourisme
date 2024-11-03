<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Avis;
use App\Models\Restaurant;
use App\Mail\AvisSubmitted;
use Illuminate\Support\Facades\Mail;


class AvisController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
    
        $avis = Avis::with('restaurant')
            ->when($search, function ($query, $search) {
                return $query->where('nomClient', 'like', "%{$search}%")
                             ->orWhere('commentaire', 'like', "%{$search}%")
                             ->orWhereHas('restaurant', function($query) use ($search) {
                                 $query->where('nom', 'like', "%{$search}%");
                             });
            })
            ->when($startDate, function ($query) use ($startDate) {
                return $query->where('dateAvis', '>=', $startDate);
            })
            ->when($endDate, function ($query) use ($endDate) {
                return $query->where('dateAvis', '<=', $endDate);
            })
            ->paginate(5);
        
        if ($request->ajax()) {
            $output = '';
            foreach ($avis as $avisItem) {
                $output .= '
                    <tr>
                        <td>'.$avisItem->nomClient.'</td>
                        <td>'.$avisItem->note.'</td>
                        <td>'.$avisItem->commentaire.'</td>
                        <td>'.$avisItem->dateAvis.'</td>
                        <td>'.($avisItem->restaurant ? $avisItem->restaurant->nom : 'Inconnu').'</td>
                        <td>
                            <form action="'.route('avis.destroy', $avisItem->id).'" method="POST" onsubmit="return confirm(\'Êtes-vous sûr de vouloir supprimer cet avis ?\');">
                                '.csrf_field().'
                                '.method_field('DELETE').'
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>';
            }
            return $output;
        }
    
        return view('backoffice.avis.index', compact('avis', 'search', 'startDate', 'endDate'));
    }
    


// public function generatePDF(Request $request)
// {
//     // Filtrer les avis selon la période demandée
//     $startDate = $request->get('start_date');
//     $endDate = $request->get('end_date');
//     $avis = Avis::whereBetween('dateAvis', [$startDate, $endDate])->get();

//     // Générer le PDF avec la vue correspondante
//     $pdf = PDF::loadView('backoffice.avis.rapport', compact('avis', 'startDate', 'endDate'));

//     // Téléchargement du fichier PDF
//     return $pdf->download('rapport_avis.pdf');
// }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $restaurants = Restaurant::all(); // Récupérer tous les restaurants
        $user = auth()->user(); // Récupérer l'utilisateur connecté
        return view('app.avis.create', compact('restaurants', 'user'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'nomClient' => 'required|string|max:255',
        'note' => 'required|integer|min:1|max:5',
        'commentaire' => 'nullable|string',
        'restaurant_id' => 'required|exists:restaurants,id',
    ]);

    $avis = Avis::create([
        'nomClient' => $request->nomClient,
        'note' => $request->note,
        'commentaire' => $request->commentaire,
        'dateAvis' => now(),
        'restaurant_id' => $request->restaurant_id,
    ]);

    // Envoyer l'email
    Mail::to('skanderbedwi5@gmail.com')->send(new AvisSubmitted($avis));

    // Autres opérations (mise à jour de la note moyenne, redirection, etc.)
    $restaurant = Restaurant::find($request->restaurant_id);
    $restaurant->noteMoyenne = $restaurant->avis()->avg('note');
    $restaurant->save();

    return redirect()->route('restaurants.app', $restaurant->id)
                     ->with('success', 'Avis ajouté avec succès et email envoyé.');
}
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $avis = Avis::findOrFail($id); // Récupérer l'avis par ID
        $avis->delete(); // Supprimer l'avis

        return redirect()->route('avis.index')->with('success', 'Avis supprimé avec succès.');
    }
}
