<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Liste;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ListeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('listes')->insert([
            "numero" => "Feuil23_0001",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);

        DB::table('listes')->insert([
            "numero" => "Feuil23_0002",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);

        DB::table('listes')->insert([
            "numero" => "Feuil23_0003",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);

        DB::table('listes')->insert([
            "numero" => "Feuil23_0004",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
             ]);
    }
}
