<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Utilisateur; // Votre modèle personnalisé
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sécurité : On vérifie si l'admin n'existe pas déjà pour éviter les doublons
        if (!Utilisateur::where('email', 'admin@gmail.com')->exists()) {
            Utilisateur::create([
                'nom'          => 'ADMIN',
                'prenom'       => 'Asano',
                'email'        => 'Asano@gmail.com',
                'telephone'    => '90346604',
                'role'         => 'admin', // C'est ce champ qui donne l'accès au dashboard
                'mot_de_passe' => Hash::make('password123'), // Le mot de passe sera haché proprement
            ]);
        }
    }
}