<?php

namespace App\Http\Controllers;

use App\Models\Liste;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Auth;
use Carbon\Carbon;
use Dompdf\Dompdf;
use DB;


class ListeController extends Controller
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
        $listes = Liste::all();
        
        return view('listes.index',compact('listes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* $anne = Carbon::today()->format('y');

        $anne_suivant = ++$anne;

        $liste = Liste::get(); */

        $date = Carbon::parse('now');
        $date = $date->format('Y-m-d');

        $date_r = Carbon::now();
        $annee = date('y');

        $feuil = Liste::get()->last();

        if (isset($feuil)) {
            $feuil = Liste::get()->last()->numero;
                $feuil = ++$feuil;
                $feuil = $feuil;
           
        } else {
            $feuil = "0001";
            $feuil = 'Feuil'.$annee.'_'.$feuil;

        }

        return view('listes.create',compact('feuil'));
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
               
                'numero' =>  'required|string|max:50|unique:listes,numero',
            ]
        );
        $liste = new Liste([      
            'numero'           =>      $request->input('numero'),

        ]);
        
        $liste->save();
        return redirect()->route('listes.index')->with('success','enregistrement effectué avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function show(Liste $liste)
    {
        $bordereaus = $liste->bordereaus;
        
        return view('listes.feuil', compact('bordereaus','liste'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $liste = Liste::find($id);
        return view('listes.update', compact('liste','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        
        $liste = Liste::find($id);
        $liste->numero  =   $request->input('numero');

        $this->validate(
            $request, 
            [
                'numero' =>  'required|string|max:50|unique:listes,numero,'.$liste->id,
            ]);   

        $liste->save();
        return redirect()->route('listes.index')->with('success','enregistrement modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Liste  $liste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Liste $liste)
    { 
        $liste->delete();
        $message = $liste->numero.' a été supprimé(e)';
        return redirect()->route('listes.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $listes=Liste::get();
        return Datatables::of($listes)->make(true);

    }

    public function feuille($id){
        
        $liste = Liste::find($id);

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->setOptions($options);

        $dompdf->loadHtml(view('listes.feuille', compact(
            'liste'
        )));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        $anne = date('d');
        $anne = $anne.' '.date('m');
        $anne = $anne.' '.date('Y');
        $anne = $anne.' à '.date('H').'h';
        $anne = $anne.' '.date('i').'min';
        $anne = $anne.' '.date('s').'s';

        $name = $liste->numero.', Bordereau du '.$anne.'.pdf';

        // Output the generated PDF to Browser
        $dompdf->stream($name, ['Attachment' => false]);
    }
}
