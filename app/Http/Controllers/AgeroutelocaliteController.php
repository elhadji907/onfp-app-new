<?php

namespace App\Http\Controllers;

use App\Models\Localite;
use App\Models\Zone;
use App\Models\Projet;
use App\Models\Individuelle;
use App\Models\Projetslocalite;
use Illuminate\Http\Request;
use DB;

class AgeroutelocaliteController extends Controller
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

        $projet = Projet::find($projet_id);

        $localites = $projet->localites;

        /* $individuelles = $localites->individuelles; */

        /* dd($localites); */

        return view('ageroutelocalites.index', compact('projet', 'projet_name', 'localites', 'projet_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ageroutelocalites.create');
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
        'nom' => 'required|unique:localites,nom',
        ]);

        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        
        $localite = Localite::create(['nom' => $request->input('nom')]);
        $localite->projets()->sync($projet_id);

        return redirect()->route('ageroutelocalites.index')
            ->with('success', 'Département créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projet = Projet::find($projet_id);

        $localite = Localite::find($id);


        return view('ageroutelocalites.show', compact('projet', 'localite', 'projet_name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $localite = Localite::find($id);
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($projet_id);

        return view('ageroutelocalites.update', compact('localite', 'projet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
        'nom' => 'required|unique:localites,nom,'.$id
        ]);

        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $localite = Localite::find($id);
        $localite->nom = $request->input('nom');
        $localite->projets()->sync($projet_id);
        $localite->save();

        return redirect()->route('ageroutelocalites.index')
            ->with('success', 'Département modifié avec succès');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Localite  $localite
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $localite = Localite::find($id);
        $localite->projets()->detach($projet_id);
        DB::table("localites")->where('id', $id)->delete();
        /* $localite->delete(); */
        return redirect()->route('ageroutelocalites.index')
->with('success', 'Département supprimé avec succès');
    }

    public function listerparlocalite($projet, $localite)
    {
        $id_projet              = $projet;
        $id_localite            = Localite::where('nom', $localite)->first()->id;
        $projet                 = Projet::find($projet);
        $localite_concernee     = $localite;
        $individuelles          = $projet->individuelles->skip(0)->take(1000);
        
        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'attente')
                ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'rejeter')
                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'accepter')
                ->count();

        $enlever = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'enlever')
                ->count();

        $listeattante = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'liste attente')
                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->count();

        return view('agerouteindividuelles.listerparlocalite', compact('projet', 'individuelles', 'localite_concernee', 'attente', 'rejeter', 'accepter', 'total', 'enlever', 'listeattante'));
    }

    public function candidatlocalite($projet, $localite)
    {
        $projet = Projet::find($projet);

        $localite_concernee = $localite;

        $individuelles = $projet->individuelles;

        return view('ageroutelocalites.candidatlocalite', compact('projet', 'localite_concernee', 'individuelles'));
    }

    public function candidatlocalitevalides($projet, $localite)
    {
        $projet = Projet::find($projet);

        $localite_concernee = $localite;

        $individuelles = $projet->individuelles;

        return view('ageroutelocalites.candidatlocalitevalides', compact('projet', 'localite_concernee', 'individuelles'));
    }

    public function candidatlocalitevalidesattente($projet, $localite)
    {
        $projet = Projet::find($projet);

        $localite_concernee = $localite;

        $individuelles = $projet->individuelles;

        return view('ageroutelocalites.candidatlocalitevalidesattente', compact('projet', 'localite_concernee', 'individuelles'));
    }

    public function candidatzonevalides($projet, $zone)
    {
        $projet = Projet::find($projet);

        $zone_concernee = $zone;

        $individuelles = $projet->individuelles;

        return view('ageroutezones.candidatzonevalides', compact('projet', 'zone_concernee', 'individuelles'));
    }
}
