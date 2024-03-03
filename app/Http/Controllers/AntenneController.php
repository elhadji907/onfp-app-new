<?php

namespace App\Http\Controllers;

use App\Models\Antenne;
use App\Models\Region;
use Illuminate\Http\Request;

class AntenneController extends Controller
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
        $antennes = Antenne::latest()->get();
        return view('antennes.index', compact('antennes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions     =   Region::pluck('nom', 'id')->all();
        return view('antennes.create', compact('regions'));
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
               
                'name' =>  'required|string|max:50|unique:antennes,name,NULL,id,deleted_at,NULL',
                'code' =>  'required|string|max:50|unique:antennes,code,NULL,id,deleted_at,NULL'
            ]
        );
        $antenne = new Antenne([
            'name'           =>      $request->input('name'),
            'code'           =>      $request->input('code'),

        ]);
        
        $antenne->save();
        $antenne->regions()->sync($request->input('regions'));
        
        return redirect()->route('antennes.index')->with('success', 'enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Antenne  $antenne
     * @return \Illuminate\Http\Response
     */
    public function show(Antenne $antenne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Antenne  $antenne
     * @return \Illuminate\Http\Response
     */
    public function edit(Antenne $antenne)
    {
        
        $antenneRegion = $antenne->regions->pluck('nom', 'nom')->all();
        $regions = Region::distinct('nom')->pluck('nom', 'id')->unique();
        
        return view('antennes.update', compact('antenne', 'regions', 'antenneRegion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Antenne  $antenne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Antenne $antenne)
    {        
        $this->validate(
            $request,
            [
                'name' =>  'required|string|unique:antennes,name,'.$antenne->id,
                'code' =>  'required|string|unique:antennes,code,'.$antenne->id
            ]
        );

        $antenne->name  =   $request->input('name');
        $antenne->code  =   $request->input('code');
        
        $antenne->regions()->sync($request->input('regions'));

        $antenne->save();

        return redirect()->route('antennes.index')->with('success', 'enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Antenne  $antenne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Antenne $antenne)
    {
        $antenne->delete();
        $message = $antenne->name.' a été supprimé(e)';
        return redirect()->route('antennes.index')->with(compact('message'));
    }
}
