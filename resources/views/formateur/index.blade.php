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
                            <h1 class="hero-title text-black mt-4 mb-4">Formateur! <br>welcome</h1>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <h4 class="card-title">Add Formateur</h4>
                    <a href="{{ url('admin/dashboard/formateurs/createformateur') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Add Formateur
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table id="add-row" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Specialité</th>
                            <th style="width: 10%">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Specialité</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($formateur as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->specialite }}</td>
                            <td>
                                <div class="form-button-action">
                                    <a href="{{ url('admin/dashboard/formateurs/'.$item->id.'/editformateur') }}" class="btn btn-link btn-primary btn-lg" data-bs-toggle="tooltip" title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ url('admin/dashboard/formateurs/'.$item->id.'/deleteformateur') }}" class="btn btn-link btn-danger" data-bs-toggle="tooltip" title="Remove" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-times"></i>
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

    <!-- Inclure jQuery et DataTables -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#add-row').DataTable({
                "language": {
                    "search": "Rechercher:",
                    "lengthMenu": "Afficher _MENU_ entrées",
                    "info": "Affichage de _START_ à _END_ de _TOTAL_ entrées",
                    "paginate": {
                        "next": "Suivant",
                        "previous": "Précédent"
                    }
                },
                "pageLength": 10, // Nombre d'entrées à afficher par page
                    "lengthMenu": [5, 10, 25, 50] // Options de pagination
            });
        });
    </script>
@endsection
