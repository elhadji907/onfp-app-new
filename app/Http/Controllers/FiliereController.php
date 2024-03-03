<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FiliereController extends Controller
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
        $filieres = Filiere::all();
        return view('filieres.index', compact('filieres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('filieres.create');
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
               
                'name' =>  'required|string|max:50|unique:filieres,name',
            ]
        );
        $filiere = new Filiere([      
            'name'           =>      $request->input('name'),

        ]);
        
        $filiere->save();

        return redirect()->route('filieres.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function show(Filiere $filiere)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function edit(Filiere $filiere)
    {
        return view('filieres.update', compact('filiere'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filiere $filiere)
    {
        $this->validate(
            $request, 
            [
                'name' =>  "required|string|max:50|unique:filieres,name,{$filiere->id},id,deleted_at,NULL"
            ]);   

        $filiere->name  =   $request->input('name');

        $filiere->save();

        return redirect()->route('filieres.index')->with('success','enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filiere $filiere)
    {
        $filiere->delete();
        $message = $filiere->name.' a été supprimé(e)';
        return redirect()->route('filieres.index')->with(compact('message'));
    }
    
    public function list(Request $request)
    {
        $filieres=Filiere::withCount('pcharges')->get();
        return Datatables::of($filieres)->make(true);
    }
}
