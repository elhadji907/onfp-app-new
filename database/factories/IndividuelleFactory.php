<?php

namespace Database\Factories;

use App\Models\Individuelle;
use App\Models\Demandeur;
use App\Models\TypesDemande;
use App\Models\Commune;
use App\Models\Programme;
use App\Models\Diplome;
use App\Models\Findividuelle;
use App\Models\Etude;
use App\Models\Antenne;
use App\Models\Convention;
use App\Models\Diplomespro;
use App\Models\Module;
use App\Models\Formation;
use App\Models\Zone;
use App\Models\Localite;
use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SnNameGenerator as SnmG;

class IndividuelleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Individuelle::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_demande_id  =   TypesDemande::where('name', 'Individuelle')->first()->id;
        $communes_id       =   Commune::all()->random()->id;
        $diplomes_id       =   Diplome::all()->random()->id;
        $programmes_id     =   Programme::all()->random()->id;
        $etudes_id         =   Etude::all()->random()->id;
        $antennes_id       =   Antenne::all()->random()->id;
        $conventions_id    =   Convention::all()->random()->id;
        $diplomespros_id   =   Diplomespro::all()->random()->id;
        $modules_id        =   Module::all()->random()->id;
        $formations_id     =   Formation::all()->random()->id;
        $zones_id          =   Zone::all()->random()->id;
        $localites_id      =   Localite::all()->random()->id;
        $projets_id        =   Projet::all()->random()->id;

        $nombre = rand(1, 9);
            
        return [
            'experience' => $this->faker->text,
            'projetprofessionnel' => $this->faker->text,
            'prerequis' => $this->faker->text,
            'information' => $this->faker->text,
            'date_depot' => $this->faker->dateTime(),
            'note' => rand(4, 17),
            'statut' => $this->faker->randomElement($array = array('attente', 'rejeter','accepter')),
            'type' => $this->faker->randomElement($array = array('Nouvelle demande','Renouvellement')),
            'qualification' => $this->faker->word,
            'etablissement' => SnmG::getEtablissement(),
            'adresse' => $this->faker->address,
            'option' => $this->faker->randomElement($array = array('Littéraire','Science', 'Technologie', 'Arabe')),
            'autres_diplomes' => SnmG::getDiplome(),
            'autres_diplomes_pros' => SnmG::getDiplomepro(),
            'telephone' => $this->faker->unique(true)->numberBetween(70, 79).rand(10, 99).rand(10, 99).rand(0, 9).rand(0, 9).rand(0, 9),
            'fixe' => $this->faker->phoneNumber,
            'motivation' => $this->faker->text,
            'motif' => $this->faker->text,
            'annee_diplome' => rand(1990, 2020),
            'annee_diplome_professionelle' =>rand(1990, 2020),
            'nbre_enfant' => rand(0, 7),
            'activite_travail' => $this->faker->word,
            'travail_renumeration' => SnmG::getTravailrenumeration(),
            'activite_avenir' => $this->faker->word,
            'handicap' => SnmG::getHandicap(),
            'situation_economique' => SnmG::getSituationeconomique(),
            'victime_social' => SnmG::getVictime_social(),
            'autre_victime' => $this->faker->word,
            'salaire' => $this->faker->randomElement($array = array('Indécent','Moyen', 'Bien')),
            'preciser_handicap' => $this->faker->word,
            'optiondiplome' => $this->faker->randomElement($array = array('Littéraire','Science', 'Technologie', 'Arabe')),
            'dossier' => $this->faker->text,
            'autre_diplomes_fournis' => $this->faker->text,
            'items1' => $this->faker->word,
            'date1' => $this->faker->dateTime(),
            'item1' => $this->faker->word,
            'item2' => $this->faker->word,
            'file1' => $this->faker->word,
            'file2' => $this->faker->word,
            'file3' => $this->faker->word,
            'file4' => $this->faker->word,
            'file5' => $this->faker->word,
            'file6' => $this->faker->word,
            'file7' => $this->faker->word,
            'nbre_pieces' => rand(5, 7),
            'nbre_enfants' => rand(0, 5),

            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },

            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },

            'diplomes_id' => function () use ($diplomes_id) {
                return $diplomes_id;
            },

            'programmes_id' => function () use ($programmes_id) {
                return $programmes_id;
            },

            'etudes_id' => function () use ($etudes_id) {
                return $etudes_id;
            },

            'antennes_id' => function () use ($antennes_id) {
                return $antennes_id;
            },

            'diplomes_id' => function () use ($diplomes_id) {
                return $diplomes_id;
            },

            'conventions_id' => function () use ($conventions_id) {
                return $conventions_id;
            },

            'diplomespros_id' => function () use ($diplomespros_id) {
                return $diplomespros_id;
            },

            'modules_id' => function () use ($modules_id) {
                return $modules_id;
            },

        /*     'formations_id' => function () use ($formations_id) {
                return $formations_id;
            }, */

            'zones_id' => function () use ($zones_id) {
                return $zones_id;
            },

            'localites_id' => function () use ($localites_id) {
                return $localites_id;
            },

            'projets_id' => function () use ($projets_id) {
                return $projets_id;
            },
        ];
    }
}
