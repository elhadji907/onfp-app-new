<?php

namespace App\Http\Controllers;

use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use Auth;
use App\Models\Courrier;
use App\Models\Projet;
use App\Models\Direction;
use App\Models\Imputation;
use App\Models\TypesCourrier;
use App\Models\Banque;
use Illuminate\Http\Request;

class BanqueController extends Controller
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
        $banques = banque::all();
       
        return view('banques.index',compact('date', 'banques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TypesCourrier::get();
        $numCourrier = date('YmdHis');
        $date = Carbon::parse('now');
        $date = $date->format('Y-m-d');
        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');
        $date_r = Carbon::now();
        $projets = Projet::distinct('name')->get()->pluck('sigle','id')->unique();

        return view('banques.create',compact('numCourrier', 'date', 'directions','imputations', 'date_r','types','projets'));
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
                'date_dg'               =>  'required|date',
                'date_ac'               =>  'required|date',
                'numero_courrier'       =>  'required|unique:bordereaus,numero_mandat',
                'montant'               =>  'required',
                'tva'                   =>  'required',
                'observation'           =>  'required',
                'designation'           =>  'required'
            ]
        );
        
        $types_courrier_id = TypesCourrier::where('name','Banques')->first()->id;
        $user_id  = Auth::user()->id;
        $courrier_id = Courrier::get()->last()->id;
        $annee = date('Y');
        $numCourrier = $courrier_id;

        $direction = \App\Models\Direction::first();
        $imputation = \App\Models\Imputation::first();
        $courrier = \App\Models\Courrier::first();

        
        $montant            =    $request->input('montant');        
        $autres_montant     =    $request->input('autres_montant');

        $total1 = $montant + $autres_montant;

        if($request->input('tva') == "oui"){
            $tva                =    $total1*(18/100);
        }else{            
            $tva                =    "0";
        }

        $ir                 =    $request->input('ir');

        $total              =    $tva + $total1 + $ir;

        $courrier = new Courrier([
            'numero'                    =>      $request->input('numero_courrier'),
            'designation'               =>      $request->input('designation'),
            'observation'               =>      $request->input('observation'),
            'telephone'                 =>      $request->input('telephone'),    
            'montant'                   =>      $montant,
            'autres_montant'            =>      $autres_montant,
            'total'                     =>      $total,
            'email'                     =>      $request->input('email'),
            'tva'                       =>      $tva,
            'ir'                        =>      $ir,
            'types_courriers_id'        =>      $types_courrier_id,
            'users_id'                  =>      $user_id,
            'projets_id'                =>      $request->input('projet'),
        ]);

        
        $courrier->save();

        $banques = new banque([      
            'numero'                    =>      $request->input('numero_mandat'),
            'date_dg'                   =>      $request->input('date_dg'),     
            'date_ac'                   =>      $request->input('date_ac'),       
            'montant'                   =>      $montant,
            'courriers_id'              =>      $courrier->id

        ]);

        $banques->save();

        $courrier->directions()->sync($request->imputations);
        
        return redirect()->route('banques.index')->with('success','banque ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function show(Banque $banque)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function edit(Banque $banque)
    {
        /* $this->authorize('update',  $banque->courrier); */

        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');
        $projets = Projet::distinct('sigle')->get()->pluck('sigle','sigle')->unique();

         return view('banques.update', compact('banque', 'directions','imputations','projets'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banque $banque)
    {
        
        $this->validate(
            $request, [
                'date_dg'               =>  'required|date',
                'date_ac'               =>  'required|date',
                'numero_courrier'       =>  'required|unique:courriers,numero,'.$banque->courrier->id,
                'montant'               =>  'required',
                'tva'                   =>  'required',
                'observation'           =>  'required',
                'designation'           =>  'required'

            ]
        );
        
    $projet = $request->input('projet');
    $liste = $request->input('liste');
    $projet_id = Projet::where('sigle',$projet)->first()->id;
        
        $montant            =    $request->input('montant');        
        $autres_montant     =    $request->input('autres_montant');

        $total1 = $montant + $autres_montant;

        if($request->input('tva') == "oui"){
            $tva                =    $total1*(18/100);
        }else{            
            $tva                =    "0";
        }

        $ir                 =    $request->input('ir');

        $total              =    $tva + $total1 + $ir;

    if (request('file')) { 
       $filePath = request('file')->store('banques', 'public');
       $courrier = $banque->courrier; 
       $types_courrier_id = TypesCourrier::where('name','Banques')->first()->id;
       $user_id  = Auth::user()->id;

       $courrier->email                     =      $request->input('email');
       $courrier->telephone                 =      $request->input('telephone');
       $courrier->types_courriers_id        =      $types_courrier_id;
       $courrier->users_id                  =      $user_id;
       $courrier->file                      =      $filePath;
       $courrier->legende                   =      $request->input('legende');
       $courrier->adresse                   =      $request->input('adresse');
       $courrier->designation               =      $request->input('designation');
       $courrier->observation               =      $request->input('observation');
       $courrier->tva                       =      $tva;
       $courrier->ir                        =      $tva;
       $courrier->montant                   =      $montant;
       $courrier->autres_montant            =      $autres_montant;
       $courrier->total                     =      $total;
       $courrier->projets_id                =      $projet_id;
    
       $courrier->save();

       $banque->numero                     =      $request->input('numero_courrier');
       $banque->date_dg                    =      $request->input('date_dg');
       $banque->date_ac                    =      $request->input('date_ac');
       $banque->montant                    =      $montant;
       $banque->courriers_id               =      $courrier->id; 

       $banque->save();
       $courrier->directions()->sync($request->input('directions'));

        }
    else{   
        $courrier = $banque->courrier; 
        $types_courrier_id = TypesCourrier::where('name','Banques')->first()->id;
        $user_id  = Auth::user()->id;

        $courrier->email                     =      $request->input('email');
        $courrier->telephone                 =      $request->input('telephone');
        $courrier->adresse                   =      $request->input('adresse');
        $courrier->designation               =      $request->input('designation');
        $courrier->observation               =      $request->input('observation');
        $courrier->types_courriers_id        =      $types_courrier_id;
        $courrier->users_id                  =      $user_id;
        $courrier->tva                       =      $tva;
        $courrier->ir                        =      $ir;
        $courrier->montant                   =      $montant;
        $courrier->autres_montant            =      $autres_montant;
        $courrier->total                     =      $total;
        $courrier->projets_id                =      $projet_id;
    
       $courrier->save();

       $banque->numero                       =      $request->input('numero_mandat');
       $banque->date_dg                      =      $request->input('date_dg');
       $banque->date_ac                      =      $request->input('date_ac');
       $banque->montant                      =      $montant;
       $banque->courriers_id                 =      $courrier->id; 

       $banque->save();
       $courrier->directions()->sync($request->input('directions'));

         }

       return redirect()->route('courriers.show', $banque->courrier->id)->with('success','courrier modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banque  $banque
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banque $banque)
    {
        $banque->courrier->delete();
        $banque->delete();
                
        $message = 'Le courrier n° '.$banque->numero.' a été supprimé(e)';
        return redirect()->route('banques.index')->with(compact('message'));
    }
}
