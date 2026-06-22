@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="text-center py-4 rounded mb-4 shadow text-white" style="background-color: #111a2e !important;">
        <h2 class="mb-2 font-weight-bold">🏢 Découvrez Nos Logements Disponibles</h2>
        <p class="text-white-50 mb-0">Des appartements, studios et villas adaptés à votre style de vie</p>
    </div>

    <div class="card mb-4 shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-secondary" style="font-size: 1.2rem;">🔍</span>
                <input type="text" id="logementSearchInput" class="form-control border-start-0 py-2" placeholder="Rechercher un appartement, une villa, une ville, un prix..." style="font-size: 1.05rem; outline: none; box-shadow: none;">
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row" id="logementsGrid">
        @forelse($listeLogements as $logement)
            <div class="col-md-4 mb-4 logement-item-card">
                <div class="card h-100 shadow border-0 bg-dark text-white card-logement" style="background-color: #111a2e !important; transition: transform 0.2s;">
                    
                    <div class="position-relative overflow-hidden rounded-top">
                        @if($logement->chemin_image)
                            <img src="{{ $logement->chemin_image }}" class="card-img-top" alt="{{ $logement->nom_logement }}" style="height: 240px; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 240px;">
                                <div class="text-center">
                                    <span style="font-size: 2.5rem;">📷</span>
                                    <p class="mb-0 small mt-1">Photo en cours d'ajout</p>
                                </div>
                            </div>
                        @endif
                        <span class="badge bg-info position-absolute top-0 end-0 m-3 px-3 py-2 font-weight-bold shadow search-type" style="font-size: 0.9rem;">
                            {{ $logement->type_logement }}
                        </span>
                    </div>

                    <div class="card-body d-flex flex-column justify-content-between text-center p-4">
                        <div class="mb-3">
                            <h5 class="card-title font-weight-bold text-truncate mb-2 search-title" style="font-size: 1.2rem;">{{ $logement->nom_logement }}</h5>
                            <h4 class="text-success font-weight-bold mb-0 search-price">
                                {{ number_format($logement->prix_fcfa ?? $logement->prix, 0, ',', ' ') }} F CFA
                            </h4>
                        </div>

                        <div class="d-grid">
                            <a href="{{ route('logements.show', $logement->id_logement) }}" class="btn btn-primary font-weight-bold text-white shadow-sm px-4 py-2" style="background-color: #0d6efd !important; border: none;">
                                👀 Details
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="text-muted p-4 rounded bg-light border">
                    <span style="font-size: 3rem;">🏢</span>
                    <h4 class="mt-2 mb-0">Aucun logement n'est disponible pour le moment.</h4>
                </div>
            </div>
        @endforelse
    </div>

    <div id="noSearchLogementResult" class="col-12 text-center py-5 d-none">
        <div class="text-muted p-4 rounded bg-white border shadow-sm">
            <span style="font-size: 3rem;">🔍</span>
            <h4 class="mt-2 mb-0">Aucun logement ne correspond à votre recherche.</h4>
        </div>
    </div>

</div>

<style>
    .card-logement:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.3) !important;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("logementSearchInput");
    const cards = document.querySelectorAll(".logement-item-card");
    const noResultContainer = document.getElementById("noSearchLogementResult");

    if (searchInput) {
        searchInput.addEventListener("keyup", function() {
            const filter = searchInput.value.toLowerCase().trim();
            let visibleCardsCount = 0;

            cards.forEach(card => {
                const title = card.querySelector(".search-title") ? card.querySelector(".search-title").textContent.toLowerCase() : "";
                const type = card.querySelector(".search-type") ? card.querySelector(".search-type").textContent.toLowerCase() : "";
                const price = card.querySelector(".search-price") ? card.querySelector(".search-price").textContent.toLowerCase() : "";
                
                // On vérifie si le texte tapé correspond au titre, type ou au prix
                if (title.includes(filter) || type.includes(filter) || price.includes(filter)) {
                    card.style.setProperty('display', '', 'important');
                    visibleCardsCount++;
                } else {
                    card.style.setProperty('display', 'none', 'important');
                }
            });

            // Affichage du message si aucune carte ne match
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