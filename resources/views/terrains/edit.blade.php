@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <!-- Titre Principal Foncé -->
    <div class="bg-dark text-white text-center py-3 rounded mb-4 shadow" style="background-color: #111a2e !important;">
        <h3 class="mb-0 font-weight-bold">✏️ Modifier le Terrain : {{ $terrain->nom_terrain }}</h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Carte principale : Fond blanc, texte sombre -->
            <div class="card shadow border-0 rounded bg-white text-dark">
                
                <!-- Entête de la carte : Foncé (Style Sidebar / Dashboard) -->
                <div class="card-header py-3 font-weight-bold border-0 text-white" style="background-color: #111a2e !important;">
                    🔄 Mettre à jour les informations du bien
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('terrains.update', $terrain->id_terrain) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nom du Terrain -->
                        <div class="mb-3">
                            <label for="nom_terrain" class="form-label font-weight-bold text-secondary">Nom du Terrain</label>
                            <input type="text" name="nom_terrain" id="nom_terrain" class="form-control border-secondary @error('nom_terrain') is-invalid @enderror" value="{{ old('nom_terrain', $terrain->nom_terrain) }}" required>
                            @error('nom_terrain')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Superficie -->
                        <div class="mb-3">
                            <label for="superficie" class="form-label font-weight-bold text-secondary">Superficie (en m²)</label>
                            <input type="number" name="superficie" id="superficie" class="form-control border-secondary @error('superficie') is-invalid @enderror" value="{{ old('superficie', $terrain->superficie) }}" min="1" required>
                            @error('superficie')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Prix -->
                        <div class="mb-3">
                            <label for="prix_fcfa" class="form-label font-weight-bold text-secondary">Prix (F CFA)</label>
                            <input type="number" name="prix_fcfa" id="prix_fcfa" class="form-control border-secondary @error('prix_fcfa') is-invalid @enderror" value="{{ old('prix_fcfa', $terrain->prix_fcfa) }}" min="0" required>
                            @error('prix_fcfa')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Statut du Terrain -->
                        <div class="mb-3">
                            <label for="statut" class="form-label font-weight-bold text-secondary">Statut de disponibilité</label>
                            <select name="statut" id="statut" class="form-select border-secondary @error('statut') is-invalid @enderror" required>
                                <option value="Disponible" {{ old('statut', $terrain->statut) === 'Disponible' ? 'selected' : '' }}>🟢 Disponible</option>
                                <option value="Vendu" {{ old('statut', $terrain->statut) === 'Vendu' ? 'selected' : '' }}>🔴 Vendu</option>
                                <option value="Occupé" {{ old('statut', $terrain->statut) === 'Occupé' ? 'selected' : '' }}>🟡 Occupé</option>
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Image actuelle & Input d'envoi -->
                        <div class="mb-4">
                            <label for="image_url" class="form-label font-weight-bold text-secondary d-block">📷 Image du terrain</label>
                            
                            @if($terrain->image_url)
                                <div class="mb-3 p-2 bg-light border rounded d-inline-block shadow-sm">
                                    <small class="text-muted d-block mb-1 font-weight-bold">Image actuelle :</small>
                                    <img src="{{ asset('images/' . $terrain->image_url) }}" alt="Aperçu actuel" style="max-height: 140px; object-fit: contain; border-radius: 4px;">
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

                        <!-- Boutons d'action -->
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