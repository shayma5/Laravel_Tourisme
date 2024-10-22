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

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Liste des Formations</h4>
                    <a href="{{ url('admin/dashboard/formations/createformation') }}" class="btn btn-primary btn-round ms-auto">
                        <i class="fa fa-plus"></i>
                        Add Formation
                    </a>
                </div>

                <div class="table-responsive">
                    <table id="add-row" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Specialité</th>
                                <th>Description</th>
                                <th>Date de Début</th>
                                <th>Date de Fin</th>
                                <th>Formateur</th>
                                <th>Nombre de Réservations</th>
                                <th>Data Educative</th> <!-- Nouvelle colonne -->
                                <th style="width: 10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($formations as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->specialite }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->date_debut }}</td>
                                <td>{{ $item->date_fin }}</td>
                                <td>{{ $item->formateur->name ?? 'N/A' }}</td>
                                <td>{{ $item->reservations_count }}</td>
                                <td>
    @if (!empty($educationData))
        @foreach ($educationData as $data)
            <span>
                {{ $data['geoUnit']['name'] ?? 'Unknown Country' }}: 
                {{ $data['data'][0]['value'] ?? 'N/A' }}%
            </span><br>
        @endforeach
    @else
        <span>Aucune donnée disponible</span>
    @endif

    <!-- QR Code -->
    <div>
        <h5>Scannez le QR Code pour accéder à l'API UNESCO:</h5>
        {!! $qrCode !!}
    </div>
</td>



                                <td>
                                    <a href="{{ url('admin/dashboard/formations/'.$item->id.'/editformation') }}" class="btn btn-link btn-primary btn-lg">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{ url('admin/dashboard/formations/'.$item->id.'/deleteformation') }}" class="btn btn-link btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
        <div class="col-md-8">
            <h2 class="text-center">Statistiques des Réservations</h2>
            <canvas id="reservationsChart" style="max-height: 400px;"></canvas>
        </div>
        <!-- Inclure jQuery et DataTables -->
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

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

                const ctx = document.getElementById('reservationsChart').getContext('2d');
                const reservationsChart = new Chart(ctx, {
                    type: 'line', // Type de graphique
                    data: {
                        labels: {!! json_encode($labels) !!},
                        datasets: [{
                            label: 'Nombre de Réservations',
                            data: {!! json_encode($data) !!},
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderWidth: 1,
                            fill: true,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    </main>
</body>

@endsection
