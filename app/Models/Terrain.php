<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Terrain extends Model
{
    // Si votre table ne s'appelle pas "terrains", décommentez la ligne suivante :
    // protected $table = 'terrains';

    // Définition de votre clé primaire personnalisée
    protected $primaryKey = 'id_terrain';

    public $timestamps = false;
    // Autoriser le remplissage de vos colonnes réelles
    protected $fillable = [
        'nom_terrain',
        'superficie',
        'prix_fcfa',
        'image_url',
    ];

    /**
     * Helper Magique : Récupérer la bonne image avec n'importe quelle extension
     * Permet d'appeler $terrain->chemin_image directement dans Blade
     */
    public function getCheminImageAttribute()
    {
        // 1. Si le champ est vide en BDD
        if (!$this->image_url) {
            return null;
        }

        // 2. Si le fichier exact existe déjà sur le disque (Cas normal)
        if (file_exists(public_path('images/' . $this->image_url))) {
            return asset('images/' . $this->image_url);
        }

        // 3. Gestion flexible : On récupère le nom sans l'extension (ex: "terrain1")
        $nomSansExtension = pathinfo($this->image_url, PATHINFO_FILENAME);
        $dossierImages = public_path('images');

        // Extensions courantes à tester si l'extension en BDD ne correspond pas au fichier
        $extensionsPossibles = ['jpg', 'jpeg', 'png', 'JPG', 'JPEG', 'PNG', 'webp'];

        foreach ($extensionsPossibles as $ext) {
            $nomFichierFictif = $nomSansExtension . '.' . $ext;
            if (file_exists($dossierImages . '/' . $nomFichierFictif)) {
                return asset('images/' . $nomFichierFictif);
            }
        }

        // 4. Si vraiment aucun fichier physique n'est trouvé
        return null;
    }
}