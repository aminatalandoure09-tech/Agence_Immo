<?php

namespace App\Http\Controllers;

use App\Models\Terrain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TerrainController extends Controller
{
    public function index()
    {
        $terrains = Terrain::all();
        return view('terrains.index', compact('terrains'));
    }

    public function create()
    {
        return view('terrains.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom_terrain' => 'required|string|max:255',
            'superficie' => 'required|numeric',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prix_fcfa' => 'required|numeric',
        ]);

        $data = $request->all();

        if ($request->hasFile('image_url')) {
            $data['image_url'] = $request->file('image_url')->store('terrains', 'public');
        }

        Terrain::create($data);
        return redirect()->back();

    }

    public function edit(Terrain $terrain)
    {
        return view('terrains.edit', compact('terrain'));
    }

    public function update(Request $request, Terrain $terrain)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'superficie' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'prix' => 'required|numeric',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($terrain->image) {
                Storage::disk('public')->delete($terrain->image);
            }
            $data['image'] = $request->file('image')->store('terrains', 'public');
        }

        $terrain->update($data);

        return redirect()->route('dashboard')->with('success', 'Terrain modifié avec succès.');
    }

    public function destroy(Terrain $terrain)
    {
        if ($terrain->image) {
            Storage::disk('public')->delete($terrain->image);
        }
        $terrain->delete();

        return redirect()->route('dashboard')->with('success', 'Terrain supprimé avec succès.');
    }
}