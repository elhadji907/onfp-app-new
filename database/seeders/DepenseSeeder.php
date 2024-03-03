<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Depense;

class DepenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Depense::factory()
            ->count(0)
            ->create();
    }
}
