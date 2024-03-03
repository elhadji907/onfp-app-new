<?php

namespace App\Http\Controllers;

use App\Models\Bordereau;
use App\Models\Projet;
use App\Models\Liste;
use App\Models\Daf;
use Illuminate\Http\Request;

use Auth;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Models\Courrier;
use App\Models\Direction;
use App\Models\Imputation;
use App\Models\TypesCourrier;
use App\Models\Charts\Courrierchart;

class BordereauController extends Controller
{
        /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
  
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
        $date = Carbon::today()->locale('fr_FR');
        $date = $date->copy()->addDays(0);
        $date = $date->isoFormat('LLLL');
        $bordereaus = Bordereau::all();
       
        return view('bordereaus.index',compact('date', 'bordereaus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projets = Projet::distinct('name')->get()->pluck('sigle','id')->unique();
        $listes = Liste::distinct('numero')->get()->pluck('numero','id')->unique();
        $types = TypesCourrier::get();
        $date = Carbon::parse('now');
        $date = $date->format('Y-m-d');
        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');
        $date_r = Carbon::now();
        $annee = date('Y');

        $numCourrier = Bordereau::get()->last();
        if (isset($numCourrier)) {
            $numCourrier = Courrier::get()->last()->numero;
                $numCourrier = ++$numCourrier;
           
        } else {
            $numCourrier = "0001";

        }

        $longueur = strlen($numCourrier);

        if ($longueur <= 1) {
            $numCourrier   =   strtolower("000".$numCourrier);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numCourrier   =   strtolower("00".$numCourrier);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numCourrier   =   strtolower("0".$numCourrier);
        } else {
            $numCourrier   =   strtolower($numCourrier);
        }

        return view('bordereaus.create',compact('numCourrier', 'date', 'directions','imputations', 'date_r','projets','types','listes', 'annee'));
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
                /* 'objet'                 =>  'required|string|max:200', */
                /* 'expediteur'            =>  'required|string|max:100', */
               /*  'telephone'             =>  'required|string|max:50',
                'email'                 =>  'required|email|max:255', */
                'date_mandat'           =>     'required|date|max:10',
                'numero_mandat'         =>  'required|unique:bordereaus,numero_mandat',
                'montant'               =>  'required',
                'nombre_de_piece'       =>  'required',
                'annee'                 =>  'required|numeric|min:2022',
                'designation'           =>  'required',
                //'projet'                =>  'exists:projets,id',
            ]
        );

        $types_courrier_id = TypesCourrier::where('name','Bordereau')->first()->id;
        $user_id  = Auth::user()->id;
        /* $courrier_id = Courrier::get()->last()->id; */
       /*  $annee = date('Y'); */
        /* $numCourrier = $courrier_id; */

        $direction = \App\Models\Direction::first();
        $imputation = \App\Models\Imputation::first();
        $courrier = \App\Models\Courrier::first();

        $projet = Projet::find($request->input('projet'));

        $objet = $projet->name;

        $courrier = new Courrier([
            'numero'                    =>      $request->input('numero_cores'),
            'objet'                     =>      $objet,
            'type'                      =>      $request->input('annee'),
            'message'                   =>      $request->input('message'),
            'type'                      =>      $request->input('annee'),
            'expediteur'                =>      $request->input('expediteur'),
            'telephone'                 =>      $request->input('telephone'),
            'email'                     =>      $request->input('email'),
            'projets_id'                =>      $request->input('projet'),
            'types_courriers_id'        =>      $types_courrier_id,
            'users_id'                  =>      $user_id,
        ]);

        $courrier->save();

        $bordereaus = new Bordereau([      
            'numero'                    =>      $request->input('numero_cores'),
            'numero_mandat'             =>      $request->input('numero_mandat'),  
            'date_mandat'               =>      $request->input('date_mandat'),    
            'montant'                   =>      $request->input('montant'),
            'nombre_de_piece'           =>      $request->input('nombre_de_piece'),
            'designation'               =>      $request->input('designation'),
            'observation'               =>      $request->input('observation'),
            'listes_id'                 =>      $request->input('liste'),
            'courriers_id'              =>      $courrier->id

        ]);

        $bordereaus->save();

        /* $courrier->directions()->sync($request->imputations); */
        
