<body>
    <h1>Confirmation du Paiement</h1>
    <div id="card-element"></div>
    <button id="submit">Confirmer</button>

    <script>
        var stripe = Stripe("{{ env('STRIPE_KEY') }}");
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var clientSecret = "{{ $clientSecret }}";

        document.getElementById('submit').addEventListener('click', function() {
            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: cardElement,
                }
            }).then(function(result) {
                if (result.error) {
                    console.log(result.error.message);
                } else {
                    if (result.paymentIntent.status === 'succeeded') {
                        console.log("Paiement réussi !");
                    }
                }
            });
        });
    </script>
</body>
