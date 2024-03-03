<?php

namespace Database\Factories;

use App\Models\Banque;
use App\Models\TypesCourrier;
use App\Models\Courrier;
use Illuminate\Database\Eloquent\Factories\Factory;

class BanqueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Banque::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_courrier_id=TypesCourrier::where('name', 'Banques')->first()->id;
        $annee = date('y');
        
        return [
            'numero' => 'BQ'.$this->faker->numberBetween(0, 100)."".$annee,
            'name' => $this->faker->name,
            'montant' => $this->faker->randomFloat(),
            'date_dg' => $this->faker->dateTime(),
            'date_cg' => $this->faker->dateTime(),
            'date_ac' => $this->faker->dateTime(),
            'courriers_id' => function () use ($types_courrier_id) {
                return Courrier::factory()->create(["types_courriers_id"=>$types_courrier_id])->id;
            },
        ];
    }
}
