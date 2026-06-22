@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="text-center py-5 rounded mb-5 shadow-lg text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #111a2e 0%, #1e2d4a 100%) !important;">
        <div class="position-relative z-index-1">
            <h1 class="display-5 font-weight-bold mb-2">ℹ️ À Propos de Asano Services</h1>
            <p class="text-white-50 lead mb-0">“Votre partenaire de confiance dans l’immobilier au Mali”</p>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded p-4 mb-4 text-white" style="background-color: #111a2e !important;">
                <div class="d-flex align-items-center mb-3 border-bottom border-secondary pb-2">
                    <span class="fs-3 me-3">🏢</span>
                    <h3 class="card-title mb-0 font-weight-bold">Qui sommes-nous ?</h3>
                </div>
                <p class="card-text text-white-50 lh-lg" style="font-size: 1.05rem;">
                    <strong>Asano Services</strong> est une agence immobilière basée à Bamako, spécialisée dans la location, la vente et la gestion de biens immobiliers. Nous mettons notre expertise au service de nos clients pour les accompagner sereinement dans la recherche de logements, terrains et locaux professionnels parfaitement adaptés à leurs besoins et exigences.
                </p>
            </div>

            <div class="card border-0 shadow-sm rounded p-4 text-white" style="background-color: #111a2e !important;">
                <div class="d-flex align-items-center mb-4 border-bottom border-secondary pb-2">
                    <span class="fs-3 me-3">🎯</span>
                    <h3 class="card-title mb-0 font-weight-bold">Notre Mission</h3>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="p-3 rounded text-center h-100" style="background-color: rgba(255,255,255,0.04);">
                            <span class="fs-2 d-block mb-2">🔑</span>
                            <h5 class="text-success font-weight-bold small uppercase">Accessibilité</h5>
                            <p class="text-white-50 small mb-0">Faciliter l'accès au logement pour tous.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded text-center h-100" style="background-color: rgba(255,255,255,0.04);">
                            <span class="fs-2 d-block mb-2">🛡️</span>
                            <h5 class="text-success font-weight-bold small uppercase">Fiabilité</h5>
                            <p class="text-white-50 small mb-0">Offrir des biens fiables, vérifiés et sécurisés.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 rounded text-center h-100" style="background-color: rgba(255,255,255,0.04);">
                            <span class="fs-2 d-block mb-2">🤝</span>
                            <h5 class="text-success font-weight-bold small uppercase">Suivi</h5>
                            <p class="text-white-50 small mb-0">Assurer un accompagnement professionnel complet.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded p-4 mb-4 text-white" style="background-color: #111a2e !important;">
                <div class="d-flex align-items-center mb-3 border-bottom border-secondary pb-2">
                    <span class="fs-4 me-2">💼</span>
                    <h4 class="card-title mb-0 font-weight-bold">Nos Services</h4>
                </div>
                <ul class="list-group list-group-flush bg-transparent">
                    <li class="list-group-item bg-transparent text-white-50 border-0 ps-0 d-flex align-items-center">
                        <span class="text-success me-2">✔</span> Vente de maisons et villas
                    </li>
                    <li class="list-group-item bg-transparent text-white-50 border-0 ps-0 d-flex align-items-center">
                        <span class="text-success me-2">✔</span> Location d’appartements & locaux
                    </li>
                    <li class="list-group-item bg-transparent text-white-50 border-0 ps-0 d-flex align-items-center">
                        <span class="text-success me-2">✔</span> Vente de terrains sécurisés
                    </li>
                </ul>
            </div>

            <div class="card border-0 shadow-sm rounded p-4 text-white" style="background-color: #111a2e !important; border-left: 4px solid #22c55e !important;">
                <div class="d-flex align-items-center mb-3 border-bottom border-secondary pb-2">
                    <span class="fs-4 me-2">📍</span>
                    <h4 class="card-title mb-0 font-weight-bold">Coordonnées</h4>
                </div>
                
                <div class="d-flex align-items-start mb-3">
                    <div class="text-success me-3 mt-1">
                        <i class="fas fa-map-marker-alt fs-5"></i>
                    </div>
                    <div>
                        <span class="d-block text-white font-weight-bold small">Adresse</span>
                        <span class="text-white-50">Bamako, Missabougou</span>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-3">
                    <div class="text-success me-3 mt-1">
                        <i class="fas fa-phone-alt fs-5"></i>
                    </div>
                    <div>
                        <span class="d-block text-white font-weight-bold small">Téléphone</span>
                        <span class="text-white-50">+223 XX XX XX XX</span>
                    </div>
                </div>

                <div class="d-flex align-items-start">
                    <div class="text-success me-3 mt-1">
                        <i class="fas fa-envelope fs-5"></i>
                    </div>
                    <div>
                        <span class="d-block text-white font-weight-bold small">Email</span>
                        <span class="text-white-50">asanoservices@gmail.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Petites animations au survol des blocs */
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
    }
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.3) !important;
    }
</style>
@endsection