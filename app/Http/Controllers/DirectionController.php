<?php

namespace App\Http\Controllers;

use App\Models\Direction;
use Illuminate\Http\Request;
use App\Models\Fonction;
use App\Models\Courrier;
use App\Models\Employee;
use App\Models\TypesDirection;
use Yajra\Datatables\Datatables;

class DirectionController extends Controller
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
        /*      $chart      = Courrier::all();
             $chart = new Courrierchart;
             $chart->labels(['', '', '']);
             $chart->dataset('STATISTIQUES', 'bar', ['','',''])->options([
                 'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
             ]); */

        $directions = Direction::all();

        return view('directions.index', compact('directions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        /*   $chart      = Courrier::all();
          $chart = new Courrierchart;
          $chart->labels(['', '', '']);
          $chart->dataset('STATISTIQUES', 'bar', ['','',''])->options([
              'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
          ]); */
    
        $direction_id  =  $request->input('direction');
        $direction     =  Direction::find($direction_id);
    
        $types_directions   = TypesDirection::distinct('name')->get()->pluck('name', 'id')->unique();
        $fonctions          = Fonction::distinct('name')->get()->pluck('name', 'id')->unique();
           
        $employee_id        =   $request->input('employee');
        $employee           =   Employee::find($employee_id);
        $user               =   $employee->user;
    
        /*  dd($employee); */
    
        return view('directions.create', compact('user', 'employee', 'types_directions', 'fonctions'));
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
                'direction'             => 'required|string|max:250',
                'sigle'                 => 'required|string|max:10',
                'type_direction'        => 'required',
                'employee'              => 'required|exists:employees,id',
            ]
        );

        $employee_id=$request->input('employee');
        $employee=Employee::find($employee_id);
        
        $direction = new Direction([
            'name'                  =>      $request->input('direction'),
            'sigle'                 =>      $request->input('sigle'),
            'types_directions_id'   =>      $request->input('type_direction'),
            'chef_id'               =>      $request->input('employee')

        ]);

        $direction->save();

        $message = $direction->sigle." ajouté avec succès";

        return redirect()->route('directions.index')->with('success', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function show(Direction $direction)
    {
        $employees = $direction->employees;

        $direction_courriers = $direction->courriers;

        $courriers = $direction->courriers()->paginate(2);
        
        return view('directions.show', compact('employees', 'courriers', 'direction', 'direction_courriers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $directions = Direction::find($id);
        //dd($directions);

    /*     $chart      = Courrier::all();
        $chart = new Courrierchart;
        $chart->labels(['', '', '']);
        $chart->dataset('STATISTIQUES', 'bar', ['','',''])->options([
            'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
        ]); */
        
        $types_directions = TypesDirection::distinct('name')->get()->pluck('name', 'name')->unique();
        
        //dd($types_directions);

        /* $employees = Employee::distinct('matricule')->get()->pluck('matricule', 'matricule')->unique(); */
        $employees = Employee::all();
        return view('directions.update', compact('directions', 'id', 'types_directions', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $direction = Direction::find($id);

        $this->validate(
            $request,
            [
                'name'                  => 'required|unique:directions,name,'.$direction->id.',id,deleted_at,NULL',
                'sigle'                 => 'sometimes|unique:directions,sigle,'.$direction->id.',id,deleted_at,NULL',
                'type_direction'        => 'required',
            ]
        );
            
        $types_directions_id = TypesDirection::where('name', $request->input('type_direction'))->first()->id;

        $direction->name                    =     $request->input('name');
        $direction->sigle                   =     $request->input('sigle');
        $direction->types_directions_id     =     $types_directions_id;
        $direction->chef_id                 =     $request->input('employee');

        $direction->save();
        
        return redirect()->route('directions.index')->with('success', 'direction modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Direction  $direction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Direction $direction)
    {
        
        $direction->delete();
        $message = $direction->sigle.' a été supprimé(e)';
        return redirect()->route('directions.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $directions=Direction::with('employees', 'chef')->get();
        return Datatables::of($directions)->make(true);
    }
}
