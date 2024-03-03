<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

    }
}
