<?php

namespace Database\Factories;

use App\Models\Etablissement;
use App\Models\Commune;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SnNameGenerator as SnmG;

class EtablissementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Etablissement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $communes_id=Commune::all()->random()->id;
        $regions_id=Region::all()->random()->id;
        
        return [
            'matricule' => "ETAB".$this->faker->postcode,
            'name' => SnmG::getEtablissement(),
            'sigle' => $this->faker->word,
            'items1' => $this->faker->word,
            'date1' => $this->faker->dateTime(),
            'telephone1' => $this->faker->e164PhoneNumber,
            'telephone2' => $this->faker->e164PhoneNumber,
            'fixe' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'adresse' => $this->faker->address,
            'users_id' => function () {
                return User::factory()->create()->id;
            },
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'regions_id' => function () use ($regions_id) {
                return $regions_id;
            },
        ];
    }
}
