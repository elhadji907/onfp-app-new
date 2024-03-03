<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EtatsPrevi;

class EtatpreviSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EtatsPrevi::factory()
            ->count(0)
            ->create();
    }
}
