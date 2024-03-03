<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Individuelle;

class IndividuelleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Individuelle::factory()
            ->count(0)
            ->create();
    }
}
