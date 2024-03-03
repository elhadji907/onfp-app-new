<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Localite;
use App\Models\Projet;
use Illuminate\Http\Request;
use DB;

class AgeroutezoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Ageroute|Gestionnaire|Demandeur|Individuelle|Collective|Pcharge']);
    }
    /*
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        /* dd($projet_id); */

       /*  $ageroutelocalite = Projet::all()->load(['zones'])
        ->where('name', '=', $projet_name); */

        /* dd($ageroutelocalite); */

        $projet = Projet::find($projet_id);

        $zones = $projet->zones;

      /*   foreach ($ageroutelocalite as $ageroutezones) {
        } */

        return view('ageroutezones.index', compact('zones', 'projet_name', 'projet_id', 'projet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $projetLocalites = Localite::join("projetslocalites", "projetslocalites.localites_id", "=", "localites.id")
        ->where("projetslocalites.projets_id", $id)
        ->get()->pluck('nom', 'nom')->unique();
        
        $localite = Localite::distinct('nom')->get()->pluck('nom', 'id')->unique();
        return view('ageroutezones.create', compact('localite', 'projetLocalites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
        'departement'                         => 'required',
        'commune'                             => 'required|unique:zones,nom'
        ]);

        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        
        $departement_id = Localite::where('nom', $request->input('departement'))->first()->id;
        
        $zone = Zone::create([
            'nom' => $request->input('commune'),
            'localites_id' => $departement_id
        ]);

        $zone->projets()->sync($projet_id);

        return redirect()->route('ageroutezones.index')
            ->with('success', 'Commune créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function show(Zone $zone)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = Zone::find($id);
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($projet_id);

        $projetLocalites = Localite::join("projetslocalites", "projetslocalites.localites_id", "=", "localites.id")
        ->where("projetslocalites.projets_id", $projet_id)
        ->get()->pluck('nom', 'nom')->unique();

        return view('ageroutezones.update', compact('zone', 'projetLocalites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $zone = Zone::find($id);

        $this->validate($request, [
        'departement'                         => 'required',
        'commune'                             => 'required|unique:zones,nom,'.$zone->id
        ]);

        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $departement_id = Localite::where('nom', $request->input('departement'))->first()->id;

        $zone->nom              = $request->input('commune');
        $zone->localites_id     = $departement_id;

        $zone->save();

        $zone->projets()->sync($projet_id);
        return redirect()->route('ageroutezones.index')
            ->with('success', 'Commune modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zone  $zone
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $zone = Zone::find($id);
        $zone->projets()->detach($projet_id);
        DB::table("zones")->where('id', $id)->delete();
        return redirect()->route('ageroutezones.index')
->with('success', 'Commune supprimé avec succès');
    }
    
    public function listerparlocalite($projet, $localite)
    {
        $projet = Projet::find($projet);
        
        return view('agerouteindividuelles.listerparlocalite', compact('projet', 'localite'));
    }
    
    public function candidatzone($projet, $zone)
    {
        $projet = Projet::find($projet);

        $zone_concernee = $zone;

        $individuelles = $projet->individuelles;
        
        return view('ageroutezones.candidatzone', compact('projet', 'zone_concernee', 'individuelles'));
    }

    
    public function candidatzonevalidesattente($projet, $zone)
    {
        $projet = Projet::find($projet);

        $zone_concernee = $zone;

        $individuelles = $projet->individuelles;

        return view('ageroutezones.candidatzonevalidesattente', compact('projet', 'zone_concernee', 'individuelles'));
    }
}
