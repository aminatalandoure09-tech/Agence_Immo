@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 600px; padding-bottom: 50px;">
    <div class="card shadow border-0" style="background: #081133; color: white; border-radius: 8px;">
        
        <div class="card-header bg-dark text-white text-center py-3">
            <h3 class="mb-0">📅 Prendre un Rendez-vous</h3>
        </div>

        <div class="card-body p-4">

            @if($terrain)
                <div class="alert alert-info bg-opacity-10 text-white border-secondary mb-4">
                    <strong>Terrain sélectionné :</strong> {{ $terrain->nom_terrain }} <br>
                    <small class="text-muted">Superficie : {{ $terrain->superficie }} m² | Prix : {{ number_format($terrain->prix_fcfa, 0, ',', ' ') }} FCFA</small>
                </div>
            @endif

            <form action="{{ route('rendezvous.store') }}" method="POST">
                @csrf

                @if($terrain)
                    <input type="hidden" name="id_terrain" value="{{ $terrain->id_terrain }}">
                @endif

                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label text-white-50 small fw-bold">Date de la visite :</label>
                        <input type="date" 
                               name="date_rdv" 
                               class="form-control bg-light text-dark @error('date_rdv') is-invalid @enderror" 
                               value="{{ old('date_rdv', date('Y-m-d')) }}" required>
                        @error('date_rdv')
                            <div class="invalid-feedback text-warning">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-4">
                        <label class="form-label text-white-50 small fw-bold">Heure de la visite :</label>
                        <input type="time" 
                               name="heure_rdv" 
                               class="form-control bg-light text-dark @error('heure_rdv') is-invalid @enderror" 
                               value="{{ old('heure_rdv') }}" required>
                        @error('heure_rdv')
                            <div class="invalid-feedback text-warning">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-white-50 small fw-bold">Message ou précisions (optionnel) :</label>
                    <textarea name="message" 
                              rows="3" 
                              class="form-control bg-light text-dark @error('message') is-invalid @enderror" 
                              placeholder="Ajoutez des détails si nécessaire (ex: disponibilités, questions...)"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback text-warning">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-success py-2 fw-bold fs-5 shadow" style="background: #2ecc71; border: none;">
                        Confirmer la demande de RDV
                    </button>
                    <a href="{{ route('terrains.index') }}" class="btn btn-outline-light py-2 small">
                        Annuler
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection