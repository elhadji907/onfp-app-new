<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use App\Models\Ingenieur;
use App\Models\Localite;
use App\Models\Zone;
use App\Models\Module;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use DB;

class ProjetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projets = Projet::all();

        return view('projets.index', compact('projets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $localite = Localite::get();
        $zone = Zone::get();
        $module = Module::get();
        /* $ingenieurs = Ingenieur::distinct('name')->get()->pluck('name', 'name')->unique(); */
        $ingenieur = Ingenieur::get();

        return view('projets.create', compact('ingenieur', 'localite', 'zone', 'module'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'          =>  'required|string|max:200|unique:projets,name',
                'sigle'         =>  'required|string|max:20|unique:projets,sigle',
                'localite'      => 'required',
                'budjet_lettre' => 'required',
                'budjet'        => 'required',
                'zone'          => 'required',
                'module'        => 'required',
                'description'   => 'required',
                'debut'         =>  'date',
                'fin'           =>  'date',
                'date_signature'=>  'date',
            ]
        );
        
        $budjet = $request->input('budjet');
        $budjet = str_replace(' ', '', $budjet);

        $projet = new Projet([
            'name'              =>      $request->input('name'),
            'sigle'             =>      $request->input('sigle'),
            'description'       =>      $request->input('description'),
            'date_signature'    =>      $request->input('date_signature'),
            'debut'             =>      $request->input('debut'),
            'fin'               =>      $request->input('fin'),
            'budjet_lettre'     =>      $request->input('budjet_lettre'),
            'budjet'            =>      $budjet,

        ]);
        
        $projet->save();
        
        $projet->localites()->sync($request->input('localite'));
        $projet->zones()->sync($request->input('zone'));
        $projet->modules()->sync($request->input('module'));
        $projet->ingenieurs()->sync($request->input('ingenieur'));

        return redirect()->route('projets.index')->with('success', 'enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $projet = Projet::find($id);

        $projetLocalites = Localite::join("projetslocalites", "projetslocalites.localites_id", "=", "localites.id")
        ->where("projetslocalites.projets_id", $id)
        ->get();
        
        $projetZones = Zone::join("projetszones", "projetszones.zones_id", "=", "zones.id")
        ->where("projetszones.projets_id", $id)
        ->get();

        $projetModules = Module::join("projetsmodules", "projetsmodules.modules_id", "=", "modules.id")
        ->where("projetsmodules.projets_id", $id)
        ->get();

        $projetIngenieurs = Ingenieur::join("projetsingenieurs", "projetsingenieurs.ingenieurs_id", "=", "ingenieurs.id")
        ->where("projetsingenieurs.projets_id", $id)
        ->get();

        return view('projets.show', compact('projet', 'projetLocalites', 'projetZones', 'projetModules', 'projetIngenieurs'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projet = Projet::find($id);
        $localite = Localite::get();
        $zone = Zone::get();
        $module = Module::get();
        $ingenieur = Ingenieur::get();
        
        $projetIngenieurs = DB::table("projetsingenieurs")->where("projetsingenieurs.projets_id", $id)
        ->pluck('projetsingenieurs.ingenieurs_id', 'projetsingenieurs.ingenieurs_id')
        ->all();

        $projetLocalites = DB::table("projetslocalites")->where("projetslocalites.projets_id", $id)
        ->pluck('projetslocalites.localites_id', 'projetslocalites.localites_id')
        ->all();

        $projetZones = DB::table("projetszones")->where("projetszones.projets_id", $id)
        ->pluck('projetszones.zones_id', 'projetszones.zones_id')
        ->all();

        $projetModules = DB::table("projetsmodules")->where("projetsmodules.projets_id", $id)
        ->pluck('projetsmodules.modules_id', 'projetsmodules.modules_id')
        ->all();

        return view('projets.update', compact('projet', 'localite', 'projetLocalites', 'projetZones', 'zone', 'projetIngenieurs', 'projetModules', 'module', 'ingenieur'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Projet $projet)
    {
        $this->validate(
            $request,
            [
                'name'          =>  'required|string|max:200|unique:projets,name,'.$projet->id,
                'sigle'         =>  'required|string|max:20|unique:projets,sigle,'.$projet->id,
                'localite'      => 'required',
                'budjet_lettre' => 'required',
                'budjet'        => 'required',
                'zone'          => 'required',
                'module'        => 'required',
                'description'   => 'required',
                'debut'         =>  'date',
                'fin'           =>  'date',
                'date_signature'=>  'date',
            ]
        );

        $budjet = $request->input('budjet');
        $budjet = str_replace(' ', '', $budjet);

        $projet->name           =   $request->input('name');
        $projet->sigle          =   $request->input('sigle');
        $projet->description    =   $request->input('description');
        $projet->debut          =   $request->input('debut');
        $projet->fin            =   $request->input('fin');
        $projet->budjet_lettre  =   $request->input('budjet_lettre');
        $projet->budjet         =   $budjet;

        $projet->save();
        
        $projet->localites()->sync($request->input('localite'));
        $projet->zones()->sync($request->input('zone'));
        $projet->modules()->sync($request->input('module'));
        $projet->ingenieurs()->sync($request->input('ingenieur'));

        return redirect()->route('projets.index')->with('success', 'enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Projet  $projet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Projet $projet)
    {
        $projet->delete();
        $message = "Le projet ".$projet->name." a été supprimé avec succès";
        return redirect()->route('projets.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $projets=Projet::get();
        return Datatables::of($projets)->make(true);
    }
}
