<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SecteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('secteurs')->insert([
            "name"=>"primaire",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        DB::table('secteurs')->insert([
            "name"=>"secondaire",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        DB::table('secteurs')->insert([
            "name"=>"tertiaire",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        DB::table('secteurs')->insert([
            "name"=>"quaternaire",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
    }
}
