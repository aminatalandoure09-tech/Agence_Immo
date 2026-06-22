@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="text-center py-4 rounded mb-4 shadow text-white" style="background-color: #111a2e !important;">
        <h2 class="mb-2 font-weight-bold">🌳 Découvrez Nos Terrains Disponibles</h2>
        <p class="text-white-50 mb-0">Trouvez l'emplacement idéal pour concrétiser vos projets immobiliers</p>
    </div>

    <div class="card mb-4 shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-secondary" style="font-size: 1.2rem;">🔍</span>
                <input type="text" id="terrainSearchInput" class="form-control border-start-0 py-2" placeholder="Rechercher un terrain par emplacement, superficie (ex: 300), prix..." style="font-size: 1.05rem; outline: none; box-shadow: none;">
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row" id="terrainsGrid">
        @forelse($listeTerrains as $terrain)
            <div class="col-md-4 mb-4 terrain-item-card">
                <div class="card h-100 shadow border-0 text-white card-terrain" style="background-color: #111a2e !important; transition: transform 0.2s;">
                    
                    <div class="position-relative overflow-hidden rounded-top p-3">
                        @if($terrain->chemin_image)
                            <img src="{{ $terrain->chemin_image }}" class="card-img-top rounded shadow-sm" alt="{{ $terrain->nom_terrain }}" style="height: 240px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-secondary text-white rounded" style="height: 240px;">
                                <div class="text-center">
                                    <span style="font-size: 2.5rem;">📷</span>
                                    <p class="mb-0 small mt-1">Photo en cours d'ajout</p>
                                </div>
                            </div>
                        @endif
                        <span class="badge bg-primary position-absolute top-0 end-0 m-4 px-3 py-2 font-weight-bold shadow search-surface" style="font-size: 0.9rem;">
                            📐 {{ $terrain->superficie }} m²
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between p-4 pt-0">
                        <div class="mb-3 text-start">
                            <p class="text-white mb-1" style="font-size: 1.05rem;">
                                Terrain situé : <strong class="search-title">{{ $terrain->nom_terrain }}</strong>
                            </p>
                            <p class="text-white mb-0" style="font-size: 1.05rem;">
                                Prix : <span class="font-weight-bold text-success search-price">{{ number_format($terrain->prix_fcfa ?? $terrain->prix, 0, ',', ' ') }} FCFA</span>
                            </p>
                        </div>

                        <div class="text-center mt-2">
                            <a href="{{ route('rendezvous.create', ['terrain_id' => $terrain->id_terrain]) }}" class="btn btn-success font-weight-bold px-4 py-2 w-100 rounded shadow-sm" style="background-color: #22c55e !important; border: none; font-size: 1rem;">
                                Prendre rendez-vous
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted p-4 rounded bg-light border">
                    <span style="font-size: 3rem;">🌳</span>
                    <h4 class="mt-2 mb-0">Aucun terrain n'est disponible pour le moment.</h4>
                </div>
            </div>
        @endforelse
    </div>

    <div id="noSearchTerrainResult" class="col-12 text-center py-5 d-none">
        <div class="text-muted p-4 rounded bg-white border shadow-sm">
            <span style="font-size: 3rem;">🔍</span>
            <h4 class="mt-2 mb-0">Aucun terrain ne correspond à votre recherche.</h4>
        </div>
    </div>
</div>

<style>
    .card-terrain:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.4) !important;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("terrainSearchInput");
    const cards = document.querySelectorAll(".terrain-item-card");
    const noResultContainer = document.getElementById("noSearchTerrainResult");

    if (searchInput) {
        searchInput.addEventListener("keyup", function() {
            const filter = searchInput.value.toLowerCase().trim();
            let visibleCardsCount = 0;

            cards.forEach(card => {
                const title = card.querySelector(".search-title") ? card.querySelector(".search-title").textContent.toLowerCase() : "";
                const surface = card.querySelector(".search-surface") ? card.querySelector(".search-surface").textContent.toLowerCase() : "";
                const price = card.querySelector(".search-price") ? card.querySelector(".search-price").textContent.toLowerCase() : "";
                
                // On filtre via le nom du terrain, la superficie ou le prix
                if (title.includes(filter) || surface.includes(filter) || price.includes(filter)) {
                    card.style.setProperty('display', '', 'important');
                    visibleCardsCount++;
                } else {
                    card.style.setProperty('display', 'none', 'important');
                }
            });

            // Affichage dynamique du message d'erreur si vide
            if (visibleCardsCount === 0 && filter !== "") {
                noResultContainer.classList.remove("d-none");
            } else {
                noResultContainer.classList.add("d-none");
            }
        });
    }
});
</script>
@endsection