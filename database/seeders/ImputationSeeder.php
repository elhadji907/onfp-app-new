<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImputationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('imputations')->insert([
            "destinataire"=>"Directeur Général",
            "sigle"=> "DG",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('imputations')->insert([
            "destinataire"=>"Direction de l'Evaluation et de la Certification",
            "sigle"=> "DEC",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('imputations')->insert([
            "destinataire"=>"Direction de la planification des projets",
            "sigle"=> "DPP",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('imputations')->insert([
            "destinataire"=>"Direction Administrative et Financière",
            "sigle"=> "DAF",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
        DB::table('imputations')->insert([
            "destinataire"=>"Direction de l'Ingénierie et de la Formation",
            "sigle"=> "DIOF",
            'created_at' => now(),
            'updated_at' => now(),
            'uuid' => Str::uuid(),
        ]);
    }
}
