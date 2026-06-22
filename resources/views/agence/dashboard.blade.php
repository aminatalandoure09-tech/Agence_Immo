@extends('layouts.app')

@section('content')
<div id="top" class="container-fluid py-4" style="background-color: #f4f6f9; scroll-behavior: smooth;">
    
    <div class="bg-dark text-white text-center py-3 rounded mb-4 shadow" style="background-color: #111a2e !important;">
        <h3 class="mb-0 font-weight-bold">Dashboard Administrateur</h3>
    </div>

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body bg-white d-flex flex-wrap justify-content-center gap-3 py-3 rounded">
            <span class="align-self-center font-weight-bold text-secondary me-2">📍 Aller rapidement à :</span>
            <a href="#section-clients" class="btn btn-outline-primary px-4 font-weight-bold shadow-sm">
                👥 Liste des Clients
            </a>
            <a href="#section-terrains" class="btn btn-outline-success px-4 font-weight-bold shadow-sm">
                🌳 Gestion des Terrains
            </a>
            <a href="#section-demandes" class="btn btn-outline-warning text-dark px-4 font-weight-bold shadow-sm">
                📋 Demandes de RDV
            </a>
            <a href="#section-logements" class="btn btn-outline-info text-dark px-4 font-weight-bold shadow-sm">
                🏢 Gestion des Logements
            </a>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-white" style="background-color: #7fa9e3;">
                <div class="card-body py-4 text-center">
                    <h4 class="font-weight-bold">Clients</h4>
                    <h1 class="display-4 font-weight-bold mb-0">{{ $totalClients ?? 0 }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-white" style="background-color: #7fa9e3;">
                <div class="card-body py-4 text-center">
                    <h4 class="font-weight-bold">Terrains</h4>
                    <h1 class="display-4 font-weight-bold mb-0">{{ $totalTerrains ?? 0 }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-white" style="background-color: #7fa9e3;">
                <div class="card-body py-4 text-center">
                    <h4 class="font-weight-bold">Logements</h4>
                    <h1 class="display-4 font-weight-bold mb-0">{{ $totalLogements ?? 0 }}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-4 shadow-sm border-0 bg-white">
        <div class="card-body p-3">
            <div class="input-group">
                <span class="input-group-text bg-transparent border-end-0 text-secondary" style="font-size: 1.2rem;">🔍</span>
                <input type="text" id="globalSearchInput" class="form-control border-start-0 py-2" placeholder="Rechercher instantanément un client, un terrain, un statut, une date, un prix..." style="font-size: 1.05rem; outline: none; box-shadow: none;">
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="section-clients" class="card mb-4 shadow-sm border-0 rounded bg-dark text-white" style="background-color: #111a2e !important; scroll-margin-top: 30px;">
        <div class="card-header bg-primary py-3 font-weight-bold border-0" style="background-color: #0d6efd !important;">
            🌐 Gestion des clients
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped mb-0 align-middle border-0 searchable-table">
                    <thead>
                        <tr class="text-muted small uppercase">
                            <th class="p-3">Noms</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($clients as $client)
                        <tr>
                            <td class="p-3">{{ $client->nom }} {{ $client->prenom }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->telephone ?? 'Non renseigné' }}</td>
                            <td class="text-center">
                                <form action="{{ route('dashboard.clients.destroy', $client->id_utilisateur) }}" method="POST" onsubmit="return confirm('Supprimer ce client ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 fs-5">🗑</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="no-results-row"><td colspan="4" class="text-center py-3 text-muted">Aucun client inscrit.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="section-terrains" class="card mb-4 shadow-sm border-0 rounded bg-dark text-white" style="background-color: #111a2e !important; scroll-margin-top: 30px;">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center border-0" style="background-color: #0d6efd !important;">
            <span class="font-weight-bold">🌳 Gestion des terrains</span>
            <a href="{{ route('terrains.create') }}" class="btn btn-success btn-sm font-weight-bold px-3">+ AJOUTER</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped mb-0 align-middle border-0 searchable-table">
                    <thead>
                        <tr class="text-muted small uppercase">
                            <th class="p-3">Terrains</th>
                            <th>Superficie</th>
                            <th>Prix</th>
                            <th>Statut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($terrains as $terrain)
                        <tr>
                            <td class="p-3">{{ $terrain->nom_terrain }}</td>
                            <td>{{ $terrain->superficie }} m²</td>
                            <td class="text-success font-weight-bold">{{ number_format($terrain->prix_fcfa ?? $terrain->prix, 0, ',', ' ') }} F CFA</td>
                            <td>
                                @if(strtolower($terrain->statut) === 'disponible')
                                    <span class="badge bg-success px-2 py-1 rounded">Disponible</span>
                                @else
                                    <span class="badge bg-secondary px-2 py-1 rounded">{{ $terrain->statut ?? 'Non défini' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('terrains.edit', $terrain->id_terrain) }}" class="text-success me-3 text-decoration-none fs-5">✏</a>
                                <form action="{{ route('terrains.destroy', $terrain->id_terrain) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce terrain ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 fs-5">🗑</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="no-results-row"><td colspan="5" class="text-center py-3 text-muted">Aucun terrain disponible.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="section-demandes" class="card mb-4 shadow-sm border-0 rounded bg-dark text-white" style="background-color: #111a2e !important; scroll-margin-top: 30px;">
        <div class="card-header bg-primary py-3 font-weight-bold border-0" style="background-color: #0d6efd !important;">
            📋 Gestion des demandes de RDV
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped mb-0 align-middle border-0 searchable-table">
                    <thead>
                        <tr class="text-muted small uppercase">
                            <th class="p-3">Client</th>
                            <th>Bien demandé</th>
                            <th>Date & Heure</th>
                            <th>Statut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($demandes as $demande)
                        <tr>
                            <td class="p-3"><strong>{{ $demande->utilisateur->nom ?? 'Inconnu' }} {{ $demande->utilisateur->prenom ?? '' }}</strong></td>
                            <td>
                                @if($demande->id_logement && $demande->logement)
                                    <span class="text-info font-weight-bold">🏢 Logement</span> - {{ $demande->logement->nom_logement }}
                                @elseif($demande->id_terrain && $demande->terrain)
                                    <span class="text-warning font-weight-bold">🌳 Terrain</span> - {{ $demande->terrain->nom_terrain }}
                                @else
                                    <span class="text-muted small">Non spécifié</span>
                                @endif
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse($demande->date_rdv)->format('d/m/Y') }} à {{ \Carbon\Carbon::parse($demande->heure_rdv)->format('H\hi') }}
                            </td>
                            <td>
                                @if(strtolower($demande->statut_rdv) === 'accepte' || strtolower($demande->statut_rdv) === 'accepté')
                                    <span class="badge bg-success px-3 py-1 rounded-pill">Accepté</span>
                                @else
                                    <span class="badge bg-warning text-dark px-3 py-1 rounded-pill">Attente</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(strtolower($demande->statut_rdv) !== 'accepte' && strtolower($demande->statut_rdv) !== 'accepté')
                                    <form action="{{ route('demandes.status', [$demande->id_rendez_vous, 'Refuse']) }}" method="POST" class="d-inline me-2">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-circle shadow-sm" style="width:32px; height:32px;" title="Refuser">✖</button>
                                    </form>
                                    <form action="{{ route('demandes.status', [$demande->id_rendez_vous, 'Accepte']) }}" method="POST" class="d-inline me-2">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm rounded-circle shadow-sm" style="width:32px; height:32px;" title="Accepter">✔</button>
                                    </form>
                                @endif

                                <form action="{{ route('dashboard.demandes.destroy', $demande->id_rendez_vous) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer définitivement cette demande du tableau ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 fs-5" title="Supprimer définitivement">🗑</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="no-results-row"><td colspan="5" class="text-center py-3 text-muted">Aucune demande active en attente ou acceptée.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="section-logements" class="card mb-4 shadow-sm border-0 rounded bg-dark text-white" style="background-color: #111a2e !important; scroll-margin-top: 30px;">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center border-0" style="background-color: #0d6efd !important;">
            <span class="font-weight-bold">🏢 Gestion des logements</span>
            <a href="{{ route('logements.create') }}" class="btn btn-success btn-sm font-weight-bold px-3">+ AJOUTER</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped mb-0 align-middle border-0 searchable-table">
                    <thead>
                        <tr class="text-muted small uppercase">
                            <th class="p-3">Logements</th>
                            <th>Superficie</th>
                            <th>Prix</th>
                            <th>Statut</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logements as $logement)
                        <tr>
                            <td class="p-3">{{ $logement->nom_logement ?? $logement->nom }}</td>
                            <td>{{ $logement->superficie }} m²</td>
                            <td class="text-success font-weight-bold">{{ number_format($logement->prix_fcfa ?? $logement->prix, 0, ',', ' ') }} F CFA</td>
                            <td>
                                @if(strtolower($logement->statut) === 'disponible')
                                    <span class="badge bg-success px-2 py-1 rounded">Disponible</span>
                                @else
                                    <span class="badge bg-secondary px-2 py-1 rounded">{{ $logement->statut ?? 'Non défini' }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('logements.edit', $logement->id_logement) }}" class="text-success me-3 text-decoration-none fs-5">✏</a>
                                <form action="{{ route('logements.destroy', $logement->id_logement) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce logement ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 fs-5">🗑</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr class="no-results-row"><td colspan="5" class="text-center py-3 text-muted">Aucun logement en catalogue.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="text-end mt-4">
        <a href="#top" class="btn btn-secondary btn-sm shadow-sm font-weight-bold">
            ⬆️ Retourner en haut
        </a>
    </div>

