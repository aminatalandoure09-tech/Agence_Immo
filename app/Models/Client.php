<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    protected $primaryKey = 'idClient';
    
    protected $fillable = [
        'nom', 'prenom', 'tel', 'email', 
        'idCompte', 'idAgence', 'type_client'
    ];

    // Relation : Un client appartient à un compte
    public function compte(): BelongsTo
    {
        return $this->belongsTo(Compte::class, 'idCompte');
    }

    // Relation : Un client appartient à une agence
    public function agence(): BelongsTo
    {
        return $this->belongsTo(Agence::class, 'idAgence');
    }

    // Relation : Un client peut posséder plusieurs biens
    public function biensPossedes(): HasMany
    {
        return $this->hasMany(BienImmobilier::class, 'idProprietaire');
    }

    // Relation : Un client peut louer plusieurs biens
    public function biensLoues(): HasMany
    {
        return $this->hasMany(BienImmobilier::class, 'idLocataire');
    }

    // Accesseur pour le nom complet
    public function getNomCompletAttribute(): string
    {
        return $this->prenom . ' ' . $this->nom;
    }
}