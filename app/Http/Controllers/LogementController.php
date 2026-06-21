<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use Illuminate\Http\Request;

class LogementController extends Controller
{
    /**
     * Afficher le formulaire d'ajout de logement
     */
    public function create()
    {
        return view('logements.create'); // Adapte le nom selon ton fichier Blade
    }

    /**
     * Enregistrer un nouveau logement dans la base de données
     */
    public function store(Request $request)
    {
        // 1. Validation stricte des données du formulaire
        $request->validate([
            'nom_logement'          => 'required|string|max:255',
            'description_logement'  => 'nullable|string',
            'superficie'            => 'required|integer|min:1',
            'prix_fcfa'             => 'required|numeric|min:0',
            'nombre_pieces'         => 'required|integer|min:1',
            'nombre_chambres'       => 'required|integer|min:0',
            'nombre_salles_de_bain' => 'required|integer|min:0',
            'type_logement'         => 'required|string|max:100',
            'meuble'                => 'required|in:Oui,Non',
            'image'                 => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Optionnel : pour l'upload d'image
        ]);

        // 2. Gestion du fichier image (si envoyé)
        $imagePath = null;
        if ($request->hasFile('image')) {
            // Stocke l'image dans le dossier storage/app/public/logements
            $imagePath = $request->file('image')->store('logements', 'public');
        }

        // 3. Insertion dans la base de données via le modèle
        Logement::create([
            'nom_logement'          => $request->input('nom_logement'),
            'description_logement'  => $request->input('description_logement'),
            'superficie'            => $request->input('superficie'),
            'prix_fcfa'             => $request->input('prix_fcfa'),
            'nombre_pieces'         => $request->input('nombre_pieces'),
            'nombre_chambres'       => $request->input('nombre_chambres'),
            'nombre_salles_de_bain' => $request->input('nombre_salles_de_bain'),
            'type_logement'         => $request->input('type_logement'),
            'meuble'                => $request->input('meuble'),
            'image_url'             => $imagePath,
            'statut'                => 'disponible', // Par défaut à la création
        ]);

        // 4. Retour sur la page du formulaire avec le message de succès
        return redirect()->back()->with('success', 'Logement ajouté avec succès.');
    }
}