<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Session;

class ClientDashboardController extends Controller
{
    public function index()
    {
        // Récupérer l'ID du client depuis la session
        $clientId = Session::get('client_id');

        if (!$clientId) {
            return redirect()->route('client.login');
        }

        // Charger le client avec ses biens
        $client = Client::with(['biensPossedes', 'biensLoues', 'agence'])
                        ->findOrFail($clientId);

        return view('client.dashboard', compact('client'));
    }
}