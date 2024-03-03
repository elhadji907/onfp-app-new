<?php

namespace App\Http\Controllers;

use App\Models\Arrondissement;
use App\Models\Departement;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class ArrondissementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Gestionnaire|SAOS|ASAOS']);
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrondissements = Arrondissement::all();
        return view('arrondissements.index', compact('arrondissements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departements = Departement::get();
        return view('arrondissements.create', compact('departements'));
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
            $request, [
               
                'nom'           =>  'required|string|max:50|unique:arrondissements,nom',
                'departement'   =>  'required|string',
            ]
        );
        $departement_id = $request->input('departement');
       /*  dd($departement_id); */
        $arrondissement = new Arrondissement([      
            'nom'                   =>      $request->input('nom'),
            'departements_id'       =>      $departement_id

        ]);

        $arrondissement->save();
        return redirect()->route('arrondissements.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arrondissement  $arrondissement
     * @return \Illuminate\Http\Response
     */
    public function show(Arrondissement $arrondissement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Arrondissement  $arrondissement
     * @return \Illuminate\Http\Response
     */
    public function edit(Arrondissement $arrondissement)
    {
        $id = $arrondissement->id;
        $departement = $arrondissement->departement;
        $departements = Departement::get();
        
        return view('arrondissements.update', compact('arrondissement','departements','departement','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arrondissement  $arrondissement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arrondissement $arrondissement)
    {
        $this->validate(
            $request, 
            [
                'nom'           =>  'required|string|max:50|unique:arrondissements,nom,'.$arrondissement->id,
                'departement'   =>  'required|string'
            ]);   

        $arrondissement->nom            =   $request->input('nom');
        $arrondissement->departements_id   =   $request->input('departement');
        $arrondissement->save();
        return redirect()->route('arrondissements.index')->with('success','enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arrondissement  $arrondissement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arrondissement $arrondissement)
    {        
        $arrondissement->delete();
        $message = $arrondissement->nom.' a été supprimé(e)';
        return redirect()->route('arrondissements.index')->with(compact('message'));
    }
    
    public function list(Request $request)
    {
        $arrondissements=Arrondissement::with('departement.region')->withCount('communes')->get();
        return Datatables::of($arrondissements)->make(true);
    }
}
