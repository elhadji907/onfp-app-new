<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lieux;

class LieuxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lieux::factory()
            ->count(0)
            ->create();
    }
}
