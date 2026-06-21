@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="card shadow mx-auto" style="max-width:700px;">

        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Modifier Logement</h3>

            <a href="{{ route('dashboard') }}" class="text-white text-decoration-none fs-3">
                &times;
            </a>
        </div>

        <div class="card-body p-5">

            <form action="{{ route('logements.update', $logement->id_logement ?? $logement->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Nom du logement :</label>
                    <input type="text"
                           name="nom_logement"
                           class="form-control @error('nom_logement') is-invalid @enderror"
                           value="{{ old('nom_logement', $logement->nom_logement) }}">
                    @error('nom_logement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Description / Situation :</label>
                    <textarea name="description_logement"
                              class="form-control @error('description_logement') is-invalid @enderror"
                              rows="3">{{ old('description_logement', $logement->description_logement) }}</textarea>
                    @error('description_logement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Superficie (m²) :</label>
                    <input type="number"
                           name="superficie"
                           class="form-control @error('superficie') is-invalid @enderror"
                           value="{{ old('superficie', $logement->superficie) }}">
                    @error('superficie')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Modifier la photo (laisser vide pour conserver l'actuelle) :</label>
                    <input type="file"
                           name="image_url"
                           class="form-control @error('image_url') is-invalid @enderror">
                    @error('image_url')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    @if($logement->image_url)
                        <div class="mt-2">
                            <span class="text-muted small d-block mb-1">Photo actuelle :</span>
                            <img src="{{ asset('images/' . $logement->image_url) }}" class="rounded shadow-sm" style="height: 80px; object-fit: cover;" alt="Aperçu">
                        </div>
                    @endif
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Prix (FCFA) :</label>
                    <input type="number"
                           name="prix_fcfa"
                           class="form-control @error('prix_fcfa') is-invalid @enderror"
                           value="{{ old('prix_fcfa', $logement->prix_fcfa) }}">
                    @error('prix_fcfa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Nombre de pièces :</label>
                    <input type="number"
                           name="nombre_pieces"
                           class="form-control @error('nombre_pieces') is-invalid @enderror"
                           value="{{ old('nombre_pieces', $logement->nombre_pieces) }}">
                    @error('nombre_pieces')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Nombre de chambres :</label>
                    <input type="number"
                           name="nombre_chambres"
                           class="form-control @error('nombre_chambres') is-invalid @enderror"
                           value="{{ old('nombre_chambres', $logement->nombre_chambres) }}">
                    @error('nombre_chambres')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Nombre de salles de bain :</label>
                    <input type="number"
                           name="nombre_salles_de_bain"
                           class="form-control @error('nombre_salles_de_bain') is-invalid @enderror"
                           value="{{ old('nombre_salles_de_bain', $logement->nombre_salles_de_bain) }}">
                    @error('nombre_salles_de_bain')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Type de logement :</label>
                    <input type="text"
                           name="type_logement"
                           class="form-control @error('type_logement') is-invalid @enderror"
                           value="{{ old('type_logement', $logement->type_logement) }}">
                    @error('type_logement')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Meublé ?</label>
                    <select name="meuble" class="form-control @error('meuble') is-invalid @enderror">
                        <option value="Oui" {{ old('meuble', $logement->meuble) == 'Oui' ? 'selected' : '' }}>Oui</option>
                        <option value="Non" {{ old('meuble', $logement->meuble) == 'Non' ? 'selected' : '' }}>Non</option>
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
                        Modifier
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection