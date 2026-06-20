<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compte extends Model
{
    protected $primaryKey = 'idCompte';
    
    protected $fillable = [
        'login', 'motDePasse'
    ];
}