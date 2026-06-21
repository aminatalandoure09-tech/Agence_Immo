@extends('layouts.app')

@section('content')
<style>
    body {
        background: #e5e5e5;
        font-family: Arial, sans-serif;
    }

    .container-terrains {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 50px;
        flex-wrap: wrap;
        padding-bottom: 50px;
    }

    .card-terrain {
        width: 350px;
        background: #081133;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .card-terrain img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 4px;
    }

    .card-content-terrain {
        color: white;
        margin-top: 15px;
    }

    .card-content-terrain h3 {
        margin: 0;
        font-size: 20px;
        font-weight: normal;
        height: 56px; /* Évite les décalages si le titre fait 2 lignes */
        overflow: hidden;
    }

    .card-content-terrain p {
        margin: 5px 0;
        font-size: 18px;
    }

    .btn-terrain {
        display: block;
        width: 80%;
        margin: 25px auto 10px;
        text-align: center;
        background: #2ecc71;
        color: white;
        text-decoration: none;
        padding: 15px;
        border-radius: 5px;
        font-size: 18px;
        font-weight: bold;
        transition: background 0.2s ease;
    }

    .btn-terrain:hover {
        background: #27ae60;
    }
</style>

<div class="container-terrains">

    @forelse($listeTerrains as $terrain)
        <div class="card-terrain">
            @if($terrain->image_url)
                <img src="{{ asset('images/' . $terrain->image_url) }}" alt="{{ $terrain->nom_terrain }}">
            @else
                <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 250px; border-radius: 4px;">
                    📷 Aucune photo disponible
                </div>
            @endif

            <div class="card-content-terrain">
                <h3>{{ $terrain->nom_terrain }}</h3>
                <p>Prix : {{ number_format($terrain->prix_fcfa, 0, ',', ' ') }} FCFA</p>
                <p>Superficie : {{ $terrain->superficie }} m²</p>
            </div>

            <a href="{{ route('rendezvous.create', ['terrain_id' => $terrain->id_terrain ?? $terrain->id]) }}" class="btn-terrain">
                Prendre rendez-vous
            </a>
        </div>
    @empty
        <div class="text-center py-5 w-100">
            <h3 class="text-muted">Aucun terrain n'est disponible pour le moment. 🏢</h3>
            <a href="{{ route('dashboard') }}" class="btn btn-dark mt-3 px-4">Retour au Dashboard</a>
        </div>
    @endforelse

</div>
@endsection