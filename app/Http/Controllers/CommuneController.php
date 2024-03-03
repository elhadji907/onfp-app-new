<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\Arrondissement;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class CommuneController extends Controller
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
        $communes = Commune::all();
        return view('communes.index', compact('communes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $arrondissements = Arrondissement::get();
        return view('communes.create', compact('arrondissements'));
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
               
                'nom'           =>  'required|string|max:50|unique:communes,nom',
                'arrondissement'   =>  'required|string',
            ]
        );
        $arrondissement_id = $request->input('arrondissement');
       /*  dd($arrondissement_id); */
        $commune = new Commune([      
            'nom'                       =>      $request->input('nom'),
            'arrondissements_id'        =>      $arrondissement_id

        ]);

        $commune->save();
        return redirect()->route('communes.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function show(Commune $commune)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function edit(Commune $commune)
    {
        $id = $commune->id;
        $arrondissement = $commune->arrondissement;
        $arrondissements = Arrondissement::get();
        
        return view('communes.update', compact('commune','arrondissements','arrondissement','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commune $commune)
    {
        $this->validate(
            $request, 
            [
                'nom'           =>  'required|string|max:50|unique:communes,nom,'.$commune->id,
                'arrondissement'   =>  'required|string'
            ]);   

        $commune->nom                   =   $request->input('nom');
        $commune->arrondissements_id    =   $request->input('arrondissement');
        $commune->save();
        return redirect()->route('communes.index')->with('success','enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commune  $commune
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commune $commune)
    {
        $commune->delete();
        $message = $commune->nom.' a été supprimé(e)';
        return redirect()->route('communes.index')->with(compact('message'));
    }
    public function list(Request $request)
    {
        $communes=Commune::with('arrondissement.departement.region')->get();
        return Datatables::of($communes)->make(true);
    }
}
