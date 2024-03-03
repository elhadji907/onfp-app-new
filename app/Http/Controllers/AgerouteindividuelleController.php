<?php

namespace App\Http\Controllers;

use App\Models\Individuelle;
use App\Models\Projet;
use App\Models\Module;
use App\Models\Diplome;
use App\Models\Commune;
use App\Models\Familiale;
use App\Models\Professionnelle;
use App\Models\Etude;
use App\Models\Localite;
use App\Models\Zone;
use App\Models\User;
use App\Models\TypesDemande;
use App\Models\Demandeur;
use App\Models\Diplomespro;
use Auth;
use DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AgerouteindividuelleController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Ageroute|Gestionnaire|Demandeur|Individuelle|Collective|Pcharge']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_projet = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($id_projet);
        $individuelles = Individuelle::skip(0)->take(1000)->get();

        $ziguinchor_id = Localite::where('nom', 'Ziguinchor')->first()->id;
        $bignona_id = Localite::where('nom', 'Bignona')->first()->id;
        $bounkiling_id = Localite::where('nom', 'Bounkiling')->first()->id;
        
        $ziguinchor_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $ziguinchor_id)->count();
        $bignona_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $bignona_id)->count();
        $bounkiling_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $bounkiling_id)->count();

        $total_count = Individuelle::where('projets_id', '=', $id_projet)->count();

        if ($total_count != 0) {
            $ziguinchor_p               =      ($ziguinchor_count / $total_count) * 100;
            $bignona_p                  =      ($bignona_count / $total_count) * 100;
            $bounkiling_p               =      ($bounkiling_count / $total_count) * 100;
            $total_p                    =      ($total_count / $total_count) * 100;
        } else {
            
            $ziguinchor_p               =      0;
            $bignona_p                  =      0;
            $bounkiling_p               =      0;
            $total_p                    =      0;
        }

        
        $ziguinchor_p               =       round($ziguinchor_p, 2);
        $bignona_p                  =       round($bignona_p, 2);
        $bounkiling_p               =       round($bounkiling_p, 2);
     
        return view('agerouteindividuelles.index', compact('projet', 'projet_name', 'individuelles', 'ziguinchor_count', 'bignona_count', 'bounkiling_count', 'total_count', 'ziguinchor_p', 'bignona_p', 'bounkiling_p', 'total_p'));
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
        
        $projetZones = Zone::join("projetszones", "projetszones.zones_id", "=", "zones.id")
        ->where("projetszones.projets_id", $id)
        ->get()->pluck('nom', 'nom')->unique();

        $projetModules = Module::join("projetsmodules", "projetsmodules.modules_id", "=", "modules.id")
        ->where("projetsmodules.projets_id", $id)
        ->get()->pluck('name', 'name')->unique();

        return view('agerouteindividuelles.create', compact('etude', 'familiale', 'communes', 'diplomes', 'projetModules', 'projetZones', 'projetLocalites', 'projet_name', 'diplomespros'));
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
                'localites'                         =>    'required',
                'activite_avenir'                   =>    'required',
                'zones'                             =>    'required',
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
        
        /*  $created_by1 = $user_connect->firstname;
         $created_by2 = $user_connect->name;
         $created_by3 = $user_connect->username;

         $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')'; */

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
        $zones_id = Zone::where('nom', $request->input('zones'))->first()->id;
        $modules_id = Module::where('name', $request->input('modules'))->first()->id;
        $localites_id = Localite::where('nom', $request->input('localites'))->first()->id;
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

        /*  $user->assignRole('Individuelle');
         $user->assignRole('Demandeur'); */
        
        $types_demandes_id = TypesDemande::where('name', 'Individuelle')->first()->id;

        $demandeur = new Demandeur([
                    'cin'                       =>     $cin,
                    'numero_dossier'            =>     $numero_dossier,
                    'types_demandes_id'         =>     $types_demandes_id,
                    'users_id'                  =>     $user->id
                ]);
        
        $demandeur->save();

        /* $dossier = implode(";", $request->get('dossier')); */
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
            'zones_id'                          =>     $zones_id,
            'localites_id'                      =>     $localites_id,
            'projets_id'                        =>     $projet_id,
            'modules_id'                        =>     $modules_id,
            'created_by'                        =>     $created_by,
            'updated_by'                        =>     $updated_by,
            'demandeurs_id'                     =>     $demandeur->id
            ]);
            
        $individuelle->save();

        /*  $zones_id = Zone::where('nom', $request->input('zones'))->first()->id;
         $localites_id = Localite::where('nom', $request->input('localites'))->first()->id;
         $modules1_id = Module::where('name', $request->input('modules1'))->first()->id;

         $module2 = $request->input('modules2');

         if (isset($module2)) {
             $modules2_id = Module::where('name', $module2)->first()->id;
         }
         $module3 = $request->input('modules3');

         if (isset($module3)) {
             $modules3_id = Module::where('name', $module3)->first()->id;
         }

         $individuelle->modules()->attach($modules1_id);
         if (isset($module2)) {
             $individuelle->modules()->attach($modules2_id);
         }
         if (isset($module3)) {
             $individuelle->modules()->attach($modules3_id);
         } */
        /* $individuelle->projets()->sync($projet_id);
        $individuelle->zones()->sync($zones_id);
        $individuelle->localites()->sync($localites_id); */

        $success = "demandeur ajouté avec succès !";
        return back()->with(compact('success'));

        /* return redirect()->route('agerouteindividuelles.index')->with('success', 'demandeur ajouté avec succès !'); */
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

        /*      $individuelleLocalites = DB::table("individuelleslocalites")->where("individuelleslocalites.individuelles_id", $id)
             ->pluck('individuelleslocalites.localites_id', 'individuelleslocalites.localites_id')
             ->all();

             $individuelleZones = DB::table("individuelleszones")->where("individuelleszones.individuelles_id", $id)
             ->pluck('individuelleszones.zones_id', 'individuelleszones.zones_id')
             ->all();

             $individuelleModules = DB::table("individuellesmodules")->where("individuellesmodules.individuelles_id", $id)
             ->pluck('individuellesmodules.modules_id', 'individuellesmodules.modules_id')
             ->all(); */

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

        $dompdf->loadHtml(view('agerouteindividuelles.show', compact(
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

        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;

        /*     $individuelleLocalites = DB::table("individuelleslocalites")->where("individuelleslocalites.individuelles_id", $id)
            ->pluck('individuelleslocalites.localites_id', 'individuelleslocalites.localites_id')
            ->all();

            $individuelleZones = DB::table("individuelleszones")->where("individuelleszones.individuelles_id", $id)
            ->pluck('individuelleszones.zones_id', 'individuelleszones.zones_id')
            ->all();

            $individuelleModules = DB::table("individuellesmodules")->where("individuellesmodules.individuelles_id", $id)
            ->pluck('individuellesmodules.modules_id', 'individuellesmodules.modules_id')
            ->all(); */

        $projetModules = DB::table("projetsmodules")->where("projetsmodules.projets_id", $projet_id)
        ->pluck('projetsmodules.modules_id', 'projetsmodules.modules_id')
        ->all();

        $projetModules  = Module::find($projetModules);

        return view(
            'agerouteindividuelles.update',
            compact(
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
        /* $this->authorize('update',  $individuelle); */
        
        /*     if ($individuelle->demandeur->user->created_by != $individuelle->demandeur->user->updated_by && !$auth_user->hasRole('Administrateur|Super-admin')) {
                $messages = "Désolé ! vous n'avez pas le droit de modifier cet enregistrement, veuillez contacter la personne qui a effectué cet enregistrement";
                return back()->with(compact('messages'));
            } */

        $this->validate(
            $request,
            [
                'sexe'                              =>    'required|string|max:10',
                /* 'numero_dossier'                    =>    'required|string|min:4|max:4||unique:demandeurs,numero_dossier,'.$id_demandeur, */
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
                'localite'                          =>    'required',
                'activite_avenir'                   =>    'required',
                'zone'                              =>    'required',
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
      
        /*   $updated_by1 = $user_connect->firstname;
          $updated_by2 = $user_connect->name;
          $updated_by3 = $user_connect->username;

          $updated_by = $updated_by1.' '.$updated_by2.' ('.$updated_by3.')'; */

        $user_id             =   User::latest('id')->first()->id;
        /*  $username            =   strtolower($request->input('nom').$user_id);
         $updated_by          =   strtolower($request->input('nom').$user_id); */

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
        $localites_id = Localite::where('nom', $request->input('localite'))->first()->id;
        $zones_id = Zone::where('nom', $request->input('zone'))->first()->id;

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
        $individuelle->zones_id                        =     $zones_id;
        $individuelle->modules_id                      =     $modules_id;
        $individuelle->localites_id                    =     $localites_id;
        $individuelle->projets_id                      =     $projets_id;
        $individuelle->demandeurs_id                   =     $demandeur->id;
            
        $individuelle->save();
        
        /* $zones_id = Zone::where('nom', $request->input('zone'))->first()->id;
        $localites_id = Localite::where('nom', $request->input('localite'))->first()->id;
        $modules_id = Module::where('name', $request->input('module'))->first()->id; */
        
        /* $individuelle->projets()->sync($projet_id); */

        $message = 'demandeur '.$utilisateur->firstname.' '.$utilisateur->name.' a été modifié avec succès';
        return redirect()->route('agerouteindividuelles.index')->with(compact('message'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Individuelle  $individuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();
        $individuelle   = Individuelle::find($id);
        $utilisateurs   =   $individuelle->demandeur->user;

        $deleted_by1 = $user->firstname;
        $deleted_by2 = $user->name;
        $deleted_by3 = $user->username;

        $deleted_by = $deleted_by1.' '.$deleted_by2.' ('.$deleted_by3.')';

        $utilisateurs->deleted_by      =      $deleted_by;

        $utilisateurs->save();
        
        $individuelle->delete();

        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été supprimé(e)';

        return redirect()->route('agerouteindividuelles.index')->with('success', $message);
    }

    /*     public function listerparlocalite($projet, $localite)
        {
            $projet = Projet::find($projet);

            dd($localite);

            return view('agerouteindividuelles.listerparlocalite', compact('projet', 'localite'));
        } */

    public function listerparmodulelocalite($projet, $localite, $module)
    {
        $id_projet              = $projet;
        $id_localite            = Localite::where('nom', $localite)->first()->id;
        $projet                 = Projet::find($projet);
        $individuelles          = $projet->individuelles;
        $modules                = Module::find($module);
        $localite_concernee     = $localite;

        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'attente')
                ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'rejeter')
                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'accepter')
                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->count();

        return view('agerouteindividuelles.listerparmodulelocalite', compact('projet', 'localite', 'module', 'modules', 'localite_concernee', 'individuelles', 'attente', 'rejeter', 'accepter', 'total'));
    }
    public function listerparmodulelocalites($projet, $localite, $module)
    {
        $id_projet              = $projet;
        $id_localite            = Localite::where('nom', $localite)->first()->id;
        $projet                 = Projet::find($projet);
        $individuelles          = $projet->individuelles;

        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'attente')
                ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'rejeter')
                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'accepter')
                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->count();

        return view('ageroutemodules.listerparmodulelocalites', compact('projet', 'localite', 'module', 'individuelles', 'attente', 'rejeter', 'accepter', 'total'));
    }
    public function listerparmodulelocalitesaccepter($projet, $localite, $module)
    {
        $id_projet              = $projet;
        $id_localite            = Localite::where('nom', $localite)->first()->id;
        $projet                 = Projet::find($projet);
        $individuelles          = $projet->individuelles;

        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'attente')
                ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'rejeter')
                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('statut', '=', 'accepter')
                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->count();

        return view('ageroutemodules.listerparmodulelocalitesaccepter', compact('projet', 'localite', 'module', 'individuelles', 'attente', 'rejeter', 'accepter', 'total'));
    }

    public function listerparmodulezone($projet, $zone, $module)
    {
        $projet = Projet::find($projet);
        $individuelles = $projet->individuelles;
        $modules = Module::find($module);
        $zone_concernee = $zone;

        return view('agerouteindividuelles.listerparmodulezone', compact('projet', 'zone_concernee', 'module', 'modules', 'individuelles'));
    }

    public function listerparmodulezoneretenues($projet, $zone, $module)
    {
        $projet = Projet::find($projet);
        $individuelles = $projet->individuelles;
        $modules = Module::find($module);
        $zone_concernee = $zone;

        $zones = Zone::where('nom', $zone)->first()->id;
        $zones = Zone::find($zones);

        return view('ageroutezones.listerparmodulezoneretenues', compact('projet', 'zone_concernee', 'module', 'modules', 'individuelles', 'zones'));
    }

    public function listercandidatzonevalidesexes($projet, $zone, $module, $civilite)
    {
        $projet = Projet::find($projet);
        $individuelles = $projet->individuelles;
        $modules = Module::find($module);
        $zone_concernee = $zone;

        $zones = Zone::where('nom', $zone)->first()->id;
        $zones = Zone::find($zones);

        return view('ageroutezones.listercandidatzonevalidesexes', compact('projet', 'zone_concernee', 'module', 'modules', 'individuelles', 'zones', 'civilite'));
    }

    public function listercandidatlocalitevalidesexes($projet, $localite, $module, $civilite)
    {
        $projet = Projet::find($projet);
        $individuelles = $projet->individuelles;
        $modules = Module::find($module);
        $localite_concernee = $localite;

        $localites = Localite::where('nom', $localite)->first()->id;
        $localites = localite::find($localites);

        return view('ageroutelocalites.listercandidatlocalitevalidesexes', compact('projet', 'localite_concernee', 'module', 'modules', 'individuelles', 'localites', 'civilite'));
    }

    public function listercandidatzonevalidepmr($projet, $zone, $module, $pmr)
    {
        $projet = Projet::find($projet);
        $individuelles = $projet->individuelles;
        $modules = Module::find($module);
        $zone_concernee = $zone;

        $zones = Zone::where('nom', $zone)->first()->id;
        $zones = Zone::find($zones);

        return view('ageroutezones.listercandidatzonevalidepmr', compact('projet', 'zone_concernee', 'module', 'modules', 'individuelles', 'zones', 'pmr'));
    }

    public function listercandidatzonevalidevictimesocial($projet, $zone, $module, $victimesocial)
    {
        $projet = Projet::find($projet);
        $individuelles = $projet->individuelles;
        $modules = Module::find($module);
        $zone_concernee = $zone;

        $zones = Zone::where('nom', $zone)->first()->id;
        $zones = Zone::find($zones);

        return view('ageroutezones.listercandidatzonevalidevictimesocial', compact('projet', 'zone_concernee', 'module', 'modules', 'individuelles', 'zones', 'victimesocial'));
    }

    /*   public function agerouteattente($statut)
      {
          $individuelles = Individuelle::get()->where('statut', '=', 'Attente');

          $effectif = Individuelle::get()->where('statut', '=', 'Attente')
                                    ->count();

          return view('agerouteindividuelles.attente', compact('statut', 'individuelles', 'effectif'));
      } */

    public function moduleindividuelle($projet, $individuelle)
    {
        $projet = Projet::find($projet);
        $individuelle = Individuelle::find($individuelle);

        $cin_individuelle = $individuelle->cin;
        $prenom_individuelle = $individuelle->demandeur->user->firstname;
        $nom_individuelle = $individuelle->demandeur->user->name;
        $civilite_individuelle = $individuelle->demandeur->user->civilite;

        return view('agerouteindividuelles.moduleindividuelle', compact('projet', 'cin_individuelle', 'prenom_individuelle', 'nom_individuelle', 'civilite_individuelle'));
    }

    public function agerouteattente($individuelle, $statut, $module)
    {
        $module = Module::find($module);

        $individuelle = Individuelle::find($individuelle);

        $individuelle->statut     =   $statut;

        $individuelle->save();

        $message = "La demande de " .$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' est ' .$statut;
        return back()->with(compact('message'));
    }

    public function ageroutelisteattente($individuelle, $statut, $module)
    {
        $module = Module::find($module);

        $individuelle = Individuelle::find($individuelle);

        $individuelle->statut     =   $statut;

        $individuelle->save();

        $message = "La demande de " .$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' est ' .$statut;
        return back()->with(compact('message'));
    }

    /*     public function agerouteencours($individuelle, $statut, $module, $numero)
        {
            $module = Module::find($module);

            $individuelle = Individuelle::find($individuelle);

            $individuelle->statut     =   $statut;

            $individuelle->save();

            $message = "La demande de " .$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' est ' .$statut;
            return back()->with(compact('message'));
        } */

    public function agerouterejeter($individuelle, $statut, $module)
    {
        $module = Module::find($module);

        $individuelle = Individuelle::find($individuelle);

        $individuelle->statut     =   $statut;
        
        $individuelle->save();
        
        $message = "La demande de " .$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' est ' .$statut;
        return back()->with(compact('message'));
    }

    public function agerouteretenues($individuelle, $statut, $module)
    {
        $module = Module::find($module);

        $individuelle = Individuelle::find($individuelle);

        $individuelle->statut     =   $statut;

        $individuelle->save();
        
        $message = "La demande de " .$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' est ' .$statut;
        return back()->with(compact('message'));
    }

    public function agerouteterminer($individuelle, $statut, $module, $numero)
    {
        $module = Module::find($module);

        $individuelle = Individuelle::find($individuelle);

        $individuelle->statut     =   $statut;
        
        $individuelle->save();
        
        $message = "La demande de " .$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' est ' .$statut;
        return back()->with(compact('message'));
    }

    public function ageroutepresel($module, $statut, $individuelle)
    {
        $module = Module::find($module);

        $individuelle = Individuelle::find($individuelle);

        $individuelle->statut        =   $statut;
        $individuelle->modules_id    =   $module->name;
        
        $individuelle->save();
        
        $message = "La demande de " .$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été accordée';
        return back()->with(compact('message'));
    }

    public function candidatspmr($localite, $projet, $handicap)
    {
        $id_projet              = $projet;
        $id_localite            = $localite;
        $projet                 = Projet::find($projet);
        $localite               = Localite::find($localite);
        $localite_concernee     = $localite->nom;

        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                               ->where('localites_id', '=', $id_localite)
                               ->where('handicap', '=', 'Oui')
                               ->where('statut', '=', 'attente')
                               ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'rejeter')
                                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'accepter')
                                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->count();

        return view('agerouteindividuelles.candidatspmr', compact('projet', 'localite_concernee', 'handicap', 'attente', 'rejeter', 'accepter', 'total'));
    }

    public function candidatspmrs($localite, $projet, $handicap, $module, $sexe)
    {
        $id_projet              = $projet;
        $id_localite            = $localite;
        $projet                 = Projet::find($projet);
        $localite               = Localite::find($localite);
        $individuelles          = $projet->individuelles;

        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                               ->where('localites_id', '=', $id_localite)
                               ->where('handicap', '=', 'Oui')
                               ->where('statut', '=', 'attente')
                               ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'rejeter')
                                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'accepter')
                                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->count();

        return view('ageroutemodules.candidatspmrs', compact('projet', 'localite', 'handicap', 'attente', 'rejeter', 'accepter', 'total', 'module', 'sexe', 'individuelles'));
    }

    public function candidatsvs($localite, $projet, $victimes)
    {
        $id_projet              = $projet;
        $id_localite            = $localite;
        $projet                 = Projet::find($projet);
        $localite               = Localite::find($localite);
        $localite_concernee     = $localite->nom;

        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('victime_social', '=', 'Déplacé ou démobilisé par le conflit')
                ->where('statut', '=', 'attente')
                ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('victime_social', '=', 'Déplacé ou démobilisé par le conflit')
                ->where('statut', '=', 'rejeter')
                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('victime_social', '=', 'Déplacé ou démobilisé par le conflit')
                ->where('statut', '=', 'accepter')
                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                ->where('localites_id', '=', $id_localite)
                ->where('victime_social', '=', 'Déplacé ou démobilisé par le conflit')
                ->count();

        return view('agerouteindividuelles.candidatsvs', compact('projet', 'localite', 'victimes', 'localite_concernee', 'attente', 'rejeter', 'accepter', 'total'));
    }

    public function candidatsvss($localite, $projet, $handicap, $module, $sexe, $victime)
    {        
        $id_projet              = $projet;
        $id_localite            = $localite;
        $projet                 = Projet::find($projet);
        $localite               = Localite::find($localite);
        $individuelles          = $projet->individuelles;


        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                               ->where('localites_id', '=', $id_localite)
                               ->where('handicap', '=', 'Oui')
                               ->where('statut', '=', 'attente')
                               ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'rejeter')
                                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'accepter')
                                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->count();

        return view('ageroutemodules.candidatsvss', compact('projet', 'localite', 'handicap', 'attente', 'rejeter', 'accepter', 'total', 'module', 'sexe', 'individuelles', 'victime'));
    }

    public function candidatses($localite, $projet, $handicap, $module, $sexe, $victime, $situation_eco)
    {
        $id_projet              = $projet;
        $id_localite            = $localite;
        $projet                 = Projet::find($projet);
        $localite               = Localite::find($localite);
        $individuelles          = $projet->individuelles;


        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                               ->where('localites_id', '=', $id_localite)
                               ->where('handicap', '=', 'Oui')
                               ->where('statut', '=', 'attente')
                               ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'rejeter')
                                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'accepter')
                                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->count();

        return view('ageroutemodules.candidatses', compact('projet', 'localite', 'handicap', 'attente', 'rejeter', 'accepter', 'total', 'module', 'sexe', 'individuelles', 'victime', 'situation_eco'));
    }

    public function diplomes($localite, $projet, $handicap, $module, $sexe, $victime, $situation_eco, $diplomes)
    {
        $id_projet              = $projet;
        $id_localite            = $localite;
        $projet                 = Projet::find($projet);
        $localite               = Localite::find($localite);
        $individuelles          = $projet->individuelles;


        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                               ->where('localites_id', '=', $id_localite)
                               ->where('handicap', '=', 'Oui')
                               ->where('statut', '=', 'attente')
                               ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'rejeter')
                                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'accepter')
                                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->count();

        return view('ageroutemodules.diplomes', compact('projet', 'localite', 'handicap', 'attente', 'rejeter', 'accepter', 'total', 'module', 'sexe', 'individuelles', 'victime', 'situation_eco', 'diplomes'));
    }

    public function diplomespros($localite, $projet, $handicap, $module, $sexe, $victime, $situation_eco, $diplomespros)
    {
        $id_projet              = $projet;
        $id_localite            = $localite;
        $projet                 = Projet::find($projet);
        $localite               = Localite::find($localite);
        $individuelles          = $projet->individuelles;


        $attente = Individuelle::get()->where('projets_id', '=', $id_projet)
                               ->where('localites_id', '=', $id_localite)
                               ->where('handicap', '=', 'Oui')
                               ->where('statut', '=', 'attente')
                               ->count();

        $rejeter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'rejeter')
                                ->count();

        $accepter = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->where('statut', '=', 'accepter')
                                ->count();

        $total = Individuelle::get()->where('projets_id', '=', $id_projet)
                                ->where('localites_id', '=', $id_localite)
                                ->where('handicap', '=', 'Oui')
                                ->count();

        return view('ageroutemodules.diplomespros', compact('projet', 'localite', 'handicap', 'attente', 'rejeter', 'accepter', 'total', 'module', 'sexe', 'individuelles', 'victime', 'situation_eco', 'diplomespros'));
    }

    public function candidatse($localite, $projet, $situation_eco)
    {
        $id_projet              = $projet;
        $id_localite            = $localite;
        $projet                 = Projet::find($projet);
        $localite               = Localite::find($localite);
        $localite_concernee     = $localite->nom;

        return view('agerouteindividuelles.candidatse', compact('projet', 'localite', 'situation_eco', 'localite_concernee'));
    }

    public function statutageroute($localite, $projet, $statut)
    {
        $localites_id = Localite::where('nom', $localite)->first()->id;

        $individuelles = Individuelle::get()->where('projets_id', '=', $projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->where('statut', '=', $statut);

        $effectif =     Individuelle::get()->where('projets_id', '=', $projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->where('statut', '=', $statut)
                                    ->count();

        $projet                    = Projet::find($projet);
        $localite_concernee         = $localite;

        return view('agerouteindividuelles.statut', compact('statut', 'individuelles', 'effectif', 'projet', 'localite_concernee'));
    }

    public function statut_ageroute($localite, $projet, $statut)
    {
        $localites_id = Localite::where('nom', $localite)->first()->id;

        $individuelles = Individuelle::get()->where('projets_id', '=', $projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->where('statut', '=', $statut);

        $effectif =     Individuelle::get()->where('projets_id', '=', $projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->where('statut', '=', $statut)
                                    ->count();

        $projet                    = Projet::find($projet);
        $localite_concernee         = $localite;

        return view('agerouteindividuelles.statut_ageroute', compact('statut', 'individuelles', 'effectif', 'projet', 'localite_concernee'));
    }

    public function statutageroutepmr($localite, $projet, $statut, $pmr)
    {
        $localites_id = Localite::where('nom', $localite)->first()->id;

        $individuelles = Individuelle::get()->where('projets_id', '=', $projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->where('handicap', '=', $pmr)
                                    ->where('statut', '=', $statut);

        $effectif =     Individuelle::get()->where('projets_id', '=', $projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->where('handicap', '=', $pmr)
                                    ->where('statut', '=', $statut)
                                    ->count();

        $projet                    = Projet::find($projet);
        $localite_concernee         = $localite;

        return view('agerouteindividuelles.statutpmr', compact('statut', 'individuelles', 'effectif', 'projet', 'localite_concernee', 'pmr'));
    }

    public function statutageroutesvs($localite, $projet, $statut, $svs)
    {
        $localites_id = Localite::where('nom', $localite)->first()->id;

        $individuelles = Individuelle::get()->where('projets_id', '=', $projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->where('victime_social', '=', $svs)
                                    ->where('statut', '=', $statut);

        $effectif =     Individuelle::get()->where('projets_id', '=', $projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->where('victime_social', '=', $svs)
                                    ->where('statut', '=', $statut)
                                    ->count();

        $projet                    = Projet::find($projet);
        $localite_concernee         = $localite;

        return view('agerouteindividuelles.statutsvs', compact('statut', 'individuelles', 'effectif', 'projet', 'localite_concernee', 'svs'));
    }

    public function ageroutesexe($sexe, $localite, $projet)
    {
        $localites_id = Localite::where('nom', $localite)->first()->id;

        $id_projet = $projet;

        $individuelles = Individuelle::get()->where('projets_id', '=', $id_projet)
                                    ->where('localites_id', '=', $localites_id);

        /* $effectif =     Individuelle::get()->where('projets_id', '=', $id_projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->count(); */

        $projet                    = Projet::find($projet);
        $localite_concernee         = $localite;

        return view('agerouteindividuelles.ageroutesexe', compact('sexe', 'individuelles', 'projet', 'localite_concernee', 'id_projet'));
    }

    public function ageroutesexes($sexe, $localite, $projet, $module)
    {
        $localites_id = Localite::where('nom', $localite)->first()->id;

        $id_projet = $projet;

        $individuelles = Individuelle::get()->where('projets_id', '=', $id_projet)
                                    ->where('localites_id', '=', $localites_id);

        /* $effectif =     Individuelle::get()->where('projets_id', '=', $id_projet)
                                    ->where('localites_id', '=', $localites_id)
                                    ->count(); */

        $projet                    = Projet::find($projet);

        return view('ageroutemodules.ageroutesexes', compact('sexe', 'individuelles', 'projet', 'localite', 'id_projet', 'module'));
    }

    public function createdby($createdby)
    {
        $user_id = User::where('username', $createdby)->first()->id;

        $user = User::find($user_id);

        $id_projet = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;
        $projet = Projet::find($id_projet);
        $individuelle = Individuelle::all();

        
        $ziguinchor_id = Localite::where('nom', 'Ziguinchor')->first()->id;
        $bignona_id = Localite::where('nom', 'Bignona')->first()->id;
        $bounkiling_id = Localite::where('nom', 'Bounkiling')->first()->id;
        
        $ziguinchor_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $ziguinchor_id)->count();
        $bignona_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $bignona_id)->count();
        $bounkiling_count = Individuelle::where('projets_id', '=', $id_projet)->where('localites_id', '=', $bounkiling_id)->count();

        $total_count = Individuelle::where('projets_id', '=', $id_projet)->count();

        foreach ($individuelle as $key => $individuelles) {
        }
     
        return view('agerouteindividuelles.createdby', compact('projet', 'createdby', 'user', 'projet_name', 'individuelles', 'ziguinchor_count', 'bignona_count', 'bounkiling_count', 'total_count'));
    }
}
