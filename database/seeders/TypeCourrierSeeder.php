<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TypeCourrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_courriers')->insert([
            "name"=>"Courriers arrives",
            "categorie"=>"arrives",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Courriers departs",
            "categorie"=>"departs",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Courriers internes",
            "categorie"=>"internes",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Bordereau",
            "categorie"=>"bordereaus",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Factures daf",
            "categorie"=>"factures",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Banques",
            "categorie"=>"banques",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Tresors",
            "categorie"=>"tresors",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Missions",
            "categorie"=>"missions",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Etats",
            "categorie"=>"etats",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"Etats previs",
            "categorie"=>"previs",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('types_courriers')->insert([
            "name"=>"FADS",
            "categorie"=>"fads",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
