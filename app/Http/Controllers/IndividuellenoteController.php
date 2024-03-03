<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use Illuminate\Http\Request;

class IndividuellenoteController extends Controller
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
        $individuelle = Individuelle::find($id);
        return view('individuellenotes.update', compact('individuelle'));
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
        $individuelle = Individuelle::find($id);

        $this->validate(
            $request,
            [
            'note_obtenue'                  =>    'numeric'
    ]
        );

        $individuelle->note_obtenue          =     $request->input('note_obtenue');
        $individuelle->niveau_maitrise       =     $request->input('niveau_maitrise');
        $individuelle->observations          =     $request->input('observations');
        $individuelle->appreciation          =     $request->input('appreciations');
            
        $individuelle->save();
        
        $message = "Modifications de  " .$individuelle->demandeur->user->civilite.' '.$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' prises en comptes';
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
