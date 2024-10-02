

@extends('layouts.backoffice')

@section('content')

<body>
    <main>
        <section class="hero-section d-flex justify-content-center align-items-center">
            <div class="section-overlay"></div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-5 mb-lg-0">
                        <div class="hero-section-text mt-5">
                            <h6 class="text-white">Is it possible to enjoy nature and preserve it?</h6>
                            <h1 class="hero-title text-black mt-4 mb-4">Classes! <br>welcome</h1>

                           
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>


<div class="col-md-12">
                <div class="card">
                  <div class="card-header">
                    <div class="d-flex align-items-center">
                      <h4 class="card-title">Add Row</h4>
                      <a href="{{ url('admin/dashboard/formations/createformation') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Add Formation
                      </a>

                    </div>
                  </div>
                 

                    <div class="table-responsive">
                      <table
                        id="add-row"
                        class="display table table-striped table-hover"
                      >
                        <thead>
                          <tr>
                          <th>ID</th>
                          <th>Name</th>
                           <th>Specialité</th>
                           <th>Description</th>
                           <th>Date de Début</th>
                           <th>Date de Fin</th>
                           <th>formateur</th>
                            <th style="width: 10%">Action</th>
                          </tr>
                        </thead>

                        <tfoot>
                          <tr>
                            <th>id</th>
                          <th>Name</th>
                            <th>Specialité</th>
                            <th>Description</th>
                            <th>Date de Début</th>
                            <th>Date de Fin</th>
                            <th>formateur</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($formations as $item)

                          <tr>
                          <td>{{ $item->id }}</td>
                                                                <td>{{ $item->name }}</td>
                                                                <td>{{ $item->specialite }}</td>
                                                                <td>{{ $item->description }}</td>
                                                                <td>{{ $item->date_debut }}</td>
                                                                <td>{{ $item->date_fin }}</td>
                                                                <td>{{ $item->formateur->name ?? 'N/A' }}</td> <!-- Accéder au nom du formateur -->

                            <td>
                        <div class="form-button-action">
                            <a href="{{ url('admin/dashboard/formations/'.$item->id.'/editformation')}}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Task">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ url('admin/dashboard/formations/'.$item->id.'/deleteformation')}}" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure?')">
                                <i class="fa fa-times"></i>
                            </a>
                            <a href="{{ url('admin/dashboard/formations/'.$item->id.'/affecter') }}" class="btn btn-link btn-success" data-bs-toggle="tooltip" title="Affecter classes">
                                Affecter Programme
                            </a>
                        </div>
                            </td>

                          </tr>
                          @endforeach

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       
@endsection
