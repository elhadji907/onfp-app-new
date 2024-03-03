<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Interne;

class InterneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Interne::factory()
            ->count(0)
            ->create();
    }
}
