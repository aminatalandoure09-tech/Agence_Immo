@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="card shadow-sm border-0 mb-5 rounded-3 text-center" 
         style="background-image: url('{{ asset('images/bckground.jpg') }}'); 
                background-size: cover; 
                background-position: center; 
                min-height: 80px; 
                background-color: #f8f9fa;">
        <div class="card-body d-flex align-items-center justify-content-center py-3">
            <h3 class="fw-bold text-uppercase mb-0" style="letter-spacing: 1px; font-size: 1.5rem;">
                BIENVENUE SUR ASANO SERVICES !
            </h3>
        </div>
    </div>

    <div class="row justify-content-center g-4">

        <div class="col-md-6 col-lg-5">
            <div class="position-relative overflow-hidden rounded shadow-sm service-card" style="height: 320px;">
                <img src="{{ asset('images/logementAccuel.jpg') }}" 
                     alt="Location ou achat de logement" 
                     class="w-100 h-100" 
                     style="object-fit: cover;">
                
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-start p-4" 
                     style="background: rgba(17, 26, 46, 0.65);">
                    <h3 class="text-white fw-bold mb-3 text-start lh-sm" style="max-width: 80%; font-size: 1.6rem;">
                        Location ou achat de logement
                    </h3>
                    <a href="{{ route('logements.index') }}" class="btn btn-success font-weight-bold px-4 py-2 rounded shadow-sm" style="background-color: #22c55e !important; border: none;">
                        Voir plus
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-5">
            <div class="position-relative overflow-hidden rounded shadow-sm service-card" style="height: 320px;">
                <img src="{{ asset('images/terrainAccueil.jpg') }}" 
                     alt="Achat de terrain en titre foncier" 
                     class="w-100 h-100" 
                     style="object-fit: cover;">
                
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column justify-content-center align-items-start p-4" 
                     style="background: rgba(17, 26, 46, 0.65);">
                    <h3 class="text-white fw-bold mb-3 text-start lh-sm" style="max-width: 80%; font-size: 1.6rem;">
                        Achat de terrain en titre foncier
                    </h3>
                    <a href="{{ route('terrains.index') }}" class="btn btn-success font-weight-bold px-4 py-2 rounded shadow-sm" style="background-color: #22c55e !important; border: none;">
                        Voir plus
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .service-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .service-card img {
        transition: transform 0.3s ease;
    }
    .service-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3) !important;
    }
    .service-card:hover img {
        transform: scale(1.03);
    }
</style>
@endsection