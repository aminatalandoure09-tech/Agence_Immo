<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utilisateur extends Authenticatable
{
    use Notifiable;

    // Définir explicitement le nom de la table
    protected $table = 'utilisateurs';

    // Définir la clé primaire personnalisée
    protected $primaryKey = 'id_utilisateur';
    public $timestamps = false;

    // Indiquer les champs remplissables en masse
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'role',
        'telephone',
        'mot_de_passe',
    ];

    // Cacher le mot de passe dans les tableaux/JSON
    protected $hidden = [
        'mot_de_passe',
    ];

    // Indiquer à Laravel quel champ utiliser pour le mot de passe d'authentification
    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }
}