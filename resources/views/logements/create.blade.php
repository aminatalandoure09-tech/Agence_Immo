@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width:700px;">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Ajouter Logement</h3>

            <a href="{{ route('dashboard') }}" class="text-white text-decoration-none fs-3">
                &times;
            </a>
        </div>

        <div class="card-body p-5">

            <form action="{{ route('logements.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
                    <input type="text"
                           name="nom_logement"
                           value="{{ old('nom_logement') }}"
                           class="form-control @error('nom_logement') is-invalid @enderror"
                           placeholder="Nom du logement">
                    @error('nom_logement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <textarea name="description_logement"
                              class="form-control @error('description_logement') is-invalid @enderror"
                              rows="3"
                              placeholder="Description ou situation géographique (Ex: GOLF, Sotuba...)">{{ old('description_logement') }}</textarea>
                    @error('description_logement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="superficie"
                           value="{{ old('superficie') }}"
                           class="form-control @error('superficie') is-invalid @enderror"
                           placeholder="Superficie (en m²)">
                    @error('superficie')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Image du logement :</label>
                    <input type="file"
                           name="image"
                           class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="prix_fcfa"
                           value="{{ old('prix_fcfa') }}"
                           class="form-control @error('prix_fcfa') is-invalid @enderror"
                           placeholder="Prix en FCFA">
                    @error('prix_fcfa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="nombre_pieces"
                           value="{{ old('nombre_pieces') }}"
                           class="form-control @error('nombre_pieces') is-invalid @enderror"
                           placeholder="Nombre de pièces au total">
                    @error('nombre_pieces')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="nombre_chambres"
                           value="{{ old('nombre_chambres') }}"
                           class="form-control @error('nombre_chambres') is-invalid @enderror"
                           placeholder="Nombre de chambres">
                    @error('nombre_chambres')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="number"
                           name="nombre_salles_de_bain"
                           value="{{ old('nombre_salles_de_bain') }}"
                           class="form-control @error('nombre_salles_de_bain') is-invalid @enderror"
                           placeholder="Nombre de salles de bain">
                    @error('nombre_salles_de_bain')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <input type="text"
                           name="type_logement"
                           value="{{ old('type_logement') }}"
                           class="form-control @error('type_logement') is-invalid @enderror"
                           placeholder="Type de logement (Ex: Appartement, Villa...)">
                    @error('type_logement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <select name="meuble" class="form-control @error('meuble') is-invalid @enderror">
                        <option value="">Meublé ?</option>
                        <option value="Oui" {{ old('meuble') == 'Oui' ? 'selected' : '' }}>Oui</option>
                        <option value="Non" {{ old('meuble') == 'Non' ? 'selected' : '' }}>Non</option>
                    </select>
                    @error('meuble')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="text-end mt-5">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary me-2">
                        Annuler
                    </a>

                    <button type="submit" class="btn btn-dark px-4">
                        Ajouter
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection