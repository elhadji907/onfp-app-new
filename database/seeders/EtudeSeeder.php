<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EtudeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('etudes')->insert([
            "name"=>"Elementaire",
            "uuid"=>Str::uuid(),
           ]);

        DB::table('etudes')->insert([
            "name"=>"Moyen",
            "uuid"=>Str::uuid(),
           ]);

        DB::table('etudes')->insert([
            "name"=>"Secondaire",
            "uuid"=>Str::uuid(),
           ]);

        DB::table('etudes')->insert([
            "name"=>"Supérieur",
            "uuid"=>Str::uuid(),
           ]);
           
        DB::table('etudes')->insert([
            "name"=>"Aucun",
            "uuid"=>Str::uuid(),
           ]);
    }
}
