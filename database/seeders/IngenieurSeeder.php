<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class IngenieurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('ingenieurs')->insert([
            "name"=>"Mourtalla BITEYE",
            "matricule"=>"MRB",
            "email"=>"mourtalla.biteye@onfp.sn",
            "telephone"=>"77 352 15 60",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
                
        DB::table('ingenieurs')->insert([
            "name"=>"Dieynenba TALLA",
            "matricule"=>"DYT",
            "email"=>"dieynaba.talla@onfp.sn",
            "telephone"=>"76 567 25 97",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
                
        DB::table('ingenieurs')->insert([
            "name"=>"Edouard MANSAMA",
            "matricule"=>"EDM",
            "email"=>"edouard.mansama@onfp.sn",
            "telephone"=>"77 586 28 96",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
                
        DB::table('ingenieurs')->insert([
            "name"=>"Yacine YADE",
            "matricule"=>"YCY",
            "email"=>"yacine.yade@onfp.sn",
            "telephone"=>"77 259 97 70",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
                
        DB::table('ingenieurs')->insert([
            "name"=>"Sokhna Aminata SARR",
            "matricule"=>"SAS",
            "email"=>"aminata.sarr@onfp.sn",
            "telephone"=>"76 181 02 20",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
