<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Findividuelle;

class FindividuelleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Findividuelle::factory()
            ->count(0)
            ->create();
    }
}