        return redirect()->route('bordereaus.index')->with('success','bordereau ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bordereau  $bordereau
     * @return \Illuminate\Http\Response
     */
    public function show(Bordereau $bordereau)
    {
        
        dd("En cours de construction...");
        
        $directions = $bordereau->courrier->directions;
        $projets = Projet::distinct('sigle')->get()->pluck('sigle','sigle')->unique();
        $listes = Liste::distinct('numero')->get()->pluck('numero','numero')->unique();
        $imputations = Imputation::pluck('sigle','id');
        
        
        return view('bordereaus.imputations', compact('bordereau', 'directions','imputations', 'projets','listes'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bordereau  $bordereau
     * @return \Illuminate\Http\Response
     */
    public function edit(Bordereau $bordereau)
    {
        /* $this->authorize('update',  $bordereau->courrier); */

        $directions = Direction::pluck('sigle','id');
        $projets = Projet::distinct('sigle')->get()->pluck('sigle','sigle')->unique();
        $listes = Liste::distinct('numero')->get()->pluck('numero','numero')->unique();
        $imputations = Imputation::pluck('sigle','id');

         return view('bordereaus.update', compact('bordereau', 'directions','imputations', 'projets','listes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bordereau  $bordereau
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bordereau $bordereau)
    {
        $this->validate(
            $request, [
               /*  'objet'                 =>  'required|string|max:200', */
                /* 'expediteur'            =>  'required|string|max:100', */
                /* 'telephone'             =>  'required|string|max:50',
                'email'                 =>  'required|email|max:255', */
                'numero_mandat'         =>  'required|string|max:30|unique:bordereaus,numero_mandat,'.$bordereau->id,
                'montant'               =>  'required',
                'nombre_de_piece'       =>  'required',
                'designation'           =>  'required',

            ]
        );

    $projet = $request->input('projet');
    $liste = $request->input('liste');
    $projet_id = Projet::where('sigle',$projet)->first()->id;
    $liste_id = Liste::where('numero',$liste)->first()->id;
        
    if (request('file')) { 
       $filePath = request('file')->store('bordereaus', 'public');
       $courrier = $bordereau->courrier; 
       $types_courrier_id = TypesCourrier::where('name','Bordereau')->first()->id;
       $user_id  = Auth::user()->id;

       $courrier->numero                    =      $request->input('numero_cores');
       $courrier->type                      =      $request->input('annee');
       $courrier->objet                     =      $projet;
       $courrier->message                   =      $request->input('message');
       $courrier->expediteur                =      $request->input('expediteur');
       $courrier->email                     =      $request->input('email');
       $courrier->telephone                 =      $request->input('telephone');
       $courrier->types_courriers_id        =      $types_courrier_id;
       $courrier->projets_id                =      $projet_id;
       $courrier->users_id                  =      $user_id;
       $courrier->file                      =      $filePath;
       $courrier->legende                   =      $request->input('legende');
    
       $courrier->save();

       $bordereau->numero                   =      $request->input('numero_cores');
       $bordereau->numero_mandat            =      $request->input('numero_mandat');
       $bordereau->date_mandat              =      $request->input('date_mandat');
       $bordereau->montant                  =      $request->input('montant');
       $bordereau->nombre_de_piece          =      $request->input('nombre_de_piece');
       $bordereau->date_mandat              =      $request->input('date_mandat');
       $bordereau->nombre_de_piece          =      $request->input('nombre_de_piece');
       $bordereau->designation              =      $request->input('designation');
       $bordereau->observation              =      $request->input('observation');
       $bordereau->courriers_id             =      $courrier->id; 
       $bordereau->listes_id                =      $liste_id;

       $bordereau->save();
       
       $courrier->directions()->sync($request->input('directions'));

        }
    else{   
        $courrier = $bordereau->courrier; 
        $types_courrier_id = TypesCourrier::where('name','Bordereau')->first()->id;
        $user_id  = Auth::user()->id;

       $courrier->numero                    =      $request->input('numero_cores');
       $courrier->objet                     =      $projet;
       $courrier->message                   =      $request->input('message');
       $courrier->expediteur                =      $request->input('expediteur');
       $courrier->email                     =      $request->input('email');
       $courrier->telephone                 =      $request->input('telephone');
       $courrier->types_courriers_id        =      $types_courrier_id;
       $courrier->projets_id                =      $projet_id;
       $courrier->users_id                  =      $user_id;
    
       $courrier->save();

       $bordereau->numero                   =      $request->input('numero_cores');
       $bordereau->numero_mandat            =      $request->input('numero_mandat');
       $bordereau->date_mandat              =      $request->input('date_mandat');
       $bordereau->montant                  =      $request->input('montant');
       $bordereau->nombre_de_piece          =      $request->input('nombre_de_piece');
       $bordereau->date_mandat              =      $request->input('date_mandat');
       $bordereau->nombre_de_piece          =      $request->input('nombre_de_piece');
       $bordereau->designation              =      $request->input('designation');
       $bordereau->observation              =      $request->input('observation');
       $bordereau->courriers_id             =      $courrier->id; 
       $bordereau->listes_id                =      $liste_id;

       $bordereau->save();

       
       $courrier->directions()->sync($request->input('directions'));

         }
         
       return redirect()->route('bordereaus.index', $bordereau->courrier->id)->with('success','Bordereau modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bordereau  $bordereau
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bordereau $bordereau)
    {
        $bordereau->courrier->delete();
        $bordereau->delete();
                
        $message = 'Le bordereau n° '.$bordereau->numero_mandat.' a été supprimé(e)';
        return redirect()->route('bordereaus.index')->with(compact('message'));
    }
}
