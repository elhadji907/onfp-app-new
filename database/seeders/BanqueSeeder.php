<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banque;


class BanqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banque::factory()
            ->count(0)
            ->create();
    }
}
