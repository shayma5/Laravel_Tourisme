@extends('layouts.backoffice')
@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Edit event</div>
  <div class="card-body">
       
      <form action="{{ url('event/' .$events->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$events->name}}" class="form-control"></br>
        <label>Description</label></br>
        <textarea name="description" id="description" value="{{$events->description}}" class="form-control"></br></textarea>
        <label>Type</label></br>
        <input type="text" name="type" id="type" value="{{$events->type}}" class="form-control"></br>
        <label for="start_date">Date de début</label><br>
        <input type="datetime-local" name="start_date" id="start_date" value="{{ old('start_date', $events->start_date) }}" class="form-control"><br>
        <label for="end_date">Date de fin</label><br>
        <input type="datetime-local" name="end_date" id="end_date" value="{{ old('end_date', $events->end_date) }}" class="form-control"><br>
        <label>Location</label></br>
        <input type="text" name="location" id="location" value="{{$events->location}}" class="form-control"></br>
        <div class=" d-flex justify-content-between align-items-center">
            <input type="submit" value="Update" class="btn btn-success"></br>

            
            <!-- Bouton retour -->
            <button onclick="window.history.back()" class="btn btn-secondary">
                ← Retour
            </button>
        </div>
    </form>
    
  </div>
</div>
@stop