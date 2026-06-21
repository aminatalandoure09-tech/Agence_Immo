@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <div class="mb-4 text-white">
        <h2 class="fw-bold">✨ Nos Logements Disponibles</h2>
        <p class="text-muted">Découvrez nos appartements et villas d'exception.</p>
    </div>

    <div class="row">
        @forelse($logements as $logement)
            <div class="col-md-6 mb-4">
                <div class="card bg-dark text-white shadow rounded-3 overflow-hidden h-100 border-0">
                    
                    <div style="height: 350px; background-color: #222;" class="p-3">
                        @if($logement->image_url)
                            <img src="{{ asset('public/images/' . $logement->image_url) }}" class="w-100 h-100 rounded" style="object-fit: cover;" alt="{{ $logement->nom_logement }}">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 text-muted">
                                📷 Aucune photo disponible
                            </div>
                        @endif
                    </div>

                    <div class="card-body text-center pt-0">
                        <p class="card-text fw-bold mb-3 fs-5">
                            {{ $logement->nom_logement }} - {{ number_format($logement->prix_fcfa, 0, ',', ' ') }} F CFA 
                            <span class="text-muted small">
                                ({{ $logement->type_logement === 'location' ? 'par mois' : 'la nuit' }})
                            </span>
                        </p>
                        
                        <a href="{{ route('logements.show', $logement->id_logement ?? $logement->id) }}" class="btn btn-success px-5 fw-bold rounded-pill shadow-sm">
                            Details
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-5">
                <div class="fs-4">Aucun logement n'est disponible pour le moment. 🏢</div>
                <a href="{{ route('dashboard') }}" class="btn btn-outline-light mt-3">Retour au Dashboard</a>
            </div>
        @endforelse
    </div>
</div>
@endsection