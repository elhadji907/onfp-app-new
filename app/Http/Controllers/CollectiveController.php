<?php

namespace App\Http\Controllers;

use App\Models\Collective;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Commune;
use App\Models\Region;
use App\Models\Diplome;
use App\Models\Demandeur;
use App\Models\Niveaux;
use App\Models\Module;
use App\Models\Programme;
use App\Models\TypesDemande;
use App\Models\User;
use App\Models\Professionnelle;
use App\Models\Familiale;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use Auth;
use Carbon\Carbon;

class CollectiveController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Courrier|Gestionnaire|Demandeur']);
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $collectives = Collective::where('communes_id', '>', 0)->get();

        $user = Auth::user();
        $user_connect = $user;
        $countries = DB::table('regions')->pluck("nom", "id");
        if (!$user->hasRole('Demandeur')) {
            return view('collectives.index', compact('collectives', 'countries'));
        } else {
            return redirect()->route('profiles.show', ['user'=>$user, 'user_connect'=>$user_connect]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $programmes = Programme::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'name')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'id')->unique();
        $professionnelle = Professionnelle::distinct('name')->get()->pluck('name', 'id')->unique();

        $date_depot = Carbon::now();

        $user = auth::user();
        
        $civilites = User::pluck('civilite', 'civilite');

        /* if ($user->hasRole('Demandeur')) { */
            foreach ($user->demandeur->collectives as $key => $collective) {
            }
                $demandeurs = $user->demandeur;
                $collectives = $demandeurs->collectives;
                $utilisateurs = $user;                
                
                $CollectiveModules = $collective->modules->pluck('name', 'name')->all();

                /* return view('collectives.update', compact('civilites', 'familiale', 'collective', 
                'professionnelle', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot', 'utilisateurs', 'CollectiveModules', 'regions')); */
          
      /*   } else { */
            return view('collectives.create', compact('civilites', 'familiale', 'professionnelle', 'user', 'communes', 'diplomes', 'modules', 'programmes', 'date_depot', 'regions'));
       /*  } */
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
        $utilisateur = $user_connect;
        
        $collectives = $user_connect->demandeur->collectives;
        foreach ($collectives as $collective) {

        }
        
        if (!$user->hasRole('Demandeur')) {
                $this->validate(
                    $request,
                    [
                        'sexe'                =>  'required|string|max:10',
                        'name'                =>  'required|string|unique:collectives,name,NULL,id,deleted_at,NULL',
                        'prenom'              =>  'required|string|max:50',
                        'nom'                 =>  'required|string|max:50',
                        'date_naiss'          =>  'required|date_format:Y-m-d',
                        'date_depot'          =>  'required|date_format:Y-m-d',
                        'lieu_naissance'      =>  'required|string|max:50',
                        'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
                        'fixe'                =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
                        'structure_fixe'      =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
                        'adresse'             =>  'required|string|max:200',
                        'structure_adresse'   =>  'required|string|max:200',
                        'description'         =>  'required|string|min:1000|max:1500',
                        'email'               =>  'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
                        'professionnelle'     =>  'required',
                        'commune'             =>  'required',
                        'modules'             =>  'required',
                    ]
                );
            } 
            else {
            $this->validate(
                $request,
                [
                    'sexe'                =>  'required|string|max:10',
                    'name'                =>  "required|string|unique:collectives,name,{$collective->id},id,deleted_at,NULL",
                    'prenom'              =>  'required|string|max:50',
                    'nom'                 =>  'required|string|max:50',
                    'date_naiss'          =>  'required|date_format:Y-m-d',
                    'date_depot'          =>  'required|date_format:Y-m-d',
                    'lieu_naissance'      =>  'required|string|max:50',
                    'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
                    'fixe'                =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
                    'structure_fixe'      =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
                    'adresse'             =>  'required|string|max:200',
                    'structure_adresse'   =>  'required|string|max:200',
                    'description'         =>  'required|string|min:1|max:1500',
                    'email'               =>  "required|string|email|max:255|unique:users,email,{$user_connect->id},id,deleted_at,NULL",
                    'professionnelle'     =>  'required',
                    'commune'             =>  'required',
                    'modules'             =>  'required',
                ]
            );
        }

        $user_id             =   User::latest('id')->first()->id;
        $username            =   $user->username;
        
        $annee = date('y');
        $longueur = strlen($user_id);

        if ($longueur <= 1) {
            $numero   =   "C".strtolower($annee."000000".$user_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero   =   "C".strtolower($annee."00000".$user_id);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero   =   "C".strtolower($annee."0000".$user_id);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero   =   "C".strtolower($annee."000".$user_id);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numero   =   "C".strtolower($annee."00".$user_id);
        } elseif ($longueur >= 6 && $longueur < 7) {
            $numero   =   "C".strtolower($annee."0".$user_id);
        } else {
            $numero   =   "C".strtolower($annee.$user_id);
        }

        $created_by1 = $user->firstname;
        $created_by2 = $user->name;
        $created_by3 = $username;

        $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')';

        $statut = "Attente";

        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);

        $fixe = $request->input('fixe');
        $fixe = str_replace(' ', '', $fixe);

        $autre_tel = $request->input('autre_tel');
        $autre_tel = str_replace(' ', '', $autre_tel);

        $structure_fixe = $request->input('structure_fixe');
        $structure_fixe = str_replace(' ', '', $structure_fixe);
       
        if ($request->input('programme') !== null) {
            $programme_id = Programme::where('sigle', $request->input('programme'))->first()->id;
        } else {
            $programme_id = null;
        }

        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        

        $types_demandes_id = TypesDemande::where('name', 'Collective')->first()->id;
        
        if ($request->input('sexe') == "M") {
            $civilite = "M.";
        } elseif ($request->input('sexe') == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }

        if (!$user->hasRole('Demandeur')) {
        $user = new User([
            'sexe'                          =>      $request->input('sexe'),
            'civilite'                      =>      $civilite,
            'firstname'                     =>      $request->input('prenom'),
            'name'                          =>      $request->input('nom'),
            'email'                         =>      $request->input('email'),
            'username'                      =>      $username,
            'telephone'                     =>      $telephone,
            'fixe'                          =>      $fixe,
            'bp'                            =>      $request->input('bp'),
            'fax'                           =>      $request->input('fax'),
            'professionnelles_id'           =>      $professionnelle_id,
            /* 'familiales_id'                 =>      $familiale_id, */
            'date_naissance'                =>      $request->input('date_naiss'),
            'lieu_naissance'                =>      $request->input('lieu_naissance'),
            'adresse'                       =>      $request->input('adresse'),
            'password'                      =>      Hash::make($request->input('email')),
            'created_by'                    =>      $created_by,
            'updated_by'                    =>      $created_by

        ]);
    
            $user->save();
            $user->assignRole('Demandeur');

        } 

        $demandeur = new Demandeur([
            'numero'                        =>     $numero,
            'types_demandes_id'             =>     $types_demandes_id,
            'users_id'                      =>     $user->id
        ]);

        $demandeur->save();

        $collectives = new Collective([
            'name'                          =>     $request->input('name'),
            'sigle'                         =>     $request->input('sigle'),
            'description'                   =>     $request->input('description'),
            'date_depot'                    =>     $request->input('date_depot'),
            'adresse'                       =>     $request->input('structure_adresse'),
            'experience'                    =>     $request->input('experience'),
            'projetprofessionnel'           =>     $request->input('projetprofessionnel'),
            'prerequis'                     =>     $request->input('prerequis'),
            'motivation'                    =>     $request->input('motivation'),
            'nbre_pieces'                   =>     $request->input('nombre_de_piece'),
            'telephone'                     =>     $telephone,
            'fixe'                          =>     $fixe,
            'bp'                            =>     $request->input('bpcol'),
            'fax'                           =>     $request->input('faxcol'),
            'communes_id'                   =>     $commune_id,
            'statut'                        =>     $statut,
            'telephone'                     =>     $autre_tel,
            'fixe'                          =>     $autre_tel,
            'programmes_id'                 =>     $programme_id,
            'demandeurs_id'                 =>     $demandeur->id
        ]);

        $collectives->save();
        $collectives->modules()->sync($request->input('modules'));

        if (!$user->hasRole('Demandeur')) {
            return redirect()->route('collectives.index')->with('success', 'demandeur ajouté avec succès !');
        } else {
            return redirect()->route('profiles.show', ['user'=>$user, 'user_connect'=>$user_connect]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collective  $collective
     * @return \Illuminate\Http\Response
     */
    public function show(Collective $collective)
    {
        $utilisateurs = $collective->demandeur->user;

        $civilites = User::pluck('civilite', 'civilite');
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'id')->unique();
        $programmes = Programme::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $niveaux = Niveaux::distinct('name')->get()->pluck('name', 'name')->unique();
        $communes = commune::distinct('nom')->get()->pluck('nom', 'id')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'id')->unique();
        $professionnelle = Professionnelle::distinct('name')->get()->pluck('name', 'id')->unique();

        
        return view('collectives.show', compact(
            'collective',
            'communes',
            'niveaux',
            'modules',
            'familiale',
            'professionnelle',
            'programmes',
            'diplomes',
            'utilisateurs',
            'civilites'
        ));
    }

    public function details($id)
    {
        $collective = Collective::find($id);
        
        $civilites = User::pluck('civilite', 'civilite');

        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();

        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'id')->unique();
    
        $programmes = Programme::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();

        $niveaux = Niveaux::distinct('name')->get()->pluck('name', 'name')->unique();

        $communes = commune::distinct('nom')->get()->pluck('nom', 'id')->unique();

        return view('collectives.details', compact(
            'collective',
            'communes',
            'niveaux',
            'modules',
            'programmes',
            'diplomes',
            'civilites'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collective  $collective
     * @return \Illuminate\Http\Response
     */
    public function edit(Collective $collective)
    {
        /* $this->authorize('update',  $collective); */
       
        $demandeurs = $collective->demandeur;
        $utilisateurs = $demandeurs->user;

        $civilites = User::pluck('civilite', 'civilite');
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'name')->unique();
        $professionnelle = Professionnelle::distinct('name')->get()->pluck('name', 'name')->unique();

        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $CollectiveModules = $collective->modules->pluck('name', 'name')->all();

        $programmes = Programme::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();

        $date_depot = Carbon::now();

        return view('collectives.update', compact('civilites', 'collective', 'familiale', 'professionnelle', 'communes', 'modules', 'programmes', 'date_depot', 'utilisateurs', 'regions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collective  $collective
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collective $collective)
    {
        $user_connect = Auth::user();
        $demandeur = $collective->demandeur;
        $utilisateur = $user_connect;

        if (!$user_connect->hasRole('Demandeur')) {
            $this->validate(
                $request,
                [
               'sexe'                =>  'required|string|max:10',
               'name'                =>  "required|string|unique:collectives,name,{$collective->id},id,deleted_at,NULL",
               'prenom'              =>  'required|string|max:50',
               'nom'                 =>  'required|string|max:50',
               'date_naiss'          =>  'required|date_format:Y-m-d',
               'date_depot'          =>  'required|date_format:Y-m-d',
               'lieu_naissance'      =>  'required|string|max:50',
               'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
               'fixe'                =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
               'structure_fixe'      =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
               'adresse'             =>  'required|string|max:100',
               'description'         =>  'required|string|min:10|max:1500',
               'professionnelle'     =>  'required',
               'commune'             =>  'required',
               'modules'             =>  'required',

               ]
            );
        } else {
            $this->validate(
                $request,
                [
               'sexe'                =>  'required|string|max:10',
               'name'                =>  "required|string|unique:collectives,name,{$collective->id},id,deleted_at,NULL",
               'prenom'              =>  'required|string|max:50',
               'nom'                 =>  'required|string|max:50',
               'date_naiss'          =>  'required|date_format:Y-m-d',
               'date_depot'          =>  'required|date_format:Y-m-d',
               'lieu_naissance'      =>  'required|string|max:50',
               'telephone'           =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
               'fixe'                =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
               'structure_fixe'      =>  'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:12|max:17',
               'adresse'             =>  'required|string|max:100',
               'structure_adresse'   =>  'required|string|max:200',
               'description'         =>  'required|string|min:10|max:1500',
               'professionnelle'     =>  'required',
               'commune'             =>  'required',
               'modules'             =>  'required',

               ]
            );
        }

        $updated_by1 = $user_connect->firstname;
        $updated_by2 = $user_connect->name;
        $updated_by3 = $user_connect->username;

        $updated_by = $updated_by1.' '.$updated_by2.' ('.$updated_by3.')';


        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
 
        $fixe = $request->input('fixe');
        $fixe = str_replace(' ', '', $fixe);
 
        $autre_tel = $request->input('autre_tel');
        $autre_tel = str_replace(' ', '', $autre_tel);

        $structure_fixe = $request->input('structure_fixe');
        $structure_fixe = str_replace(' ', '', $structure_fixe);

        if ($request->input('programme') !== null) {
            $programme_id = Programme::where('sigle', $request->input('programme'))->first()->id;
        } else {
            $programme_id = "";
        }

        if ($request->input('sexe') == "M") {
            $civilite = "M.";
        } elseif ($request->input('sexe') == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }
        
        $statut = "Attente";

        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        /* $region_id = Region::where('nom', $request->input('region'))->first()->id; */
        $types_demandes_id = TypesDemande::where('name', 'Collective')->first()->id;
        /* $familiale_id = Familiale::where('name', $request->input('familiale'))->first()->id; */
        $professionnelle_id = Professionnelle::where('name', $request->input('professionnelle'))->first()->id;

        $utilisateur->sexe                      =      $request->input('sexe');
        $utilisateur->civilite                  =      $civilite;
        $utilisateur->firstname                 =      $request->input('prenom');
        $utilisateur->name                      =      $request->input('nom');
        $utilisateur->username                  =      $request->input('username');
        $utilisateur->telephone                 =      $telephone;
        $utilisateur->fixe                      =      $fixe;
        $utilisateur->bp                        =      $request->input('bp');
        $utilisateur->fax                       =      $request->input('fax');
        $utilisateur->professionnelles_id       =      $professionnelle_id;
        $utilisateur->date_naissance            =      $request->input('date_naiss');
        $utilisateur->lieu_naissance            =      $request->input('lieu_naissance');
        $utilisateur->adresse                   =      $request->input('adresse');
        $utilisateur->updated_by                =      $updated_by;

        $utilisateur->save();

        $demandeur->numero                      =      $request->input('numero');
        $demandeur->types_demandes_id           =      $types_demandes_id;
        $demandeur->users_id                    =      $utilisateur->id;

        $demandeur->save();

        if (!$user_connect->hasRole('Demandeur')) {
        $collective->statut                     =       $request->input('statut');
        }
        $collective->statut                     =       $statut;
        $collective->name                       =       $request->input('name');
        $collective->date_depot                 =       $request->input('date_depot');
        $collective->description                =       $request->input('description');
        $collective->projetprofessionnel        =       $request->input('projetprofessionnel');
        $collective->prerequis                  =       $request->input('prerequis');
        $collective->motivation                 =       $request->input('motivation');
        $collective->nbre_pieces                =       $request->input('nbre_pieces');
        $collective->fixe                       =       $structure_fixe;
        $collective->telephone                  =       $autre_tel;
        $utilisateur->bp                        =       $request->input('bpcol');
        $utilisateur->fax                       =       $request->input('faxcol');
        $collective->adresse                    =       $request->input('structure_adresse');
        $collective->autres_diplomes            =       $request->input('autres_diplomes');
        $collective->experience                 =       $request->input('experience');
        $collective->qualification              =       $request->input('qualification');
        if ($request->input('programme') !== null) {
            $collective->programmes_id          =       $programme_id;
        }
        $collective->communes_id                =       $commune_id;
        $collective->demandeurs_id              =       $demandeur->id;

        $collective->save();
        $collective->modules()->sync($request->input('modules'));

        if (!$user_connect->hasRole('Demandeur')) {
            return redirect()->route('collectives.index')->with('success', 'demande modifiée avec succès !');
        } else {
            return redirect()->route('profiles.show', ['user'=>$user_connect, 'user_connect'=>$user_connect])->with('success', 'votre demande modifiée avec succès !');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collective  $collective
     * @return \Illuminate\Http\Response
     */
    public function destroy(Collective $collective)
    {
        $user = Auth::user();
        $utilisateurs   =   $collective->demandeur->user;

        $deleted_by1 = $user->firstname;
        $deleted_by2 = $user->name;
        $deleted_by3 = $user->username;

        $deleted_by = $deleted_by1.' '.$deleted_by2.' ('.$deleted_by3.')';

        $utilisateurs->deleted_by      =      $deleted_by;

        $utilisateurs->save();
       
        if ($user->hasRole('super-admin') || $user->hasRole('Administrateur')) {
            $collective->demandeur->user->delete();
            $collective->demandeur->delete();
        } else {
            $collective->demandeur->delete();
        }
        
        $collective->delete();

        $message = $collective->demandeur->user->firstname.' '.$collective->demandeur->user->name.' a été supprimé(e)';

        if (!$user->hasRole('Demandeur')) {
            return redirect()->route('collectives.index')->with('success', $message);
        } else {
            return redirect()->route('profiles.show', ['user'=>$user])->with('success', $message);
        }
    }
}
