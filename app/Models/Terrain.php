<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
    protected $table = 'terrains';
    public $timestamps = false;
    protected $primaryKey = 'id_terrain';
    protected $fillable = [
        'nom_terrain',
        'superficie',
        'image_url',
        'prix_fcfa'
    ];
}