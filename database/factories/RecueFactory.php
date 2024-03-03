<?php

namespace Database\Factories;

use App\Models\Recue;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;
use App\Models\TypesCourrier;
use App\Models\Courrier;

class RecueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Recue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_courrier_id=TypesCourrier::where('name', 'Courriers arrives')->first()->id;
        $annee = date('y');
        $numero_courrier = date('His');

        return [
            'numero' => "CA".$numero_courrier."".$annee,
            'courriers_id' => function () use ($types_courrier_id) {
                return Courrier::factory()->create(["types_courriers_id"=>$types_courrier_id])->id;
            },
        ];
    }
}
