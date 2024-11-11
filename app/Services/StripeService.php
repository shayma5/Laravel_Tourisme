<?php

namespace App\Services;

class StripeService
{
    protected $stripeSecretKey;

    public function __construct()
    {
        $this->stripeSecretKey = env('STRIPE_SECRET_KEY'); // Récupérer la clé API depuis le fichier .env

        

    }

    public function createPaymentIntent($amount, $currency = 'dollar')
{
    $url = "https://api.stripe.com/v1/payment_intents";

    // Données du paiement
    $data = [
        'amount' => $amount, // Montant en centimes
        'currency' => $currency,
        'payment_method_types' => ['card'], // Mode de paiement (par carte)
    ];

    $postFields = http_build_query($data);

    
    // Préparer la requête cURL
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $this->stripeSecretKey,
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    dd($ch);




    // Exécuter la requête et obtenir la réponse
    $response = curl_exec($ch);
    dd($response);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);


    if ($httpCode !== 200) {
        dd("Erreur cURL : " . $httpCode . ". Contenu de la réponse : " . $response);
    }


    // Retourner la réponse sous forme de tableau
    return json_decode($response, true);
}

}
