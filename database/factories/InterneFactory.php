<?php

namespace Database\Factories;

use App\Models\Interne;
use App\Models\TypesCourrier;
use App\Models\Courrier;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;

class InterneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Interne::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $types_courrier_id=TypesCourrier::where('name', 'Courriers internes')->first()->id;
        $annee = date('y');
        $numero_courrier = date('His');

        return [
            'numero' => "CI".$numero_courrier."".$annee,
            'courriers_id' => function () use ($types_courrier_id) {
                return Courrier::factory()->create(["types_courriers_id"=>$types_courrier_id])->id;
            },
        ];
    }
}
