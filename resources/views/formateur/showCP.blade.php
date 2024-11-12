@extends('layouts.backoffice')

@section('content')
<div class="container">
   
<h1>Détails d affectation classe </h1>
    <div class="container">
    <div class="row">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                      <div class="card-title">Formateur</div>
                      
                      
                    </div>
                  </div>
                  <div class="card-body">
                    <ol class="activity-feed">
                      <li class="feed-item feed-item-secondary">
                        <time class="date" datetime="9-25">---</time>
                        <span class="text"
                          >Name du Formation : 
                          <a href="#">{{ $formateur->name }}</a></span
                        >
                      </li>
                      <li class="feed-item feed-item-success">
                        <time class="date" datetime="9-24">---</time>
                        <span class="text"
                          >specialite : 
                          <a href="#">{{ $formateur->specialite }}</a></span
                        >
                      </li>
                      
                      
                    </ol>
                  </div>
                </div>
              </div>

              </div>




    <h2>Classes Associées</h2>
   
<div class="table-responsive">
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>Nom de la classes</th>
                <th>specialite</th>
                <th>programme_id</th>
                            <th style="width: 10%">Action</th>
                          </tr>
                        </thead>

                        <tfoot>
                          <tr>
                            <th>id</th>
                            <th>Nom de la classes</th>
                <th>specialite</th>
                <th>programme_id</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($classes as $classe)

                          <tr>
                          <td>{{ $classe->id }}</td>
                    <td>{{ $classe->name }}</td>
                    <td>{{ $classe->specialite }}</td>
                    <td>{{ $classe->programme_id }}</td>
                            <td>
                        <div class="form-button-action">
                            <a href="{{ route('classes.edit', $classe->id) }}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Task">
                                <i class="fa fa-edit"></i>
                            </a>
                            <form action="{{ route('classes.delete', $classe->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="fa fa-times" data-bs-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        </div>
                            </td>

                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>
</div>
@endsection
