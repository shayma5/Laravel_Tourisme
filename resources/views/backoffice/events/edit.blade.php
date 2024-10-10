@extends('layouts.backoffice')
@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Modifier l'événement</div>
  <div class="card-body">
       
    <form action="{{ url('event/' . $events->id) }}" method="post" enctype="multipart/form-data">
      {!! csrf_field() !!}
      @method("PATCH")
      
      <label>Nom</label></br>
      <input type="text" name="name" id="name" value="{{ old('name', $events->name) }}" class="form-control">
      @if ($errors->has('name'))
          <span class="text-danger">{{ $errors->first('name') }}</span>
      @endif
      </br>
      
      <label>Description</label></br>
      <textarea name="description" id="description" class="form-control">{{ old('description', $events->description) }}</textarea>
      @if ($errors->has('description'))
          <span class="text-danger">{{ $errors->first('description') }}</span>
      @endif
      </br>
      
      <label>Type</label></br>
      <input type="text" name="type" id="type" value="{{ old('type', $events->type) }}" class="form-control">
      @if ($errors->has('type'))
          <span class="text-danger">{{ $errors->first('type') }}</span>
      @endif
      </br>
      
      <label for="start_date">Date de début</label><br>
      <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date', $events->start_date) }}" class="form-control">
      @if ($errors->has('start_date'))
          <span class="text-danger">{{ $errors->first('start_date') }}</span>
      @endif
      </br>
      
      <label for="end_date">Date de fin</label><br>
      <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date', $events->end_date) }}" class="form-control">
      @if ($errors->has('end_date'))
          <span class="text-danger">{{ $errors->first('end_date') }}</span>
      @endif
      </br>
      
      <label>Localisation</label></br>
      <input type="text" name="location" id="location" value="{{ old('location', $events->location) }}" class="form-control">
      @if ($errors->has('location'))
          <span class="text-danger">{{ $errors->first('location') }}</span>
      @endif
      </br>
      
      <!-- Affichage de l'image actuelle -->
      @if($events->photo)
          <div class="my-3">
              <img src="{{ asset($events->photo) }}" alt="Image actuelle de l'événement" style="max-width: 100%; height: auto;">
          </div>
      @endif

      <!-- Champ pour télécharger une nouvelle image -->
      <input class="form-control" name="photo" type="file" id="photo">
      @if ($errors->has('photo'))
          <span class="text-danger">{{ $errors->first('photo') }}</span>
      @endif
      </br>
      
      <div class="d-flex justify-content-between align-items-center">
          <input type="submit" value="Mettre à jour" class="btn btn-success"></br>

          <!-- Bouton retour -->
          <button type="button" onclick="window.history.back()" class="btn btn-secondary">
              ← Retour
          </button>
      </div>
    </form>
    
  </div>
</div>
@stop
