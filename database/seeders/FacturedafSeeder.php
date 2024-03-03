<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facturesdaf;

class FacturedafSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Facturesdaf::factory()
            ->count(0)
            ->create();
    }
}
