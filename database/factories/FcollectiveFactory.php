<?php

namespace Database\Factories;

use App\Models\Fcollective;
use App\Models\TypesFormation;
use App\Models\Formation;
use App\Models\Module;
use App\Models\Projet;
use App\Models\Programme;
use Illuminate\Database\Eloquent\Factories\Factory;

class FcollectiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Fcollective::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $annee = date('y');
    
        $types_formation_id=TypesFormation::where('name', 'Collective')->first()->id;
        $modules_id=Module::all()->random()->id;
        $projets_id=Projet::all()->random()->id;
        $programmes_id=Programme::all()->random()->id;

        return [
            'code' => 'C'."".$annee.$this->faker->unique(true)->numberBetween(0, 300),
            'categorie' => $this->faker->word,
            'modules_id' => function () use ($modules_id) {
                return $modules_id;
            },
            'formations_id' => function () use ($types_formation_id) {
                return Formation::factory()->create(["types_formations_id"=>$types_formation_id])->id;
            },

            'projets_id' => function () use ($projets_id) {
                return $projets_id;
            },

            'programmes_id' => function () use ($programmes_id) {
                return $programmes_id;
            },
        ];
    }
}
