@extends('layouts.app')

@section('content')

<div class="container-fluid">

    <!-- Bannière -->
    <div class="card shadow-sm mb-5" style="background-image: url('{{ asset('images/bckground.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: black;">
        <div class="card-body text-center py-4">
            <h1 class="fw-bold">
                BIENVENUE SUR ASANO SERVICES !
            </h1>
            <p class="text-muted">
                Trouvez facilement votre logement ou votre terrain.
            </p>
        </div>
    </div>

    <!-- Cartes -->
    <div class="row justify-content-center g-5">

        <!-- Logement -->
        <div class="col-lg-5">

            <div class="service-card">

                <img
                    src="{{ asset('images/logementAccuel.jpg') }}"
                    alt="Logement">

                <div class="overlay">

                    <h2>
                        Location ou achat de logement
                    </h2>

                    <a href="/logements" class="btn btn-success btn-lg">
                        Voir plus
                    </a>

                </div>

            </div>

        </div>

        <!-- Terrain -->
        <div class="col-lg-5">

            <div class="service-card">

                <img
                    src="{{ asset('images/terrainAccueil.jpg') }}"
                    alt="Terrain">

                <div class="overlay">

                    <h2>
                        Achat de terrain en titre foncier
                    </h2>

                    <a href="/terrains" class="btn btn-success btn-lg">
                        Voir plus
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


@endsection