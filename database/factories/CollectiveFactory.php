<?php

namespace Database\Factories;

use App\Helpers\SnNameGenerator as SnmG;
use Illuminate\Support\Str;
use App\Models\Collective;
use App\Models\TypesDemande;
use App\Models\Demandeur;
use App\Models\Commune;
use App\Models\Projet;
use App\Models\Programme;
use App\Models\Fcollective;
use App\Models\Formation;
use App\Models\Etude;
use App\Models\Convention;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollectiveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Collective::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_demande_id    =      TypesDemande::where('name', 'Collective')->first()->id;
        $communes_id         =      Commune::all()->random()->id;
        $projet_id           =      Projet::all()->random()->id;
        $programmes_id       =      Programme::all()->random()->id;
        $fcollectives_id     =      Fcollective::all()->random()->id;
        $formations_id       =      Formation::all()->random()->id;
        $etudes_id           =      Etude::all()->random()->id;
        $projets_id          =      Projet::all()->random()->id;
        $conventions_id      =      Convention::all()->random()->id;
        $modules_id          =      Module::all()->random()->id;

        $nombre = rand(1, 9);

        return [
            'name' =>  SnmG::getEtablissement(),
            'sigle' =>  $this->faker->word,
            'date_depot' =>  $this->faker->dateTime(),
            'items1' =>  $this->faker->word,
            'date1' =>  $this->faker->dateTime(),
            'statut' =>  $this->faker->word,
            'description' =>  $this->faker->text,
            'type' => $this->faker->randomElement($array = array('Nouvelle demande','Renouvellement')),
            'adresse' =>  $this->faker->word,
            'telephone' =>  $this->faker->e164PhoneNumber,
            'fixe' =>  $this->faker->phoneNumber,
            'bp' =>  $this->faker->postcode,
            'fax' =>  $this->faker->e164PhoneNumber,
            'projetprofessionnel' =>  $this->faker->text,
            'experience' =>  $this->faker->text,
            'prerequis' =>  $this->faker->text,
            'motivation' =>  $this->faker->text,
            'nbre_pieces' =>  rand(1, 7),
            'file1' =>  $this->faker->word,
            'file2' =>  $this->faker->word,
            'file3' =>  $this->faker->word,
            'file4' =>  $this->faker->word,
            'file5' =>  $this->faker->word,
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'formations_id' => function () use ($formations_id) {
                return $formations_id;
            },
            'etudes_id' => function () use ($etudes_id) {
                return $etudes_id;
            },
            'programmes_id' => function () use ($programmes_id) {
                return $programmes_id;
            },
            'projets_id' => function () use ($projets_id) {
                return $projets_id;
            },
            'conventions_id' => function () use ($conventions_id) {
                return $conventions_id;
            },
            'fcollectives_id' => function () use ($fcollectives_id) {
                return $fcollectives_id;
            },
            'modules_id' => function () use ($modules_id) {
                return $modules_id;
            },
        ];
    }
}
