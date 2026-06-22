@extends('layouts.app')

@section('content')
<div class="container-fluid bg-white py-5" style="min-height: 100vh;">
    <div class="container" style="max-width: 600px; padding-bottom: 50px;">
        
        <div class="card shadow-sm border border-light" style="background: #ffffff; color: #333333; border-radius: 8px;">
            
            <div class="card-header text-white text-center py-3" style="background: #081133; border-top-left-radius: 7px; border-top-right-radius: 7px;">
                <h3 class="mb-0 fw-bold">📅 Prendre un Rendez-vous</h3>
            </div>

            <div class="card-body p-4">

                {{-- 1. AFFICHAGE DES INFOS S'IL S'AGIT D'UN TERRAIN --}}
                @if($terrain)
                    <div class="alert alert-info bg-light text-dark border-info mb-4">
                        <strong class="text-primary">Terrain sélectionné :</strong> {{ $terrain->nom_terrain }} <br>
                        <small class="text-muted">Superficie : {{ $terrain->superficie }} m² | Prix : {{ number_format($terrain->prix_fcfa, 0, ',', ' ') }} FCFA</small>
                    </div>
                @endif

                {{-- 2. AFFICHAGE DES INFOS S'IL S'AGIT D'UN LOGEMENT --}}
                @if($logement)
                    <div class="alert alert-info bg-light text-dark border-info mb-4">
                        <strong class="text-primary">Logement sélectionné :</strong> {{ $logement->nom_logement }} <br>
                        <small class="text-muted">Type : {{ $logement->type_logement }} | Superficie : {{ $logement->superficie }} m² | Prix : {{ number_format($logement->prix_fcfa, 0, ',', ' ') }} FCFA</small>
                    </div>
                @endif

                <form action="{{ route('rendezvous.store') }}" method="POST">
                    @csrf

                    {{-- CHAMPS CACHÉS SELON LA SÉLECTION --}}
                    @if($terrain)
                        <input type="hidden" name="id_terrain" value="{{ $terrain->id_terrain }}">
                    @endif

                    @if($logement)
                        <input type="hidden" name="id_logement" value="{{ $logement->id_logement }}">
                    @endif

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-secondary small fw-bold">Date de la visite :</label>
                            <input type="date" 
                                   name="date_rdv" 
                                   class="form-control bg-white text-dark border-secondary-subtle @error('date_rdv') is-invalid @enderror" 
                                   value="{{ old('date_rdv', date('Y-m-d')) }}" required>
                            @error('date_rdv')
                                <div class="invalid-feedback text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label class="form-label text-secondary small fw-bold">Heure de la visite :</label>
                            <input type="time" 
                                   name="heure_rdv" 
                                   class="form-control bg-white text-dark border-secondary-subtle @error('heure_rdv') is-invalid @enderror" 
                                   value="{{ old('heure_rdv') }}" required>
                            @error('heure_rdv')
                                <div class="invalid-feedback text-danger fw-bold">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-secondary small fw-bold">Message ou précisions (optionnel) :</label>
                        <textarea name="message" 
                                  rows="3" 
                                  class="form-control bg-white text-dark border-secondary-subtle @error('message') is-invalid @enderror" 
                                  placeholder="Ajoutez des détails si nécessaire (ex: disponibilités, questions...)"
                        >{{ old('message') }}</textarea>
                        @error('message')
                            <div class="invalid-feedback text-danger fw-bold">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2 mt-4">
                        <button type="submit" class="btn btn-success py-2 fw-bold fs-5 shadow-sm" style="background: #2ecc71; border: none;">
                            Confirmer la demande de RDV
                        </button>
                        
                        @if($logement)
                            <a href="{{ route('logements.index') }}" class="btn btn-outline-dark py-2 small">
                                Annuler
                            </a>
                        @else
                            <a href="{{ route('terrains.index') }}" class="btn btn-outline-dark py-2 small">
                                Annuler
                            </a>
                        @endif
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection