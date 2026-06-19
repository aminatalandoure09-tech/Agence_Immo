<?php

namespace App\Http\Controllers;

use App\Models\Logement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LogementController extends Controller
{
    public function index()
    {
        $logements = Logement::all();
        return view('logements.index', compact('logements'));
    }

    public function create()
    {
        return view('logements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'superficie' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prix' => 'required|numeric',
            'nb_pieces' => 'required|integer',
            'nb_chambres' => 'required|integer',
            'nb_salles_bain' => 'required|integer',
            'type_logement' => 'required|string',
            'meuble' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('logements', 'public');
        }

        Logement::create($data);

        return redirect()->route('dashboard')->with('success', 'Logement ajouté avec succès.');
    }

    public function edit(Logement $logement)
    {
        return view('logements.edit', compact('logement'));
    }

    public function update(Request $request, Logement $logement)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
            'superficie' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prix' => 'required|numeric',
            'nb_pieces' => 'required|integer',
            'nb_chambres' => 'required|integer',
            'nb_salles_bain' => 'required|integer',
            'type_logement' => 'required|string',
            'meuble' => 'required|string',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($logement->image) {
                Storage::disk('public')->delete($logement->image);
            }
            $data['image'] = $request->file('image')->store('logements', 'public');
        }

        $logement->update($data);

        return redirect()->route('dashboard')->with('success', 'Logement modifié avec succès.');
    }

    public function destroy(Logement $logement)
    {
        if ($logement->image) {
            Storage::disk('public')->delete($logement->image);
        }
        $logement->delete();

        return redirect()->route('dashboard')->with('success', 'Logement supprimé avec succès.');
    }
}