@extends('layouts.app')

@section('content')

<div class="container mt-5">

    <div class="card shadow mx-auto" style="max-width:700px;">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Modifier Terrain</h3>

            <!-- Bouton Croix (Retour au dashboard) -->
            <a href="{{ route('dashboard') }}"
               class="text-white text-decoration-none fs-3">
                &times;
            </a>
        </div>

        <div class="card-body p-5">

            <!-- Route dynamique de mise à jour avec l'ID du terrain -->
            <form action="{{ route('terrains.update', $terrain->id_terrain) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <!-- CHAMP : NOM -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3">
                        <label class="fw-bold">Nom :</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text"
                               name="nom_terrain"
                               value="{{ old('nom_terrain', $terrain->nom_terrain) }}"
                               class="form-control @error('nom_terrain') is-invalid @enderror" required>
                        @error('nom_terrain')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- CHAMP : SUPERFICIE -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3">
                        <label class="fw-bold">Superficie (m²) :</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text"
                               name="superficie"
                               value="{{ old('superficie', $terrain->superficie) }}"
                               class="form-control @error('superficie') is-invalid @enderror" required>
                        @error('superficie')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- CHAMP : IMAGE -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3">
                        <label class="fw-bold">Image :</label>
                    </div>
                    <div class="col-md-9">
                        <!-- Affichage de l'ancienne image si elle existe -->
                        @if($terrain->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $terrain->image) }}" alt="Aperçu" class="img-thumbnail" style="max-height: 80px;">
                                <span class="text-muted d-block small">Image actuelle</span>
                            </div>
                        @endif
                        <input type="file"
                               name="image"
                               class="form-control @error('image') is-invalid @enderror">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- CHAMP : PRIX -->
                <div class="row mb-4 align-items-center">
                    <div class="col-md-3">
                        <label class="fw-bold">Prix (FCFA) :</label>
                    </div>
                    <div class="col-md-9">
                        <input type="number"
                               name="prix_fcfa"
                               value="{{ old('prix_fcfa', $terrain->prix_fcfa) }}"
                               class="form-control @error('prix_fcfa') is-invalid @enderror" required>
                        @error('prix_fcfa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <!-- BOUTONS ACTIONS -->
                <div class="text-end mt-5">
                    <a href="{{ route('dashboard') }}"
                       class="btn btn-secondary me-2">
                        Annuler
                    </a>

                    <button type="submit"
                            class="btn btn-dark px-4">
                        Modifier
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

@endsection