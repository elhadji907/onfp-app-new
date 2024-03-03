<?php

namespace App\Http\Controllers;

use App\Models\Depart;
use Illuminate\Http\Request;
use App\Models\TypesCourrier;
use Yajra\Datatables\Datatables;
use App\Models\Direction;
use App\Models\Imputation;
use Auth;
use App\Models\Courrier;
/* use App\Models\Charts\Courrierchart; */

use Illuminate\Support\Facades\Date;
use Carbon\Carbon;
use Dompdf\Dompdf;

class DepartController extends Controller
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
    public function index()
    {
       $date = Carbon::today()->locale('fr_FR');
       $date = $date->copy()->addDays(0);
       $date = $date->isoFormat('LLLL'); // M/D/Y
       $recues = \App\Models\Recue::get()->count();
       $internes = \App\Models\Interne::get()->count();
       $departs = \App\Models\Depart::all();
       $courriers = \App\Models\Courrier::get()->count();
              
        return view('departs.index',compact('date','courriers', 'recues', 'internes', 'departs'));
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
        //$numCourrier = date('YmdHis');

        $date = Carbon::parse('now');
        $date = $date->format('Y-m-d');
        $annee = date('Y');

        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');

        /* dd($date); */      
        $date_r = Carbon::now();

        /* $numCourrier = Courrier::get()->last()->numero; */
        $numCourrier = Depart::get()->last();
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
       
        return view('departs.create', compact('numCourrier', 'date', 'directions','imputations', 'date_r', 'annee'));
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
                'numero_ordre'    =>  'required|string|min:4|max:6|unique:departs,numero,Null,id,deleted_at,NULL',
                'nbre_pieces'     =>  'required|numeric',
                'annee'           =>  'required|numeric|min:2022',
                'destinataire'    =>  'required|string|max:100',
                'objet'           =>  'required|string|max:200',
                'numero_archive'  =>  'required|string|min:4|max:6|unique:courriers,num_bord,Null,id,deleted_at,NULL',
                'date_depart'     =>  'required|date',
            ]
        );
       /*  $types_courrier_id = TypesCourrier::where('name','Courriers departs')->first()->id;
        $user_id  = Auth::user()->id;
        $courrier_id = Courrier::get()->last()->id;
        $annee = date('Y');
        $numCourrier = $courrier_id; */

        $types_courrier_id = TypesCourrier::where('name', 'Courriers departs')->first()->id;
        $users_id  = Auth::user()->id;

        // dd($users_id);

        //$courrier_id = Courrier::get()->last()->id;
        $courrier_id = $users_id;

        $direction = \App\Models\Direction::first();
        $imputation = \App\Models\Imputation::first();
        $courrier = \App\Models\Courrier::first();
        // $filePath = request('file')->store('recues', 'public');


   /*      $numero_archive = $request->input('numero_archive');
        $longueur = strlen($numero_archive);

        if ($longueur <= 1) {
            $numero_archive   =   strtolower("00000".$numero_archive);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero_archive   =   strtolower("0000".$numero_archive);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero_archive   =   strtolower("000".$numero_archive);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero_archive   =   strtolower("00".$numero_archive);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numero_archive   =   strtolower("0".$numero_archive);
        } else {
            $numero_archive   =   strtolower($numero_archive);
        }
 */
        $courrier = new Courrier([
            'numero'             =>      $request->input('numero_ordre'),
            'nb_pc'              =>      $request->input('nbre_pieces'),
            'type'               =>      $request->input('annee'),
            'date_imp'           =>      $request->input('date_imp'), //date depart
            'date_depart'        =>      $request->input('date_depart'), 
            'objet'              =>      $request->input('objet'),
            'num_bord'           =>      $request->input('numero_archive'), //numéro archive
            'observation'        =>      $request->input('observation'),
            'reference'          =>      $request->input('reference'),
            'types_courriers_id' =>      $types_courrier_id,
            'users_id'           =>      $users_id,
            'file'               =>      ""
        ]);

        $courrier->save();

        $depart = new Depart([
            /* 'numero'            =>  "CD-".$request->input('annee')."-".$request->input('numero_ordre'), */
            'numero'            =>   $request->input('numero_ordre'),
            'destinataire'      =>   $request->input('destinataire'),
            'courriers_id'      =>   $courrier->id
        ]);
        
        $depart->save();
        
        //$courrier->directions()->sync($request->directions);
        $courrier->directions()->sync($request->imputations);
        
        return redirect()->route('departs.index')->with('success','courrier ajouté avec succès !');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Depart  $depart
     * @return \Illuminate\Http\Response
     */
    public function show(Depart $depart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Depart  $depart
     * @return \Illuminate\Http\Response
     */
    public function edit(Depart $depart)
    {
        
        $this->authorize('update',  $depart->courrier);

        $directions = Direction::pluck('sigle','id');
        $imputations = Imputation::pluck('sigle','id');

         return view('departs.update', compact('depart', 'directions','imputations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Depart  $depart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Depart $depart)
    {
        $this->authorize('update',  $depart->courrier);

        $imp = $request->input('imp');

        if (isset($imp) && $imp == "1") {
            $courrier = $depart->courrier;
            $count = count($request->product);
                $courrier->directions()->sync($request->id_direction);
                $courrier->employees()->sync($request->id_employe);
                $courrier->description =  $request->input('description');
                $courrier->date_imp    =  $request->input('date_imp'); 
                $courrier->save();
                return redirect()->route('departs.index', $depart->courrier->id)->with('success', 'Courrier imputé !');
            
            //solution, récuper l'id à partir de blade avec le mode hidden
        }


        $this->validate(
            $request, [
                'annee'           =>  'required|numeric|min:2022',
                'numero_ordre'    =>  'required|string|min:4|max:6|unique:departs,numero,'.$depart->id.',id,deleted_at,NULL',
                'nbre_pieces'     =>  'required|numeric',
                'destinataire'    =>  'required|string|max:100',
                'objet'           =>  'required|string|max:200',
                'numero_archive'  =>  'required|string|min:4|max:6|unique:courriers,num_bord,'.$depart->courrier->id.',id,deleted_at,NULL',
                'date_depart'     =>  'required|date',
                'file'            =>  'sometimes|required|file|max:30000|mimes:pdf,doc,txt,xlsx,xls,jpeg,jpg,jif,docx,png,svg,csv,rtf,bmp',

            ]
        );

        $numero_archive = $request->input('numero_archive');
        $longueur = strlen($numero_archive);

        
        if ($longueur <= 1) {
            $numero_archive   =   strtolower("000".$numero_archive);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero_archive   =   strtolower("00".$numero_archive);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero_archive   =   strtolower("0".$numero_archive);
        } else {
            $numero_archive   =   strtolower($numero_archive);
        }
        
    if (request('file')) { 
       $filePath = request('file')->store('departs', 'public');
       $courrier = $depart->courrier; 
       $types_courrier_id = TypesCourrier::where('name','Courriers departs')->first()->id;
       $user_id  = Auth::user()->id;

       $courrier->type               =      $request->input('annee');
       $courrier->numero             =      $request->input('numero_ordre');
       $courrier->nb_pc              =      $request->input('nbre_pieces');
       $courrier->date_imp           =      $request->input('date_imp'); 
       $courrier->date_depart        =      $request->input('date_depart'); 
       $courrier->objet              =      $request->input('objet');
       $courrier->num_bord           =      $numero_archive;
       $courrier->observation        =      $request->input('observation');
       $courrier->description        =      $request->input('description');
       $courrier->reference          =      $request->input('reference');

       $courrier->types_courriers_id =      $types_courrier_id;
       $courrier->users_id           =      $user_id;
       $courrier->file               =      $filePath;

       $courrier->save(); 

       $depart->courriers_id          =      $courrier->id; 
       $depart->numero                 =      $request->input('numero_ordre');
       $depart->destinataire          =      $request->input('destinataire'); 

       $depart->save();
       //$courrier->directions()->sync($request->input('directions'));
       $courrier->imputations()->sync($request->input('imputations'));
        }
         else{   
            $courrier = $depart->courrier;
            $types_courrier_id = TypesCourrier::where('name','Courriers departs')->first()->id;
            $user_id  = Auth::user()->id;
     
       
            $courrier->type               =      $request->input('annee');
            $courrier->numero             =      $request->input('numero_ordre');
            $courrier->nb_pc              =      $request->input('nbre_pieces');
            $courrier->date_depart        =      $request->input('date_depart'); 
            $courrier->date_imp           =      $request->input('date_imp');
            $courrier->objet              =      $request->input('objet');
            $courrier->num_bord           =      $request->input('numero_archive');
            $courrier->observation        =      $request->input('observation');
            $courrier->description        =      $request->input('description');
            $courrier->reference          =      $request->input('reference');
     
            $courrier->types_courriers_id =      $types_courrier_id;
            $courrier->users_id           =      $user_id;
     
            $courrier->save();
     
            $depart->courriers_id          =      $courrier->id;
            $depart->numero                =      $request->input('numero_ordre');
            $depart->destinataire          =      $request->input('destinataire'); 
    
            $depart->save();
            //$courrier->directions()->sync($request->input('directions'));
            $courrier->directions()->sync($request->input('directions'));
 
         }

       return redirect()->route('departs.index', $depart->courrier->id)->with('success','courrier modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Depart  $depart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Depart $depart)
    {

        $this->authorize('delete',  $depart->courrier);

        $depart->courrier->directions()->detach();
        $depart->courrier->imputations()->detach();
        $depart->courrier->delete();
        $depart->delete();
        
        $message = "Le courrier enregistré sous le numéro ".$depart->numero.' a été supprimé';
        return redirect()->route('departs.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $date = Carbon::today();
        $date = $date->copy()->addDays(-7);

        $departs=Depart::with('courrier')->where('created_at', '>=', $date)->get();
        return Datatables::of($departs)->make(true);
    }

    
    public function departimputations($id)
    {
        $depart = Depart::find($id);
        $courrier = $depart->courrier;

        return view('departs.imputation', compact('courrier', 'depart'));
    }

    public function departfactures($id)
    {
        $depart = Depart::find($id);
        $courrier = $depart->courrier;
        $numero = $courrier->numero;
      
        $title =' Coupon d\'envoi n° '.$numero;

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->setOptions($options);

        $actions = [
            'Urgent',
            'M\'en parler',
            'Etudes et Avis',
            'Répondre',
            'Suivi',
            'Information',
            'Diffusion',
            'Attribution',
            'Classement',
            ];

        $dompdf->loadHtml(view('departs.coupon', compact(
            'depart',
            'courrier',
            'title',
            'actions'
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

        $name = $courrier->expediteur.', facture n° '.$numero.' du '.$anne.'.pdf';

        // Output the generated PDF to Browser
        $dompdf->stream($name, ['Attachment' => false]);

    }
}
