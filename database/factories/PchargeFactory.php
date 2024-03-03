<?php

namespace Database\Factories;

use App\Models\Pcharge;
use App\Models\Etablissement;
use App\Models\TypesDemande;
use App\Models\Demandeur;
use App\Models\Commune;
use App\Models\Scolarite;
use App\Models\Filiere;
use App\Models\Etude;
use App\Models\Diplome;
use Illuminate\Database\Eloquent\Factories\Factory;

class PchargeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pcharge::class;

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
        $etablissements_id=Etablissement::all()->random()->id;
        $scolarites_id=Scolarite::all()->random()->id;
        $etudes_id=Etude::all()->random()->id;
        $filieres_id=Filiere::all()->random()->id;
        $scolarite=Scolarite::all()->random()->name;
        $types_demande_id=TypesDemande::where('name', 'Prise en charge')->first()->id;
        $communes_id=Commune::all()->random()->id;
        $diplomes_id=Diplome::all()->random()->id;

        return [
            'cin' => $cin,
            'annee' => $this->faker->numberBetween(2018, 2022),
            'matricule' => "PC".$this->faker->word,
            'niveau' => $this->faker->randomElement($array = array('1ère Année','2ème Année', '3ème Année')),
            'date1' => $this->faker->dateTime(),
            'date_depot' => $this->faker->dateTime(),
            'duree' => $this->faker->numberBetween(1, 3),
            'montant' => $this->faker->numberBetween(250000, 1500000),
            'accompt' => $this->faker->randomFloat(),
            'reliquat' => $this->faker->randomFloat(),
            'specialisation' => $this->faker->word,
            'motivation' => $this->faker->word,
            'adresse' => $this->faker->word,
            'nbre_pieces' => $this->faker->randomNumber(),
            'avis_dg' => $this->faker->randomElement($array = array('0','0')),
            'typedemande' => $this->faker->randomElement($array = array('Nouvelle demande','Renouvellement', 'Report')),
            'optiondiplome' => $this->faker->word,
            'statut' => "Attente",
            'file1' => "",
            'file2' => "",
            'file3' => "",
            'file4' => "",
            'file5' => "",
            'file6' => "",
            'file7' => "",
            'file8' => "",
            'niveauentree' => "",
            'niveausortie' => "",
            'etudes_id' => function () use ($etudes_id) {
                return $etudes_id;
            },
            'filieres_id' => function () use ($filieres_id) {
                return $filieres_id;
            },
            'scolarites_id' => function () use ($scolarites_id) {
                return $scolarites_id;
            },
            'communes_id' => function () use ($communes_id) {
                return $communes_id;
            },
            'demandeurs_id' => function () use ($types_demande_id) {
                return Demandeur::factory()->create(["types_demandes_id"=>$types_demande_id])->id;
            },
        'etablissements_id' => function () use ($etablissements_id) {
            return $etablissements_id;
        },
        'diplomes_id' => function () use ($diplomes_id) {
            return $diplomes_id;
        },
        ];
    }
}
