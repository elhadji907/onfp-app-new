<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pcharge;

class PchargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Pcharge::factory()
            ->count(0)
            ->create();
    }
}
