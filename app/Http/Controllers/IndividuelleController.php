<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Commune;
use App\Models\Region;
use App\Models\Niveaux;
use App\Models\Diplome;
use App\Models\Demandeur;
use App\Models\Module;
use App\Models\Programme;
use App\Models\TypesDemande;
use App\Models\Professionnelle;
use App\Models\Familiale;
use App\Models\User;
use App\Models\Etude;
use App\Models\Convention;
use App\Models\Projet;
use App\Models\Diplomespro;
use App\Models\Localite;
use App\Models\Zone;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Auth;
use Carbon\Carbon;

class IndividuelleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Courrier|Gestionnaire|Demandeur|Individuelle|Collective|Pcharge|Ageroute']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* $individuelles = Individuelle::where('cin', '>', 0)->get(); */
        $individuelles = Individuelle::skip(0)->take(1000)->get();




        $user = Auth::user();
        $user_connect = $user;
        $countries = DB::table('regions')->pluck("nom", "id");
        if (!$user->hasRole('Demandeur')) {
            return view('individuelles.index', compact('individuelles', 'countries'));
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
       
        $diplomes = Diplome::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $diplomespros = Diplomespro::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'id')->unique();
        $etude = Etude::distinct('name')->get()->pluck('name', 'id')->unique();

        $id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projetLocalites = Localite::join("projetslocalites", "projetslocalites.localites_id", "=", "localites.id")
        ->where("projetslocalites.projets_id", $id)
        ->get()->pluck('nom', 'nom')->unique();

        $modules = Module::distinct('name')
        ->get()->pluck('name', 'name')->unique();

        return view('individuelles.create', compact('etude', 'familiale', 'communes', 'diplomes', 'modules', 'projet_name', 'diplomespros'));
    }

    public function findNomDept(Request $request)
    {
        $communes=Commune::select('nom', 'id')->where('arrondissements_id', $request->id)->take(100)->get();
        return response()->json($communes);
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
                'sexe'                              =>    'required|string|max:10',
                'cin'                               =>    'required|string|min:13|max:15|unique:demandeurs,cin',
                /* 'numero_dossier'                    =>    'required|string|min:4|max:4|unique:demandeurs,numero_dossier', */
                'numero_dossier'                    =>    'required|string|min:4|max:4',
                'prenom'                            =>    'required|string|max:50',
                'nom'                               =>    'required|string|max:50',
                'date_naiss'                        =>    'required|date_format:Y-m-d',
                'date_depot'                        =>    'required|date_format:Y-m-d',
                'lieu_naissance'                    =>    'required|string|max:50',
                'telephone'                         =>    'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:12',
                'telephone_secondaire'              =>    'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:12',
                'adresse'                           =>    'required|string|max:100',
                /* 'email'                             =>    'required|string|email|max:255|unique:users,email', */
                'familiale'                         =>    'required',
                'enfant'                            =>    'required|numeric',
                'etude'                             =>    'required',
                'commune'                           =>    'required',
                'diplome'                           =>    'required',
                'diplomespro'                       =>    'required',
                'activite_travail'                  =>    'required',
                'travail_renumeration'              =>    'required',
                /* 'localites'                         =>    'required', */
                'activite_avenir'                   =>    'required',
                /* 'zones'                             =>    'required', */
                'handicap'                          =>    'required',
                'situation_economique'              =>    'required',
                'victime_social'                    =>    'required',
                'modules'                           =>    'required',
        ]
        );
        
        $handicap                           =        $request->input('handicap');
        $diplome                            =        $request->input('diplome');
        $diplomespro                        =        $request->input('diplomespro');
        $travail_renumeration               =        $request->input('travail_renumeration');
        $victime_social                     =        $request->input('victime_social');
        $autre_victime                      =        $request->input('autre_victime');
        $dossiers                           =        $request->input('dossiers');
        $salaire                            =        $request->input('salaire');
        $situation_economique               =        $request->input('situation_economique');
        $sexe                               =        $request->input('sexe');

        if ($diplome == "Autre") {
            $this->validate(
                $request,
                [
                    'autres_diplomes'                              =>    'required',
                    'annee_diplome'                                =>    'required|numeric',
                ]
            );
        }
        if ($diplomespro == "Autre") {
            $this->validate(
                $request,
                [
                    'autres_diplomes_pros'                         =>    'required',
                    'annee_diplome_professionelle'                 =>    'required|numeric',
                ]
            );
        }
        if ($diplome != "Aucun") {
            $this->validate(
                $request,
                [
                    'annee_diplome'                                 =>    'required|numeric',
                ]
            );
        }
        if ($diplomespro != "Aucun") {
            $this->validate(
                $request,
                [
                    'specialite'                                   =>    'required',
                    'annee_diplome_professionelle'                 =>    'required|numeric',
                ]
            );
        }
        if ($travail_renumeration == "Oui") {
            $this->validate(
                $request,
                [
                    'salaire'                                      =>    'required',
                ]
            );
        }
        if ($handicap == "Oui") {
            $this->validate(
                $request,
                [
                    'preciser_handicap'                             =>    'required'
                ]
            );
        }
        if ($victime_social == "Autre") {
            $this->validate(
                $request,
                [
                    'autre_victime'                                 =>    'required'
                ]
            );
        }
        if ($dossiers == "Copie diplomes ou attestations") {
            $this->validate(
                $request,
                [
                    'autre_diplomes_fournis'                         =>    'required'
                ]
            );
        }
        if ($dossiers == "Copie diplomes ou attestations") {
            $this->validate(
                $request,
                [
                    'autre_diplomes_fournis'                         =>    'required',
                    'nbre_pieces'                                    =>    'required'
                ]
            );
        }

        $note = 0;

        if ($travail_renumeration == "Oui") {
            $note = $note + 1;
        } elseif ($travail_renumeration == "Non") {
            $note = $note + 5;
        } else {
            $note = $note + 0;
        }

        if ($handicap == "Oui") {
            $note = $note + 5;
        } elseif ($handicap == "Non") {
            $note = $note + 0;
        } else {
            $note = $note + 0;
        }

        if ($sexe == "M") {
            $note = $note + 1;
        } elseif ($sexe == "F") {
            $note = $note + 2;
        } else {
            $note = $note + 0;
        }

        if ($salaire == "Indécent") {
            $note = $note + 5;
        } elseif ($salaire == "Moyen") {
            $note = $note + 2;
        } elseif ($salaire == "Bien") {
            $note = $note + 1;
        } else {
            $note = $note + 0;
        }

        if ($situation_economique == "Très faible") {
            $note = $note + 5;
        } elseif ($situation_economique == "Faible") {
            $note = $note + 4;
        } elseif ($situation_economique == "Moyenne") {
            $note = $note + 2;
        } elseif ($situation_economique == "Correcte") {
            $note = $note + 1;
        } else {
            $note = $note + 0;
        }

        if ($situation_economique == "Emigration irrégulière") {
            $note = $note + 4;
        } elseif ($situation_economique == "Déplacé ou démobilisé par le conflit") {
            $note = $note + 6;
        } elseif ($situation_economique == "Emprisonnement") {
            $note = $note + 3;
        } elseif ($situation_economique == "Aucun") {
            $note = $note + 1;
        } else {
            $note = $note + 0;
        }

        if ($diplomespro == "Aucun") {
            $note = $note + 5;
        } elseif ($diplomespro == "CAP") {
            $note = $note + 3;
        } elseif ($diplomespro == "BEP") {
            $note = $note + 2;
        } elseif ($diplomespro == "BT") {
            $note = $note + 1;
        } else {
            $note = $note + 0;
        }

        $user_connect           =   Auth::user();

        $user_id             =   User::latest('id')->first()->id;
        $username            =   strtolower($request->input('nom').$user_id);
        $numero_dossier      =   $request->input('numero_dossier');
        $email               =   $username.".".$numero_dossier."@gmail.com";

        $created_by  = strtolower($user_connect->username);
        $updated_by  = strtolower($user_connect->username);

        $annee = date('y');
        $longueur = strlen($user_id);

        if ($longueur <= 1) {
            $numero   =   "I".strtolower("000000".$user_id."".$annee);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero   =   "I".strtolower("00000".$user_id."".$annee);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero   =   "I".strtolower("0000".$user_id."".$annee);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero   =   "I".strtolower("000".$user_id."".$annee);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numero   =   "I".strtolower("00".$user_id."".$annee);
        } elseif ($longueur >= 6 && $longueur < 7) {
            $numero   =   "I".strtolower("0".$user_id."".$annee);
        } else {
            $numero   =   "I".strtolower($user_id."".$annee);
        }

        if ($request->input('sexe') == "M") {
            $civilite = "M.";
        } elseif ($request->input('sexe') == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }

        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
        $telephone_secondaire = $request->input('telephone_secondaire');
        $telephone_secondaire = str_replace(' ', '', $telephone_secondaire);
        
        $diplome_id = Diplome::where('sigle', $request->input('diplome'))->first()->id;
        $diplomepro_id = Diplomespro::where('sigle', $request->input('diplomespro'))->first()->id;
        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        /* $zones_id = Zone::where('nom', $request->input('zones'))->first()->id; */
        $modules_id = Module::where('name', $request->input('modules'))->first()->id;
        /* $localites_id = Localite::where('nom', $request->input('localites'))->first()->id; */
        $familiale_id = $request->input('familiale');
        $etude_id = $request->input('etude');
        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);



        $user = new User([
            'sexe'                      =>      $sexe,
            'civilite'                  =>      $civilite,
            'firstname'                 =>      $request->input('prenom'),
            'name'                      =>      $request->input('nom'),
            'email'                     =>      $email,
            'username'                  =>      $username,
            'telephone'                 =>      $telephone,
            'bp'                        =>      $request->input('bp'),
            'fax'                       =>      $request->input('fax'),
            'date_naissance'            =>      $request->input('date_naiss'),
            'lieu_naissance'            =>      $request->input('lieu_naissance'),
            'adresse'                   =>      $request->input('adresse'),
            'password'                  =>      Hash::make($email),
            'familiales_id'             =>      $familiale_id,
            'created_by'                =>      $created_by,
            'updated_by'                =>      $updated_by

        ]);

        $user->save();
        
        $types_demandes_id = TypesDemande::where('name', 'Individuelle')->first()->id;

        $demandeur = new Demandeur([
                    'cin'                       =>     $cin,
                    'numero_dossier'            =>     $numero_dossier,
                    'types_demandes_id'         =>     $types_demandes_id,
                    'users_id'                  =>     $user->id
                ]);
        
        $demandeur->save();

        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet = Projet::find($projet_id);
        
        $individuelle = new Individuelle([
            'date_depot'                        =>     $request->input('date_depot'),
            'optiondiplome'                     =>     $request->input('specialite'),
            'adresse'                           =>     $request->input('adresse'),
            'autres_diplomes'                   =>     $request->input('autres_diplomes'),
            'autres_diplomes_pros'              =>     $request->input('autres_diplomes_pros'),
            'nbre_enfants'                      =>     $request->input('enfant'),
            'annee_diplome'                     =>     $request->input('annee_diplome'),
            'annee_diplome_professionelle'      =>     $request->input('annee_diplome_professionelle'),
            'activite_travail'                  =>     $request->input('activite_travail'),
            'travail_renumeration'              =>     $request->input('travail_renumeration'),
            'activite_avenir'                   =>     $request->input('activite_avenir'),
            'handicap'                          =>     $request->input('handicap'),
            'preciser_handicap'                 =>     $request->input('preciser_handicap'),
            'situation_economique'              =>     $situation_economique,
            'victime_social'                    =>     $victime_social,
            'autre_victime'                     =>     $request->input('autre_victime'),
            'salaire'                           =>     $salaire,
            'dossier'                           =>     $request->get('dossiers'),
            'autre_diplomes_fournis'            =>     $request->input('autre_diplomes_fournis'),
            'nbre_pieces'                       =>     $request->input('nbre_pieces'),
            'statut'                            =>     'attente',
            'note'                              =>     $note,
            'telephone'                         =>     $telephone_secondaire,
            'etudes_id'                         =>     $etude_id,
            'communes_id'                       =>     $commune_id,
            'diplomes_id'                       =>     $diplome_id,
            'diplomespros_id'                   =>     $diplomepro_id,
            /* 'zones_id'                          =>     $zones_id,
            'localites_id'                      =>     $localites_id, */
            'projets_id'                        =>     $projet_id,
            'modules_id'                        =>     $modules_id,
            'created_by'                        =>     $created_by,
            'updated_by'                        =>     $updated_by,
            'demandeurs_id'                     =>     $demandeur->id
            ]);
            
        $individuelle->save();

        $success = "demande ajouté avec succès !";
        return back()->with(compact('success'));

        /* return redirect()->route('individuelles.index')->with('success', 'demandeur ajouté avec succès !'); */
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $individuelle = Individuelle::find($id);
        $localites = Localite::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $zones = Zone::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $modules = Module::distinct('name')->get()->pluck('name', 'name')->unique();

        $diplomes = Diplome::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $diplomespros = Diplomespro::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'name')->unique();
        $etude = Etude::distinct('name')->get()->pluck('name', 'name')->unique();

        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        $projetModules = DB::table("projetsmodules")->where("projetsmodules.projets_id", $projet_id)
        ->pluck('projetsmodules.modules_id', 'projetsmodules.modules_id')
        ->all();

        $projetModules  = Module::find($projetModules);

        $prenom = $individuelle->demandeur->user->firstname;
        $nom = $individuelle->demandeur->user->name;

        $name = $prenom.' '.$nom;

        $name = htmlentities($name, ENT_NOQUOTES, 'utf-8');
        $name = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $name);
        $name = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $name);
        $name = preg_replace('#&[^;]+;#', '', $name);
        
        $anne = date('d');
        $anne = $anne.' '.date('m');
        $anne = $anne.' '.date('Y');
        $anne = $anne.' à '.date('H').'h';
        $anne = $anne.' '.date('i').'min';
        $anne = $anne.' '.date('s').'s';

        $dompdf = new Dompdf();
        $options = $dompdf->getOptions();
        $options->setDefaultFont('Courier');
        $options->setIsHtml5ParserEnabled(true);
        $dompdf->setOptions($options);

        $dompdf->loadHtml(view('individuelles.show', compact(
            'localites',
            'projetModules',
            'zones',
            'modules',
            'individuelle',
            'etude',
            'familiale',
            'communes',
            'diplomes',
            'projet_name',
            'diplomespros'
        )));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Fiche de candidature de '.$name.' du '.$anne.'.pdf', ['Attachment' => false]);
    }

    public function details($id)
    {
        $individuelle = Individuelle::find($id);

        $civilites = User::pluck('civilite', 'civilite');

        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();

        $diplomes = Diplome::distinct('name')->get()->pluck('name', 'id')->unique();
    
        $programmes = Programme::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();

        $niveaux = Niveaux::distinct('name')->get()->pluck('name', 'name')->unique();

        $communes = commune::distinct('nom')->get()->pluck('nom', 'id')->unique();

        return view('individuelles.details', compact(
            'individuelle',
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
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $auth_user      =       Auth::user();
        $individuelle = Individuelle::find($id);
        
        if ($individuelle->demandeur->user->created_by != $individuelle->demandeur->user->updated_by && !$auth_user->hasRole('Administrateur|Super-admin')) {
            $messages = "Désolé ! vous n'avez pas le droit de modifier cet enregistrement, veuillez contacter la personne qui a effectué cet enregistrement";
            return back()->with(compact('messages'));
        }

        $localites = Localite::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $zones = Zone::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $modules = Module::distinct('name')->get()->pluck('name', 'name')->unique();

        $diplomes = Diplome::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $diplomespros = Diplomespro::distinct('sigle')->get()->pluck('sigle', 'sigle')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'name')->unique();
        $etude = Etude::distinct('name')->get()->pluck('name', 'name')->unique();

        return view(
            'individuelles.update',
            compact(
                'localites',
                'zones',
                'modules',
                'individuelle',
                'etude',
                'familiale',
                'communes',
                'diplomes',
                'diplomespros'
            )
        );
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
        $user_connect           =   Auth::user();
        $demandeur = $individuelle->demandeur;
        $id_demandeur = $demandeur->id;
        $utilisateur   =   $demandeur->user;

        $formation = $individuelle->formation;
  
        $auth_user      =       Auth::user();

        $this->validate(
            $request,
            [
                'sexe'                              =>    'required|string|max:10',
                'cin'                               =>    'required|string|min:13|max:15|unique:demandeurs,cin,'.$id_demandeur,
                'prenom'                            =>    'required|string|max:50',
                'nom'                               =>    'required|string|max:50',
                'date_naiss'                        =>    'required|date_format:Y-m-d',
                'date_depot'                        =>    'required|date_format:Y-m-d',
                'lieu_naissance'                    =>    'required|string|max:50',
                'telephone'                         =>    'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:12',
                'telephone_secondaire'              =>    'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:12',
                'adresse'                           =>    'required|string|max:100',
                'email'                             =>    'required|string|email|max:255|unique:users,email,'.$utilisateur->id,
                'familiale'                         =>    'required',
                'enfant'                            =>    'required|numeric',
                'etude'                             =>    'required',
                'commune'                           =>    'required',
                'diplome'                           =>    'required',
                'diplomespro'                       =>    'required',
                'activite_travail'                  =>    'required',
                'travail_renumeration'              =>    'required',
                'activite_avenir'                   =>    'required',
                'handicap'                          =>    'required',
                'situation_economique'              =>    'required',
                'victime_social'                    =>    'required',
                'module'                            =>    'required',
        ]
        );
        
        if (isset($formation) && $formation->module->name != $request->input('module')) {
            $messages = "Désolé ! vous ne pouvez pas changer le module demandé, car ce demandeur bénéficie déjà d'une formation";
            return back()->with(compact('messages'));
        }

        $handicap                           =        $request->input('handicap');
        $diplome                            =        $request->input('diplome');
        $diplomespro                        =        $request->input('diplomespro');
        $travail_renumeration               =        $request->input('travail_renumeration');
        $victime_social                     =        $request->input('victime_social');
        $autre_victime                      =        $request->input('autre_victime');
        $dossiers                           =        $request->input('dossiers');
        $salaire                            =        $request->input('salaire');
        $situation_economique               =        $request->input('situation_economique');
        $sexe                               =        $request->input('sexe');

        if ($diplome == "Autre") {
            $this->validate(
                $request,
                [
                    'autres_diplomes'                              =>    'required',
                    'annee_diplome'                                =>    'required|numeric',
                ]
            );
        }
        
        if ($diplomespro == "Autre") {
            $this->validate(
                $request,
                [
                    'autres_diplomes_pros'                         =>    'required',
                    'annee_diplome_professionelle'                 =>    'required|numeric',
                ]
            );
        }
        
        if ($diplome != "Aucun") {
            $this->validate(
                $request,
                [
                    'annee_diplome'                                 =>    'required|numeric',
                ]
            );
        }
        
        if ($diplomespro != "Aucun") {
            $this->validate(
                $request,
                [
                    'specialite'                                   =>    'required',
                    'annee_diplome_professionelle'                 =>    'required|numeric',
                ]
            );
        }
        
        if ($travail_renumeration == "Oui") {
            $this->validate(
                $request,
                [
                    'salaire'                                      =>    'required',
                ]
            );
        }
        
        if ($handicap == "Oui") {
            $this->validate(
                $request,
                [
                    'preciser_handicap'                             =>    'required'
                ]
            );
        }
        
        if ($victime_social == "Autre") {
            $this->validate(
                $request,
                [
                    'autre_victime'                                 =>    'required'
                ]
            );
        }
        if ($dossiers == "Copie diplomes ou attestations") {
            $this->validate(
                $request,
                [
                    'autre_diplomes_fournis'                         =>    'required',
                    'nbre_pieces'                                    =>    'required'
                ]
            );
        }
        
        $note = 0;

        if ($travail_renumeration == "Oui") {
            $note = $note + 1;
        } elseif ($travail_renumeration == "Non") {
            $note = $note + 5;
        } else {
            $note = $note + 0;
        }

        if ($handicap == "Oui") {
            $note = $note + 5;
        } elseif ($handicap == "Non") {
            $note = $note + 0;
        } else {
            $note = $note + 0;
        }

        if ($sexe == "M") {
            $note = $note + 1;
        } elseif ($sexe == "F") {
            $note = $note + 2;
        } else {
            $note = $note + 0;
        }

        if ($salaire == "Indécent") {
            $note = $note + 5;
        } elseif ($salaire == "Moyen") {
            $note = $note + 2;
        } elseif ($salaire == "Bien") {
            $note = $note + 1;
        } else {
            $note = $note + 0;
        }

        if ($situation_economique == "Très faible") {
            $note = $note + 5;
        } elseif ($situation_economique == "Faible") {
            $note = $note + 4;
        } elseif ($situation_economique == "Moyenne") {
            $note = $note + 2;
        } elseif ($situation_economique == "Correcte") {
            $note = $note + 1;
        } else {
            $note = $note + 0;
        }

        if ($situation_economique == "Emigration irrégulière") {
            $note = $note + 4;
        } elseif ($situation_economique == "Déplacé ou démobilisé par le conflit") {
            $note = $note + 6;
        } elseif ($situation_economique == "Emprisonnement") {
            $note = $note + 3;
        } elseif ($situation_economique == "Aucun") {
            $note = $note + 1;
        } else {
            $note = $note + 0;
        }

        if ($diplomespro == "Aucun") {
            $note = $note + 5;
        } elseif ($diplomespro == "CAP") {
            $note = $note + 3;
        } elseif ($diplomespro == "BEP") {
            $note = $note + 2;
        } elseif ($diplomespro == "BT") {
            $note = $note + 1;
        } else {
            $note = $note + 0;
        }

        $user_id             =   User::latest('id')->first()->id;

        if ($request->input('sexe') == "M") {
            $civilite = "M.";
        } elseif ($request->input('sexe') == "F") {
            $civilite = "Mme";
        } else {
            $civilite = "";
        }

        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
        $telephone_secondaire = $request->input('telephone_secondaire');
        $telephone_secondaire = str_replace(' ', '', $telephone_secondaire);
        
        $diplome_id = Diplome::where('sigle', $request->input('diplome'))->first()->id;
        $diplomepro_id = Diplomespro::where('sigle', $request->input('diplomespro'))->first()->id;
        $familiale_id = Familiale::where('name', $request->input('familiale'))->first()->id;
        $commune_id = Commune::where('nom', $request->input('commune'))->first()->id;
        $etude_id = Etude::where('name', $request->input('etude'))->first()->id;
        $modules_id = Module::where('name', $request->input('module'))->first()->id;

        $cin = $request->input('cin');
        $cin = str_replace(' ', '', $cin);
        
        $user_connect           =              Auth::user();
        $updated_by             =              strtolower($user_connect->username);
        
        $utilisateur->sexe                      =      $sexe;
        $utilisateur->civilite                  =      $civilite;
        $utilisateur->firstname                 =      $request->input('prenom');
        $utilisateur->name                      =      $request->input('nom');
        $utilisateur->email                     =      $request->input('email');
        $utilisateur->username                  =      $request->input('username');
        $utilisateur->telephone                 =      $telephone;
        $utilisateur->bp                        =      $request->input('bp');
        $utilisateur->fax                       =      $request->input('fax');
        $utilisateur->date_naissance            =      $request->input('date_naiss');
        $utilisateur->lieu_naissance            =      $request->input('lieu_naissance');
        $utilisateur->adresse                   =      $request->input('adresse');
        $utilisateur->familiales_id             =      $familiale_id;
        $utilisateur->updated_by                =      $request->input('updated_by');

        $utilisateur->save();

        $types_demandes_id = TypesDemande::where('name', 'Individuelle')->first()->id;
        
        $demandeur->cin                         =     $cin;
        $demandeur->numero_dossier              =     $request->input('numero_dossier');
        $demandeur->types_demandes_id           =      $types_demandes_id;
        $demandeur->users_id                    =      $utilisateur->id;

        $demandeur->save();

        $projets_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet = Projet::find($projets_id);
        /* $dossier = implode(";", $request->get('dossier')); */
        
        $individuelle->date_depot                      =     $request->input('date_depot');
        $individuelle->nbre_pieces                     =     $request->input('nbre_pieces');
        $individuelle->optiondiplome                   =     $request->input('specialite');
        $individuelle->adresse                         =     $request->input('adresse');
        $individuelle->autres_diplomes                 =     $request->input('autres_diplomes');
        $individuelle->autres_diplomes_pros            =     $request->input('autres_diplomes_pros');
        $individuelle->nbre_enfants                    =     $request->input('enfant');
        $individuelle->annee_diplome                   =     $request->input('annee_diplome');
        $individuelle->annee_diplome_professionelle    =     $request->input('annee_diplome_professionelle');
        $individuelle->activite_travail                =     $request->input('activite_travail');
        $individuelle->travail_renumeration            =     $request->input('travail_renumeration');
        $individuelle->activite_avenir                 =     $request->input('activite_avenir');
        $individuelle->handicap                        =     $request->input('handicap');
        $individuelle->preciser_handicap               =     $request->input('preciser_handicap');
        $individuelle->situation_economique            =     $situation_economique;
        $individuelle->victime_social                  =     $request->input('victime_social');
        $individuelle->autre_victime                   =     $request->input('autre_victime');
        $individuelle->salaire                         =     $salaire;
        $individuelle->note                            =     $note;
        $individuelle->dossier                         =     $request->input('dossiers');
        $individuelle->autre_diplomes_fournis          =     $request->input('autre_diplomes_fournis');
        $individuelle->telephone                       =     $telephone_secondaire;
        $individuelle->etudes_id                       =     $etude_id;
        $individuelle->communes_id                     =     $commune_id;
        $individuelle->diplomes_id                     =     $diplome_id;
        $individuelle->diplomespros_id                 =     $diplomepro_id;
        $individuelle->modules_id                      =     $modules_id;
        $individuelle->projets_id                      =     $projets_id;
        $individuelle->demandeurs_id                   =     $demandeur->id;
            
        $individuelle->save();
        

        $message = 'demandeur '.$utilisateur->firstname.' '.$utilisateur->name.' a été modifié avec succès';
        return redirect()->route('individuelles.index')->with(compact('message'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Individuelle $individuelle)
    {
        $user = Auth::user();
        $utilisateurs   =   $individuelle->demandeur->user;

        $deleted_by1 = $user->firstname;
        $deleted_by2 = $user->name;
        $deleted_by3 = $user->username;

        $deleted_by = $deleted_by1.' '.$deleted_by2.' ('.$deleted_by3.')';

        $utilisateurs->deleted_by      =      $deleted_by;

        $utilisateurs->save();
        
        $individuelle->delete();

        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été supprimé(e)';

        if (!$user->hasRole('Demandeur')) {
            return redirect()->route('individuelles.index')->with('success', $message);
        } else {
            return redirect()->route('profiles.show', ['user'=>$user])->with('success', $message);
        }
    }

    public function list(Request $request)
    {
        $modules=Individuelle::with('demandeur.modules')->get();
        return Datatables::of($modules)->make(true);
    }
}
