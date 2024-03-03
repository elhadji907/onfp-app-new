<?php

namespace Database\Factories;

use App\Models\Liste;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Liste::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $annee = date('y');
        $x = 1;
        $number = $x + 1;
        
        return [
            'numero' => 'Feuil'.$this->faker->unique(true)->numberBetween(0, 30)."_".$annee,
            'destinataire' => $this->faker->name,
            'date' => $this->faker->dateTime(),
            'name' => $this->faker->name,
            'liste' => '',
        ];
    }
}
