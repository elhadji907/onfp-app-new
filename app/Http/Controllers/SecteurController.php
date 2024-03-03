<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Secteur;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SecteurController extends Controller
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
        return view('secteurs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('secteurs.create');
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
               
                'name' =>  'required|string|max:50|unique:secteurs,name',
            ]
        );
        $secteur = new Secteur([      
            'name'           =>      $request->input('name'),

        ]);
        
        $secteur->save();
        return redirect()->route('secteurs.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function show(Secteur $secteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Secteur $secteur)
    {
        return view('secteurs.update', compact('secteur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secteur $secteur)
    {       
        $this->validate(
            $request, 
            [
                'name' =>  "required|string|max:50|unique:secteurs,name,{$secteur->id},id,deleted_at,NULL"
            ]);   

        $secteur->name  =   $request->input('name');
        $secteur->save();
        return redirect()->route('secteurs.index')->with('success','enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secteur $secteur)
    {
        $secteur->delete();
        $message = $secteur->name.' a été supprimé(e)';
        return redirect()->route('secteurs.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $secteurs=Secteur::get();
        return Datatables::of($secteurs)->make(true);
    }
}
