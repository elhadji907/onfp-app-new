<?php

namespace Database\Factories;

use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;
use App\Models\Demandeur;
use App\Models\User;
use App\Models\TypesDemande;
use App\Models\Domaine;
use App\Models\Courrier;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandeurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Demandeur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
        $nombre1 = rand(1, 2);
        $nombre2 = rand(100, 999);
        $nombre3 = rand(1965, 1998);
        $nombre4 = rand(1, 9);
        $nombre5 = rand(0, 9);
        $nombre6 = rand(0, 9);
        $nombre7 = rand(0, 9);
        $nombre8 = rand(0, 9);
        $nombre9 = rand(0, 9);
        $cin = $nombre1.$nombre2.$nombre3.$nombre4.$nombre5.$nombre6.$nombre7.$nombre8.$nombre9;
        
        $annee = date('y');
        /* $role_id=Role::where('name', 'Demandeur')->first()->id; */
        $types_demandes_id  =   TypesDemande::all()->random()->id;
        $courriers_id       =   Courrier::all()->random()->id;
        $domaine            =   Domaine::all()->random()->name;

        return [
            'cin' => $cin,
            'numero_dossier' => $this->faker->unique(true)->numberBetween(100, 999).rand(10, 99)."".$annee,
            'date1' => $this->faker->dateTime(),         
            'users_id' => function () {
                return User::factory()->create()->id;
            },
            /* 'users_id' => function () use ($role_id) {
                return User::factory()->create(["roles_id"=>$role_id])->id;
            }, */
        /* 'items_id' => function () {
            return factory(App\Item::class)->create()->id;
        }, */
            'types_demandes_id' => function () use ($types_demandes_id) {
                return $types_demandes_id;
            },
            'courriers_id' =>function () use ($courriers_id) {
                return $courriers_id;
            },
        ];
    }
}
