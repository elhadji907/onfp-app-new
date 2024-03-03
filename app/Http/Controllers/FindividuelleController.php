<?php

namespace App\Http\Controllers;

use App\Models\Findividuelle;
use App\Models\Individuelle;
use App\Models\TypesOperateur;
use App\Models\Region;
use App\Models\TypesFormation;
use App\Models\Choixoperateur;
use App\Models\Projet;
use App\Models\Ingenieur;
use App\Models\Module;
use App\Models\Commune;
use App\Models\Convention;
use App\Models\Departement;
use Carbon\Carbon;
use App\Models\Programme;
use App\Models\Formation;
use App\Models\Operateur;
use App\Models\User;
use Illuminate\Http\Request;
use DB;
use PDF;
use Dompdf\Dompdf;
use Dompdf\Options;

class FindividuelleController extends Controller
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
        $findividuelles = Findividuelle::all();

        return view('findividuelles.index', compact('findividuelles'));
    }

    public function selectdindividuelles($id_commune, $id_module, $id_form)
    {
        $communes = Commune::find($id_commune);

        $modules = Module::find($id_module);

        $nom_module = $modules->name;

        $nom_commune = $communes->nom;

        $nom_region = $communes->arrondissement->departement->region->nom;

        $nom_formation = Formation::find($id_form);

        $individuelles = Individuelle::all()->load(['demandeur'])
        ->where('demandeur.commune.arrondissement.departement.region.nom', '=', $nom_region)
        ->where('module', '=', $nom_module)
        ->where('cin', '>', 0);

                
        return view('findividuelles.selectdindividuelles', compact('individuelles', 'communes', 'modules', 'nom_module', 'nom_commune', 'nom_region', 'nom_formation', 'id_form'));
    }

    public function adddindividuelles($id_ind, $id_form)
    {
        $individuelle = Individuelle::find($id_ind);
        $formation = Formation::find($id_form);
        
        $individuelle->formations()->sync($formation);
        
        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été ajouté';
        return back()->with(compact('message'));
    }

    public function deleteindividuelles($id_ind, $id_form)
    {
        $individuelle = Individuelle::find($id_ind);
        $formation = Formation::find($id_form);
        //dd($individuelle);
        $individuelle->formations()->detach($formation);
        
        $message = $individuelle->demandeur->user->firstname.' '.$individuelle->demandeur->user->name.' a été enlevé';
        return back()->with(compact('message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ingenieur_id=$request->input('ingenieur');
        $ingenieur=\App\Models\Ingenieur::find($ingenieur_id);
       
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $programmes = Programme::distinct('name')->get()->pluck('sigle', 'id')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'id')->unique();
        $departements = Departement::distinct('nom')->get()->pluck('nom', 'id')->unique();
        $conventions = Convention::distinct('name')->get()->pluck('name', 'id')->unique();
       
        $date_debut = Carbon::now();
        $date_fin = Carbon::now()->addMonth();
        $operateur_id = $request->input('operateur');
        $operateur = Operateur::find($operateur_id);
        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
        $types_operateurs = TypesOperateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_formations = TypesFormation::distinct('name')->get()->pluck('name', 'name')->unique();
        $choixoperateur = Choixoperateur::distinct('trimestre')->get()->pluck('trimestre', 'trimestre')->unique();
        $projets = Projet::distinct('name')->get()->pluck('name', 'name')->unique();

        

        return view('findividuelles.create', compact('ingenieur', 'modules', 'communes', 'departements', 'conventions', 'date_debut', 'date_fin', 'programmes', 'types_operateurs', 'operateur', 'types_formations', 'choixoperateur', 'projets', 'programmes'));
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
                'date_debut'                        =>    'required|date_format:Y-m-d',
                'date_fin'                          =>    'required|date_format:Y-m-d',
                'programme'                         =>    'required',
                'projet'                            =>    'required',
                'commune'                           =>    'required',
                'modules'                           =>    'required',
                'choixoperateur'                    =>    'required',
                'adresse'                           =>    'required',
                'beneficiaire'                      =>    'required',
                'types_formations'                  =>    'required',
        ]
        );
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
        $individuelle = $formation->individuelles;

        foreach ($individuelle as $key => $individuelles) {
            # code...
        }

        $EffectifdemandeurFormations = DB::table("demandeursformations")->where("demandeursformations.formations_id", $formation->id)->count();

        
        return view('findividuelles.show', compact('formation', 'findividuelle', 'EffectifdemandeurFormations', 'individuelles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function edit(Findividuelle $findividuelle)
    {
        $name_ingenieur = $findividuelle->formation->ingenieur->name;

        $list_ingenieurs = Ingenieur::distinct('name')->get()->pluck('name', 'name')->unique();

        $ingenieurs = Ingenieur::all();

        return view('findividuelles.update', compact('findividuelle', 'ingenieurs', 'list_ingenieurs', 'name_ingenieur'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Findividuelle  $findividuelle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Findividuelle $findividuelle)
    {
        //
    }

    
    public function list(Request $request)
    {
        $individuelles=Individuelle::with('demandeur')->get();
        dd($individuelles);
        return Datatables::of($individuelles)->make(true);
    }

    
    public function beneficiairesformation($module, $projet, $programme, $findividuelle)
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

        return view('findividuelles.beneficiairesformation', compact('code', 'projet_name', 'individuelles', 'module_name', 'programme', 'findividuelle', 'projet_id', 'module_id', 'programme_id'));
    }

    public function suivieval($module, $projet, $programme, $findividuelle)
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

        $dompdf->loadHtml(view('findividuelles.suivieval', compact('beneficiaires', 'formation', 'findividuelle')));

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

        $dompdf->loadHtml(view('findividuelles.pvevaluation', compact('beneficiaires', 'formation', 'findividuelle')));

        // (Optional) Setup the paper size and orientation
        /* $dompdf->setPaper('A4', 'portrait'); */
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream('PV evaluation pour les '.$beneficiaires.' du '.$anne.'.pdf', ['Attachment' => false]);
    }
}
