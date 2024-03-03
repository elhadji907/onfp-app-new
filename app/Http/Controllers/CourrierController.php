<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use App\Models\Recue;
use App\Models\User;
use App\Models\TypesCourrier;
use Illuminate\Http\Request;

use Yajra\Datatables\Datatables;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\DB;

class CourrierController extends Controller
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
        $this->middleware('permission:courrier-list|courrier-create|courrier-edit|courrier-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:courrier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:courrier-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:courrier-delete', ['only' => ['destroy']]);
    }

    public function index()
    {

        $recues = Recue::get()->count();
        $internes = \App\Models\Interne::get()->count();
        $departs = \App\Models\Depart::get()->count();
        $bordereaus = \App\Models\Bordereau::get()->count();
        $facturesdafs = \App\Models\Facturesdaf::get()->count();
        $tresors = \App\Models\Tresor::get()->count();
        $banques = \App\Models\Banque::get()->count();

        $courrier = Courrier::get()->count();

        $courriers = Courrier::all();

        $pieChart = app()->chartjs
            ->name('pieChart')
            ->type('pie')
            ->size(['width' => 400, 'height' => 200])
            ->labels(['Courriers arrivés', 'Courriers départs', 'Courriers internes', 'Bordereau'])
            ->datasets([
                [
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#7bb13c', '#6384ff'],
                    'hoverBackgroundColor' => ['#FF6384', '#36A2EB', '#7bb13c', '#6384ff'],
                    'data' => [$recues, $departs, $internes, $bordereaus]
                ]
            ])
            ->options([]);


        /*    $chart      = Courrier::all();

        $chart = new Courrierchart;
        $chart->labels(['Courriers départs', 'Courriers arrivés', 'Courriers internes']);
        $chart->dataset('STATISTIQUES', 'bar', [$internes, $recues, $departs])->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        ]); */

        return response(view('courriers.index', compact('courriers', 'courrier', 'recues', 'internes', 'departs', 'bordereaus', 'facturesdafs', 'tresors', 'pieChart')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $recues = Recue::get()->count();
        $internes = \App\Models\Interne::get()->count();
        $departs = \App\Models\Depart::get()->count();
        $courriers = Courrier::get()->count();
        $demandes = \App\Models\Demandeur::get()->count();
        $bordereaus = \App\Models\Bordereau::get()->count();
        $facturesdafs = \App\Models\Facturesdaf::get()->count();
        $tresors = \App\Models\Tresor::get()->count();
        $banques = \App\Models\Banque::get()->count();



        return response(view('courriers.create', compact('courriers', 'recues', 'demandes', 'internes', 'departs', 'bordereaus', 'facturesdafs', 'tresors')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Http\Response
     */
    public function show(Courrier $courrier)
    {
        $typescourrier = $courrier->types_courrier->name;
        // dd($typescourrier); 

        $recues = $courrier->recues;
        $departs = $courrier->departs;
        $internes = $courrier->internes;
        $bordereaus = $courrier->bordereaus;
        $facturesdafs = $courrier->facturesdafs;
        $tresors = $courrier->tresors;
        $banques = $courrier->banques;

        $chart      = Courrier::all();


        $recue = Recue::get()->count();
        $interne = \App\Models\Interne::get()->count();
        $depart = \App\Models\Depart::get()->count();

        /*     $chart = new Courrierchart;
        $chart->labels(['Départs', 'Arrivés', 'Internes']);
        $chart->dataset('STATISTIQUES', 'bar', [$interne, $recue, $depart])->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        ]); */
        if ($typescourrier == 'Courriers arrives') {
            return response(view('recues.show', compact('recues', 'courrier')));
        } elseif ($typescourrier == 'Courriers departs') {
            return response(view('departs.show', compact('departs', 'courrier')));
        } elseif ($typescourrier == 'Courriers internes') {
            return response(view('internes.show', compact('internes', 'courrier')));
        } elseif ($typescourrier == 'Bordereau') {
            return response(view('bordereaus.show', compact('bordereaus', 'courrier')));
        } elseif ($typescourrier == 'Tresors') {
            return response(view('tresors.show', compact('tresors', 'courrier')));
        } elseif ($typescourrier == 'Factures daf') {
            return response(view('facturesdafs.show', compact('facturesdafs', 'courrier')));
        } elseif ($typescourrier == 'Banques') {
            return response(view('banques.show', compact('banques', 'courrier')));
        } else {
            return response(view('courriers.show', compact('courrier')));
        }
    }


    public function showFromNotification(Courrier $courrier, DatabaseNotification $notification)
    {

        $notification->markAsRead();

        $typescourrier = $courrier->types_courrier->name;
        $recues = $courrier->recues;
        $departs = $courrier->departs;
        $internes = $courrier->internes;
        $bordereaus = $courrier->bordereaus;
        $facturesdafs = $courrier->facturesdafs;
        $tresors = $courrier->tresors;
        $banques = $courrier->banques;
        // $demandes = $courrier->demandeurs;

        $recue = Recue::get()->count();
        $interne = \App\Models\Interne::get()->count();
        $depart = \App\Models\Depart::get()->count();

        $chart      = Courrier::all();

        /*    $chart = new Courrierchart;
        $chart->labels(['Départs', 'Arrivés', 'Internes']);
        $chart->dataset('STATISTIQUES', 'bar', [$interne, $recue, $depart])->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        ]); */
        // dd($typescourrier);
        if ($typescourrier == 'Courriers arrives') {
            return response(view('recues.show', compact('recues', 'courrier')));
        } elseif ($typescourrier == 'Courriers departs') {
            return response(view('departs.show', compact('departs', 'courrier')));
        } elseif ($typescourrier == 'Courriers internes') {
            return response(view('internes.show', compact('internes', 'courrier')));
        } elseif ($typescourrier == 'Bordereau') {
            return response(view('bordereaus.show', compact('bordereaus', 'courrier')));
        } elseif ($typescourrier == 'Factures daf') {
            return response(view('facturesdafs.show', compact('facturesdafs', 'courrier')));
        } elseif ($typescourrier == 'Tresors') {
            return response(view('tresors.show', compact('tresors', 'courrier')));
        } elseif ($typescourrier == 'Banques') {
            return response(view('banques.show', compact('banques', 'courrier')));
        } else {
            return response(view('courriers.show', compact('courrier')));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Http\Response
     */
    public function edit(Courrier $courrier)
    {
        //    dd($courrier);
        $typescourrier = $courrier->types_courrier->name;
        //dd($typescourrier);

        $recues = $courrier->recues;
        $departs = $courrier->departs;
        $internes = $courrier->internes;
        $bordereaus = $courrier->bordereaus;
        $facturesdafs = $courrier->facturesdafs;
        $tresors = $courrier->tresors;
        $banques = $courrier->banques;

        $recue = Recue::get()->count();
        $interne = \App\Models\Interne::get()->count();
        $depart = \App\Models\Depart::get()->count();

        $chart      = Courrier::all();

        /*     $chart = new Courrierchart;
    $chart->labels(['Départs', 'Arrivés', 'Internes']);
    $chart->dataset('STATISTIQUES', 'bar', [$interne, $recue, $depart])->options([
        'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
    ]); */

        if ($typescourrier == 'Courriers arrives') {
            return response(view('recues.details', compact('recues', 'courrier')));
        } elseif ($typescourrier == 'Courriers departs') {
            return response(view('departs.details', compact('departs', 'courrier')));
        } elseif ($typescourrier == 'Courriers internes') {
            return response(view('internes.details', compact('internes', 'courrier')));
        } elseif ($typescourrier == 'Bordereau') {
            return response(view('bordereaus.details', compact('bordereaus', 'courrier')));
        } elseif ($typescourrier == 'Factures daf') {
            return response(view('facturesdafs.details', compact('facturesdafs', 'courrier')));
        } elseif ($typescourrier == 'Tresors') {
            return response(view('tresors.details', compact('tresors', 'courrier')));
        } elseif ($typescourrier == 'Banques') {
            return response(view('banques.details', compact('banques', 'courrier')));
        } else {
            return response(view('courriers.details', compact('courrier')));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courrier $courrier)
    {
        $this->authorize('update', $courrier);

        $courrier->message     =  $request->input('message');

        $courrier->directions()->attach($request->id_direction);
        $courrier->employees()->attach($request->id_employe);

        $courrier->save();

        return back()->with('success', 'Courrier imputé !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Courrier  $courrier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courrier $courrier)
    {
        //
    }

    public function list(Request $request)
    {
        $courriers = Courrier::with('types_courrier')->get();
        return Datatables::of($courriers)->make(true);
    }

    public function courrierimputations($type, $id)
    {
        $type = TypesCourrier::find($type);
        $courrier = Courrier::find($id);

        return response(view('courriers.imputation', compact('courrier', 'type')));
    }

    function fetch(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');

            /* $data = DB::table('employees.users')      
      ->where('email', 'LIKE', "%{$query}%")
        ->get(); */

            $data = DB::table('users')
                ->join('employees', function ($join) {
                    $join->on('users.id', '=', 'employees.users_id');
                })
                ->where('firstname', 'LIKE', "%{$query}%")
                ->get();


            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';

            foreach ($data as $user) {
                $id         =   $user->id;
                $name       =   $user->firstname . ' ' . $user->name;

                $user = User::findOrFail($id);
                $employe      =   $user->employee;
                $idemploye    =   $user->employee->id;
                $direction    =   $employe->direction->name;
                $iddirection  =   $employe->direction->id;


                /* $direction  =   $employe->direction->name; */

                $output .= '
       
       <li data-id="' . $id . '" data-direction="' . $direction . '" data-iddirection="' . $iddirection . '" data-idemploye="' . $idemploye . '"><a href="#">' . $name . '</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
