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
}
