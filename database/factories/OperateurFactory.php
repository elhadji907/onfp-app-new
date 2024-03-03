<?php

namespace Database\Factories;

use App\Models\Operateur;
use App\Models\Commune;
use App\Models\Ninea;
use App\Models\User;
use App\Models\Role;
use App\Models\TypesOperateur;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SnNameGenerator as SnmG;

class OperateurFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Operateur::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $communes_id=Commune::all()->random()->id;
        $nineas_id=Ninea::all()->random()->id;
        $types_operateurs_id=TypesOperateur::all()->random()->id;
        /* $role_id=Role::where('name', 'Operateur')->first()->id; */
        $annee = date('Y');
     /*    $firstName = SnmG::getFirstName();
        $name = SnmG::getFirstName();
        $uniqueSuffix = $this->faker->unique()->numberBetween(1,99);
        $domain1 = 'gmail.com';
        $domain2 = 'yahoo.fr';
        $uniqueFakeEmail1 = "$firstName.$name.$uniqueSuffix@$domain1";
        $uniqueFakeEmail2 = "$firstName.$name.$uniqueSuffix@$domain2"; */

        return [
            'numero_agrement' => $this->faker->unique(true)->numberBetween(1000, 9999).'/ONFP/DG/DEC/'.$annee,
            'name' => SnmG::getEtablissement(),
            'sigle' => "SIGLE",
            'typestructure' => SnmG::getTypesstructure(),
            'ninea' => $this->faker->word,
            'rccm' => $this->faker->word,
            'quitus' => $this->faker->word,
            'telephone1' => $this->faker->e164PhoneNumber,
            'telephone2' => $this->faker->e164PhoneNumber,
            'fixe' => $this->faker->word,
            'email1' => $this->faker->unique()->safeEmail(),
            'email2' => $this->faker->unique()->safeEmail(),
            'adresse' => $this->faker->word,
            'debut_quitus' => $this->faker->dateTime(),
            'fin_quitus' => $this->faker->dateTime(),
            'date' => $this->faker->dateTime(),
            'date_debut' => $this->faker->dateTime(),
            'date_fin' => $this->faker->dateTime(),
            'date_renew' => $this->faker->dateTime(),
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'users_id' => function () {
                return User::factory()->create()->id;
            },
            /* 'users_id' => function () use ($role_id) {
                return User::factory()->create(["roles_id"=>$role_id])->id;
            }, */
            /* 'rccms_id' => function () {
                return factory(App\Rccm::class)->create()->id;
            }, */
            'nineas_id' => function () use ($nineas_id) {
                return $nineas_id;
            },
            
            'types_operateurs_id' => function () use ($types_operateurs_id) {
                return $types_operateurs_id;
            },

         /*    'specialites_id' => function () {
                return factory(App\Specialite::class)->create()->id;
            }, */

           /*  'courriers_id' => function () {
                return factory(App\Courrier::class)->create()->id;
            }, */
        ];
    }
}
