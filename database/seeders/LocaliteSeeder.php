<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LocaliteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('localites')->insert([
               "nom" => "Ziguinchor",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
                ]);

        DB::table('localites')->insert([
               "nom" => "Bignona",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
                ]);
   
        DB::table('localites')->insert([
               "nom" => "Bounkiling",
               'created_at' => now(),
               'updated_at' => now(),
               'uuid' => Str::uuid(),
                ]);

    }
}
