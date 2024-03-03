<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tresor;

class TresorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tresor::factory()
            ->count(0)
            ->create();
    }
}
