@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <div class="card mx-auto shadow-lg border-0 bg-dark text-white rounded-3" style="max-width: 850px;">
        
        <div class="card-body p-4">
            <div class="mb-3">
                <span class="bg-white text-dark fw-bold px-4 py-1 rounded shadow-sm text-uppercase border" style="letter-spacing: 1px;">
                    Description
                </span>
            </div>

            <div class="fs-5 lh-lg mb-4 ms-2">
                <div class="fw-bold fs-4 text-warning mb-2">{{ $logement->nom_logement }}</div>
                <div>📍 Situé à : <strong>{{ $logement->description_logement ?? 'Non spécifié' }}</strong></div>
                <div>🛏️ Caractéristiques : <strong>{{ $logement->nombre_chambres }} Chambres et {{ $logement->nombre_salles_de_bain }} salles de bain</strong></div>
                <div>🚗 Garage : <strong>{{ $logement->garage ?? 'Oui' }}</strong></div>
                <div>💰 Prix : <strong class="text-success">{{ number_format($logement->prix_fcfa, 0, ',', ' ') }} FCFA</strong> ({{ $logement->meuble === 'Oui' ? 'meublé' : 'non meublé' }})</div>
                <div>📐 Superficie totale : <strong>{{ $logement->superficie }} m²</strong></div>
                
                <div class="mt-2">Statut : 
                    <span class="badge bg-success px-3 py-1 rounded">{{ $logement->statut }}</span>
                </div>
            </div>

            <p class="text-muted small ms-2">(voir les images ci-dessous)</p>

            <div class="row g-3 mt-2">
                <div class="col-md-6">
                    <div class="rounded overflow-hidden shadow-sm" style="height: 250px; background-color: #333;">
                        <img src="{{ asset('images/' . $logement->image_url) }}" class="w-100 h-100" style="object-fit: cover;">
                    </div>
                </div>
                
            </div>
            
            <div class="mt-4 text-start">
                <a href="{{ route('logements.index') }}" class="btn btn-outline-light btn-sm px-4">
                    ⬅ Retour au catalogue
                </a>
            </div>

        </div>
    </div>

</div>
@endsection