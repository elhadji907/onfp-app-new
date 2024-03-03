<?php

namespace Database\Factories;

use App\Models\Formation;
use App\Models\TypesFormation;
use App\Models\Commune;
use App\Models\Ingenieur;
use App\Models\Individuelle;
use App\Models\Operateur;
use App\Models\Module;
use App\Models\Statut;
use App\Models\Choixoperateur;
use App\Models\Localite;
use App\Models\Convention;
use App\Models\Projet;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Helpers\SnNameGenerator as SnmG;

class FormationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Formation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $annee = date('y');
    
        $types_formations_id      =   TypesFormation::all()->random()->id;
        $communes_id              =   Commune::all()->random()->id;
        $ingenieurs_id            =   Ingenieur::all()->random()->id;
        $operateurs_id            =   Operateur::all()->random()->id;
        $modules_id               =   Module::all()->random()->id;
        $statuts_id               =   Statut::all()->random()->id;
        $choixoperateurs_id       =   Choixoperateur::all()->random()->id;
        $localites_id             =   Localite::all()->random()->id;
        $conventions_id           =   Convention::all()->random()->id;
        $projets_id               =   Projet::all()->random()->id;
    
        $prevue_h = $this->faker->numberBetween(5, 9);
        $prevue_f = $this->faker->numberBetween(5, 1);
    
        $effectif_total = $prevue_h + $prevue_f;
    
        $forme_h = $this->faker->numberBetween(5, 9);
        $forme_f = $this->faker->numberBetween(5, 9);
    
        $total = $forme_h + $forme_f;

        $frais_operateurs = $this->faker->randomFloat();
        $frais_add = $this->faker->randomFloat();
        $autes_frais = $this->faker->randomFloat();

        $frais_total = $frais_operateurs + $frais_add + $autes_frais;

        return [
            'code' => 'FP'."".$annee.$this->faker->unique(true)->numberBetween(0, 300),
            'annee' => $this->faker->randomElement($array = array('2020','2021', '2022')),
            'name' => $this->faker->company,
            'qualifications' => $this->faker->randomElement($array = array('RC','Titre')),
            'effectif_total' => $effectif_total,
            'date_pv' => $this->faker->dateTime(),
            'date_suivi' => $this->faker->dateTime(),
            'date_debut' => $this->faker->dateTimeBetween('-3 week', '+1 week'),
            'date_fin' => $this->faker->dateTimeBetween('-1 week', '+5 week'),
            'adresse' => $this->faker->address,
            'prevue_h' => $prevue_h,
            'prevue_f' => $prevue_f,
            'titre' => $this->faker->word,
            'attestation' => $this->faker->word,
            'forme_h' => $forme_h,
            'forme_f' => $forme_f,
            'total' => $total,
            'frais_operateurs' => $frais_operateurs,
            'frais_add' => $frais_add,
            'autes_frais' => $autes_frais,
            'frais_total' => $frais_total,
            'lieu' => SnmG::getLieunaissance(),
            'convention_col' => $this->faker->word,
            'decret' => $this->faker->word,
            'beneficiaires' => $this->faker->company,
            
            'ingenieurs_id' => function () use ($ingenieurs_id) {
                return $ingenieurs_id;
            },

            'types_formations_id' => function () use ($types_formations_id) {
                return $types_formations_id;
            },

            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },

            'operateurs_id' => function () use ($operateurs_id) {
                return $operateurs_id;
            },

            'choixoperateurs_id' => function () use ($choixoperateurs_id) {
                return $choixoperateurs_id;
            },

            'modules_id' => function () use ($modules_id) {
                return $modules_id;
            },

            'statuts_id' => function () use ($statuts_id) {
                return $statuts_id;
            },

            'localites_id' => function () use ($localites_id) {
                return $localites_id;
            },

            'conventions_id' => function () use ($conventions_id) {
                return $conventions_id;
            },

            'projets_id' => function () use ($projets_id) {
                return $projets_id;
            },
        ];
        
    }
}
