<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Collective;

class CollectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Collective::factory()
            ->count(0)
            ->create();
    }
}
