<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use Illuminate\Http\Request;
use Auth;

class IndividuellerangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function show(Individuelle $individuelle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auth_user      =       Auth::user();
        $individuelle = Individuelle::find($id);
        return view('agerouteindividuelles.rang', compact('individuelle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $individuelle =   Individuelle::find($id);
        $demandeur    =   $individuelle->demandeur;
        $utilisateur  =   $demandeur->user;

        $this->validate(
            $request,
            [
                'rang'               =>    'required',
        ]
        );

        $user_connect           =              Auth::user();
        $updated_by             =              strtolower($user_connect->username);
                
        $utilisateur->updated_by                =      $request->input('updated_by');

        $utilisateur->save();

        $individuelle->items1           =     $request->input('rang');

        $individuelle->save();

        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été classé à la position '.$request->input('rang').'';
        return back()->with(compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Individuelle $individuelle)
    {
        //
    }
}
