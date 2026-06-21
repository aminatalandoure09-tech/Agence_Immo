<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TerrainController extends Controller
{
    /**
     * 1. AFFICHER LA LISTE DES TERRAINS
     */
    public function index()
{
    // On change le nom de la variable pour éviter le conflit
    $listeTerrains = Terrain::orderBy('id_terrain', 'desc')->get();
    
    
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
     * 3. ENREGISTRER UN NOUVEAU TERRAIN (Adapté à vos colonnes)
     */
    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        // Validation calquée sur vos colonnes réelles
        $request->validate([
            'nom_terrain' => 'required|string|max:255',
            'superficie'  => 'required|numeric|min:1',
            'prix_fcfa'   => 'required|numeric|min:0',
            'image_url'   => 'nullable|string|max:255',
        ]);

        // Création avec les bons attributs fillable
        Terrain::create([
            'nom_terrain' => $request->nom_terrain,
            'superficie'  => $request->superficie,
            'prix_fcfa'   => $request->prix_fcfa,
            'image_url'   => $request->image_url,
        ]);

        return redirect()->route('dashboard')->with('success', 'Le terrain a été ajouté avec succès !');
    }

    /**
     * 4. AFFICHER LES DÉTAILS D'UN TERRAIN
     */
    public function show($id_terrain)
    {
        $terrain = Terrain::where('id_terrain', $id_terrain)->firstOrFail();
        return view('terrains.show', compact('terrain'));
    }

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
     * 6. ENREGISTRER LES MODIFICATIONS (Adapté à vos colonnes)
     */
    public function update(Request $request, $id_terrain)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        $request->validate([
            'nom_terrain' => 'required|string|max:255',
            'superficie'  => 'required|numeric|min:1',
            'prix_fcfa'   => 'required|numeric|min:0',
            'image_url'   => 'nullable|string|max:255',
        ]);

        $terrain = Terrain::where('id_terrain', $id_terrain)->firstOrFail();
        
        $terrain->update([
            'nom_terrain' => $request->nom_terrain,
            'superficie'  => $request->superficie,
            'prix_fcfa'   => $request->prix_fcfa,
            'image_url'   => $request->image_url,
        ]);

        return redirect()->route('dashboard')->with('success', 'Le terrain a été modifié avec succès !');
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
        $terrain->delete();

        return redirect()->route('dashboard')->with('success', 'Le terrain a été supprimé avec succès !');
    }
}