</div>

<style>
    html {
        scroll-behavior: smooth;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const searchInput = document.getElementById("globalSearchInput");
    
    searchInput.addEventListener("keyup", function() {
        const filter = searchInput.value.toLowerCase().trim();
        const tables = document.querySelectorAll(".searchable-table");

        tables.forEach(table => {
            const tbody = table.getElementsByTagName("tbody")[0];
            const rows = tbody.getElementsByTagName("tr");
            let hasVisibleRows = false;

            for (let i = 0; i < rows.length; i++) {
                // Ignore la ligne "Aucun résultat" si elle existe déjà
                if (rows[i].classList.contains('no-results-row')) continue;

                const textContent = rows[i].textContent.toLowerCase();
                
                if (textContent.includes(filter)) {
                    rows[i].style.display = "";
                    hasVisibleRows = true;
                } else {
                    rows[i].style.display = "none";
                }
            }

            // Gestion de l'affichage d'un message si aucun élément ne correspond dans la table
            let noResultRow = tbody.querySelector(".dynamic-no-results");
            if (!hasVisibleRows && filter !== "") {
                if (!noResultRow) {
                    const colCount = table.getElementsByTagName("thead")[0].getElementsByTagName("th").length;
                    noResultRow = document.createElement("tr");
                    noResultRow.className = "dynamic-no-results text-center text-muted small";
                    noResultRow.innerHTML = `<td colspan="${colCount}" class="py-3">🔍 Aucun élément ne correspond à votre recherche.</td>`;
                    tbody.appendChild(noResultRow);
                }
            } else if (noResultRow) {
                noResultRow.remove();
            }
        });
    });
});
</script>
@endsection