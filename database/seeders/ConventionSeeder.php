<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ConventionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('conventions')->insert([
            "numero"=>"00201 du 25 novembre 2020",
            "name"=>"00201 du 25 novembre 2020",
            "sigle"=>"sigle",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
       ]);

        DB::table('conventions')->insert([
            "numero"=>"00035 du 10 janvier 2021",
            "name"=>"00035 du 10 janvier 2021",
            "sigle"=>"sigle",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
       ]);

    }
}
