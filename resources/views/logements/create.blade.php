@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="text-dark text-center py-3 rounded mb-4 shadow-sm bg-white border">
        <h3 class="mb-0 fw-bold">🏢 Ajouter un Nouveau Logement</h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border rounded bg-white text-dark">
                <div class="card-header py-3 fw-bold border-0 text-white" style="background-color: #111a2e !important;">
                    📝 Formulaire d'informations
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('logements.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nom_logement" class="form-label fw-bold">Nom / Titre du Logement</label>
                            <input type="text" name="nom_logement" id="nom_logement" class="form-control border @error('nom_logement') is-invalid @enderror" value="{{ old('nom_logement') }}" placeholder="Ex: Bel Appartement Meublé - Ville Nouvelle" required>
                            @error('nom_logement')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_logement" class="form-label fw-bold">Type de Logement</label>
                            <select name="type_logement" id="type_logement" class="form-select border @error('type_logement') is-invalid @enderror" required>
                                <option value="" disabled selected>Choisir le type...</option>
                                <option value="Appartement" {{ old('type_logement') == 'Appartement' ? 'selected' : '' }}>Appartement</option>
                                <option value="Studio" {{ old('type_logement') == 'Studio' ? 'selected' : '' }}>Studio</option>
                                <option value="Villa" {{ old('type_logement') == 'Villa' ? 'selected' : '' }}>Villa</option>
                                <option value="Chambre" {{ old('type_logement') == 'Chambre' ? 'selected' : '' }}>Chambre</option>
                            </select>
                            @error('type_logement')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prix_fcfa" class="form-label fw-bold">Prix Mensuel ou Total (F CFA)</label>
                            <input type="number" name="prix_fcfa" id="prix_fcfa" class="form-control border @error('prix_fcfa') is-invalid @enderror" value="{{ old('prix_fcfa') }}" placeholder="Ex: 300000" min="0" required>
                            @error('prix_fcfa')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image_url" class="form-label fw-bold">📷 Photo du logement</label>
                            <input type="file" name="image_url" id="image_url" class="form-control border @error('image_url') is-invalid @enderror" accept="image/*">
                            <small class="text-muted d-block mt-1">Formats : jpeg, png, jpg, gif, webp. Max : 2 Mo.</small>
                            @error('image_url')
                                <div class="invalid-feedback text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-2">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 fw-bold">Annuler</a>
                            <button type="submit" class="btn text-white px-5 fw-bold" style="background-color: #111a2e;">+ Enregistrer le logement</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection