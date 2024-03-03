<?php

namespace App\Http\Controllers;

use App\Models\Specialite;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class SpecialiteController extends Controller
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
        $specialites = Specialite::all();
        return view('specialites.index', compact('specialites'));
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
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function show(Specialite $specialite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function edit(Specialite $specialite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Specialite $specialite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Specialite  $specialite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Specialite $specialite)
    {
        //
    }
    
    public function list(Request $request)
    {
        $specialites=Specialite::withCount('formations')->get();
        return Datatables::of($specialites)->make(true);
    }
}
