<?php

namespace App\Http\Controllers;

use App\Models\Fcollective;
use Illuminate\Http\Request;

class FcollectiveController extends Controller
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
        $fcollectives = Fcollective::all();

       /*  dd($fcollectives); */

        return view('fcollectives.index', compact('fcollectives'));
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
     * @param  \App\Models\Fcollective  $fcollective
     * @return \Illuminate\Http\Response
     */
    public function show(Fcollective $fcollective)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fcollective  $fcollective
     * @return \Illuminate\Http\Response
     */
    public function edit(Fcollective $fcollective)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fcollective  $fcollective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fcollective $fcollective)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fcollective  $fcollective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fcollective $fcollective)
    {
        //
    }
}
