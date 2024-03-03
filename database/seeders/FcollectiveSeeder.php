<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fcollective;

class FcollectiveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fcollective::factory()
            ->count(0)
            ->create();
    }
}
