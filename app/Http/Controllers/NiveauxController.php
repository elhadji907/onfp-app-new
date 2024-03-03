<?php

namespace App\Http\Controllers;

use App\Models\Niveaux;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class NiveauxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('niveauxs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('niveauxs.create');
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
               
                'name' =>  'required|string|max:50|unique:niveauxs,name',
            ]
        );
        $niveaux = new Niveaux([      
            'name'           =>      $request->input('name'),

        ]);
        
        $nivaux->save();
        return redirect()->route('niveauxs.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Niveaux  $niveaux
     * @return \Illuminate\Http\Response
     */
    public function show(Niveaux $niveaux)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Niveaux  $niveaux
     * @return \Illuminate\Http\Response
     */
    public function edit(Niveaux $niveaux)
    {
        return view('niveauxs.update', compact('niveaux'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Niveaux  $niveaux
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Niveaux $niveaux)
    {
        $this->validate(
            $request, 
            [
                'name' =>  'required|string|max:50'
            ]);   

        $niveaux->name  =   $request->input('name');
        $niveaux->save();
        return redirect()->route('niveauxs.index')->with('success','enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Niveaux  $niveaux
     * @return \Illuminate\Http\Response
     */
    public function destroy(Niveaux $niveaux)
    {
        $niveaux->delete();
        $message = $niveaux->name.' a été supprimé(e)';
        return redirect()->route('niveauxs.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $niveaux=Niveaux::get();
        return Datatables::of($niveaux)->make(true);
    }
}
