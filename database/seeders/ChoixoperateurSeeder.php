<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ChoixoperateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('choixoperateurs')->insert([
           'annee' => "2020",
           'trimestre' => "Choix opérateurs du 15 mars 2020",
           'description' => "Description",
           'date' => now(),
           'created_at' => now(),
           'updated_at' => now(),
           'uuid' => Str::uuid(),
       ]);
           
        DB::table('choixoperateurs')->insert([
           'annee' => "2021",
           'trimestre' => "Choix opérateurs du 15 juin 2021",
           'description' => "Description",
           'date' => now(),
           'created_at' => now(),
           'updated_at' => now(),
           'uuid' => Str::uuid(),
       ]);
           
        DB::table('choixoperateurs')->insert([
           'annee' => "2022",
           'trimestre' => "Choix opérateurs du 15 septembre 2022",
           'description' => "Description",
           'date' => now(),
           'created_at' => now(),
           'updated_at' => now(),
           'uuid' => Str::uuid(),
       ]);
    }
}
