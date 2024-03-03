<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etat;

class EtatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Etat::factory()
            ->count(0)
            ->create();
    }
}
