<?php

namespace App\Http\Controllers;

use App\Models\Pcharge;
use App\Models\Etablissement;
use App\Models\Filiere;
use App\Models\Filierespecialite;
use App\Models\TypesDemande;
use App\Models\Commune;
use App\Models\Diplome;
use App\Models\Module;
use App\Models\User;
use App\Models\Demandeur;
use App\Models\Professionnelle;
use App\Models\Scolarite;
use App\Models\Familiale;
use App\Models\Etude;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Auth;
use DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Buyer;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class PchargeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Courrier|Gestionnaire|Demandeur|Individuelle|Collective|Pcharge']);
        /*  $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $annees = Pcharge::distinct('annee')->pluck('annee', 'annee'); */

        /* $an2019 = DB::table('pcharges')->whereBetween('annee', array('2019', '2019'))->get()->count();
        $an2020 = DB::table('pcharges')->whereBetween('annee', array('2020', '2020'))->get()->count();
        $an2021 = DB::table('pcharges')->whereBetween('annee', array('2021', '2021'))->get()->count(); */
        /* $an2022 = DB::table('pcharges')->whereBetween('annee', array('2022', '2022'))->get()->count(); */

        /* $total = Pcharge::get()->count(); */
        /* $depart = "2019";
        $enCours = date('Y'); */

        /* $total = DB::table('pcharges')->whereBetween('annee', array($depart, $enCours))->get()->count(); */

        /* $pcharges      =   Pcharge::whereBetween('annee', array($depart, $enCours))->get(); */

        /* return view('pcharges.index', compact('pcharges', 'annees', 'total', 'an2019', 'an2020', 'an2021', 'depart', 'enCours')); */
        
        $pcharges = Pcharge::get()->where('scolarites_id', '>=', 1);

        $pctotal = Pcharge::get()->where('scolarites_id', '>=', 1)->count();
        
        $ptypenouvelle = Pcharge::get()->where('scolarites_id', '>=', 1)
                               ->where('typedemande', '=', 'Nouvelle demande')
                               ->count();
        
        $ptyperenouvelle = Pcharge::get()->where('scolarites_id', '>=', 1)
                               ->where('typedemande', '=', 'Renouvellement')
                               ->count();

        $attente = Pcharge::get()->where('scolarites_id', '>=', 1)
                               ->where('statut', '=', 'Attente')
                               ->count();

        $accorde = Pcharge::get()->where('scolarites_id', '>=', 1)
                               ->where('statut', '=', 'Accordée')
                               ->count();

        $nonaccorde = Pcharge::get()->where('scolarites_id', '>=', 1)
                               ->where('statut', '=', 'Non accordée')
                               ->count();

        $termine = Pcharge::get()->where('scolarites_id', '>=', 1)
                               ->where('statut', '=', 'Terminée')
                               ->count();

        $user = Auth::user();
        $user_connect = $user;

        if (!$user->hasRole('Demandeur')) {
            return view('pcharges.index', compact('pcharges', 'pctotal', 'ptypenouvelle', 'ptyperenouvelle', 'attente', 'accorde', 'nonaccorde', 'termine'));
        } else {
            return redirect()->route('profiles.show', ['user'=>$user, 'user_connect'=>$user_connect]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $etablissement_id = $request->input('etablissement');
        $etablissement = Etablissement::find($etablissement_id);
        $etablissements = Etablissement::distinct('name')->get()->pluck('name', 'name')->unique();
        $filieres = Filiere::distinct('name')->get()->pluck('name', 'id')->unique();
        $filierespecialites = Filierespecialite::distinct('name')->get()->pluck('name', 'id')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'name')->unique();
        $professionnelle = Professionnelle::distinct('name')->get()->pluck('name', 'id')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'id')->unique();
        $etude = Etude::distinct('name')->get()->pluck('name', 'id')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        
        $scolarites = Scolarite::where('statut', '!=', 'Fermé')
                                ->get()
                                ->pluck('annee', 'id')
                                ->unique();

        $enCours = date('Y');

        $date_depot = Carbon::now();
        return view('pcharges.create', compact('communes', 'etude', 'etablissements', 'filieres', 'enCours', 'etablissement', 'date_depot', 'filierespecialites', 'diplomes', 'professionnelle', 'familiale', 'scolarites'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_connect = Auth::user();
        $demandeur = $user_connect->demandeur;
        $pcharges = $user_connect->demandeur->pcharges;

        $typedemande = $request->input('typedemande');

        if (isset($typedemande) && $typedemande != "Renouvellement") {
            $this->validate($request, [
            'cin'                   =>  'required|string|min:12|max:14',
            'civilite'              =>  'required|string',
            'firstname'             =>  'required|string|max:50',
            'name'                  =>  'required|string|max:50',
            'telephone'             =>  'required|string|max:50',
            'email'                 =>  'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
            'adresse'               =>  'required|string',
            'specialite'            =>  'required|string',
            'fixe'                  =>  'required|string|max:50',
            'date'                  =>  'required|date',
            'lieu_naissance'        =>  'required|string|max:50',
            'etablissement'         =>  'required|exists:etablissements,id',
            'filiere'               =>  'required|exists:filieres,id',
            'professionnelle'       =>  'required',
            'etude'                 =>  'required',
            'inscription'           =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            'montant'               =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            'duree'                 =>  'required|min:1|max:1',
            'niveauentree'          =>  'required',
            'optiondiplome'         =>  'required',
            'niveausortie'          =>  'required',
            'motivation'            =>  'required',
            'nbre_piece'            =>  'required',
            'diplome'               =>  'required',
            'typedemande'           =>  'required',
            'scolarite'             =>  'required',
            'commune'               =>  'required',
        ]);
        } else {
            $this->validate($request, [
                'cin'                   =>  'required|string|min:12|max:14',
                'civilite'              =>  'required|string',
                'firstname'             =>  'required|string|max:50',
                'name'                  =>  'required|string|max:50',
                'telephone'             =>  'required|string|max:50',
                'email'                 =>  'required|email|max:255|unique:users,email,'.$user_connect->id,
                'adresse'               =>  'required|string',
                'specialite'            =>  'required|string',
                'fixe'                  =>  'required|string|max:50',
                'date'                  =>  'required|date',
                'lieu_naissance'        =>  'required|string|max:50',
                'etablissement'         =>  'required|exists:etablissements,id',
                'filiere'               =>  'required|exists:filieres,id',
                'professionnelle'       =>  'required',
                'etude'                 =>  'required',
                'inscription'           =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'montant'               =>  'required|regex:/^\d+(\.\d{1,2})?$/',
                'duree'                 =>  'required|min:1|max:1',
                'niveauentree'          =>  'required',
                'optiondiplome'         =>  'required',
                'niveausortie'          =>  'required',
                'motivation'            =>  'required',
                'nbre_piece'            =>  'required',
                'diplome'               =>  'required',
                'typedemande'           =>  'required',
                'scolarite'             =>  'required',
                'commune'               =>  'required',
            ]);
        }

        $etablissement_id = $request->input('etablissement');
        $etablissement = Etablissement::find($etablissement_id);

        $user_id             =   User::latest('id')->first()->id;
        if (!$user_connect->hasRole('Demandeur')) {
            $username            =   strtolower($request->input('name').$user_id);
        } else {
            $username            =   $user_connect->username;
        }

        $annee = date('y');
        $longueur = strlen($user_id);
    
        if ($longueur <= 1) {
            $numero   =   "I".strtolower($annee."000000".$user_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero   =   "I".strtolower($annee."00000".$user_id);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero   =   "I".strtolower($annee."0000".$user_id);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero   =   "I".strtolower($annee."000".$user_id);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numero   =   "I".strtolower($annee."00".$user_id);
        } elseif ($longueur >= 6 && $longueur < 7) {
            $numero   =   "I".strtolower($annee."0".$user_id);
        } else {
            $numero   =   "I".strtolower($annee.$user_id);
        }
    
        $created_by1 = $user_connect->firstname;
        $created_by2 = $user_connect->name;
        $created_by3 = $user_connect->username;
    
        $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')';
    
        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
    
        $fixe = $request->input('fixe');
        $fixe = str_replace(' ', '', $fixe);
            
        $diplome_id = Diplome::where('name', $request->input('diplome'))->first()->id;
        $professionnelle_id = $request->input('professionnelle');
        $scolarite_id = $request->input('scolarite');
        $familiale_id = $request->input('familiale');
        $etude_id = $request->input('etude');
        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);

        $types_demandes_id = TypesDemande::where('name', 'Prise en charge')->first()->id;
        
        if ($request->input('civilite') == "M.") {
            $sexe = "M";
        } elseif ($request->input('civilite') == "Mme") {
            $sexe = "F";
        } else {
            $sexe = "";
        }

        /* if (isset($typedemande) && $typedemande != "Renouvellement") { */
        if (!$user_connect->hasRole('Pcharge')) {
            /* Nouvelle prise en charge */
            $user = new User([
            'sexe'                      =>      $sexe,
            'civilite'                  =>      $request->input('civilite'),
            'firstname'                 =>      $request->input('firstname'),
            'name'                      =>      $request->input('name'),
            'email'                     =>      $request->input('email'),
            'username'                  =>      $username,
            'telephone'                 =>      $telephone,
            'fixe'                      =>      $fixe,
            'bp'                        =>      $request->input('bp'),
            'fax'                       =>      $request->input('fax'),
            'professionnelles_id'       =>      $professionnelle_id,
            'familiales_id'             =>      $familiale_id,
            'date_naissance'            =>      $request->input('date'),
            'lieu_naissance'            =>      $request->input('lieu_naissance'),
            'adresse'                   =>      $request->input('adresse'),
            'password'                  =>      Hash::make($request->input('email')),
            'updated_by'                =>      $created_by

        ]);
    
            $user->save();
            $user->assignRole('Pcharge');
            
            $demandeur = new Demandeur([
                'numero'                    =>     $numero,
                'types_demandes_id'         =>     $types_demandes_id,
                'users_id'                  =>     $user->id
            ]);
    
            $demandeur->save();
    
            $pcharge = new Pcharge([
                'cin'                       =>      $request->input('cin'),
                /* 'matricule'                 =>      $request->input('matricule'), */
                'typedemande'               =>      $request->input('typedemande'),
                'date_depot'                =>      $request->input('date_depot'),
                'inscription'               =>      $request->input('inscription'),
                'montant'                   =>      $request->input('montant'),
                /* 'accompt'                   =>      $request->input('accompt'), */
                /* 'reliquat'                  =>      $request->input('reliquat'), */
                'duree'                     =>      $request->input('duree'),
                'niveauentree'              =>      $request->input('niveauentree'),
                'niveausortie'              =>      $request->input('niveausortie'),
                'specialisation'            =>      $request->input('specialite'),
                'statut'                    =>      "Attente",
                'motivation'                =>      $request->input('motivation'),
                'adresse'                   =>      $request->input('adresse'),
                'nbre_piece'                =>      $request->input('nbre_piece'),
                'telephone'                 =>      $fixe,
                'diplomes_id'               =>      $diplome_id,
                'etablissements_id'         =>      $request->input('etablissement'),
                'etudes_id'                 =>      $request->input('etude'),
                'filieres_id'               =>      $request->input('filiere'),
                'communes_id'               =>      $commune_id,
                'scolarites_id'             =>      $scolarite_id,
                'demandeurs_id'             =>      $demandeur->id
    
            ]);
    
            $pcharge->save();

            return redirect()->route('pcharges.index')->with('success', 'nouvelle demande enregistrée avec succès !');
        } else {
            /* Renouvellement */
            /*         $user_connect->sexe                =      $sexe;
                    $user_connect->civilite            =      $request->input('civilite');
                    $user_connect->firstname           =      $request->input('firstname');
                    $user_connect->name                =      $request->input('name');
                    $user_connect->telephone           =      $telephone;
                    $user_connect->fixe                =      $fixe;
                    $user_connect->bp                  =      $request->input('bp');
                    $user_connect->fax                 =      $request->input('fax');
                    $user_connect->familiales_id       =      $familiale_id;
                    $user_connect->professionnelles_id =      $professionnelle_id;
                    $user_connect->date_naissance      =      $request->input('date');
                    $user_connect->lieu_naissance      =      $request->input('lieu_naissance');
                    $user_connect->adresse             =      $request->input('adresse');
                    $user_connect->created_by          =      $created_by; */
            $user_connect->updated_by          =      $created_by;

            $user_connect->save();
                
            /* $demandeur->numero                          =     $numero;
            $demandeur->types_demandes_id               =     $types_demandes_id; */
            $demandeur->users_id                        =     $user_connect->id;

            $demandeur->save();

            $pcharge = new Pcharge([
                'cin'                       =>      $request->input('cin'),
                /* 'matricule'                 =>      $request->input('matricule'), */
                'typedemande'               =>      $request->input('typedemande'),
                'date_depot'                =>      $request->input('date_depot'),
                'inscription'               =>      $request->input('inscription'),
                'montant'                   =>      $request->input('montant'),
                /* 'accompt'                   =>      $request->input('accompt'), */
                /* 'reliquat'                  =>      $request->input('reliquat'), */
                'duree'                     =>      $request->input('duree'),
                'niveauentree'              =>      $request->input('niveauentree'),
                'niveausortie'              =>      $request->input('niveausortie'),
                'specialisation'            =>      $request->input('specialite'),
                'statut'                    =>      "Attente",
                'motivation'                =>      $request->input('motivation'),
                'adresse'                   =>      $request->input('adresse'),
                'nbre_pieces'               =>      $request->input('nbre_piece'),
                'telephone'                 =>      $fixe,
                'diplomes_id'               =>      $diplome_id,
                'etablissements_id'         =>      $request->input('etablissement'),
                'etudes_id'                 =>      $request->input('etude'),
                'filieres_id'               =>      $request->input('filiere'),
                'communes_id'               =>      $commune_id,
                'scolarites_id'             =>      $scolarite_id,
                'demandeurs_id'             =>      $demandeur->id
    
            ]);
            
            $pcharge->save();

            if ($user_connect->hasRole('Administrateur')) {
                return redirect()->route('pcharges.index')->with('success', 'renouvellement prise en compte !');
            } else {
                return redirect()->route('profiles.show', ['user'=>$user, 'user_connect'=>$user_connect]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pcharge  $pcharge
     * @return \Illuminate\Http\Response
     */
    public function show(Pcharge $pcharge)
    {
        $utilisateurs = $pcharge->demandeur->user;

        $civilites = User::pluck('civilite', 'civilite');
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $filieres = Filiere::distinct('name')->get()->pluck('name', 'id')->unique();
        $scolarites = Scolarite::distinct('annee')->get()->pluck('annee', 'id')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'id')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'id')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'id')->unique();
        $professionnelle = Professionnelle::distinct('name')->get()->pluck('name', 'id')->unique();

        
        return view('pcharges.show', compact(
            'pcharge',
            'communes',
            'familiale',
            'professionnelle',
            'modules',
            'filieres',
            'scolarites',
            'diplomes',
            'utilisateurs',
            'civilites'
        ));
    }

    public function details($id, $pcharge)
    {
        $demandeur = Demandeur::get()->where('id', '=', $id);
        $pcharges = Pcharge::get()->where('id', '=', $pcharge);

        $civilites = User::pluck('civilite', 'civilite');

        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();

        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'id')->unique();

        $communes = commune::distinct('nom')->get()->pluck('nom', 'id')->unique();

        return view('pcharges.details', compact(
            'demandeur',
            'pcharges',
            'communes',
            'modules',
            'diplomes',
            'civilites'
        ));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pcharge  $pcharge
     * @return \Illuminate\Http\Response
     */
    public function edit(Pcharge $pcharge)
    {
        $etablissements = Etablissement::distinct('name')->get()->pluck('name', 'name')->unique();

        $filieres = Filiere::distinct('name')->get()->pluck('name', 'name')->unique();

        $filierespecialites = Filierespecialite::distinct('name')->get()->pluck('name', 'name')->unique();

        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'name')->unique();

        $professionnelle = Professionnelle::distinct('name')->get()->pluck('name', 'name')->unique();

        $familiale = Familiale::distinct('name')->get()->pluck('name', 'name')->unique();

        $etude = Etude::distinct('name')->get()->pluck('name', 'name')->unique();

        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();

        /*   $scolarites = Scolarite::distinct('annee')
                                  ->where('statut', '!=', 'Ouvert')
                                  ->get()
                                  ->pluck('annee', 'annee')
                                  ->unique(); */

        $scolarites = Scolarite::where('statut', '!=', 'Fermé')
                                ->get()
                                ->pluck('annee', 'annee')
                                ->unique();

        $date_depot = Carbon::now();

        return view('pcharges.update', compact('communes', 'etablissements', 'filieres', 'date_depot', 'filierespecialites', 'diplomes', 'professionnelle', 'familiale', 'scolarites', 'pcharge', 'etude'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pcharge  $pcharge
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pcharge $pcharge)
    {
        $user_connect   =   $pcharge->demandeur->user;
        $utilisateur    =   $user_connect;
        $demandeur      =   $pcharge->demandeur;
        $this->validate($request, [
            /* 'cin'                   =>  'required|string|min:13|max:15|unique:pcharges,cin,'.$pcharge->id, */
            'civilite'              =>  'required|string',
            'firstname'             =>  'required|string|max:50',
            'name'                  =>  'required|string|max:50',
            'telephone'             =>  'required|string|max:50',
            'email'                 =>  'required|email|max:255|unique:users,email,'.$pcharge->demandeur->user->id,
            'adresse'               =>  'required|string',
            'fixe'                  =>  'required|string|max:50',
            'date'                  =>  'required|date',
            'lieu_naissance'        =>  'required|string|max:50',
            'etablissement'         =>  'required|string',
            'filiere'               =>  'required|string',
            'familiale'             =>  'required',
            'professionnelle'       =>  'required',
            'etude'                 =>  'required',
            'inscription'           =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            'montant'               =>  'required|regex:/^\d+(\.\d{1,2})?$/',
            'duree'                 =>  'required|min:1|max:1',
            'niveauentree'          =>  'required',
            'niveausortie'          =>  'required',
            'motivation'            =>  'required',
            'diplome'               =>  'required',
            'commune'               =>  'required',
            'typedemande'           =>  'required',
            'scolarite'             =>  'required|string',
            'avis_dg'               =>  'sometimes',
            'montant'               =>  'required',
        ]);

        $created_by1 = $user_connect->firstname;
        $created_by2 = $user_connect->name;
        $created_by3 = $user_connect->username;
    
        $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')';
    
        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);

        $fixe = $request->input('fixe');
        $fixe = str_replace(' ', '', $fixe);

        $diplome_id     = Diplome::where('name', $request->input('diplome'))->first()->id;
        $familiale_id     = Familiale::where('name', $request->input('familiale'))->first()->id;
        $professionnelle_id     = Professionnelle::where('name', $request->input('professionnelle'))->first()->id;
        $commune_id     = Commune::where('nom', $request->input('commune'))->first()->id;
        $etablissement_id     = Etablissement::where('name', $request->input('etablissement'))->first()->id;
        $filiere_id     = Filiere::where('name', $request->input('filiere'))->first()->id;
        $etude_id     = Etude::where('name', $request->input('etude'))->first()->id;
        $scolarite_id     = Scolarite::where('annee', $request->input('scolarite'))->first()->id;

        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);

        $inscription = $request->input('inscription');
        $inscription = str_replace(' ', '', $inscription);

        $montant = $request->input('montant');
        $montant = str_replace(' ', '', $montant);

        $avis_dg = $request->input('avis_dg');
        $avis_dg = str_replace(' ', '', $avis_dg);

        $types_demandes_id = TypesDemande::where('name', 'Prise en charge')->first()->id;
        
        if ($request->input('civilite') == "M.") {
            $sexe = "M";
        } elseif ($request->input('civilite') == "Mme") {
            $sexe = "F";
        } else {
            $sexe = "";
        }

        $user_connect->sexe                 =      $sexe;
        $user_connect->civilite             =      $request->input('civilite');
        $user_connect->firstname            =      $request->input('firstname');
        $user_connect->name                 =      $request->input('name');
        $user_connect->email                =      $request->input('email');
        $user_connect->username             =      $request->input('username');
        $user_connect->telephone            =      $telephone;
        $user_connect->fixe                 =      $fixe;
        $user_connect->bp                   =      $request->input('bp');
        $user_connect->fax                  =      $request->input('fax');
        $user_connect->familiales_id        =      $familiale_id;
        $user_connect->professionnelles_id  =      $professionnelle_id;
        $user_connect->date_naissance       =      $request->input('date');
        $user_connect->lieu_naissance       =      $request->input('lieu_naissance');
        $user_connect->adresse              =      $request->input('adresse');
        $user_connect->created_by           =      $created_by;
        $user_connect->updated_by           =      $created_by;

        $user_connect->save();
                
        $demandeur->numero                  =     $request->input('numero');
        $demandeur->types_demandes_id       =     $types_demandes_id;
        $demandeur->users_id                =     $user_connect->id;

        $demandeur->save();

        $pcharge->cin                       =      $request->input('cin');
        $pcharge->duree                     =      $request->input('duree');
        $pcharge->inscription               =      $inscription;
        $pcharge->montant                   =      $montant;
        $pcharge->niveauentree              =      $request->input('niveauentree');
        $pcharge->niveausortie              =      $request->input('niveausortie');
        $pcharge->specialisation            =      $request->input('specialite');
        $pcharge->typedemande               =      $request->input('typedemande');
        $pcharge->date_depot                =      $request->input('date_depot');
        $pcharge->nbre_pieces               =      $request->input('nbre_piece');
        $pcharge->telephone                 =      $telephone;
        $pcharge->adresse                   =      $request->input('adresse');
        $pcharge->diplomes_id               =      $diplome_id;
        $pcharge->motivation                =      $request->input('motivation');
        if ($user_connect->hasRole('Administrateur|super-admin')) {
            $pcharge->statut                =      $request->input('statut');
        }
        $pcharge->avis_dg                   =      $avis_dg;
        $pcharge->etablissements_id         =      $etablissement_id;
        $pcharge->filieres_id               =      $filiere_id;
        $pcharge->etudes_id                 =      $etude_id;
        $pcharge->communes_id               =      $commune_id;
        $pcharge->scolarites_id             =      $scolarite_id;
        $pcharge->demandeurs_id             =      $demandeur->id;

        $pcharge->save();
        
        return redirect()->route('pcharges.index')->with('success', 'demande modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pcharge  $pcharge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pcharge $pcharge)
    {
        //
    }
    
    public function list(Request $request)
    {
        $etablissements=Etablissement::with('etablissement')->get();
        return Datatables::of($etablissements)->make(true);
    }
    
    public function liste(Request $request)
    {
        $filieres=Filiere::with('filiere')->get();
        return Datatables::of($filieres)->make(true);
    }
    
    public function countscolaritenbre($cin)
    {
        $pcharges = Pcharge::get()->where('cin', '=', $cin);
        $effectif = Pcharge::get()->where('cin', '=', $cin)->count();

        return view('pcharges.countscolaritenbre', compact('cin', 'pcharges', 'effectif'));
    }
    
    
    public function termine($pcharge, $statut)
    {
        $pcharge = Pcharge::find($pcharge);

        $pcharge->statut    =   $statut;
        
        $pcharge->save();
        
        $message = "La demande de prise en charge de " .$pcharge->demandeur->user->firstname.' '.$pcharge->demandeur->user->name.' a été cloturée';
        return back()->with(compact('message'));
    }

    public function attente($statut)
    {
        $pcharges = Pcharge::get()->where('scolarites_id', '>=', 1)
                                  ->where('statut', '=', 'Attente');

        $effectif = Pcharge::get()->where('scolarites_id', '>=', 1)
                                  ->where('statut', '=', 'Attente')
                                  ->count();

        return view('pcharges.attente', compact('statut', 'pcharges', 'effectif'));
    }

    public function terminer($statut)
    {
        $pcharges = Pcharge::get()->where('scolarites_id', '>=', 1)
                                  ->where('statut', '=', 'Terminée');

        $effectif = Pcharge::get()->where('scolarites_id', '>=', 1)
                                  ->where('statut', '=', 'Terminée')
                                  ->count();

        return view('pcharges.terminer', compact('statut', 'pcharges', 'effectif'));
    }

    public function rejeter($statut)
    {
        $pcharges = Pcharge::get()->where('scolarites_id', '>=', 1)
                                  ->where('statut', '=', 'Non accordée');

        $effectif = Pcharge::get()->where('scolarites_id', '>=', 1)
                                  ->where('statut', '=', 'Non accordée')
                                  ->count();

        return view('pcharges.rejeter', compact('statut', 'pcharges', 'effectif'));
    }

    public function accorder($statut)
    {
        $pcharges = Pcharge::get()->where('scolarites_id', '>=', 1)
                                  ->where('statut', '=', 'Accordée');

        $effectif = Pcharge::get()->where('scolarites_id', '>=', 1)
                                  ->where('statut', '=', 'Accordée')
                                  ->count();

        return view('pcharges.accorder', compact('statut', 'pcharges', 'effectif'));
    }

    public function contrat($pcharges)
    {        
        $pcharges = Pcharge::get()->where('id', '=', $pcharges);

        foreach ($pcharges as $pcharge) {
        }
        $prenom = $pcharge->demandeur->user->firstname;
        $nom = $pcharge->demandeur->user->name;

        $name = $prenom.'-'.$nom;

        $name = htmlentities($name, ENT_NOQUOTES, 'utf-8');
        $name = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $name);
        $name = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $name);
        $name = preg_replace('#&[^;]+;#', '', $name);
        
        $anne = date('d');
        $anne = $anne.'_'.date('m');
        $anne = $anne.'_'.date('Y');
        $anne = $anne.'_'.date('His');

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->setOptions($options);

        $dompdf->loadHtml(view('contrat', compact('pcharges')));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Contrat_'.$name.'_'.$anne.'.pdf', ['Attachment' => false]);
    }


    public function lettre($pcharges)
    {
        $pcharges = Pcharge::get()->where('id', '=', $pcharges);

        foreach ($pcharges as $pcharge) {
        }

        $prenom = $pcharge->demandeur->user->firstname;
        $nom = $pcharge->demandeur->user->name;

        $name = $prenom.'-'.$nom;

        /* $lettre = PDF::loadView('lettre', compact('pcharges'))
                            ->setPaper('A4', 'portrait')
                            ->setOption('images', true)
                            ->setOption('enable-javascript', true)
                            ->setOption('javascript-delay', 10); */
        
        $name = htmlentities($name, ENT_NOQUOTES, 'utf-8');
        $name = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $name);
        $name = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $name);
        $name = preg_replace('#&[^;]+;#', '', $name);

        $anne = date('d');
        $anne = $anne.'_'.date('m');
        $anne = $anne.'_'.date('Y');
        $anne = $anne.'_'.date('His');
        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->setOptions($options);

        $dompdf->loadHtml(view('lettre', compact('pcharges')));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Lettre_'.$name.'_'.$anne.'.pdf', ['Attachment' => false]);
    }
}
