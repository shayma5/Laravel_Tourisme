@extends('layouts.app')

@section('content')


<!-- @foreach ($formations as $formation)
    <h3>{{ $formation->name }}</h3>
    <p>Description : {{ $formation->description }}</p>

    <h4>Formateur :</h4>
    <p>{{ $formation->formateur ? $formation->formateur->name : 'No Formateur' }}</p>

    <h4>Programmes :</h4>
    <ul>
        @if ($formation->programmes->isNotEmpty())
            @foreach ($formation->programmes as $programme)
                <li>{{ $programme->name }}</li>
            @endforeach
        @else
            <li>No Programme</li>
        @endif
    </ul>

    <h4>Classes :</h4>
    <ul>
        @foreach ($formation->programmes as $programme)
            @foreach ($programme->classes as $classe)
                <li>{{ $classe->name }}</li>
            @endforeach
        @endforeach
        @if ($formation->programmes->isEmpty())
            <li>No Classes</li>
        @endif
    </ul>

  Formulaire de réservation -->
    <!-- <form action="{{ route('reservations.store') }}" method="POST">
        @csrf
        <input type="hidden" name="formation_id" value="{{ $formation->id }}">

        <h4>Choisir un Formateur :</h4>
        <select name="formateur_id" required>
            <option value="">Sélectionnez un formateur</option>
            @if ($formation->formateur)
                <option value="{{ $formation->formateur->id }}">{{ $formation->formateur->name }}</option>
            @endif
        </select>

        <h4>Choisir une Classe :</h4>
        <select name="classe_id" required>
            <option value="">Sélectionnez une classe</option>
            @foreach ($formation->programmes as $programme)
                @foreach ($programme->classes as $classe)
                    <option value="{{ $classe->id }}">{{ $classe->name }}</option>
                @endforeach
            @endforeach
        </select>

        <h4>Choisir un Programme :</h4>
        <select name="programme_id" required>
            <option value="">Sélectionnez un programme</option>
            @foreach ($formation->programmes as $programme)
                <option value="{{ $programme->id }}">{{ $programme->name }}</option>
            @endforeach
        </select>

        <button type="submit">Réserver cette formation</button>
    </form>

    <hr> <!-- Ligne de séparation pour chaque formation -->

    <!-- @endforeach  -->




    

    <section class="job-section section-padding">
                <div class="container">
                    <div class="row align-items-center">

                        <div class="col-lg-6 col-12 mb-lg-4">
                            <h3>Results of 30-65 of 1500 jobs</h3>
                        </div>

                        <div class="col-lg-4 col-12 d-flex align-items-center ms-auto mb-5 mb-lg-4">
                            <p class="mb-0 ms-lg-auto">Sort by:</p>

                            <div class="dropdown dropdown-sorting ms-3 me-4">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownSortingButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Newest Jobs
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownSortingButton">
                                    <li><a class="dropdown-item" href="#">Lastest Jobs</a></li>

                                    <li><a class="dropdown-item" href="#">Highed Salary Jobs</a></li>

                                    <li><a class="dropdown-item" href="#">Internship Jobs</a></li>
                                </ul>
                            </div>

                            <div class="d-flex">
                                <a href="#" class="sorting-icon active bi-list me-2"></a>

                                <a href="#" class="sorting-icon bi-grid"></a>
                            </div>
                        </div>

                        @foreach ($formations as $formation)

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="job-thumb job-thumb-box">
                                <div class="job-image-box-wrap">
                                    <a href="job-details.html">
                                        <img src="images/jobs/it-professional-works-startup-project.jpg" class="job-image img-fluid" alt="">
                                    </a>

                                    <div class="job-image-box-wrap-info d-flex align-items-center">
                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge badge-level">formation : {{ $formation->name }}</a>
                                        </p>
                                        <p>Description : {{ $formation->description }}</p>


                                        <p class="mb-0">
                                            <a href="job-listings.html" class="badge">{{ $formation->formateur ? $formation->formateur->name : 'No Formateur' }}</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="job-body">
                                    <h4 class="job-title">
                                    formation : {{ $formation->name }}                               </h4>
                                    <p>Description : {{ $formation->description }}</p>

                                    <div class="d-flex align-items-center">
                                        <div class="job-image-wrap d-flex align-items-center bg-white shadow-lg mt-2 mb-4">
                                            <img src="images/logos/salesforce.png" class="job-image me-3 img-fluid" alt="">

                                            <p class="mb-0"> {{ $formation->formateur ? $formation->formateur->name : 'No Formateur' }}</p>
                                        </div>

                                        <a href="#" class="bi-bookmark ms-auto me-2">
                                        </a>

                                        <a href="#" class="bi-heart">
                                        </a>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <p class="job-location">
                                            <i class=" me-1"></i>
                                            Programme
                                        </p>

                                        <p class="job-date">
                                            <i class="custom-icon bi-clock me-1"></i>
                                            <ul>
                                @if ($formation->programmes->isNotEmpty())
                                    @foreach ($formation->programmes as $programme)
                                        <li>{{ $programme->name }}</li>
                                    @endforeach
                                @else
                                    <li>No Programme</li>
                                @endif
                            </ul>                                           </p>
                                    </div>

                                    <div class="d-flex align-items-center border-top pt-3">
    <div class="job-price mb-0">
        <h5>Classes :</h5>
        <ul class="list-unstyled">
            @if ($formation->programmes->isNotEmpty())
                @foreach ($formation->programmes as $programme)
                    @foreach ($programme->classes as $classe)
                        <li>{{ $classe->name }}</li>
                    @endforeach
                @endforeach
            @else
                <li>No Classes</li>
            @endif
        </ul>
    </div>
    <a href="{{ route('reservations.createR', ['formation_id' => $formation->id]) }}" class="custom-btn btn ms-auto">Réserver</a>
</div>

                                </div>
                            </div>
                        </div>

                        @endforeach


                        

                    </div>
                </div>
            </section>








    @endsection

