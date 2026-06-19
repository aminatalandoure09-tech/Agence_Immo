@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width:700px;">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Ajouter Terrain</h3>

            <a href="#" class="text-white text-decoration-none fs-3">
                &times;
            </a>
        </div>

        <div class="card-body p-5">

            <form action="{{ route('terrains.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <input type="text"
                           name="nom_terrain"
                           class="form-control"
                           placeholder="Nom du terrain (+ quartier)" required>
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="superficie"
                           class="form-control"
                           placeholder="Superficie" required>
                </div>

                <div class="mb-4">
                    <input type="file"
                           name="image_url"
                           class="form-control" required>
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="prix_fcfa"
                           class="form-control"
                           placeholder="Prix en FCFA" required>
                </div>

                <div class="text-end mt-5">

                    <a href="#"
                       class="btn btn-secondary">
                        Annuler
                    </a>

                    <button type="submit"
                            class="btn btn-dark px-4">
                        Ajouter
                    </button>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection