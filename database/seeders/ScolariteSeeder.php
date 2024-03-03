<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScolariteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('scolarites')->insert([
            'annee' => "2018-2019",
            'statut' => "Fermé",
            'date_debut' => "2018-08-04",
            'date_fin' => "2018-09-04",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('scolarites')->insert([
            'annee' => "2019-2020",
            'statut' => "Fermé",
            'date_debut' => "2019-08-04",
            'date_fin' => "2019-09-04",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('scolarites')->insert([
            'annee' => "2020-2021",
            'statut' => "Ouvert",
            'date_debut' => "2020-08-04",
            'date_fin' => "2020-09-04",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('scolarites')->insert([
            'annee' => "2021-2022",
            'statut' => "Ouvert",
            'date_debut' => "2021-08-04",
            'date_fin' => "2021-09-04",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
