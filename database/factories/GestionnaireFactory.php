<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use App\Models\Gestionnaire;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class GestionnaireFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gestionnaire::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        /* $role_id=Role::where('name', 'Gestionnaire')->first()->id; */

        return [
        'matricule' => "GEST".$this->faker->word,
        'users_id' => function () {
            return User::factory()->create()->id;
        },
        /* 'users_id' => function () use ($role_id) {
            return User::factory()->create(["roles_id"=>$role_id])->id;
        }, */
        ];
    }
}
