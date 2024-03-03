<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProgrammeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programmes')->insert([
                        "name"=>"Aucun",
                        "sigle"=>"Aucun",
                        "uuid"=>Str::uuid(),
                    ]);
        DB::table('programmes')->insert([
                        "name"=>"Formation de 1.000 jeunes dans les métiers du numérique",
                        "sigle"=>"NUMERIQUE(1.000)",
                        "uuid"=>Str::uuid(),
                    ]);
        DB::table('programmes')->insert([
                        "name"=>"Formation de 500 Développeurs web/mobile",
                        "sigle"=>"DEVELOPPEURS WEB/MOBILE",
                        "uuid"=>Str::uuid(),
                    ]);
        DB::table('programmes')->insert([
                        "name"=>"Programme triennal de renforcement des compétences des artisans",
                        "sigle"=>"PRECA",
                        "uuid"=>Str::uuid(),
                    ]);
    }
}
