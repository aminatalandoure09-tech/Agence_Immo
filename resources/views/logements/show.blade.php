@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <div class="card mx-auto shadow-lg border-0 bg-dark text-white rounded-3" style="max-width: 850px; background-color: #111a2e !important;">
        
        <div class="card-body p-4">
            <div class="mb-3">
                <span class="bg-white text-dark fw-bold px-4 py-1 rounded shadow-sm text-uppercase border" style="letter-spacing: 1px;">
                    Description Détaillée
                </span>
            </div>

            <div class="fs-5 lh-lg mb-4 ms-2">
                <div class="fw-bold fs-4 text-warning mb-3">{{ $logement->nom_logement }}</div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div>🏢 Type : <strong>{{ $logement->type_logement }}</strong></div>
                        <div>📍 Situé à : <strong>{{ $logement->description_logement ?? 'Non spécifié' }}</strong></div>
                        <div>🛏️ Chambres : <strong>{{ $logement->nombre_chambres }}</strong></div>
                        <div>🚿 Salles de bain : <strong>{{ $logement->nombre_salles_de_bain }}</strong></div>
                    </div>
                    
                    <div class="col-md-6">
                        <div>🚗 Garage : <strong>{{ $logement->garage ?? 'Non spécifié' }}</strong></div>
                        <div>📐 Superficie : <strong>{{ $logement->superficie }} m²</strong></div>
                        <div>🛋️ État : <strong>{{ strtolower($logement->meuble) === 'oui' ? 'Meublé' : 'Non meublé' }}</strong></div>
                        <div>💰 Prix : <strong class="text-success">{{ number_format($logement->prix_fcfa, 0, ',', ' ') }} F CFA</strong></div>
                    </div>
                </div>
                
                <div class="mt-3">
                    Statut : 
                    <span class="badge {{ strtolower($logement->statut) === 'disponible' ? 'bg-success' : 'bg-danger' }} px-3 py-1 rounded">
                        {{ $logement->statut ?? 'Disponible' }}
                    </span>
                </div>
            </div>

            <p class="text-muted small ms-2">(Aperçu de la photo ci-dessous)</p>

            <div class="row g-3 mt-2">
                <div class="col-md-10 mx-auto">
                    <div class="rounded overflow-hidden shadow-sm border border-secondary" style="height: 380px; background-color: #1a263f;">
                        @if($logement->chemin_image)
                            <img src="{{ $logement->chemin_image }}" alt="{{ $logement->nom_logement }}" class="w-100 h-100" style="object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center w-100 h-100 text-muted bg-secondary">
                                <div class="text-center">
                                    <span style="font-size: 3rem;">📷</span>
                                    <p class="mb-0 small mt-2 text-white">Aucune photo disponible</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="d-flex justify-content-between align-items-center mt-5 border-top border-secondary pt-3">
                <a href="{{ route('logements.index') }}" class="btn btn-outline-light btn-sm px-4">
                    ⬅ Retour au catalogue
                </a>
                
                 @auth
        <a href="{{ route('rendezvous.create', ['logement_id' => $logement->id_logement]) }}" class="btn btn-success font-weight-bold px-4 py-2 w-100 rounded shadow-sm" style="background-color: #22c55e !important; border: none; font-size: 1rem;">
            Prendre rendez-vous
        </a>
    @endauth

    @guest
        <a href="{{ route('login') }}" class="btn btn-warning font-weight-bold px-4 py-2 w-100 rounded shadow-sm" style="font-size: 1rem;">
            🔑 Se connecter pour réserver
        </a>
    @endguest
            </div>

        </div>
    </div>

</div>
@endsection