<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Demandeur']);
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $formations = Formation::all();

        /* dd($formations); */
        
        $findividuelles = \App\Models\Findividuelle::get()->count();
        $fcollectives = \App\Models\Fcollective::get()->count();

        $all_formations = Formation::get()->count();

        return view('formations.index', compact('formations','findividuelles','fcollectives','all_formations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function show(Formation $formation)
    {
        $type_formation = $formation->types_formation->name;
        $findividuelles = $formation->findividuelles;
        $fcollectives = $formation->fcollectives;

        $id_form = $formation->id;
        
        /* dd($formation); */

        if ($type_formation == "Individuelle") {
            return view('findividuelles.details', compact('formation','findividuelles','id_form'));
        } elseif ($type_formation == "Collective") {
            return view('fcollectives.details', compact('formation','fcollectives','id_form'));
        } else {
            return view('formations.show', compact('formation','id_form'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function edit(Formation $formation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formation $formation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formation  $formation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Formation $formation)
    {
        $type_formation = $formation->types_formation->name;
        $findividuelles = $formation->formations_individuelles;
        $fcollectives = $formation->formations_collectives;

        if ($type_formation == "Individuelle") {
            $findividuelles->delete();
        } elseif ($type_formation == "Collective") {
            $fcollectives->delete();
        } else {
            $formation->delete();
        }

        $formation->delete();

        $message = $type_formation.' a été supprimé(e)';
        return back()->with(compact('message'));

    }
}
