<?php

namespace Database\Factories;

use App\Models\Courrier;
use App\Models\User;
use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Helpers\SnNameGenerator as SnmG;

class CourrierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Courrier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $user_id = User::all()->random()->id;
        $projet_id = Projet::all()->random()->id;
        $annee = date('y');
        $numero_courrier = date('His');

        $montant = $this->faker->randomFloat();
        $autre_montant = $this->faker->randomFloat();

        $total = $montant + $autre_montant;

        return [
            'numero' => $numero_courrier."".$annee,
            'objet' => $this->faker->paragraph(1),
            'expediteur' => SnmG::getFirstName()." ".SnmG::getName(),
            'name' => $this->faker->name,
            'type' => $this->faker->word,
            'description' => $this->faker->text,
            'message' => $this->faker->paragraph(2),
            'email' => $this->faker->safeEmail,
            'fax' => $this->faker->e164PhoneNumber,
            'bp' => $this->faker->postcode,
            'telephone' => $this->faker->phoneNumber,
            'statut' => "",
            'date' => $this->faker->dateTime(),
            'adresse' => $this->faker->address,
            'date_imp' => $this->faker->dateTime(),
            'date_recep' => $this->faker->dateTime(),
            'date_cores' => $this->faker->dateTime(),
            'date_rejet' => $this->faker->dateTime(),
            'date_liq' => $this->faker->dateTime(),
            'designation' => $this->faker->paragraph(1),
            'observation' => $this->faker->paragraph(1),
            'date_visa' => $this->faker->dateTime(),
            'date_mandat' => $this->faker->dateTime(),
            'tva' => $this->faker->randomNumber(),
            'ir' => $this->faker->randomNumber(),
            'nb_pc' => $this->faker->word,
            'destinataire' => $this->faker->word,
            'date_paye' => $this->faker->dateTime(),
            'num_bord' => $this->faker->randomNumber(),
            'montant' => $montant,
            'autres_montant' => $autre_montant,
            'total' => $total,
            'projets_id' => function () use ($projet_id) {
                return $projet_id;
            },
            'users_id' => function () use ($user_id) {
                return $user_id;
            },
        ];
    }
}
