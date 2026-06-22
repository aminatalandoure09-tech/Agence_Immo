@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="bg-dark text-white text-center py-3 rounded mb-4 shadow" style="background-color: #111a2e !important;">
        <h3 class="mb-0 font-weight-bold">✏️ Modifier le Logement : {{ $logement->nom_logement }}</h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0 rounded bg-white text-dark">
                
                <div class="card-header py-3 font-weight-bold border-0 text-white" style="background-color: #111a2e !important;">
                    🔄 Mettre à jour les informations du bien
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('logements.update', $logement->id_logement) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="nom_logement" class="form-label font-weight-bold text-secondary">Nom / Titre du Logement</label>
                            <input type="text" name="nom_logement" id="nom_logement" class="form-control border-secondary @error('nom_logement') is-invalid @enderror" value="{{ old('nom_logement', $logement->nom_logement) }}" required>
                            @error('nom_logement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type_logement" class="form-label font-weight-bold text-secondary">Type de Logement</label>
                            <select name="type_logement" id="type_logement" class="form-select border-secondary @error('type_logement') is-invalid @enderror" required>
                                <option value="Appartement" {{ old('type_logement', $logement->type_logement) == 'Appartement' ? 'selected' : '' }}>Appartement</option>
                                <option value="Studio" {{ old('type_logement', $logement->type_logement) == 'Studio' ? 'selected' : '' }}>Studio</option>
                                <option value="Villa" {{ old('type_logement', $logement->type_logement) == 'Villa' ? 'selected' : '' }}>Villa</option>
                                <option value="Chambre" {{ old('type_logement', $logement->type_logement) == 'Chambre' ? 'selected' : '' }}>Chambre</option>
                            </select>
                            @error('type_logement')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prix_fcfa" class="form-label font-weight-bold text-secondary">Prix (F CFA)</label>
                            <input type="number" name="prix_fcfa" id="prix_fcfa" class="form-control border-secondary @error('prix_fcfa') is-invalid @enderror" value="{{ old('prix_fcfa', $logement->prix_fcfa) }}" min="0" required>
                            @error('prix_fcfa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="statut" class="form-label font-weight-bold text-secondary">Statut de disponibilité</label>
                            <select name="statut" id="statut" class="form-select border-secondary @error('statut') is-invalid @enderror" required>
                                <option value="Disponible" {{ old('statut', $logement->statut) === 'Disponible' ? 'selected' : '' }}>🟢 Disponible</option>
                                <option value="Vendu" {{ old('statut', $logement->statut) === 'Vendu' ? 'selected' : '' }}>🔴 Vendu</option>
                                <option value="Occupé" {{ old('statut', $logement->statut) === 'Occupé' ? 'selected' : '' }}>🟡 Occupé</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="image_url" class="form-label font-weight-bold text-secondary d-block">📷 Photo du logement</label>
                            
                            @if($logement->image_url)
                                <div class="mb-3 p-2 bg-light border rounded d-inline-block shadow-sm">
                                    <small class="text-muted d-block mb-1 font-weight-bold">Image actuelle :</small>
                                    <img src="{{ asset('images/' . $logement->image_url) }}" alt="Aperçu actuel" style="max-height: 140px; object-fit: contain; border-radius: 4px;">
                                </div>
                            @else
                                <div class="mb-3 text-warning small bg-light p-2 rounded border">
                                    ⚠️ Aucune image associée pour le moment.
                                </div>
                            @endif

                            <input type="file" name="image_url" id="image_url" class="form-control border-secondary @error('image_url') is-invalid @enderror" accept="image/*">
                            <small class="text-muted d-block mt-1">Laissez vide si vous ne souhaitez pas remplacer l'image existante.</small>
                            @error('image_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between pt-2 border-top">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 font-weight-bold">Annuler</a>
                            <button type="submit" class="btn btn-success px-5 font-weight-bold shadow-sm">💾 Sauvegarder les modifications</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection