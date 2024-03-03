<?php

namespace Database\Factories;

use App\Models\Facturesdaf;
use App\Models\Courrier;
use App\Models\TypesCourrier;
use Illuminate\Database\Eloquent\Factories\Factory;

class FacturedafFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Facturesdaf::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_courrier_id=TypesCourrier::where('name', 'Factures daf')->first()->id;
        $annee = date('y');

        return [
            'numero' => 'FD'.$this->faker->unique(true)->numberBetween(0, 30)."_"."".$annee,
            'date_recep' => $this->faker->dateTime(),
            'montant' => $this->faker->randomFloat(),
            'date_depart' => $this->faker->dateTime(),
            'date_retour' => $this->faker->dateTime(),
            'date_transmission' => $this->faker->dateTime(),
            'date_dg' => $this->faker->dateTime(),
            'date_cg' => $this->faker->dateTime(),
            'date_ac' => $this->faker->dateTime(),
            'courriers_id' => function () use ($types_courrier_id) {
                return Courrier::factory()->create(["types_courriers_id"=>$types_courrier_id])->id;
            },
        ];
    }
}
