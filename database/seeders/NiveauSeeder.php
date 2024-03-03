<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('niveauxs')->insert([
            "name"=>"Aucun",
            "uuid"=>Str::uuid(),
           ]);

        DB::table('niveauxs')->insert([
             "name"=>"Elementaire",
             "uuid"=>Str::uuid(),
            ]);

        DB::table('niveauxs')->insert([
             "name"=>"Moyen",
             "uuid"=>Str::uuid(),
            ]);

        DB::table('niveauxs')->insert([
             "name"=>"Secondaire",
             "uuid"=>Str::uuid(),
            ]);

        DB::table('niveauxs')->insert([
             "name"=>"Supérieur",
             "uuid"=>Str::uuid(),
            ]);
    }
}
