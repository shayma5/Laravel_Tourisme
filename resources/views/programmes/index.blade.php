


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
                            @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

                           
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
                      <a href="{{ route('programmes.create') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Add classe
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
                            <th>Objectif</th>
                            <th style="width: 10%">Action</th>
                          </tr>
                        </thead>

                        <tfoot>
                          <tr>
                          <th>Name</th>
                            <th>Objectif</th>
                            <th>Action</th>
                          </tr>
                        </tfoot>
                        <tbody>
                        @foreach ($programmes as $programme)

                          <tr>
                          <td>{{ $programme->id }}</td>
                    <td>{{ $programme->name }}</td>
                    <td>{{ $programme->objectif }}</td>

                            <td>
                        <div class="form-button-action">
                            <a href="{{ route('programmes.edit', $programme->id) }}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Task">
                                <i class="fa fa-edit"></i>
                            </a>
                           
                            <form action="{{ route('programmes.destroy', $programme->id) }}" method="POST" style="display:inline;">
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
                </div>
              </div>
            </div>
          </div>
        </div>


@endsection
