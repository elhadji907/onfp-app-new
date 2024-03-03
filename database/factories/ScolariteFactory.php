<?php

namespace Database\Factories;

use App\Models\Scolarite;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScolariteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Scolarite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          /*   'annee' => $this->faker->randomElement($array = array ('2021-2022','2022-2023')),
            'date_debut' => $this->faker->dateTimeBetween('-2 week', '+3 week'),
            'date_fin' => $this->faker->dateTimeBetween('+8 week', '+9 week'),
            'annee' => $this->faker->randomElement($array = array ('Ouvertes','Cloturées')), */
        ];
    }
}
