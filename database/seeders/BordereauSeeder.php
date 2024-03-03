<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bordereau;

class BordereauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bordereau::factory()
            ->count(0)
            ->create();
    }
}
