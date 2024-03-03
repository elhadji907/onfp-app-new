<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recue;

class RecueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recue::factory()
            ->count(0)
            ->create();
    }
}
