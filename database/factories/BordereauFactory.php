<?php

namespace Database\Factories;

use App\Models\Bordereau;
use App\Models\Liste;
use App\Models\Courrier;
use App\Models\TypesCourrier;
use Illuminate\Database\Eloquent\Factories\Factory;

class BordereauFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Bordereau::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types_courrier_id=TypesCourrier::where('name', 'Bordereau')->first()->id;
        $liste_id=Liste::all()->random()->id;
        $annee = date('y');

        $nombre = rand(1, 9);
        
        return [
            'numero' => 'BD'.$this->faker->unique(true)->numberBetween(0, 30)."".$annee,
            'numero_mandat' => $this->faker->unique(true)->numberBetween(0, 30),
            'date_mandat' => $this->faker->dateTime(),
            'designation' => $this->faker->paragraph(1),
            'montant' => $this->faker->randomFloat(),
            'nombre_de_piece' => $nombre,
            'observation' => $this->faker->paragraph(1),
            'courriers_id' => function () use ($types_courrier_id) {
                return Courrier::factory()->create(["types_courriers_id"=>$types_courrier_id])->id;
            },
            'listes_id' => function () use ($liste_id) {
                return $liste_id;
            },
        ];
    }
}
