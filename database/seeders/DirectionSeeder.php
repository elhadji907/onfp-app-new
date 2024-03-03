<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('directions')->insert([
            'name' => "Direction Général",
            "sigle"=> "DG",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Secrétaire Général",
            "sigle"=> "SG",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction Administrative et Financière ",
            "sigle"=> "DAF",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction de la Construction et de l'Equipement des Centres de Formation",
            "sigle"=> "DCECF",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction des Evaluations et Certifications ",
            "sigle"=> "DEC",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction de l'Ingénierie et des Opérations de Formation",
            "sigle"=> "DIOF",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Cellule Passation des Marchés",
            "sigle"=> "CPM",
            'types_directions_id'=> '3',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Direction de la Planification et des Projets",
            "sigle"=> "DPP",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Cellule Coopération et Partenariat",
            "sigle"=> "CCP",
            'types_directions_id'=> '3',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Conseillers Techniques",
            "sigle"=> "CT",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Agence comptable",
            "sigle"=> "AC",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Cellule Juridique",
            "sigle"=> "CJ",
            'types_directions_id'=> '3',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Centre de Ressources Documentation et Information",
            "sigle"=> "CRDI",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Coordination des Antennes Régionales",
            "sigle"=> "CAR",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Service Accueil, Orientation Sécurité et Suivi des Formés",
            "sigle"=> "SAOS",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Service Informatique",
            "sigle"=> "SI",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Audit Interne",
            "sigle"=> "AI",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('directions')->insert([
            'name' => "Contrôle de Gestion",
            "sigle"=> "CG",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Cellule suivi évaluation",
            "sigle"=> "CSE",
            'types_directions_id'=> '3',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Cellule Marketing et Communication",
            "sigle"=> "COM",
            'types_directions_id'=> '3',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Direction des Ressources Humaines",
            "sigle"=> "DRH",
            'types_directions_id'=> '1',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Bureau du Courrier",
            "sigle"=> "BC",
            'types_directions_id'=> '4',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Service d'Elaboration de Ressources de Formation",
            "sigle"=> "SERF",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('directions')->insert([
            'name' => "Unité de Recherche et Développement ",
            "sigle"=> "URD",
            'types_directions_id'=> '2',
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
