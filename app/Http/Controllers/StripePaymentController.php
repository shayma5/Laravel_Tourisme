<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Souvenir; 

class StripePaymentController extends Controller
{
    public function handleGet(Request $request, $souvenirId)
    {
        // Récupérer le prix du souvenir
        $souvenir = Souvenir::findOrFail($souvenirId);
        $amount = $souvenir->prix * 100; // Convertir en centimes
        dd($amount);

        // Configurer la clé API Stripe
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        // Créer une intention de paiement
        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
        ]);

        // Renvoyer les détails de l'intention à la vue
        return view('layouts.SouvenirsArtisanat.souvenirs.payment.payment', [
            'souvenir' => $souvenir,
            'clientSecret' => $paymentIntent->client_secret,
        ]);
    }

    public function handlePost(Request $request)
    {
        // Cette méthode peut recevoir le payment_method du formulaire
        // Stripe s'occupera de la confirmation du paiement
        $paymentMethod = $request->input('payment_method');


        // Vous pouvez gérer ici la confirmation et rediriger après paiement
        return redirect()->route('layouts.SouvenirsArtisanat.souvenirs.payment.thankyou')->with('souvenir', Souvenir::find($request->input('souvenir_id')));


    }
}
