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
                    <h1 class="display-4 font-weight-bold mb-0">{{ $totalClients ?? 23 }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-white" style="background-color: #7fa9e3;">
                <div class="card-body py-4 text-center">
                    <h4 class="font-weight-bold">Terrains</h4>
                    <h1 class="display-4 font-weight-bold mb-0">{{ $totalTerrains ?? 10 }}</h1>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm text-white" style="background-color: #7fa9e3;">
                <div class="card-body py-4 text-center">
                    <h4 class="font-weight-bold">Logements</h4>
                    <h1 class="display-4 font-weight-bold mb-0">{{ $totalLogements ?? 9 }}</h1>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div id="section-clients" class="card mb-4 shadow-sm border-0 rounded bg-dark text-white" style="background-color: #111a2e !important; scroll-margin-top: 30px;">
        <div class="card-header bg-primary py-3 font-weight-bold border-0" style="background-color: #0d6efd !important;">
            🌐 Gestion des clients
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped mb-0 align-middle border-0">
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
                                <form action="{{ route('clients.destroy', $client->id_utilisateur) }}" method="POST" onsubmit="return confirm('Supprimer ce client ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 fs-5">🗑</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-3 text-muted">Aucun client inscrit.</td></tr>
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
                <table class="table table-dark table-striped mb-0 align-middle border-0">
                    <thead>
                        <tr class="text-muted small uppercase">
                            <th class="p-3">Terrains</th>
                            <th>Superficie</th>
                            <th>Prix</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($terrains as $terrain)
                        <tr>
                            <td class="p-3">{{ $terrain->nom_terrain }}</td>
                            <td>{{ $terrain->superficie }} m²</td>
                            <td class="text-success font-weight-bold">{{ number_format($terrain->prix_fcfa, 0, ',', ' ') }} F CFA</td>
                            <td class="text-center">
                                <a href="{{ route('terrains.edit', $terrain->id_terrain) }}" class="text-success me-3 text-decoration-none fs-5">✏</a>
                                <form action="{{ route('terrains.destroy', $terrain->id_terrain) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce terrain ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 fs-5">🗑</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-3 text-muted">Aucun terrain disponible.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="section-demandes" class="card mb-4 shadow-sm border-0 rounded bg-dark text-white" style="background-color: #111a2e !important; scroll-margin-top: 30px;">
        <div class="card-header bg-primary py-3 font-weight-bold border-0" style="background-color: #0d6efd !important;">
            📋 Gestion des demandes
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped mb-0 align-middle border-0">
                    <thead>
                        <tr class="text-muted small uppercase">
                            <th class="p-3">Client</th>
                            <th>Bien</th>
                            <th>Date de rendez-vous</th>
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
                                    <span class="text-info font-weight-bold">Appartement</span> - {{ $demande->logement->nom_logement ?? $demande->logement->nom }}
                                @elseif($demande->id_terrain && $demande->terrain)
                                    <span class="text-warning font-weight-bold">Terrain</span> - {{ $demande->terrain->nom_terrain }}
                                @else
                                    <span class="text-muted small">Non renseigné</span>
                                @endif
                            </td>
                            <td>{{ $demande->date_demande ? \Carbon\Carbon::parse($demande->date_demande)->format('d/m/Y à H\hi') : 'Non planifié' }}</td>
                            <td>
                                @if($demande->statut_rdv === 'En attente' || !$demande->statut_rdv)
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">Attente</span>
                                @elseif($demande->statut_rdv === 'Accepte')
                                    <span class="badge bg-success px-3 py-2 rounded-pill">Confirmé</span>
                                @else
                                    <span class="badge bg-danger px-3 py-2 rounded-pill">Refusé</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @if($demande->statut_rdv === 'En attente' || !$demande->statut_rdv)
                                    <form action="{{ route('demandes.status', [$demande->id_rendez_vous, 'Refuse']) }}" method="POST" class="d-inline me-2">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-danger btn-sm rounded-circle shadow-sm" style="width:32px; height:32px;">✖</button>
                                    </form>
                                    <form action="{{ route('demandes.status', [$demande->id_rendez_vous, 'Accepte']) }}" method="POST" class="d-inline">
                                        @csrf @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm rounded-circle shadow-sm" style="width:32px; height:32px;">✔</button>
                                    </form>
                                @else
                                    <span class="text-muted small">Traité</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-3 text-muted">Aucun rendez-vous reçu.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="section-logements" class="card shadow-sm border-0 rounded bg-dark text-white" style="background-color: #111a2e !important; scroll-margin-top: 30px;">
        <div class="card-header bg-primary py-3 d-flex justify-content-between align-items-center border-0" style="background-color: #0d6efd !important;">
            <span class="font-weight-bold">🏢 Gestion des logements</span>
            <a href="{{ route('logements.create') }}" class="btn btn-success btn-sm font-weight-bold px-3">+ AJOUTER</a>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-dark table-striped mb-0 align-middle border-0">
                    <thead>
                        <tr class="text-muted small uppercase">
                            <th class="p-3">Logements</th>
                            <th>Superficie</th>
                            <th>Prix (Mensuel)</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logements as $logement)
                        <tr>
                            <td class="p-3">{{ $logement->nom_logement ?? $logement->nom }}</td>
                            <td>{{ $logement->superficie }} m²</td>
                            <td class="text-success font-weight-bold">{{ number_format($logement->prix_fcfa ?? $logement->prix, 0, ',', ' ') }} F CFA</td>
                            <td class="text-center">
                                <a href="{{ route('logements.edit', $logement->id_logement) }}" class="text-success me-3 text-decoration-none fs-5">✏</a>
                                <form action="{{ route('logements.destroy', $logement->id_logement) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer ce logement ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0 m-0 border-0 fs-5">🗑</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-3 text-muted">Aucun logement en catalogue.</td></tr>
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
@endsection