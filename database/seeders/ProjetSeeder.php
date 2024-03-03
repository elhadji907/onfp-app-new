<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Localite;
use App\Models\Projet;
use App\Models\Zone;
use App\Models\Module;
use App\Models\Ingenieur;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projets')->insert([
             "name"=>"Aucun",
             "sigle"=>"Aucun",
             "description"=> "Aucun",
             "budjet_lettre"=> "Aucun",
             "budjet"=> "0",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);
        DB::table('projets')->insert([
             "name"=>"Projet d'employabilite des jeunes par l'apprentissage",
             "sigle"=>"PEJA",
             "description"=> "description",
             "budjet_lettre"=> "budjet en lettre",
             "budjet"=> "123",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);

        DB::table('projets')->insert([
             "name"=>"Projet d’appui au Développement des Compétences et de l’Entreprenariat des Jeunes dans les secteurs porteurs",
             "sigle"=>"PDCEJ",
             "description"=> "description",
             "budjet_lettre"=> "budjet en lettre",
             "budjet"=> "123",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);

        DB::table('projets')->insert([
             "name"=>"Accès équitable à la formation professionnelle",
             "sigle"=>"ACEFOP",
             "description"=> "description",
             "budjet_lettre"=> "budjet en lettre",
             "budjet"=> "123",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);

        DB::table('projets')->insert([
             "name"=>"PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD",
             "sigle"=>"AGEROUTE-SENOZIG",
             "description"=> "description",
             "budjet_lettre"=> "budjet en lettre",
             "budjet"=> "123",
             'created_at' => now(),
             'updated_at' => now(),
             'uuid' => Str::uuid(),
        ]);

        DB::table('localites')->insert([
            "nom" => "Ziguinchor",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);

        DB::table('localites')->insert([
            "nom" => "Bignona",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);

        DB::table('localites')->insert([
            "nom" => "Bounkiling",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);

        $localites = Localite::all();

        Projet::all()->each(function ($projet) use ($localites) {
            $projet->localites()->attach(
                $localites->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $ingenieurs = Ingenieur::all();

        Projet::all()->each(function ($projet) use ($ingenieurs) {
            $projet->ingenieurs()->attach(
                $ingenieurs->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        DB::table('zones')->insert([
            "nom" => "Ziguinchor",
            "localites_id" =>"1",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Niaguis",
            "localites_id" =>"1",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Boutoupa-Camaracounda",
            "localites_id" =>"1",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
    
        DB::table('zones')->insert([
            "nom" => "Bignona",
            "localites_id" =>"2",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Oulampane",
            "localites_id" =>"2",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Sindian",
            "localites_id" =>"2",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Coubalan",
            "localites_id" =>"2",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Niamone",
            "localites_id" =>"2",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Ouonck",
            "localites_id" =>"2",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Tenghory",
            "localites_id" =>"2",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
    
        DB::table('zones')->insert([
            "nom" => "Bounkiling",
            "localites_id" =>"3",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Madina Wandifa",
            "localites_id" =>"3",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Boghal",
            "localites_id" =>"3",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Bona",
            "localites_id" =>"3",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Diacounda",
            "localites_id" =>"3",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Inor",
            "localites_id" =>"3",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
        DB::table('zones')->insert([
            "nom" => "Faoune",
            "localites_id" =>"3",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);

        $zones = Zone::all();

        Projet::all()->each(function ($projet) use ($zones) {
            $projet->zones()->attach(
                $zones->random(rand(1, 17))->pluck('id')->toArray()
            );
        });


        $modules = Module::all();

        Projet::all()->each(function ($projet) use ($modules) {
            $projet->modules()->attach(
                $modules->random(rand(1, 5))->pluck('id')->toArray()
            );
        });
    }
}
