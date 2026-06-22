<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class TerrainController extends Controller
{
    /**
     * 1. AFFICHER LA LISTE DES TERRAINS
     */
    public function index()
    {
        $listeTerrains = Terrain::where('statut', 'Disponible')->orderBy('id_terrain', 'desc')->get();
        return view('terrains.index', ['listeTerrains' => $listeTerrains]);
    }

    /**
     * 2. FORMULAIRE D'AJOUT D'UN TERRAIN
     */
    public function create()
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        return view('terrains.create');
    }

    /**
     * 3. ENREGISTRER UN NOUVEAU TERRAIN (Avec Upload d'image)
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        $request->validate([
            'nom_terrain' => 'required|string|max:255',
            'superficie'  => 'required|numeric|min:1',
            'prix_fcfa'   => 'required|numeric|min:0',
            'image_url'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2Mo max
        ]);

        $nomFichier = null;

        if ($request->hasFile('image_url')) {
            $fichier = $request->file('image_url');
            $extension = strtolower($fichier->getClientOriginalExtension());
            $nomFichier = time() . '_' . uniqid() . '.' . $extension;
            $fichier->move(public_path('images'), $nomFichier);
        }

        Terrain::create([
            'nom_terrain' => $request->nom_terrain,
            'superficie'  => $request->superficie,
            'prix_fcfa'   => $request->prix_fcfa,
            'image_url'   => $nomFichier,
        ]);

        return redirect()->route('dashboard')->with('success', 'Le terrain a été ajouté avec succès !');
    }

    /**
     * 4. AFFICHER LES DÉTAILS D'UN TERRAIN (Désactivé)
     */
   /* public function show($id_terrain)
    {
        $terrain = Terrain::where('id_terrain', $id_terrain)->firstOrFail();
        return view('terrains.show', compact('terrain'));
    }*/

    /**
     * 5. FORMULAIRE DE MODIFICATION
     */
    public function edit($id_terrain)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        $terrain = Terrain::where('id_terrain', $id_terrain)->firstOrFail();
        return view('terrains.edit', compact('terrain'));
    }

    /**
     * 6. ENREGISTRER LES MODIFICATIONS (Gestion du remplacement d'image)
     */
    public function update(Request $request, $id_terrain)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        // 1. Validation des données reçues
        $request->validate([
            'nom_terrain' => 'required|string|max:255',
            'superficie'  => 'required|numeric|min:1',
            'prix_fcfa'   => 'required|numeric|min:0',
            'statut'      => 'required|string',
            'image_url'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // 2. Correction ici : Utilisation de ta clé personnalisée id_terrain au lieu de findOrFail
        $terrain = Terrain::where('id_terrain', $id_terrain)->firstOrFail();

        // 3. Assigner les champs classiques
        $terrain->nom_terrain = $request->nom_terrain;
        $terrain->superficie  = $request->superficie;
        $terrain->prix_fcfa   = $request->prix_fcfa;
        $terrain->statut      = $request->statut;

        // 4. Gérer l'image uniquement si un nouveau fichier a été téléchargé
        if ($request->hasFile('image_url')) {
            
            // Supprimer l'ancienne image du dossier public/images si elle existe
            if ($terrain->image_url && file_exists(public_path('images/' . $terrain->image_url))) {
                @unlink(public_path('images/' . $terrain->image_url));
            }

            // Téléverser le nouveau fichier
            $image = $request->file('image_url');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            
            $terrain->image_url = $imageName;
        }

        // 5. Sauvegarder les modifications en BDD
        $terrain->save();

        return redirect()->route('dashboard')->with('success', 'Le terrain a été mis à jour avec succès !');
    }

    /**
     * 7. SUPPRIMER UN TERRAIN
     */
    public function destroy($id_terrain)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        $terrain = Terrain::where('id_terrain', $id_terrain)->firstOrFail();
        
        if ($terrain->image_url && File::exists(public_path('images/' . $terrain->image_url))) {
            File::delete(public_path('images/' . $terrain->image_url));
        }

        $terrain->delete();

        return redirect()->route('dashboard')->with('success', 'Le terrain a été supprimé avec succès !');
    }
}