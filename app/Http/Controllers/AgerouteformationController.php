<?php

namespace App\Http\Controllers;

use App\Models\Findividuelle;
use App\Models\Projet;
use App\Models\Programme;
use App\Models\Ingenieur;
use App\Models\User;
use App\Models\Typedemande;
use App\Models\Module;
use App\Models\Commune;
use App\Models\TypesOperateur;
use App\Models\Region;
use App\Models\Operateur;
use App\Models\TypesFormation;
use App\Models\Choixoperateur;
use App\Models\Formation;
use App\Models\Individuelle;
use App\Models\Statut;
use App\Models\Localite;
use App\Models\Convention;
use App\Models\Zone;
use Illuminate\Http\Request;
use DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class AgerouteformationController extends Controller
{
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
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projets = Projet::find($projet_id);
        /* $findividuelles = $projets->findividuelles; */

        $findividuelles = Findividuelle::all();

        return view('agerouteformations.index', compact('projets', 'projet_name', 'projet_id', 'findividuelles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $operateur_id = $request->input('operateur');
        $operateur = Operateur::find($operateur_id);
        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $localites = Localite::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_operateurs = TypesOperateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_formations = TypesFormation::distinct('name')->get()->pluck('name', 'name')->unique();
        $choixoperateur = Choixoperateur::distinct('trimestre')->get()->pluck('trimestre', 'trimestre')->unique();
        $projets = Projet::distinct('name')->get()->pluck('name', 'name')->unique();
        $programmes = Programme::distinct('name')->get()->pluck('name', 'name')->unique();
        $ingenieurs = Ingenieur::distinct('name')->get()->pluck('name', 'name')->unique();
        $conventions = Convention::distinct('numero')->get()->pluck('numero', 'numero')->unique();

        return view('agerouteformations.create', compact('ingenieurs', 'conventions', 'localites', 'civilites', 'modules', 'communes', 'regions', 'types_operateurs', 'operateur', 'types_formations', 'choixoperateur', 'projets', 'programmes'));
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
                /* 'date_debut'          =>    'required|date_format:Y-m-d',
                'date_fin'            =>    'required|date_format:Y-m-d', */
                'programme'           =>    'required',
                'projet'              =>    'required',
                'localite'            =>    'required',
                'modules'             =>    'required',
                'choixoperateur'      =>    'required',
                'adresse'             =>    'required',
                'lieu'                =>    'required',
                'beneficiaire'        =>    'required',
                'frais_operateurs'    =>    'numeric',
                'total'               =>    'numeric',
                'frais_additionnels'  =>    'numeric',
                'autres_frais'        =>    'numeric',
                'types_formations'    =>    'required',
                'annee'               =>    'numeric',
                'qualification'       =>    'required',
        ]
        );

        $choixoperateur_id            =       Choixoperateur::where('trimestre', $request->input('choixoperateur'))->first()->id;
        $types_formations_id          =       TypesFormation::where('name', 'Individuelle')->first()->id;
        $projet_id                    =       Projet::where('name', $request->input('projet'))->first()->id;
        $localite_id                  =       Localite::where('nom', $request->input('localite'))->first()->id;
        $programme_id                 =       Programme::where('name', $request->input('programme'))->first()->id;
        $ingenieur_id                 =       Ingenieur::where('name', $request->input('ingenieur'))->first()->id;
        $operateur_id                 =       Operateur::where('name', $request->input('operateur'))->first()->id;
        $conventions_id               =       Convention::where('numero', $request->input('conventions'))->first()->id;
        $statuts_id                   =       Statut::where('name', 'attente')->first()->id;

        $nbre = rand(1, 9);
        $annee = date('dmy');
        $code = "FI".$nbre.''.$annee;

        $frais_operateurs       =       str_replace(' ', '', $request->input('frais_operateurs'));
        $frais_additionnels     =       str_replace(' ', '', $request->input('frais_additionnels'));
        $autres_frais           =       str_replace(' ', '', $request->input('autres_frais'));

        $frais_total            =       $frais_operateurs  + $frais_additionnels + $autres_frais;

        $formation = new Formation([
            'code'                     =>      $code,
            'date_debut'               =>      $request->input('date_debut'),
            'date_fin'                 =>      $request->input('date_fin'),
            'adresse'                  =>      $request->input('adresse'),
            'beneficiaires'            =>      $request->input('beneficiaire'),
            'total'                    =>      $request->input('total'),
            'lieu'                     =>      $request->input('lieu'),
            'modules_id'               =>      $request->input('modules'),
            'annee'                    =>      $request->input('annee'),
            'qualifications'           =>      $request->input('qualification'),
            'frais_operateurs'         =>      $frais_operateurs,
            'frais_add'                =>      $frais_additionnels,
            'autes_frais'              =>      $autres_frais,
            'frais_total'              =>      $frais_total,
            'conventions_id'           =>      $conventions_id,
            'statuts_id'               =>      $statuts_id,
            'projets_id'               =>      $projet_id,
            'programmes_id'            =>      $programme_id,
            'choixoperateurs_id'       =>      $choixoperateur_id,
            'types_formations_id'      =>      $types_formations_id,
            'operateurs_id'            =>      $operateur_id,
            'localites_id'             =>      $localite_id,
            'ingenieurs_id'            =>      $ingenieur_id,

        ]);

        $formation->save();
        
        $findividuelle = new Findividuelle([
            'code'                     =>      $code,
            'modules_id'               =>      $request->input('modules'),
            'projets_id'               =>      $projet_id,
            'programmes_id'            =>      $programme_id,
            'formations_id'            =>      $formation->id,

        ]);

        $findividuelle->save();
        
        return redirect()->route('agerouteformations.index')->with('success', 'formation ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $findividuelle = Findividuelle::find($id);
        $formation = $findividuelle->formation;
        $EffectifdemandeurFormations = DB::table("demandeursformations")->where("demandeursformations.formations_id", $formation->id)->count();
        return view('agerouteformations.show', compact('formation', 'findividuelle', 'EffectifdemandeurFormations'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $findividuelle = Findividuelle::find($id);
        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
        $modules = Module::distinct('name')->get()->pluck('name', 'name')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $localites = Localite::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_operateurs = TypesOperateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_formations = TypesFormation::distinct('name')->get()->pluck('name', 'name')->unique();
        $choixoperateur = Choixoperateur::distinct('trimestre')->get()->pluck('trimestre', 'trimestre')->unique();
        $projets = Projet::distinct('name')->get()->pluck('name', 'name')->unique();
        $programmes = Programme::distinct('name')->get()->pluck('name', 'name')->unique();
        $ingenieurs = Ingenieur::distinct('name')->get()->pluck('name', 'name')->unique();
        $operateurs = Operateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $statuts = Statut::distinct('name')->get()->pluck('name', 'name')->unique();
        $conventions = Convention::distinct('numero')->get()->pluck('numero', 'numero')->unique();

        return view('agerouteformations.update', compact('ingenieurs', 'conventions', 'localites', 'civilites', 'statuts', 'modules', 'communes', 'regions', 'operateurs', 'types_operateurs', 'findividuelle', 'types_formations', 'choixoperateur', 'projets', 'programmes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'programme'           =>    'required',
                'projet'              =>    'required',
                'localite'            =>    'required',
                'modules'             =>    'required',
                'choixoperateur'      =>    'required',
                'adresse'             =>    'required',
                'lieu'                =>    'required',
                'beneficiaire'        =>    'required',
                'frais_operateurs'    =>    'numeric',
                'frais_additionnels'  =>    'numeric',
                'autres_frais'        =>    'numeric',
                'total'               =>    'numeric',
                'types_formations'    =>    'required',
                'annee'               =>    'numeric',
                'qualification'       =>    'required',
        ]
        );
        
        $findividuelle = Findividuelle::find($id);
        $formation = $findividuelle->formation;
        $frais_operateurs       =       str_replace(' ', '', $request->input('frais_operateurs'));
        $frais_additionnels     =       str_replace(' ', '', $request->input('frais_additionnels'));
        $autres_frais           =       str_replace(' ', '', $request->input('autres_frais'));

        $frais_total            =       $frais_operateurs  + $frais_additionnels + $autres_frais;

        $choixoperateur_id              =       Choixoperateur::where('trimestre', $request->input('choixoperateur'))->first()->id;
        $types_formations_id            =       TypesFormation::where('name', 'Individuelle')->first()->id;
        $projet_id                      =       Projet::where('name', $request->input('projet'))->first()->id;
        $localite_id                    =       Localite::where('nom', $request->input('localite'))->first()->id;
        $programme_id                   =       Programme::where('name', $request->input('programme'))->first()->id;
        $module_id                      =       Module::where('name', $request->input('modules'))->first()->id;
        $conventions_id                 =       Convention::where('numero', $request->input('conventions'))->first()->id;
        $operateurs_id                  =       Operateur::where('name', $request->input('operateur'))->first()->id;
        $statuts_id                     =       Statut::where('name', $request->input('statut'))->first()->id;
        $ingenieurs_id                  =       Ingenieur::where('name', $request->input('ingenieur'))->first()->id;
        
        $formation->code                =      $request->input('code');
        $formation->date_debut          =      $request->input('date_debut');
        $formation->date_fin            =      $request->input('date_fin');
        $formation->date_suivi          =      $request->input('date_suivi');
        $formation->date_pv             =      $request->input('date_pv');
        $formation->adresse             =      $request->input('adresse');
        $formation->beneficiaires       =      $request->input('beneficiaire');
        $formation->total               =      $request->input('total');
        $formation->lieu                =      $request->input('lieu');
        $formation->annee               =      $request->input('annee');
        $formation->qualifications      =      $request->input('qualification');
        $formation->frais_operateurs    =      $frais_operateurs;
        $formation->frais_add           =      $frais_additionnels;
        $formation->autes_frais         =      $autres_frais;
        $formation->frais_total         =      $frais_total;
        $formation->modules_id          =      $module_id;
        $formation->conventions_id      =      $conventions_id;
        $formation->statuts_id          =      $statuts_id;
        $formation->choixoperateurs_id  =      $choixoperateur_id;
        $formation->types_formations_id =      $types_formations_id;
        $formation->operateurs_id       =      $operateurs_id;
        $formation->localites_id        =      $localite_id;
        $formation->ingenieurs_id       =      $ingenieurs_id;
        $formation->projets_id          =      $projet_id;
        $formation->programmes_id       =      $programme_id;

        $formation->save();
        
        $findividuelle->code            =      $request->input('code');
        $findividuelle->modules_id      =      $module_id;
        $findividuelle->projets_id      =      $projet_id;
        $findividuelle->programmes_id   =      $programme_id;
        $findividuelle->formations_id   =      $formation->id;

        $findividuelle->save();
        
        return redirect()->route('agerouteformations.index')->with('success', 'formation ajoutée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $findividuelle = Findividuelle::find($id);
        $formation = $findividuelle->formation;
        $demandeurs = $formation->demandeurs;

        $findividuelle->delete();
        $formation->delete();

        $formation->demandeurs()->detach($demandeurs);

        $message = $formation->code.' a été supprimé';
        return redirect()->route('agerouteformations.index')->with(compact('message'));
    }

    public function formationcandidats($module, $projet, $programme, $findividuelle)
    {
        $individuelles      =           Individuelle::get();
        $module             =           Module::find($module);
        $module_id          =           $module->id;
        $projet             =           Projet::find($projet);
        $findividuelle      =           Findividuelle::find($findividuelle);
        $programme          =           Programme::find($programme);
        $programme_id       =           $programme->id;
        $projet_name        =           $projet->name;
        $projet_id          =           $projet->id;
        $module_name        =           $module->name;
        $code               =           $findividuelle->formation->code;

        return view('agerouteformations.formationcandidats', compact('code', 'projet_name', 'individuelles', 'module_name', 'programme', 'findividuelle', 'projet_id', 'module_id', 'programme_id'));
    }

    public function individuelleformations($individuelle)
    {
        $individuelles = Individuelle::find($individuelle);

        return view('agerouteformations.individuelleformations', compact('individuelles'));
    }

    public function individuelleformationsenlever($individuelle)
    {
        $formation = Formation::where('code', $individuelle)->first()->id;
        $formation = Formation::find($formation);
        $findividuelles = $formation->findividuelles;

        foreach ($findividuelles as $findividuelle) {
            return view('agerouteformations.show', compact('formation', 'findividuelle'));
        }


        $individuelles = Individuelle::find($individuelle);

        return view('agerouteformations.individuelleformations', compact('individuelles'));
    }

    public function formationcandidatsadd($individuelle, $findividuelle)
    {
        $individuelle       =       Individuelle::find($individuelle);
        $demandeur          =       $individuelle->demandeur;
        $findividuelle      =       Findividuelle::find($findividuelle);
        $formation          =       $findividuelle->formation;

        $EffectifdemandeurFormations = DB::table("demandeursformations")->where("demandeursformations.formations_id", $formation->id)->count();

        if (isset($individuelle->formation)) {
            $messages = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' est déjà dans une formation';
            return back()->with(compact('messages'));
        } else {
            $individuelle->statut           =     "accepter";
            $individuelle->item1            =     "accepter";
            $individuelle->formations_id    =     $formation->id;

            $individuelle->save();

            $demandeur->formations()->sync($formation);
            $EffectifdemandeurFormations = $EffectifdemandeurFormations +1;
            if ($EffectifdemandeurFormations > 20) {
                $messages = "Attention !!! vous avez dépassé l'effectif conseillé pour une formation. ".$individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name." a été ajouté, effectif à formé est de ".$EffectifdemandeurFormations;
                return back()->with(compact('messages'));
            } else {
                $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été ajouté, effectif à formé est de '.$EffectifdemandeurFormations;
                return back()->with(compact('message'));
            }
        }
    }

    public function formationcandidatsdelete($individuelle, $findividuelle)
    {

        return view('agerouteindividuelles.enlevermotif', compact('individuelle'));

        $individuelle       =       Individuelle::find($individuelle);
        $demandeur          =       $individuelle->demandeur;
        $findividuelle      =       Findividuelle::find($findividuelle);
        $formation          =       $findividuelle->formation;

        $individuelle->statut           =     "enlever";
        $individuelle->item1            =     $individuelle->formation->code;
        $individuelle->formations_id    =     null;

        $individuelle->save();

        $demandeur->formations()->detach($formation);
        
        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été retiré de cette formation';
        return back()->with(compact('message'));
    }

    public function fichesuivieval($module, $projet, $programme, $findividuelle)
    {
        $individuelles      =           Individuelle::get();
        $module             =           Module::find($module);
        $module_id          =           $module->id;
        $projet             =           Projet::find($projet);
        $findividuelle      =           Findividuelle::find($findividuelle);
        $programme          =           Programme::find($programme);
        $programme_id       =           $programme->id;
        $projet_name        =           $projet->name;
        $projet_id          =           $projet->id;
        $module_name        =           $module->name;
        $code               =           $findividuelle->formation->code;
        $formation          =           $findividuelle->formation;
        $beneficiaires      =           $findividuelle->formation->beneficiaires;

        $beneficiaires = htmlentities($beneficiaires, ENT_NOQUOTES, 'utf-8');
        $beneficiaires = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $beneficiaires);
        $beneficiaires = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $beneficiaires);
        $beneficiaires = preg_replace('#&[^;]+;#', '', $beneficiaires);
        
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

        $dompdf->loadHtml(view('agerouteindividuelles.fichesuivieval', compact('beneficiaires', 'formation', 'findividuelle')));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('Fiche de suivi evaluation pour les '.$beneficiaires.' du '.$anne.'.pdf', ['Attachment' => false]);
    }

    public function pvevaluation($module, $projet, $programme, $findividuelle)
    {
        $individuelles      =           Individuelle::get();
        $module             =           Module::find($module);
        $module_id          =           $module->id;
        $projet             =           Projet::find($projet);
        $findividuelle      =           Findividuelle::find($findividuelle);
        $programme          =           Programme::find($programme);
        $programme_id       =           $programme->id;
        $projet_name        =           $projet->name;
        $projet_id          =           $projet->id;
        $module_name        =           $module->name;
        $code               =           $findividuelle->formation->code;
        $formation          =           $findividuelle->formation;
        $beneficiaires      =           $findividuelle->formation->beneficiaires;

        $beneficiaires = htmlentities($beneficiaires, ENT_NOQUOTES, 'utf-8');
        $beneficiaires = preg_replace('#&([A-za-z])(?:uml|circ|tilde|acute|grave|cedil|ring);#', '\1', $beneficiaires);
        $beneficiaires = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $beneficiaires);
        $beneficiaires = preg_replace('#&[^;]+;#', '', $beneficiaires);
        
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

        $dompdf->loadHtml(view('agerouteindividuelles.pvevaluation', compact('beneficiaires', 'formation', 'findividuelle')));

        // (Optional) Setup the paper size and orientation
        /* $dompdf->setPaper('A4', 'portrait'); */
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('PV evaluation pour les '.$beneficiaires.' du '.$anne.'.pdf', ['Attachment' => false]);
    }

    public function formationsannee($findividuelle, $annee)
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projets = Projet::find($projet_id);
        $findividuelles = $projets->findividuelles;

        return view('agerouteformations.formationsannee', compact('annee', 'findividuelles', 'projet_name'));
    }

    public function formationsattestations($findividuelle, $attestation)
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projets = Projet::find($projet_id);
        $findividuelles = $projets->findividuelles;

        return view('agerouteformations.formationsattestations', compact('attestation', 'findividuelles', 'projet_name'));
    }
    public function formationsstatut($findividuelle, $statut)
    {
        $projet_id = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->id;
        $projet_name = Projet::where('name', 'PROJET DE REHABILITATION DE LA ROUTE SENOBA-ZIGUINCHOR-MPACK ET DE DESENCLAVEMENT DES REGIONS DU SUD')->first()->name;

        $projets = Projet::find($projet_id);
        $findividuelles = $projets->findividuelles;

        return view('agerouteformations.formationsstatut', compact('statut', 'findividuelles', 'projet_name'));
    }

    

    public function listecandidatacceptes($projet, $localite, $module)
    {
        $individuelles      =           Individuelle::get();
        $module_id          =           Module::where('name', $module)->first()->id;
        $projet             =           Projet::find($projet);
        $projet_name        =           $projet->name;
        $projet_id          =           $projet->id;
        $module_name        =           $module;
        $individuelles      =           $projet->individuelles->sortBy('items1');

       // dd($individuelles);
        
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

        $dompdf->loadHtml(view('agerouteindividuelles.listecandidatacceptes', compact('individuelles', 'module', 'localite', 'projet')));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($localite.', liste des candidats retenus en '.$module.'.pdf', ['Attachment' => false]);
    }
    

    public function listecandidatretenus($projet, $zone, $module)
    {
        $individuelles      =           Individuelle::get();
        $module             =           Module::find($module);
        $projet             =           Projet::find($projet);
        $projet_name        =           $projet->name;
        $projet_id          =           $projet->id;
        $module_name        =           $module->name;
        $individuelles      =           $projet->individuelles;

        $zones = Zone::where('nom', $zone)->first()->id;
        $zones = Zone::find($zones);
        
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

        $dompdf->loadHtml(view('agerouteindividuelles.listecandidatretenus', compact('individuelles', 'module_name', 'zone', 'projet', 'zones')));

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream($zone.', liste des candidats retenus en '.$module_name.'.pdf', ['Attachment' => false]);
    }
}
