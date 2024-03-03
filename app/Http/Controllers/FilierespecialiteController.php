<?php

namespace App\Http\Controllers;

use App\Models\Filierespecialite;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class FilierespecialiteController extends Controller
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
        $filierespecialites = Filierespecialite::all();
        return view('filierespecialites.index', compact('filierespecialites'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\Filierespecialite  $filierespecialite
     * @return \Illuminate\Http\Response
     */
    public function show(Filierespecialite $filierespecialite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Filierespecialite  $filierespecialite
     * @return \Illuminate\Http\Response
     */
    public function edit(Filierespecialite $filierespecialite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Filierespecialite  $filierespecialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Filierespecialite $filierespecialite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Filierespecialite  $filierespecialite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Filierespecialite $filierespecialite)
    {
        //
    }

    public function list(Request $request)
    {
        $filierespecialites=Filierespecialite::withCount('filiere')->with('filiere')->get();
        return Datatables::of($filierespecialites)->make(true);
    }
}
