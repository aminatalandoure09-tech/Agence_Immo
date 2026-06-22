@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4 px-4" style="max-width: 900px; padding-bottom: 50px;">
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <h2 class="text-dark mb-4 fw-bold">Mes Demandes de Rendez-vous</h2>

    <div class="d-flex flex-column gap-3">
        @forelse($demandes as $demande)
            <!-- Fixation de la hauteur ici avec height: 140px -->
            <div class="d-flex align-items-stretch shadow-sm" style="background-color: #2172cd; color: white; border-radius: 4px; overflow: hidden; height: 140px;">
                
                <!-- Zone Image bloquée à 100% de la hauteur du parent -->
                <div class="position-relative text-center d-flex align-items-center justify-content-center bg-dark text-wrap" style="width: 200px; min-width: 200px; height: 100%;">
                    @if($demande->logement && $demande->logement->image_url)
                        <img src="{{ asset('images/' . $demande->logement->image_url) }}" alt="Logement" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 w-100 py-1 bg-black bg-opacity-50 text-center fw-bold small">Appartement</div>
                    @elseif($demande->terrain && $demande->terrain->image_url)
                        <img src="{{ asset('images/' . $demande->terrain->image_url) }}" alt="Terrain" style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 w-100 py-1 bg-black bg-opacity-50 text-center fw-bold small">Terrain</div>
                    @else
                        <div class="p-2 small">📷 Pas de photo</div>
                    @endif
                </div>

                <!-- Contenu Central (Date et Heure) -->
                <div class="p-3 d-flex flex-column justify-content-center flex-grow-1" style="font-size: 1.1rem; height: 100%;">
                    <div class="mb-2">
                        <span class="text-white-50 fw-bold small d-block text-uppercase" style="font-size: 0.8rem;">Date</span>
                        <strong>{{ \Carbon\Carbon::parse($demande->date_rdv)->format('d/m/Y') }}</strong>
                    </div>
                    <div>
                        <span class="text-white-50 fw-bold small d-block text-uppercase" style="font-size: 0.8rem;">Heure</span>
                        <strong>{{ \Carbon\Carbon::parse($demande->heure_rdv)->format('H\hi') }}</strong>
                    </div>
                </div>

                <!-- Zone Droite (Statut et Bouton Supprimer) bloquée à 100% -->
                <div class="p-3 d-flex flex-column justify-content-between align-items-center" style="width: 220px; background-color: rgba(0,0,0,0.05); height: 100%;">
                    <div class="text-center w-100">
                        <span class="text-white-50 fw-bold small mb-1 d-block text-uppercase" style="font-size: 0.8rem;">Statut</span>
                        
                        @if($demande->statut_rdv == 'confirme' || $demande->statut_rdv == 'accepte')
                            <div class="text-center fw-bold py-1.5 rounded mx-auto" style="background-color: #2ecc71; color: white; width: 140px; font-size: 0.9rem; line-height: 1.5;">
                                Accepté
                            </div>
                        @elseif($demande->statut_rdv == 'en_attente')
                            <div class="text-center fw-bold py-1.5 rounded mx-auto" style="background-color: #111b30; color: white; width: 140px; font-size: 0.9rem; line-height: 1.5;">
                                Attente...
                            </div>
                        @elseif($demande->statut_rdv == 'annule' || $demande->statut_rdv == 'refuse')
                            <div class="text-center fw-bold py-1.5 rounded mx-auto" style="background-color: #c0392b; color: white; width: 140px; font-size: 0.9rem; line-height: 1.5;">
                                Refusé
                            </div>
                        @else
                            <div class="text-center fw-bold py-1.5 rounded mx-auto bg-secondary text-white" style="width: 140px; font-size: 0.9rem; line-height: 1.5;">
                                {{ ucfirst($demande->statut_rdv) }}
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('rendezvous.destroy', $demande->id_rendez_vous) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette demande ?');" class="w-100 text-center m-0">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-link btn-sm text-white text-decoration-none opacity-75 hover-opacity-100 p-0" style="font-size: 0.8rem;">
                            ❌ Supprimer la demande
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="text-center py-5 bg-light rounded border">
                <i class="bi bi-calendar-x fs-1 text-muted d-block mb-2"></i>
                <h5 class="text-muted mb-0">Vous n'avez pas encore effectué de demande de rendez-vous.</h5>
            </div>
        @endforelse
    </div>

</div>
@endsection