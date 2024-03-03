<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demandeur;
use App\Models\Recue;
use App\Models\Interne;
use App\Models\Depart;
use App\Models\Courrier;
use App\Models\Pcharge;
use App\Models\Projet;
use App\Models\Individuelle;
use App\Models\Localite;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /* $this->middleware('auth'); */
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $recues = Recue::get()->count();
        $internes = Interne::get()->count();
        $departs = Depart::get()->count();
        $courrier = Courrier::get()->count();
        $demandeurs = Demandeur::get()->count();
        $bordereaus = \App\Models\Bordereau::get()->count();

        $chart      = Courrier::all();
        $demandeurs = Demandeur::all();

        $user_connect = Auth::user();
        $demandeur  =  $user_connect->demandeur;
        $courriers = $user_connect->courriers;
        
        $courriers = Courrier::all();

        return view('courriers.index', compact('courriers', 'courrier', 'recues', 'internes', 'departs'));

    }
}
