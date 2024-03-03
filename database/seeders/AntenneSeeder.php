<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AntenneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('antennes')->insert([
            'name' => "Direction générale",
            'code' => "DG",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('antennes')->insert([
            'name' => "Antenne de Kaolack",
            'code' => "AntKL",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('antennes')->insert([
            'name' => "Antenne de Kolda",
            'code' => "AntKD",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('antennes')->insert([
            'name' => "Antenne de Kédougou",
            'code' => "AntKD",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('antennes')->insert([
            'name' => "Antenne de Diourbel",
            'code' => "AntDL",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('antennes')->insert([
            'name' => "Antenne de Matam",
            'code' => "AntMT",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('antennes')->insert([
            'name' => "Antenne de Saint-Louis",
            'code' => "AntSL",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);

        DB::table('antennes')->insert([
            'name' => "Antenne de Ziguinchor",
            'code' => "AntZG",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
