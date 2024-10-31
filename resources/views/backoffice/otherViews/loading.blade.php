@extends('layouts.backoffice')

@section('content')
<div class="container">
    <div class="text-center mt-5">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <h3 class="mt-3">Désaffectation en cours...</h3>
        <p>Vous serez redirigé dans quelques secondes</p>
    </div>
</div>

<script>
    setTimeout(function() {
        window.location.href = '{{ $redirectUrl }}';
    }, 3000); // 3 secondes de chargement
</script>
@endsection
