<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('filieres')->insert([
            "name"=>"Autre",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);

        DB::table('filieres')->insert([
            "name"=>"FROID/CLIMATISATION",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"GENIE CIVIL",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"GENIE ELECTRIQUE",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"HETELLERIE / RESTAURATION",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"INFORMATIQUE",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"MANAGEMENT",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"MECANIQUE AUTOMOBILE",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"FABRICATION MACANIQUE",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"STRUCTURE METALLIQUE",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"MENUISERIE BOIS",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
        DB::table('filieres')->insert([
            "name"=>"SANTE",
            'created_at' => now(),
            'updated_at' => now(),
            "uuid"=>Str::uuid(),
        ]);
        
    }
}
