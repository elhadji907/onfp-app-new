<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use App\Models\Recue;
use App\Models\Interne;
use App\Models\Depart;
use App\Models\Direction;
use App\Models\Imputation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Models\Employee;
use App\Models\User;
use Dompdf\Dompdf;

use Illuminate\Support\Facades\Date;
use Carbon\Carbon;
/* use App\Models\Charts\Courrierchart; */

use App\Models\TypesCourrier;

class RecueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Courrier|Gestionnaire|Demandeur|ACourrier']);
        $this->middleware('permission:courrier-list|courrier-create|courrier-edit|courrier-delete', ['only' => ['index','store']]);
        $this->middleware('permission:courrier-create', ['only' => ['create','store']]);
        $this->middleware('permission:courrier-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:courrier-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $date = Carbon::today()->locale('fr_FR');
        $date = $date->copy()->addDays(0);
        $date = $date->isoFormat('LLLL'); // M/D/Y
        $recues = Recue::all();
        $internes = Interne::get()->count();
        $departs = Depart::get()->count();
        $courriers = Courrier::all();

        // $chart = new Courrierchart;
        // $chart->labels(['Départs', 'Arrivés', 'Internes']);
        // $chart->dataset('STATISTIQUES', 'bar', [$internes, $recues, $departs])->options([
        //     'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        // ]);

        return view('recues.index', compact('date', 'courriers', 'recues', 'internes', 'departs'));
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

        $directions = Direction::pluck('sigle', 'id');

        $imputations = Imputation::pluck('sigle', 'id');

        /* dd($date); */
        $date_r = Carbon::now();
        $annee = date('Y');

        /*  dd($date_r); */
        /*      $chart      = Courrier::all();
             $chart = new Courrierchart;
             $chart->labels(['', '', '']);
             $chart->dataset('STATISTIQUES', 'bar', ['','',''])->options([
                 'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
             ]);
 */

        /* $numCourrier = Courrier::get()->last()->numero; */
        $numCourrier = Recue::get()->last();
        if (isset($numCourrier)) {
            $numCourrier = Courrier::get()->last()->numero;
                $numCourrier = ++$numCourrier;
           
        } else {
            $numCourrier = "000001";

        }

        $longueur = strlen($numCourrier);

        if ($longueur <= 1) {
            $numCourrier   =   strtolower("00000".$numCourrier);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numCourrier   =   strtolower("0000".$numCourrier);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numCourrier   =   strtolower("000".$numCourrier);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numCourrier   =   strtolower("00".$numCourrier);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numCourrier   =   strtolower("0".$numCourrier);
        } else {
            $numCourrier   =   strtolower($numCourrier);
        }

        return response(view('recues.create', compact('date', 'types', 'directions', 'imputations', 'date_r', 'numCourrier', 'annee')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
                $imputation = $request->input('imputation', array());

                dd($imputation); */

            $this->validate(
                $request,
                [
                    'date_recep'    =>  'required|date',
                    'date_cores'    =>  'required|date',
                    'numero_cores'  =>  'required|string|min:4|max:6|unique:courriers,numero,Null,id,deleted_at,NULL',
                    'expediteur'    =>  'required|string|max:100',
                    'objet'         =>  'required|string|max:100',
                    'annee'         =>  'required|numeric|min:2022',
                    /* 'adresse'       =>  'required|string|max:100',
                    'telephone'     =>  'required|string|max:50',
                    'email'         =>  'required|email|max:255', */
                ]
            );

        $types_courrier_id = TypesCourrier::where('name', 'Courriers arrives')->first()->id;
        $users_id  = Auth::user()->id;

        // dd($users_id);

        //$courrier_id = Courrier::get()->last()->id;
        $courrier_id = $users_id;

        $direction = Direction::first();
        $imputation = Imputation::first();
        $courrier = Courrier::first();

        // $filePath = request('file')->store('recues', 'public');
        $courrier = new Courrier([
            'numero'             =>      $request->input('numero_cores'),
            'type'               =>      $request->input('annee'),
            'objet'              =>      $request->input('objet'),
            'observation'        =>      $request->input('observation'),
            'expediteur'         =>      $request->input('expediteur'),
            'reference'          =>      $request->input('reference'),
            'date_recep'         =>      $request->input('date_recep'),
            'date_cores'         =>      $request->input('date_cores'),
            'name'               =>      $request->input('numero_reponse'), //date reponse du courrier
            //'legende'         =>      $request->input('legende'),
            'types_courriers_id' =>      $types_courrier_id,
            'users_id'           =>      $users_id,
            'file'               =>      ""
        ]);

        $courrier->save();

        $recue = new Recue([
            /* 'numero'        =>  "CA-".$request->input('annee')."-".$request->input('numero_cores'), */
            'numero'             =>      $request->input('numero_cores'),
            'courriers_id'       =>      $courrier->id
        ]);

        $recue->save();

        //$courrier->directions()->sync($request->directions);
        $courrier->imputations()->sync($request->imputations);

        /* $direction->courriers()->attach($courrier); */

        return response(redirect()->route('recues.index')->with('success', 'courrier ajouté avec succès !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Recue  $recue
     * @return \Illuminate\Http\Response
     */
    public function show(Recue $recue)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Recue  $recue
     * @return \Illuminate\Http\Response
     */
    public function edit(Recue $recue)
    {
        /* $this->authorize('update', $recue->courrier); */

        $directions = Direction::pluck('sigle', 'id');
        $imputations = Imputation::pluck('sigle', 'id');

        /* $chart      = Courrier::all();
        $chart = new Courrierchart;
        $chart->labels(['', '', '']);
        $chart->dataset('STATISTIQUES', 'bar', ['','',''])->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        ]); */

        //dd($recue);

        //dd($directions);
        return response(view('recues.update', compact('recue', 'directions', 'imputations')));
        /*  dd($recue); */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Recue  $recue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recue $recue)
    {
        $annee = date('Y');
        /* dd($annee); */
        $annee_precedente = $request->input('annee');
        $imp = $request->input('imp');

        if (isset($imp) && $imp == "1") {
            $courrier = $recue->courrier;
            $count = count($request->product);
                $courrier->directions()->sync($request->id_direction);
                $courrier->employees()->sync($request->id_employe);
                $courrier->description =  $request->input('description');
                $courrier->date_imp    =  $request->input('date_imp');
                $courrier->save();
                return response(redirect()->route('recues.index', $recue->courrier->id)->with('success', 'Courrier imputé !'));
            
            //solution, récuper l'id à partir de blade avec le mode hidden
        }
        if($annee == $annee_precedente){
            $this->validate(
                $request,
                [
                    'date_recep'    =>  'required|date',
                    'date_cores'    =>  'required|date',
                    'numero_cores'  =>  'required|string|min:4|max:6|unique:recues,numero,'.$recue->id.',id,deleted_at,NULL',
                    'expediteur'    =>  'required|string|max:100',
                    'objet'         =>  'required|string|max:100',
                    'annee'         =>  'required|numeric|min:2022',
                    /* 'adresse'       =>  'required|string|max:100',
                    'telephone'     =>  'required|string|max:50',
                    'email'         =>  'required|email|max:255', */
                    'file'          =>  'sometimes|required|file|max:30000|mimes:pdf,doc,txt,xlsx,xls,jpeg,jpg,jif,docx,png,svg,csv,rtf,bmp|max:100000',
    
                ]
            );
        } else {
            $this->validate(
                $request,
                [
                    'date_recep'    =>  'required|date',
                    'date_cores'    =>  'required|date',
                    'numero_cores'  =>  'required|string|min:4|max:4',
                    'expediteur'    =>  'required|string|max:100',
                    'objet'         =>  'required|string|max:100',
                    'annee'         =>  'required|numeric|min:2022',
                    /* 'adresse'       =>  'required|string|max:100',
                    'telephone'     =>  'required|string|max:50',
                    'email'         =>  'required|email|max:255', */
                    'file'          =>  'sometimes|required|file|max:30000|mimes:pdf,doc,txt,xlsx,xls,jpeg,jpg,jif,docx,png,svg,csv,rtf,bmp|max:100000',
    
                ]
            );
        }

        if (request('file')) {
            $filePath = request('file')->store('recues', 'public');
            $courrier = $recue->courrier;
            $types_courrier_id = TypesCourrier::where('name', 'Courriers arrives')->first()->id;
            /* $user_id           = Auth::user()->id; */

            $user_id           = $recue->courrier->user->id;
            /* dd($user_id); */

            //dd($courrier);

            $courrier->objet              =      $request->input('objet');
            $courrier->numero             =      $request->input('numero_cores');
            $courrier->type               =      $request->input('annee');
            $courrier->observation        =      $request->input('observation');
            $courrier->expediteur         =      $request->input('expediteur');
            $courrier->date_recep         =      $request->input('date_recep');
            $courrier->reference          =      $request->input('reference');
            $courrier->date_cores         =      $request->input('date_cores');
            $courrier->types_courriers_id =      $types_courrier_id;
            $courrier->users_id           =      $user_id;
            $courrier->file               =      $filePath;
            $courrier->date_imp           =      $request->input('date_imp'); //date reponse du courrier
            $courrier->name               =      $request->input('numero_reponse'); //date reponse du courrier
            $courrier->description        =      $request->input('description');

            $courrier->save();

            /* $recue->numero                =      "CA-".$request->input('annee')."-".$request->input('numero_cores'); */
            $recue->numero                =      $request->input('numero_cores');
            $recue->courriers_id          =      $courrier->id;

            $recue->save();

            //$courrier->directions()->sync($request->input('directions'));
            $courrier->directions()->sync($request->input('directions'));
        } else {
            /*  dd($id); */
            $courrier = $recue->courrier;
            /* dd($courrier); */

            $types_courrier_id = TypesCourrier::where('name', 'Courriers arrives')->first()->id;

            /* $user_id           = Auth::user()->id; */
            $user_id           = $recue->courrier->user->id;
            /* dd($user_id); */

            $courrier->objet              =      $request->input('objet');
            $courrier->numero             =      $request->input('numero_cores');
            $courrier->type               =      $request->input('annee');
            $courrier->observation        =      $request->input('observation');
            $courrier->expediteur         =      $request->input('expediteur');
            $courrier->reference          =      $request->input('reference');
            $courrier->date_recep         =      $request->input('date_recep');
            $courrier->date_cores         =      $request->input('date_cores');
            $courrier->legende            =      $request->input('legende');
            $courrier->types_courriers_id =      $types_courrier_id;
            $courrier->users_id           =      $user_id;
            $courrier->date_imp           =      $request->input('date_imp'); //date reponse du courrier
            $courrier->name               =      $request->input('numero_reponse'); //date reponse du courrier
            $courrier->description        =      $request->input('description');

            $courrier->save();

            /* $recue->numero                =      "CA-".$request->input('annee')."-".$request->input('numero_cores'); */
            
            $recue->numero                =      $request->input('numero_cores');
            $recue->courriers_id          =      $courrier->id;

            $recue->save();

            //$courrier->directions()->sync($request->input('directions'));
            $courrier->directions()->sync($request->input('directions'));
        }

        return response(redirect()->route('recues.index', $recue->courrier->id)->with('success', 'courrier modifié avec succès !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Recue  $recue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recue $recue)
    {
        $this->authorize('delete', $recue->courrier);

        //$recue->courrier->directions()->detach();
        $recue->courrier->imputations()->detach();
        $recue->courrier->delete();
        $recue->delete();

        $message = "Le courrier enregistré sous le numéro ".$recue->numero.' a été supprimé';
        return response(redirect()->route('recues.index')->with(compact('message')));
    }

    public function list(Request $request)
    {
        /* $date = Carbon::today();
        $date = $date->copy()->addDays(-7); */

        $recues=Recue::with('courrier')->get();
        return Datatables::of($recues)->make(true);
    }

    
    
    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');

      $data = DB::table('directions')      
      ->where('sigle', 'LIKE', "%{$query}%")
        ->get();

      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $direction)
      {
        $id = $direction->id;
        $sigle = $direction->sigle;                                              
        $chef_id = $direction->chef_id;
        $chef = Employee::findOrFail($chef_id);

        $matricule = $chef->matricule;
        $employee_id = $chef_id;
        $user_id = $chef->users_id;
        $user = User::findOrFail($user_id);
        $user = $user->firstname.' '.$user->name;

       $output .= '
       
       <li data-id="'.$id.'" data-chef="'.$user.'" data-matricule="'.$matricule.'" data-employeeid="'.$employee_id.'"><a href="#">'.$sigle.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
    
    public function recuimputations($id)
    {
        $recue = Recue::find($id);
        $courrier = $recue->courrier;

        return view('recues.imputation', compact('courrier', 'recue'));
    }

     public function recufactures($id)
    {
        $recu = Recue::find($id);
        $directions     = Direction::pluck('sigle', 'id');
        
        $courrier = $recu->courrier;
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

        $dompdf->loadHtml(view('recues.coupon', compact(
            'recu',
            'courrier',
            'directions',
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
