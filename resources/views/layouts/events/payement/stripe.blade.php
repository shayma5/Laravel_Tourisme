@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Paiement pour : {{ $event->name }}</h3>
                </div>
                <div class="card-body">
                    <p class="lead text-center">Montant à payer : <strong>{{ $event->price * $event->nbParticipant }} TND</strong></p>
                    <form id="payment-form" class="my-form" method="POST" action="{{ route('layouts.events.payement.confirm') }}">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $event->price * $event->nbParticipant }}"> <!-- Montant en centimes -->
                        <div id="card-element" class="form-control my-4 p-3"></div>
                        <div class="text-center">
                            <button id="submit" class="btn btn-success btn-lg">Payer {{ $event->prix }}€</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
    var form = document.querySelector('form.my-form');
    form.addEventListener('submit', async function(event) {
        event.preventDefault();
        const { paymentMethod, error } = await stripe.createPaymentMethod({
            type: 'card',
            card: cardElement,
        });
        if (error) {
            console.log(error);
        } else {
            let hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'payment_method');
            hiddenInput.setAttribute('value', paymentMethod.id);
            form.appendChild(hiddenInput);
            HTMLFormElement.prototype.submit.call(form);
        }
    });
</script>
@endsection