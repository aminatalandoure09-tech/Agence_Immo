<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class LogementController extends Controller
{
    public function index()
    {
        $listeLogements = Logement::where('statut','Disponible')->orderBy('id_logement', 'desc')->get();
        return view('logements.index', ['listeLogements' => $listeLogements]);
    }

    public function create()
    {
        // Sécurité Admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }
        return view('logements.create');
    }

    public function store(Request $request)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        $request->validate([
            'nom_logement'          => 'required|string|max:255',
            'type_logement'         => 'required|string|max:255',
            'description_logement'  => 'nullable|string',
            'nombre_chambres'       => 'required|integer|min:0',
            'nombre_salles_de_bain' => 'required|integer|min:0',
            'garage'                => 'required|string|max:10',
            'meuble'                => 'required|string|max:10',
            'superficie'            => 'required|numeric|min:1',
            'prix_fcfa'             => 'required|numeric|min:0',
            'statut'                => 'required|string|max:50',
            'image_url'             => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $nomFichier = null;
        if ($request->hasFile('image_url')) {
            $fichier = $request->file('image_url');
            $extension = strtolower($fichier->getClientOriginalExtension());
            $nomFichier = time() . '_logement_' . uniqid() . '.' . $extension;
            $fichier->move(public_path('images'), $nomFichier);
        }

        Logement::create([
            'nom_logement'          => $request->nom_logement,
            'type_logement'         => $request->type_logement,
            'description_logement'  => $request->description_logement,
            'nombre_chambres'       => $request->nombre_chambres,
            'nombre_salles_de_bain' => $request->nombre_salles_de_bain,
            'garage'                => $request->garage,
            'meuble'                => $request->meuble,
            'superficie'            => $request->superficie,
            'prix_fcfa'             => $request->prix_fcfa,
            'statut'                => $request->statut, // Ex: Disponible / Masqué
            'image_url'             => $nomFichier,
        ]);

        // Redirection explicite vers le Dashboard Admin
        return redirect('/dashboard')->with('success', 'Le logement a été ajouté avec succès !');
    }

    public function show($id_logement)
    {
        $logement = Logement::where('id_logement', $id_logement)->firstOrFail();
        return view('logements.show', compact('logement'));
    }

    public function edit($id_logement)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }
        $logement = Logement::where('id_logement', $id_logement)->firstOrFail();
        return view('logements.edit', compact('logement'));
    }

    public function update(Request $request, $id_logement)
{
    $request->validate([
        'nom_logement'  => 'required|string|max:255',
        'type_logement' => 'required|string',
        'prix_fcfa'     => 'required|numeric|min:0',
        'statut'        => 'required|string',
        'image_url'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);

    $logement = Logement::where('id_logement', $id_logement)->firstOrFail();

    $logement->nom_logement  = $request->nom_logement;
    $logement->type_logement = $request->type_logement;
    $logement->prix_fcfa     = $request->prix_fcfa;
    $logement->statut        = $request->statut; // Sauvegarde bien le nouveau statut sélectionné

    if ($request->hasFile('image_url')) {
        // Supprime l'ancienne image du disque
        if ($logement->image_url && file_exists(public_path('images/' . $logement->image_url))) {
            @unlink(public_path('images/' . $logement->image_url));
        }

        // Téléversement propre
        $image = $request->file('image_url');
        $imageName = time() . '_logement.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        
        $logement->image_url = $imageName;
    }

    $logement->save();

    return redirect()->route('dashboard')->with('success', 'Le logement a été mis à jour avec succès !');
}

    public function destroy($id_logement)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect('/')->with('error', "Accès non autorisé.");
        }

        $logement = Logement::where('id_logement', $id_logement)->firstOrFail();

        if ($logement->image_url && File::exists(public_path('images/' . $logement->image_url))) {
            File::delete(public_path('images/' . $logement->image_url));
        }

        $logement->delete();
        return redirect('/dashboard')->with('success', 'Le logement a été supprimé avec succès !');
    }
}