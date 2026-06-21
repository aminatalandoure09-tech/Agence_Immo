<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    protected $table = 'logements';

    // Désactive la gestion automatique de created_at et updated_at
    public $timestamps = false;
    protected $primaryKey = 'id_logement';

    protected $fillable = [
        'nom_logement',
        'description_logement',
        'superficie',
        'image_url',
        'prix_fcfa',
        'nombre_pieces',
        'nombre_chambres',
        'nombre_salles_de_bain',
        'type_logement',
        'meuble',
        'statut'
    ];
}