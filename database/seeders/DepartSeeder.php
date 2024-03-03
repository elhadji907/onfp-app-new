<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Depart;

class DepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Depart::factory()
            ->count(0)
            ->create();
    }
}
