<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    // 1. Déclarer le nom exact de la table dans phpMyAdmin
    protected $table = 'rendez_vous';

    // 2. Déclarer la clé primaire personnalisée
    protected $primaryKey = 'id_rendez_vous';

    // 3. Désactiver les timestamps automatiques (created_at/updated_at)
    public $timestamps = false;

    // 4. Liste des champs remplissables en masse
    protected $fillable = [
        'id_utilisateur',
        'id_logement',
        'id_terrain',
        'date_rdv',
        'heure_rdv',
        'message',
        'statut_rdv',
        'date_demande'
    ];

    // 5. Relations avec les clés personnalisées
    public function utilisateur()
    {
        return $this->belongsTo(Utilisateur::class, 'id_utilisateur', 'id_utilisateur');
    }

    public function logement()
    {
        return $this->belongsTo(Logement::class, 'id_logement', 'id_logement'); // Ajustez 'id' si la clé de logement est différente
    }

    public function terrain()
    {
        return $this->belongsTo(Terrain::class, 'id_terrain', 'id_terrain'); // Ajustez 'id' si la clé de terrain est différente
    }
}