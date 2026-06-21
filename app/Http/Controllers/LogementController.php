<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use Illuminate\Http\Request;

class LogementController extends Controller
{
    /**
     * Afficher le catalogue de tous les logements (Vue Client)
     */
    public function index()
    {
        // On récupère uniquement les logements dont le statut est 'disponible'
        $logements = Logement::where('statut', 'disponible')->get();

        // On renvoie vers une vue publique (resources/views/logements/index.blade.php)
        return view('logements.index', compact('logements'));
    }

    /**
     * Afficher le formulaire d'ajout de logement
     */
    public function create()
    {
        return view('logements.create'); 
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
            'image_url'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'prix_fcfa'             => 'required|numeric|min:0',
            'nombre_pieces'         => 'required|integer|min:1',
            'nombre_chambres'       => 'required|integer|min:0',
            'nombre_salles_de_bain' => 'required|integer|min:0',
            'type_logement'         => 'required|string|max:100',
            'meuble'                => 'required|in:Oui,Non',
        ]);

        // 2. Gestion du fichier image -> déplacement direct vers public/images
        $filename = null;
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            // Génération d'un nom unique basé sur le timestamp
            $filename = time() . '_' . $file->getClientOriginalName();
            // Déplacement physique vers le dossier public/images/
            $file->move(public_path('images'), $filename);
        }

        // 3. Insertion dans la base de données via le modèle
        Logement::create([
            'nom_logement'          => $request->input('nom_logement'),
            'description_logement'  => $request->input('description_logement'),
            'superficie'            => $request->input('superficie'),
            'image_url'             => $filename,
            'prix_fcfa'             => $request->input('prix_fcfa'),
            'nombre_pieces'         => $request->input('nombre_pieces'),
            'nombre_chambres'       => $request->input('nombre_chambres'),
            'nombre_salles_de_bain' => $request->input('nombre_salles_de_bain'),
            'type_logement'         => $request->input('type_logement'),
            'meuble'                => $request->input('meuble'),
             // On stocke uniquement le nom du fichier
            'statut'                => 'disponible', // Par défaut à la création
        ]);

        // 4. Retour sur le dashboard avec le message de succès
        return redirect()->route('dashboard')->with('success', 'Logement ajouté avec succès.');
    }

    /**
     * Afficher le formulaire de modification d'un logement
     */
    public function edit($id)
    {
        // Recherche le logement par sa clé primaire exacte
        $logement = Logement::findOrFail($id);

        // Renvoie vers votre vue d'édition (resources/views/logements/edit.blade.php)
        return view('logements.edit', compact('logement'));
    }

    /**
     * Mettre à jour un logement existant
     */
    public function update(Request $request, $id)
    {
        $logement = Logement::findOrFail($id);

        // 1. Validation des champs modifiés
        $request->validate([
            'nom_logement'          => 'required|string|max:255',
            'description_logement'  => 'nullable|string',
            'superficie'            => 'required|integer|min:1',
            'image_url'             => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'prix_fcfa'             => 'required|numeric|min:0',
            'nombre_pieces'         => 'required|integer|min:1',
            'nombre_chambres'       => 'required|integer|min:0',
            'nombre_salles_de_bain' => 'required|integer|min:0',
            'type_logement'         => 'required|string|max:100',
            'meuble'                => 'required|in:Oui,Non',
            
        ]);

        // 2. Gestion de l'image si une nouvelle image est soumise
        $filename = $logement->image_url; // On garde l'ancienne par défaut
        
        if ($request->hasFile('image_url')) {
            $file = $request->file('image_url');
            
            // Optionnel : On supprime l'ancienne image physique dans public/images si elle existe
            if ($logement->image_url && file_exists(public_path('images/' . $logement->image_url))) {
                @unlink(public_path('images/' . $logement->image_url));
            }
            
            // Stockage de la nouvelle image
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        }

        // 3. Sauvegarde des données mises à jour
        $logement->update([
            'nom_logement'          => $request->input('nom_logement'),
            'description_logement'  => $request->input('description_logement'),
            'superficie'            => $request->input('superficie'),
            'image_url'             => $filename,
            'prix_fcfa'             => $request->input('prix_fcfa'),
            'nombre_pieces'         => $request->input('nombre_pieces'),
            'nombre_chambres'       => $request->input('nombre_chambres'),
            'nombre_salles_de_bain' => $request->input('nombre_salles_de_bain'),
            'type_logement'         => $request->input('type_logement'),
            'meuble'                => $request->input('meuble'),
            
        ]);

        return redirect()->route('dashboard')->with('success', 'Logement mis à jour avec succès.');
    }

    /**
     * Afficher les détails d'un logement spécifique (Vue Client)
     */
    public function show($id)
    {
        // Récupère le logement ou génère une erreur 404 s'il n'existe pas
        $logement = Logement::findOrFail($id);

        // Renvoie vers le fichier resources/views/logements/show.blade.php
        return view('logements.show', compact('logement'));
    }

    /**
     * Supprimer un logement de la base de données
     */
    public function destroy($id)
    {
        $logement = Logement::findOrFail($id);

        // Suppression de l'image physique dans public/images avant de supprimer la ligne en BDD
        if ($logement->image_url && file_exists(public_path('images/' . $logement->image_url))) {
            @unlink(public_path('images/' . $logement->image_url));
        }

        // Suppression de l'enregistrement
        $logement->delete();

        return redirect()->route('dashboard')->with('success', 'Logement supprimé définitivement.');
    }
}