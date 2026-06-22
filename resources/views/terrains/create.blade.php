@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="text-dark text-center py-3 rounded mb-4 shadow-sm bg-white border">
        <h3 class="mb-0 fw-bold">🌳 Ajouter un Nouveau Terrain</h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border rounded bg-white text-dark">
                <div class="card-header py-3 fw-bold border-0 text-white" style="background-color: #111a2e !important;">
                    📝 Formulaire d'informations
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('terrains.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nom_terrain" class="form-label fw-bold">Nom du Terrain</label>
                            <input type="text" name="nom_terrain" id="nom_terrain" class="form-control border @error('nom_terrain') is-invalid @enderror" value="{{ old('nom_terrain') }}" placeholder="Ex: Terrain Zone Résidentielle A" required>
                            @error('nom_terrain')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="superficie" class="form-label fw-bold">Superficie (en m²)</label>
                            <input type="number" name="superficie" id="superficie" class="form-control border @error('superficie') is-invalid @enderror" value="{{ old('superficie') }}" placeholder="Ex: 500" min="1" required>
                            @error('superficie')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prix_fcfa" class="form-label fw-bold">Prix (F CFA)</label>
                            <input type="number" name="prix_fcfa" id="prix_fcfa" class="form-control border @error('prix_fcfa') is-invalid @enderror" value="{{ old('prix_fcfa') }}" placeholder="Ex: 15000000" min="0" required>
                            @error('prix_fcfa')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image_url" class="form-label fw-bold">📷 Photo du terrain</label>
                            <input type="file" name="image_url" id="image_url" class="form-control border @error('image_url') is-invalid @enderror" accept="image/*">
                            <small class="text-muted d-block mt-1">Formats acceptés : jpeg, png, jpg, gif. Taille max : 2 Mo.</small>
                            @error('image_url')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 fw-bold">Annuler</a>
                            <button type="submit" class="btn text-white px-5 fw-bold" style="background-color: #111a2e;">+ Enregistrer le terrain</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection