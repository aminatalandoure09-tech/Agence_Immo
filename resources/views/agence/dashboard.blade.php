@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h2 class="text-center text-white mb-4">
        Dashboard
    </h2>

    <!-- Statistiques -->

    <div class="row mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow">
                <div class="card-body bg-info text-white text-center">
                    <h5>Clients</h5>
                    <h2>23</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow">
                <div class="card-body bg-info text-white text-center">
                    <h5>Terrains</h5>
                    <h2>10</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow">
                <div class="card-body bg-info text-white text-center">
                    <h5>Logements</h5>
                    <h2>9</h2>
                </div>
            </div>
        </div>

    </div>


    <!-- Gestion des clients -->

    <div class="card mb-4 shadow bg-dark text-white">

        <div class="card-header bg-primary">
            Gestion des clients
        </div>

        <div class="card-body p-0">

            <table class="table table-dark table-bordered mb-0">

                <thead>

                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Action</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>
                        <td>ADMINISTRATEUR</td>
                        <td>admin@gmail.com</td>
                        <td>
                            <span class="badge bg-purple">
                                Administrateur
                            </span>
                        </td>

                        <td>
                            <button class="btn btn-danger btn-sm supprimer">
                                🗑
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Aminata Sidibé</td>
                        <td>aminata@gmail.com</td>
                        <td>
                            <span class="badge bg-primary">
                                Client
                            </span>
                        </td>

                        <td>
                            <button class="btn btn-danger btn-sm supprimer">
                                🗑
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    <!-- Gestion des terrains -->

    <div class="card mb-4 shadow bg-dark text-white">

        <div class="card-header bg-primary d-flex justify-content-between">

            <span>Gestion des terrains</span>

            <a href="{{ route('terrains.create') }}"
               class="btn btn-success btn-sm">
                + AJOUTER
            </a>

        </div>

        <div class="card-body p-0">

            <table class="table table-dark table-bordered mb-0">

                <thead>

                    <tr>
                        <th>Terrain</th>
                        <th>Superficie</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>Terrain situé Sotuba Village</td>
                        <td>800 m²</td>
                        <td>7 000 000 FCFA</td>

                        <td>

                            <a href="{{ route('terrains.edit') }}"
                               class="btn btn-success btn-sm">
                                ✏
                            </a>

                            <button class="btn btn-danger btn-sm supprimer">
                                🗑
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    <!-- Gestion des demandes -->

    <div class="card mb-4 shadow bg-dark text-white">

        <div class="card-header bg-primary">
            Gestion des demandes
        </div>

        <div class="card-body p-0">

            <table class="table table-dark table-bordered mb-0">

                <thead>

                    <tr>
                        <th>Client</th>
                        <th>Bien</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>Aminata Sidibé</td>
                        <td>Appartement Banankabougou</td>
                        <td>10/07/2026</td>

                        <td>
                            <span class="badge bg-warning text-dark">
                                Attente
                            </span>
                        </td>

                        <td>

                            <button class="btn btn-danger btn-sm supprimer">
                                ✖
                            </button>

                            <button class="btn btn-success btn-sm">
                                ✔
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>


    <!-- Gestion des logements -->

    <div class="card shadow bg-dark text-white">

        <div class="card-header bg-primary d-flex justify-content-between">

            <span>Gestion des logements</span>

            <a href="{{ route('logements.create') }}"
               class="btn btn-success btn-sm">
                + AJOUTER
            </a>

        </div>

        <div class="card-body p-0">

            <table class="table table-dark table-bordered mb-0">

                <thead>

                    <tr>
                        <th>Logement</th>
                        <th>Superficie</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>Appartement Golf</td>
                        <td>114 m²</td>
                        <td>100 000 FCFA/mois</td>

                        <td>

                            <a href="{{ route('logements.edit') }}"
                               class="btn btn-success btn-sm">
                                ✏
                            </a>

                            <button class="btn btn-danger btn-sm supprimer">
                                🗑
                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection


@section('scripts')

<script>

document.querySelectorAll('.supprimer').forEach(btn => {

    btn.addEventListener('click', function () {

        if(confirm('Voulez-vous supprimer cet élément ?')) {

            this.closest('tr').remove();

        }

    });

});

</script>

@endsection