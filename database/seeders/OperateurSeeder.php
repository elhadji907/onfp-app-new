<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Operateur;
use App\Models\Module;

class OperateurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Operateur::factory()
            ->count(0)
            ->create();
            
        $modules = Module::all();

    /*     Operateur::all()->each(function ($operateur) use ($modules) {
            $operateur->modules()->attach(
                $modules->random(rand(1, 3))->pluck('id')->toArray()
            );
        }); */
    }
}
