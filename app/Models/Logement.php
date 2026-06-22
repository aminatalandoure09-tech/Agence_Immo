<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logement extends Model
{
    protected $table = 'logements';
    protected $primaryKey = 'id_logement';

    protected $fillable = [
        'nom_logement',
        'type_logement',
        'description_logement',
        'nombre_chambres',
        'nombre_salles_de_bain',
        'garage',
        'meuble',
        'superficie',
        'prix_fcfa',
        'statut',
        'image_url',
    ];

    /**
     * Helper Magique pour l'extension flexible des images
     */
    public function getCheminImageAttribute()
    {
        if (!$this->image_url) {
            return null;
        }

        if (file_exists(public_path('images/' . $this->image_url))) {
            return asset('images/' . $this->image_url);
        }

        $nomSansExtension = pathinfo($this->image_url, PATHINFO_FILENAME);
        $dossierImages = public_path('images');
        $extensionsPossibles = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp'];

        foreach ($extensionsPossibles as $ext) {
            $nomFichierFictif = $nomSansExtension . '.' . $ext;
            if (file_exists($dossierImages . '/' . $nomFichierFictif)) {
                return asset('images/' . $nomFichierFictif);
            }
        }

        return null;
    }
}