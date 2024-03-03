<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Projet;
use App\Models\Domaine;
use Illuminate\Http\Request;
use DB;

class AgeroutemoduleController extends Controller
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

        $modules = $projet->modules;

        return view('ageroutemodules.index', compact('projet', 'projet_name', 'modules', 'projet_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        
        $domaines = Domaine::distinct('name')->get()->pluck('name', 'name')->unique();

        return view('ageroutemodules.create', compact('domaines'));
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
        'module' => 'required|unique:modules,name',
        'domaine' => 'required',
        ]);

        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        
        $domaines_id = Domaine::where('name', $request->input('domaine'))->first()->id;

        $module = Module::create([
            'name'              => $request->input('module'),
            'domaines_id'       => $domaines_id
        ]);

        $module->projets()->sync($projet_id);

        return redirect()->route('ageroutemodules.index')
            ->with('success', 'module créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $modules = Module::find($id);
        $id_projet = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projets = Projet::find($id_projet);
        $individuelles = $projets->individuelles;
        
        return view('ageroutemodules.show', compact('modules', 'projets', 'projet_name', 'individuelles'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $module = Module::find($id);
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($projet_id);
        $domaines = Domaine::distinct('name')->get()->pluck('name', 'name')->unique();

        return view('ageroutemodules.update', compact('module', 'domaines'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $module = Module::find($id);

        $this->validate($request, [
        'domaine'                         => 'required',
        'module'                             => 'required|unique:modules,name,'.$module->id
        ]);

        
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $domaines_id = Domaine::where('name', $request->input('domaine'))->first()->id;

        $module->name               = $request->input('module');
        $module->domaines_id        = $domaines_id;

        $module->save();

        $module->projets()->sync($projet_id);

        return redirect()->route('ageroutemodules.index')
            ->with('success', 'Module modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $module = Module::find($id);        
        $module->projets()->detach($projet_id);
        DB::table("modules")->where('id', $id)->delete();
        return redirect()->route('ageroutemodules.index')
->with('success', 'Module supprimé avec succès');
    }

    public function candidatmodule($projet, $module)
    {
        $projet = Projet::find($projet);

        $module_concernee = $module;

        $individuelles = $projet->individuelles;


        return view('ageroutemodules.candidatmodule', compact('projet', 'module_concernee', 'individuelles'));
    }

    public function candidatmoduleaccepter($projet, $module)
    {
        $projet = Projet::find($projet);

        $module_concernee = $module;

        $individuelles = $projet->individuelles;


        return view('ageroutemodules.candidatmoduleaccepter', compact('projet', 'module_concernee', 'individuelles'));
    }

    public function candidatmoduleattente($projet, $module)
    {
        $projet = Projet::find($projet);

        $module_concernee = $module;

        $individuelles = $projet->individuelles;


        return view('ageroutemodules.candidatmoduleattente', compact('projet', 'module_concernee', 'individuelles'));
    }

    public function candidatmodulerejeter($projet, $module)
    {
        $projet = Projet::find($projet);

        $module_concernee = $module;

        $individuelles = $projet->individuelles;


        return view('ageroutemodules.candidatmodulerejeter', compact('projet', 'module_concernee', 'individuelles'));
    }

    public function candidatmodulelisteattente($projet, $module)
    {
        $projet = Projet::find($projet);

        $module_concernee = $module;

        $individuelles = $projet->individuelles;


        return view('ageroutemodules.candidatmodulelisteattente', compact('projet', 'module_concernee', 'individuelles'));
    }

}
