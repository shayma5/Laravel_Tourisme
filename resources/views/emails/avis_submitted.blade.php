<!-- resources/views/emails/avis_submitted.blade.php -->
<h2>Nouveau Avis Soumis</h2>
<p><strong>Client :</strong> {{ $avis->nomClient }}</p>
<p><strong>Note :</strong> {{ $avis->note }}</p>
<p><strong>Commentaire :</strong> {{ $avis->commentaire }}</p>
<p><strong>Date :</strong> {{ $avis->dateAvis }}</p>
<p><strong>Restaurant :</strong> {{ $restaurantName }}</p>
