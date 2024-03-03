<?php

namespace App\Http\Controllers;

use App\Models\Interne;
use Illuminate\Http\Request;
use App\Models\TypesCourrier;
use Yajra\Datatables\Datatables;
use Auth;
use App\Models\Courrier;
use App\Models\Direction;
use App\Models\Imputation;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;
/* use App\Models\Charts\Courrierchart; */

class InterneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Courrier|Gestionnaire|Demandeur']);
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    public function index()
    {
       $date = Carbon::today()->locale('fr_FR');
       $date = $date->copy()->addDays(0);
       $date = $date->isoFormat('LLLL'); // M/D/Y
       $recues = \App\Models\Recue::get()->count();
       $internes = \App\Models\Interne::all();
       $departs = \App\Models\Depart::all();
       $courriers = \App\Models\Courrier::get()->count();
        
        return view('internes.index',compact('date','courriers', 'recues', 'internes', 'departs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TypesCourrier::get();
        // $numCourrier = date('YmdHis').rand(1,99999);
        $numCourrier = date('YmdHis');

        $date = Carbon::parse('now');
        $date = $date->format('Y-m-d');

        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');

        /* dd($date); */      
        $date_r = Carbon::now();

       /*  dd($date_r); */
       $chart      = Courrier::all();
       $chart = new Courrierchart;
       $chart->labels(['', '', '']);
       $chart->dataset('STATISTIQUES', 'bar', ['','',''])->options([
           'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
       ]);
       

        return view('internes.create', compact('numCourrier', 'date', 'directions', 'date_r','imputations','chart'));
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
                'objet'         =>  'required|string|max:100',
                'message'       =>  'required|string|max:255',
                'expediteur'    =>  'required|string|max:100',
                'adresse'       =>  'required|string|max:100',
                'telephone'     =>  'required|string|max:50',
                'email'         =>  'required|email|max:255',
                'date_recep'    =>  'required|date',
                'date_cores'    =>  'required|date',
            ]
        );
        $types_courrier_id = TypesCourrier::where('name','Courriers internes')->first()->id;
        $users_id  = Auth::user()->id;
        $courrier_id = Courrier::get()->last()->id;
        $annee = date('Y');
        $numCourrier = $courrier_id;

        $direction = \App\Models\Direction::first();
        $imputation = \App\Models\Imputation::first();
        $courrier = \App\Models\Courrier::first();
        // $filePath = request('file')->store('recues', 'public');
        $courrier = new Courrier([
            'objet'              =>      $request->input('objet'),
            'message'            =>      $request->input('message'),
            'expediteur'         =>      $request->input('expediteur'),
            'reference'          =>      $request->input('reference');
            'telephone'          =>      $request->input('telephone'),
            'email'              =>      $request->input('email'),
            'adresse'            =>      $request->input('adresse'),
            'fax'                =>      $request->input('fax'),
            'bp'                 =>      $request->input('bp'),
            'date_recep'         =>      $request->input('date_recep'),
            'date_cores'         =>      $request->input('date_cores'),
            // 'legende'            =>      $request->input('legende'),
            'types_courriers_id' =>      $types_courrier_id,
            'users_id'           =>      $users_id,
            'file'               =>      ""
        ]);

        $courrier->save();

        $interne = new Interne([
            'numero'        =>  "CD-".$annee."-".$numCourrier,
            'courriers_id'  =>   $courrier->id
        ]);
        
        $interne->save();
        
        //$courrier->directions()->sync($request->directions);
        $courrier->imputations()->sync($request->imputations);
        
        return redirect()->route('internes.index')->with('success','courrier ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interne  $interne
     * @return \Illuminate\Http\Response
     */
    public function show(Interne $interne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interne  $interne
     * @return \Illuminate\Http\Response
     */
    public function edit(Interne $interne)
    {
        
        $this->authorize('update',  $interne->courrier);

        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');

         return view('internes.update', compact('interne', 'directions','imputations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interne  $interne
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interne $interne)
    {
        
        $this->authorize('update',  $interne->courrier);

        $this->validate(
            $request, [
                'objet'         =>  'required|string|max:100',
                'message'       =>  'required|string|max:255',
                'expediteur'    =>  'required|string|max:100',
                'adresse'       =>  'required|string|max:100',
                'telephone'     =>  'required|string|max:50',
                'email'         =>  'required|email|max:255',
                'date_recep'    =>  'required|date',
                'date_cores'    =>  'required|date',
                'file'          =>  'sometimes|required|file|max:100000|mimes:pdf,doc,txt,xlsx,xls,jpeg,jpg,jif,docx,png,svg,csv,rtf,bmp',

            ]
        );

       
        if (request('file')) { 
            $filePath = request('file')->store('internes', 'public');
       $courrier = $interne->courrier; 
       $types_courrier_id = TypesCourrier::where('name','Courriers internes')->first()->id;
       $user_id  = Auth::user()->id;

       $courrier->objet              =      $request->input('objet');
       $courrier->message            =      $request->input('message');
       $courrier->expediteur         =      $request->input('expediteur');
       $courrier->reference          =      $request->input('reference');
       $courrier->telephone          =      $request->input('telephone');
       $courrier->email              =      $request->input('email');
       $courrier->adresse            =      $request->input('adresse');
       $courrier->fax                =      $request->input('fax');
       $courrier->bp                 =      $request->input('bp');
       $courrier->date_recep         =      $request->input('date_recep');
       $courrier->date_cores         =      $request->input('date_cores');
       $courrier->legende            =      $request->input('legende');
       $courrier->types_courriers_id =      $types_courrier_id;
       $courrier->users_id           =      $user_id;
       $courrier->file               =      $filePath;

       $courrier->save(); 

       $interne->courriers_id          =      $courrier->id; 

       $interne->save();
       $courrier->directions()->sync($request->input('directions'));
       //$courrier->imputations()->sync($request->input('imputations'));
        }
         else{   
            $courrier = $interne->courrier;
            $types_courrier_id = TypesCourrier::where('name','Courriers internes')->first()->id;
            $user_id  = Auth::user()->id;
     
            $courrier->objet              =      $request->input('objet');
            $courrier->message            =      $request->input('message');
            $courrier->expediteur         =      $request->input('expediteur');
            $courrier->reference          =      $request->input('reference');
            $courrier->telephone          =      $request->input('telephone');
            $courrier->email              =      $request->input('email');
            $courrier->adresse            =      $request->input('adresse');
            $courrier->fax                =      $request->input('fax');
            $courrier->bp                 =      $request->input('bp');
            $courrier->date_recep         =      $request->input('date_recep');
            $courrier->date_cores         =      $request->input('date_cores');
            $courrier->legende            =      $request->input('legende');
            $courrier->types_courriers_id =      $types_courrier_id;
            $courrier->users_id           =      $user_id;
     
            $courrier->save();
     
            $interne->courriers_id          =      $courrier->id;
     
            $interne->save();
            $courrier->directions()->sync($request->input('directions'));
            //$courrier->imputations()->sync($request->input('imputations'));
 

         }

       return redirect()->route('courriers.show', $interne->courrier->id)->with('success','courrier modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interne  $interne
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interne $interne)
    {
        
        $this->authorize('delete',  $interne->courrier);

        //$interne->courrier->directions()->detach();
        $interne->courrier->imputations()->detach();
        $interne->courrier->delete();
        $interne->delete();
        
        $message = "Le courrier enregistré sous le numéro ".$interne->numero.' a été supprimé';
        return redirect()->route('internes.index')->with(compact('message'));
    }


    public function list(Request $request)
    {
        $date = Carbon::today();
        $date = $date->copy()->addDays(-7);

        $internes=Interne::with('courrier')->where('created_at', '>=', $date)->get();
        return Datatables::of($internes)->make(true);
    }

}
