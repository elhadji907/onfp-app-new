<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Professionnelle;
use App\Models\Familiale;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Helpers\SnNameGenerator as SnmG;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $professionnelles_id = Professionnelle::all()->random()->id;
        $familiales_id = Familiale::all()->random()->id;

        return [
            'civilite' => SnmG::getCivilite(),
            'firstname' => SnmG::getFirstName(),
            'name' => SnmG::getName(),
            'username' => Str::random(7),
            'email' => $this->faker->unique()->email(),
            'telephone' => $this->faker->unique(true)->numberBetween(70, 79).rand(10, 99).rand(10, 99).rand(0, 9).rand(0, 9).rand(0, 9),
            'fixe' => $this->faker->phoneNumber,
            'sexe' => SnmG::getSexe(),
            'date_naissance' => $this->faker->dateTimeBetween('-35 years', '-18 years'),
            'lieu_naissance' => SnmG::getLieunaissance(),
            'adresse' => $this->faker->address,
            'bp' => $this->faker->postcode,
            'fax' => $this->faker->e164PhoneNumber,
            'email_verified_at' => now(),
            'password' => bcrypt($this->faker->password),
            'created_by' => SnmG::getFirstName().' '.SnmG::getFirstName().' ('.Str::random(7).')',
            'updated_by' => SnmG::getFirstName().' '.SnmG::getFirstName().' ('.Str::random(7).')',
            'deleted_by' => " ",
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'professionnelles_id' => function () use ($professionnelles_id) {
                return $professionnelles_id;
            },
            'familiales_id' => function () use ($familiales_id) {
                return $familiales_id;
            },
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
