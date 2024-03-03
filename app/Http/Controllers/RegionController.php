<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class RegionController extends Controller
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
        $regions = Region::all();
        return view('regions.index', compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('regions.create');
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
               
                'nom' =>  'required|string|max:50|unique:regions,nom,NULL,id,deleted_at,NULL',
            ]
        );
        $region = new region([
            'nom'           =>      $request->input('nom'),

        ]);
        
        $region->save();
        return redirect()->route('regions.index')->with('success', 'enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        $id = $region->id;

        return view('regions.update', compact('region', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $this->validate(
            $request,
            [
                'nom' =>  'required|string|unique:regions,nom,'.$region->id
            ]
        );

        $region->nom  =   $request->input('nom');
        $region->save();
        return redirect()->route('regions.index')->with('success', 'enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        
     /*    if (isset($region->departements) AND $region->departements != "") {
            dd($region->departements);
        } else {
            dd('ne pas supprimer');
        } */

        $region->delete();
        $message = $region->nom.' a été supprimé(e)';
        return redirect()->route('regions.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $regions=Region::with('departements.arrondissements.communes.modules')
                        ->withCount([
                        'departements',
                        'demandeurs',
                                    ])->get();
        return Datatables::of($regions)->make(true);
    }
}
