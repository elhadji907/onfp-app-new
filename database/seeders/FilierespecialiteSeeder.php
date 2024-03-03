<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FilierespecialiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('filierespecialites')->insert([
            "name"=>"Froid, Climatisation et Plomberie (APC)",
            "filieres_id" => "1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Technicien en Froid et Climatisation (APC)",
            "filieres_id" => "1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Monteur Dépanneur en Froid et Climatisation (APC)",
            "filieres_id" => "1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Monteur Frigoriste",
            "filieres_id" => "1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Technique de Froid",
            "filieres_id" => "1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Froid Climatisation",
            "filieres_id" => "1",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        
        DB::table('filierespecialites')->insert([
            "name"=>"Génie civil bâtiment (APC)",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Bâtiment",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Ferraillage",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Dessin bâtiment",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Plomberie/Canalisations/Sanitaire",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Architechture et design intérieur",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Génie civil ",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Maintenance des installations du bâtiment (APC)",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Technicien Génie civil Bâtiment (APC)",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Electricité d'installation du Bâtiment",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Carrelage/Revêtement",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Géomatique (APC)",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Automatique",
            "filieres_id" => "2",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        
        DB::table('filierespecialites')->insert([
            "name"=>"Electricien (APC)",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Electricité",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Domotique",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Electricité d'installation industrielle (APC)",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Electrotechnique ",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Maintenance industrielle Option électromécanique ",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Maintenance industrielle (APC)",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Electromécanique",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Electronique industrielle",
            "filieres_id" => "3",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Boulangerie/Pâtisserie",
            "filieres_id" => "4",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Cuisinier (APC)",
            "filieres_id" => "4",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Serveur (APC)",
            "filieres_id" => "4",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Gestion hôtélièere et touristique",
            "filieres_id" => "4",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Hôtellerie et Restauration",
            "filieres_id" => "4",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
            
        DB::table('filierespecialites')->insert([
            "name"=>"Restauration",
            "filieres_id" => "4",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

            
        DB::table('filierespecialites')->insert([
            "name"=>"Informatique industrielle et réseaux",
            "filieres_id" => "4",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
            
        DB::table('filierespecialites')->insert([
            "name"=>"Maintenance en électricité, électronique et informatique",
            "filieres_id" => "5",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
            
        DB::table('filierespecialites')->insert([
            "name"=>"Informatique industrielle et automatique (APC)",
            "filieres_id" => "5",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
            
        DB::table('filierespecialites')->insert([
            "name"=>"Informatique de gestion",
            "filieres_id" => "5",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        
        DB::table('filierespecialites')->insert([
            "name"=>"Comptabilité - Gestion",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Comptabilité",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Aide comptable",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Commerce, Administration, Secrétariat ",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Informatique (CASI)",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Dactylographie",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Commerce International",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Secrétariat Bureautique",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Bureautique",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Employé de Banque",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Assistant comptable (APC)",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Assistant de direction",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Gestion de la chaine d'approvisionement et logistique (APC)",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Assistance de Gestion des PME/PMI",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Marketing",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Banque",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Transit",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Transport Logistique",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Transit (APC)",
            "filieres_id" => "6",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        
        DB::table('filierespecialites')->insert([
            "name"=>"Mécanique moteur",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Mécanique automobile",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Technicien de Maintenance Véhicule Moteur (APC)",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Mécanicien automobile (APC)",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Electricité automobile (APC)",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Carrosserie Peinture (APC)",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Maintenance des engins lours (APC)",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Maintenance Machine Agricole (APC)",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Maintenance Mécanique ",
            "filieres_id" => "7",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Mécanique Générale",
            "filieres_id" => "8",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Production (APC)",
            "filieres_id" => "8",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Fabricant mécanicien (APC)",
            "filieres_id" => "8",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        
        DB::table('filierespecialites')->insert([
            "name"=>"Structures Métalliques (APC)",
            "filieres_id" => "9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Chaudronnerie Tuyauterie Industrielle",
            "filieres_id" => "9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Ouvrage métallique",
            "filieres_id" => "9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Tôlerie Serrurerie",
            "filieres_id" => "9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Structure métallique",
            "filieres_id" => "9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Structure métallique (APC)",
            "filieres_id" => "9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Menuserie métallique (APC)",
            "filieres_id" => "9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Construction métallique",
            "filieres_id" => "9",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filierespecialites')->insert([
            "name"=>"Menuiserie bois",
            "filieres_id" => "10",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Menuiserie bois (APC)",
            "filieres_id" => "10",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
            "name"=>"Angent de Santé communautaire (APC)",
            "filieres_id" => "11",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filierespecialites')->insert([
                "name"=>"Santé communautaire",
                "filieres_id" => "11",
                'created_at' => now(),
                'updated_at' => now(),
                "uuid"=>Str::uuid(),
            ]);

        DB::table('filierespecialites')->insert([
                    "name"=>"Santé Hygiéne",
                    "filieres_id" => "11",
                    'created_at' => now(),
                    'updated_at' => now(),
                    "uuid"=>Str::uuid(),
        ]);
    }
}
