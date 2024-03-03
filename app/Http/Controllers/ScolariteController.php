<?php

namespace App\Http\Controllers;

use App\Models\Scolarite;
use App\Models\Pcharge;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ScolariteController extends Controller
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
        $scolarites = Scolarite::all();

        return view('scolarites.index', compact('scolarites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scolarites.create');
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
                'annee'        =>  'required|string|max:9|unique:scolarites,annee,NULL,id,deleted_at,NULL',
            ]
        );

        $statut = "Fermé";

        $scolarite = new Scolarite([
            'annee'           =>      $request->input('annee'),
            'statut'          =>      $statut

        ]);
       
        $scolarite->save();
        return redirect()->route('scolarites.index')->with('success', 'enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function show(Scolarite $scolarite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function edit(Scolarite $scolarite)
    {
        return view('scolarites.update', compact('scolarite'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Scolarite $scolarite)
    {
        $this->validate(
            $request,
            [
                'annee'             =>  'required|string|max:9|unique:scolarites,annee,'.$scolarite->id,
                'date_debut'        =>  'required|date',
                'date_fin'          =>  'required|date',
                'statut'            =>  'required|string'
            ]
        );
        
        $scolarite->annee          =   $request->input('annee');
        $scolarite->date_debut     =   $request->input('date_debut');
        $scolarite->date_fin       =   $request->input('date_fin');
        $scolarite->statut         =   $request->input('statut');

        $scolarite->save();

        return redirect()->route('scolarites.index')->with('success', 'enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Scolarite  $scolarite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Scolarite $scolarite)
    {
        $scolarite->delete();
        $message = $scolarite->annee.' a été supprimé(e)';
        return redirect()->route('scolarites.index')->with(compact('message'));
    }

    public function countscolarite($annee)
    {
        $pcharges = Pcharge::get()->where('scolarite.annee', '=', $annee);
        $effectif = Pcharge::get()->where('scolarite.annee', '=', $annee)->count();

        $nouvelle = Pcharge::get()
                        ->where('scolarite.annee', '=', $annee)
                        ->where('typedemande', '=', 'Nouvelle demande')
                        ->count();

        $renouvelle = Pcharge::get()
                        ->where('scolarite.annee', '=', $annee)
                        ->where('typedemande', '=', 'Renouvellement')
                        ->count();

        $report = Pcharge::get()
                        ->where('scolarite.annee', '=', $annee)
                        ->where('typedemande', '=', 'Report')
                        ->count();

        return view('scolarites.countscolarite', compact('annee', 'pcharges', 'effectif', 'nouvelle', 'renouvelle', 'report'));
    }

    public function countype($type, $annee, $effectif)
    {
        $pcharges = Pcharge::get()->where('typedemande', '=', $type)->where('scolarite.annee', '=', $annee);

        $count = Pcharge::get()->where('typedemande', '=', $type)->where('scolarite.annee', '=', $annee)->count();

        $attente = Pcharge::get()->where('typedemande', '=', $type)
                                ->where('scolarite.annee', '=', $annee)
                                ->where('statut', '=', 'Attente')
                                ->count();
                                
        $accorde = Pcharge::get()->where('typedemande', '=', $type)
                                ->where('scolarite.annee', '=', $annee)
                                ->where('statut', '=', 'Accordée')
                                ->count();
                                
        $nonaccorde = Pcharge::get()->where('typedemande', '=', $type)
                                ->where('scolarite.annee', '=', $annee)
                                ->where('statut', '=', 'Non accordée')
                                ->count();

        return view('scolarites.countype', compact('annee', 'pcharges', 'effectif', 'type', 'count', 'attente', 'accorde', 'nonaccorde'));
    }

    public function accord($pcharge, $statut, $avis_dg)
    {
        $pcharge = Pcharge::find($pcharge);
        
        $pcharge->statut    =   $statut;
        $pcharge->avis_dg   =   $avis_dg;
        
        $pcharge->save();
        
        $message = "La demande de prise en charge de " .$pcharge->demandeur->user->firstname.' '.$pcharge->demandeur->user->name.' a été accordée';
        return back()->with(compact('message'));
    }

    public function nonaccord($pcharge, $statut)
    {
        $pcharge = Pcharge::find($pcharge);

        $pcharge->statut    =   $statut;
        $pcharge->avis_dg   =   '0';
        
        $pcharge->save();
        
        $message = "La demande de prise en charge de " .$pcharge->demandeur->user->firstname.' '.$pcharge->demandeur->user->name.' a été rejetée';
        return back()->with(compact('message'));
    }
}
