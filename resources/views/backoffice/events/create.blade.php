@extends('layouts.backoffice')
@section('content')
  
<div class="card" style="margin:20px;">
  <div class="card-header">Create New events</div>
  <div class="card-body">
       
      <form action="{{ url('event') }}" method="post">
        {!! csrf_field() !!}
        <label>Name</label></br>
        <input type="text" name="name" id="name"  class="form-control"></br>
        <label>Description</label></br>
        <textarea name="description" id="description" class="form-control"></textarea>
        <label>Type</label></br>
        <input type="text" name="type" id="type" class="form-control"></br>
        <label for="start_date">Date de début</label><br>
        <input type="datetime-local" name="start_date" id="start_date" class="form-control"><br>
        <label for="end_date">Date de fin</label><br>
        <input type="datetime-local" name="end_date" id="end_date" class="form-control"><br>
        <label>Location</label></br>
        <input type="text" name="localisation" id="location" class="form-control"></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>
    
  </div>
</div>
  
@stop