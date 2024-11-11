<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Stripe;
use Stripe\Charge;
use App\Models\Participation;
use App\Models\Events;


class PayementStripeController extends Controller
{    

    public function handlePayment(Request $request)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $request->amount, // Montant en centimes
                'currency' => 'eur',
                'source' => $request->stripeToken,
                'description' => 'Paiement pour réservation d\'événement',
            ]);

            // Récupérer et mettre à jour la réservation
            $reservation = Participation::find($request->reservation_id);
            if ($reservation) {
                $reservation->is_paid = true;
                $reservation->save();
            }

            return back()->with('success', 'Paiement réussi !');
        } catch (\Exception $e) {
            return back()->withErrors('Erreur de paiement : ' . $e->getMessage());
        }
    }

    public function showPaymentPage($id)
    {
        $event = Events::findOrFail($id); // Load the event data
        return view('layouts.events.payement.stripe', compact('event'));
    }
    public function handlePost(Request $request)
    {
        // Cette méthode peut recevoir le payment_method du formulaire
        // Stripe s'occupera de la confirmation du paiement
        $paymentMethod = $request->input('payment_method');
        // Vous pouvez gérer ici la confirmation et rediriger après paiement
        return redirect()->route('events.index')->with('success', 'Le paiement a été effectué avec succès !');
    }

}