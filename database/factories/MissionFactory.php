<?php

namespace Database\Factories;

use App\Models\Mission;
use App\Models\TypesCourrier;
use App\Models\Courrier;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_courrier_id=TypesCourrier::where('name', 'Missions')->first()->id;
        $annee = date('y');
        
        return [
            'numero' => 'MI'.$this->faker->unique(true)->numberBetween(0, 30)."".$annee,
            'localites' => $this->faker->word,
            'distance' => $this->faker->randomNumber(),
            'jours' => $this->faker->randomNumber(),
            'date_visa' => $this->faker->dateTime(),
            'date_mandat' => $this->faker->dateTime(),
            'date_ac' => $this->faker->dateTime(),
            'tva_ir' => $this->faker->word,
            'rejet' => $this->faker->text,
            'date_cg' => $this->faker->dateTime(),
            'retour' => $this->faker->word,
            'paye' => $this->faker->word,
            'date_paye' => $this->faker->dateTime(),
            'date_depart' => $this->faker->dateTime(),
            'date_retour' => $this->faker->dateTime(),
            'destination' => $this->faker->word,
            'montant' => $this->faker->randomFloat(),
            'reliquat' => $this->faker->randomFloat(),
            'courriers_id' => function () use ($types_courrier_id) {
                return Courrier::factory()->create(["types_courriers_id"=>$types_courrier_id])->id;
            },
        ];
    }
}
