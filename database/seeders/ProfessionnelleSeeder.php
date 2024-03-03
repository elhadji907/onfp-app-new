<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfessionnelleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        DB::table('professionnelles')->insert([
            'name' => "Agriculteur exploitant",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Salarié de l’agriculture",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Industriel, artisan ou commerçant",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Profession libérale",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Cadre moyen ou supérieur",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Employé",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Ouvrier",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Personnel de services",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Retraité(e)",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Sans activité professionnelle",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "En recherche d'emploi",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Etudiant",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        
        DB::table('professionnelles')->insert([
            'name' => "Élève",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

    }
}
