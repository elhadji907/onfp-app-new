<?php

namespace Database\Factories;

use App\Models\Depense;
use App\Models\Activite;
use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SnNameGenerator as SnmG;

class DepenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Depense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $activites_id=Activite::all()->random()->id;
        $projets_id=Projet::all()->random()->id;

        return [
            'numero' => $this->faker->unique(true)->numberBetween(0, 30),
            'designation' => $this->faker->paragraph(1),
            'fournisseurs' => SnmG::getFirstName()." ".SnmG::getName(),
            'montant' => $this->faker->randomFloat(),
            'tva' => $this->faker->randomFloat(),
            'ir' => $this->faker->randomFloat(),
            'autre_montant' => $this->faker->randomFloat(),
            'total' => $this->faker->randomFloat(),
            'activites_id' => function () use ($activites_id) {
                return $activites_id;
            },
            'projets_id' => function () use ($projets_id) {
                return $projets_id;
            },
        ];
    }
}
