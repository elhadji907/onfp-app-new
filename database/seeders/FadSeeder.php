<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fad;

class FadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fad::factory()
            ->count(0)
            ->create();
    }
}
