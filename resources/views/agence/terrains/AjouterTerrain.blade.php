@extends('layouts.App')

@section('content')

<div class="container mt-4">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0 text-center">
                        Ajouter un terrain
                    </h3>
                </div>

                <div class="card-body">

                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nom du terrain -->
                        <div class="mb-3">
                            <label class="form-label">
                                Nom du terrain (+ quartier)
                            </label>
                            <input
                                type="text"
                                name="nom"
                                class="form-control"
                                placeholder="Ex : Terrain à Yirimadio"
                                required>
                        </div>

                        <!-- Superficie -->
                        <div class="mb-3">
                            <label class="form-label">
                                Superficie (m²)
                            </label>
                            <input
                                type="number"
                                name="superficie"
                                class="form-control"
                                placeholder="Ex : 400"
                                required>
                        </div>

                        <!-- Image -->
                        <div class="mb-3">
                            <label class="form-label">
                                Image du terrain
                            </label>
                            <input
                                type="file"
                                name="image"
                                class="form-control"
                                accept="image/*"
                                required>
                        </div>

                        <!-- Prix -->
                        <div class="mb-4">
                            <label class="form-label">
                                Prix (FCFA)
                            </label>
                            <input
                                type="number"
                                name="prix"
                                class="form-control"
                                placeholder="Ex : 15 000 000"
                                required>
                        </div>

                        <div class="d-flex justify-content-end gap-2">

                            <a href="/terrains" class="btn btn-secondary">
                                Annuler
                            </a>

                            <button type="submit" class="btn btn-success">
                                Ajouter
                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection