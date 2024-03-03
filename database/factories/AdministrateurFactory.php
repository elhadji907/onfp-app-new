<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Role;
use App\Models\Administrateur;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdministrateurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Administrateur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //$role_id=Role::where('name', 'Administrateur')->first()->id;
        return [
        'matricule' => "ADMIN".$this->faker->word,
        
        'users_id' => function () {
            return User::factory()->create()->id;
        },

      /*   'users_id' => function () use ($role_id) {
            return User::factory()->create(["roles_id"=>$role_id])->id;
        }, */
        ];
    }
}
