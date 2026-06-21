<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    public $timestamps = false;
    protected $fillable = ['utilisateur_id', 'logement_id', 'terrain_id', 'date_demande', 'statut'];

    // Relation vers ton modèle Utilisateur
    public function utilisateur() {
        return $this->belongsTo(Utilisateur::class, 'utilisateur_id', 'id_utilisateur');
    }

    public function logement() {
        return $this->belongsTo(Logement::class);
    }

    public function terrain() {
        return $this->belongsTo(Terrain::class);
    }
}