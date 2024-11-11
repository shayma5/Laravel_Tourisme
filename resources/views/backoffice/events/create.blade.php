@extends('layouts.backoffice')
@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Create New events</div>
  <div class="card-body">
       
    <form action="{{ url('event') }}" method="post" enctype="multipart/form-data">
      {!! csrf_field() !!}
      
      <label>Name</label></br>
      <input type="text" name="name" id="name" class="form-control">
      @if ($errors->has('name'))
          <span class="text-danger">{{ $errors->first('name') }}</span>
      @endif
      </br>
      
      <label>Description</label></br>
      <textarea name="description" id="description" class="form-control"></textarea>
      @if ($errors->has('description'))
          <span class="text-danger">{{ $errors->first('description') }}</span>
      @endif
      </br>
      
      <label>Type</label></br>
      <input type="text" name="type" id="type" class="form-control">
      @if ($errors->has('type'))
          <span class="text-danger">{{ $errors->first('type') }}</span>
      @endif
      </br>
      
      <label>Prix</label></br>
      <input type="number" name="price" id="price" step="0.01" class="form-control">
      @if ($errors->has('price'))
          <span class="text-danger">{{ $errors->first('price') }}</span>
      @endif
      </br>

      <label>Nombre de participants</label></br>
      <input type="number" name="nbParticipant" id="nbParticipant" class="form-control">
      @if ($errors->has('nbParticipant'))
          <span class="text-danger">{{ $errors->first('nbParticipant') }}</span>
      @endif
      </br>
      
      <label for="start_date">Date de début</label><br>
      <input type="datetime-local" name="start_date" id="start_date" class="form-control">
      @if ($errors->has('start_date'))
          <span class="text-danger">{{ $errors->first('start_date') }}</span>
      @endif
      </br>
      
      <label for="end_date">Date de fin</label><br>
      <input type="datetime-local" name="end_date" id="end_date" class="form-control">
      @if ($errors->has('end_date'))
          <span class="text-danger">{{ $errors->first('end_date') }}</span>
      @endif
      </br>
      
      <label>Location</label></br>
      <input type="text" name="location" id="location" class="form-control">
      @if ($errors->has('location'))
          <span class="text-danger">{{ $errors->first('location') }}</span>
      @endif
      </br>
      
      <input class="form-control" name="photo" type="file" id="photo">
      @if ($errors->has('photo'))
          <span class="text-danger">{{ $errors->first('photo') }}</span>
      @endif
      </br>
      
      <input type="submit" value="Save" class="btn btn-success"></br>
  </form>
  
    
  </div>
</div>
  
@stop

