@extends('layouts.app')

@section('content')

 <div class="container">
        @if($logements->count() === 0)
            <div class="empty">Aucun logement disponible pour le moment.</div>
        @else
            <div class="grid">
                @foreach($logements as $logement)
                    <div class="card">
                        <img src="{{ asset('uploads/logements/' . $logement->image_url) }}" alt="{{ $logement->nom_logement }}">
                        <div class="card-body">
                            <div class="card-title">{{ $logement->nom_logement }}</div>
                            <div class="card-price">
                                {{ number_format($logement->prix_fcfa, 0, ',', ' ') }} FCFA
                                {{ $logement->meuble === 'Oui' ? '/ la nuit' : '/ mois' }}
                            </div>
                            <a href="{{ route('logements.show', $logement->id_logement) }}" class="btn btn-details">Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection