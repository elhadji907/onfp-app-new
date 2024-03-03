<?php

namespace App\Http\Controllers;

use App\Models\Operateur;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Typedemande;
use App\Models\Module;
use App\Models\Domaine;
use App\Models\Commune;
use App\Models\TypesOperateur;
use App\Models\Arrondissement;
use App\Models\Departement;
use App\Models\Region;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Auth;
use PDF;
use DB;

class OperateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        /* $this->middleware(['role:super-admin|Administrateur|Gestionnaire']);
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
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
        $operateurs = Operateur::latest()->get();
 
        return view('operateurs.index', compact('operateurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $operateur_id=$request->input('operateur');
        $operateur=Operateur::find($operateur_id);

        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
                        
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();

        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        
        $types_operateurs = TypesOperateur::distinct('name')->get()->pluck('name', 'name')->unique();

        $regions = Region::distinct('nom')->get()->pluck('nom', 'id')->unique();
        $region = Region::get();

        return view('operateurs.create', compact('civilites', 'modules', 'communes', 'regions', 'types_operateurs', 'operateur', 'region'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* dd($request->input('regions')); */
        $user = auth::user();
        
        if ($request->input('type_operateur') == "Autre") {
            $this->validate(
                $request,
                [
                    'autres_type_operateur'                              =>    'required',
                ]
            );
        }

        
        $this->validate(
            $request,
            [
                'numero_agrement'           =>       "required|string|unique:operateurs,numero_agrement,NULL,id,deleted_at,NULL",
                'email1'                    =>       "required|email|unique:operateurs,email1,NULL,id,deleted_at,NULL",
                'operateur'                 =>       "required|string|max:255|unique:operateurs,name,NULL,id,deleted_at,NULL",
                'sigle'                     =>       "required|string|max:50|unique:operateurs,sigle,NULL,id,deleted_at,NULL",
                'ninea'                     =>       "required|string|max:255|unique:operateurs,ninea,NULL,id,deleted_at,NULL",
                'quitus'                    =>       "required|string|max:255|unique:operateurs,quitus,NULL,id,deleted_at,NULL",
               /*  'cin'                       =>       'required|string|min:13|max:15|unique:operateurs,cin_responsable', */
                'adresse_op'                =>       'required|string',
                'prenom'                    =>       'required|string|max:50',
                'nom'                       =>       'required|string|max:50',
                'email'                     =>       'required|email|max:255|unique:users,email,'.$user->id,
                'telephone'                 =>       'required|string|max:15',
                'regions'                   =>       'required',
                'departement'               =>       'required',
                'commune'                   =>       'required',
                'type_structure'            =>       'required',
                'type_operateur'            =>       'required',
                'fonction_responsable'      =>       'required',
                'fixe_op'                   =>       'required',
                'debut_quitus'              =>       'required|date',
                'fin_quitus'                =>       'required|date',
            ]
        );

        /* dd($user); */
      
        $user_id = User::latest('id')->first()->id;
        $username   =   strtolower($request->input('nom').$user_id);

       
        $created_by1 = $user->firstname;
        $created_by2 = $user->name;
        $created_by3 = $user->username;

        $created_by = $created_by1.' '.$created_by2.' ('.$created_by3.')';

        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);
        $civilite = $request->input('civilite');

        if ($civilite == "M.") {
            $sexe = "M";
        } elseif ($civilite == "Mme") {
            $sexe = "F";
        } else {
            $sexe = "";
        }

        $utilisateur = new User([
        'sexe'                      =>      $sexe,
        'civilite'                  =>      $civilite,
        'firstname'                 =>      $request->input('prenom'),
        'name'                      =>      $request->input('nom'),
        'email'                     =>      $request->input('email'),
        'username'                  =>      $username,
        'telephone'                 =>      $telephone,
        'bp'                        =>      $request->input('bp'),
        'fax'                       =>      $request->input('fax'),
        'date_naissance'            =>      $request->input('date_naiss'),
        'lieu_naissance'            =>      $request->input('lieu_naissance'),
        'adresse'                   =>      $request->input('adresse'),
        'password'                  =>      Hash::make($request->input('email')),
        'created_by'                =>      $created_by,
        'updated_by'                =>      $created_by
    ]);
    
        $utilisateur->save();

    
        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);

    
        $communes_id = Commune::where('nom', $request->input('commune'))->first()->id;
        /* $types_operateurs_id = TypesOperateur::where('name', $request->input('type_operateur'))->first()->id; */

        $operateurs = new Operateur([
        'cin_responsable'               =>      $request->input('cin'),
        'numero_agrement'               =>      $request->input('numero_agrement'),
        'debut_quitus'                  =>      $request->input('debut_quitus'),
        'fin_quitus'                    =>      $request->input('fin_quitus'),
        'name'                          =>      $request->input('operateur'),
        'typestructure'                 =>      $request->input('type_structure'),
        'sigle'                         =>      $request->input('sigle'),
        'fixe'                          =>      $request->input('fixe_op'),
        'ninea'                         =>      $request->input('ninea'),
        'rccm'                          =>      $request->input('registre'),
        'quitus'                        =>      $request->input('quitus'),
        'email1'                        =>      $request->input('email1'),
        'email2'                        =>      $request->input('email2'),
        'telephone1'                    =>      $request->input('telephone1'),
        'telephone2'                    =>      $request->input('telephone2'),
        'adresse'                       =>      $request->input('adresse_op'),
        'fonction_responsable'          =>      $request->input('fonction_responsable'),
        'prenom_responsable'            =>      $request->input('prenom'),
        'nom_responsable'               =>      $request->input('nom'),
        'email_responsable'             =>      $request->input('email'),
        'telephone_responsable'         =>      $request->input('telephone'),
        'operateur_type'                =>      $request->input('type_operateur'),
        'file10'                       =>      $request->input('autres_type_operateur'),
        /* 'types_operateurs_id'           =>      $types_operateurs_id, */
        'communes_id'                   =>      $communes_id,
        'users_id'                      =>      $utilisateur->id,
    ]);

        $operateurs->save();

        $operateurs->regions()->sync($request->input('regions'));

        return redirect()->route('operateurs.index')->with('success', 'opérateur ajouté avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operateur  $operateur
     * @return \Illuminate\Http\Response
     */
    public function show(Operateur $operateur)
    {
        $user = $operateur->user;

        $modules = $operateur->modules;
        
        return view('operateurs.show', compact('operateur', 'user', 'modules'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operateur  $operateur
     * @return \Illuminate\Http\Response
     */
    public function edit(Operateur $operateur)
    {
        $utilisateurs = $operateur->user;

        $civilites = User::pluck('civilite', 'civilite');
        $modules = Module::distinct('name')->get()->pluck('name', 'id')->unique();
        $communes = Commune::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $departements = Departement::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $lesregion = Region::distinct('nom')->get()->pluck('nom', 'nom')->unique();
        $types_operateurs = TypesOperateur::distinct('name')->get()->pluck('name', 'name')->unique();
        $regions = Region::distinct('nom')->get()->pluck('nom', 'id')->unique();
        
        $module = Module::get();
        $operateurModules = DB::table("modulesoperateurs")->where("modulesoperateurs.operateurs_id", $operateur->id)
        ->pluck('modulesoperateurs.modules_id', 'modulesoperateurs.modules_id')
        ->all();

        $region = Region::get();
        $operateurRegions = DB::table("operateursregions")->where("operateursregions.operateurs_id", $operateur->id)
        ->pluck('operateursregions.regions_id', 'operateursregions.regions_id')
        ->all();

        return view('operateurs.update', compact('lesregion', 'departements', 'operateur', 'modules', 'utilisateurs', 'civilites', 'communes', 'regions', 'types_operateurs', 'module', 'region', 'operateurRegions', 'operateurModules'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operateur  $operateur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operateur $operateur)
    {
        $imp = $request->input('imp');

        if (isset($imp) && $imp == "1") {
            $count = count($request->product);
                $operateur->modules()->attach($request->id_module);
                $operateur->save();
                return redirect()->back();
            
            //solution, récuper l'id à partir de blade avec le mode hidden
        }

        $user = auth::user();

        $this->validate(
            $request,
            [
                'numero_agrement'     =>  "required|string|unique:operateurs,numero_agrement,{$operateur->id},id,deleted_at,NULL",
                'email1'              =>  "required|email|unique:operateurs,email1,{$operateur->id},id,deleted_at,NULL",
                'operateur'           =>  "required|string|max:255|unique:operateurs,name,{$operateur->id},id,deleted_at,NULL",
                'sigle'               =>  "required|string|max:50|unique:operateurs,sigle,{$operateur->id},id,deleted_at,NULL",
                'ninea'               =>  "required|string|max:255|unique:operateurs,ninea,{$operateur->id},id,deleted_at,NULL",
                'registre'            =>  "required|string|max:50|unique:operateurs,rccm,{$operateur->id},id,deleted_at,NULL",
                'quitus'              =>  "required|string|max:255|unique:operateurs,quitus,{$operateur->id},id,deleted_at,NULL",
                'telephone1'          =>  'required|string|max:15',
                'adresse'             =>  'required|string',
                'type_structure'      =>  'required|string',
                'prenom'              =>  'required|string|max:50',
                'nom'                 =>  'required|string|max:50',
                'email'               =>  "required|email|max:255|unique:users,email,{$operateur->user->id},id,deleted_at,NULL",
                'telephone'           =>  'required|string|max:15',
            ]
        );

        $utilisateur    =   $operateur->user;
        $updated_by1    =   $user->firstname;
        $updated_by2    =   $user->name;
        $updated_by3    =   $user->username;

        $updated_by = $updated_by1.' '.$updated_by2.' ('.$updated_by3.')';
        $communes_id = Commune::where('nom', $request->input('commune'))->first()->id;
        /* $types_operateurs_id = TypesOperateur::where('name', $request->input('type_operateur'))->first()->id; */

        
        $telephone = $request->input('telephone');
        $telephone = str_replace(' ', '', $telephone);

        $civilite = $request->input('civilite');

        if ($civilite == "M.") {
            $sexe = "M";
        } elseif ($civilite == "Mme") {
            $sexe = "F";
        } else {
            $sexe = "";
        }

        $utilisateur->sexe                  =      $sexe;
        $utilisateur->civilite              =      $civilite;
        $utilisateur->firstname             =      $request->input('prenom');
        $utilisateur->name                  =      $request->input('nom');
        $utilisateur->email                 =      $request->input('email');
        $utilisateur->telephone             =      $request->input('telephone');
        $utilisateur->date_naissance        =      $request->input('date_naiss');
        $utilisateur->lieu_naissance        =      $request->input('lieu_naissance');
        $utilisateur->adresse               =      $request->input('adresse');
        $utilisateur->bp                    =      $request->input('bp');
        $utilisateur->fax                   =      $request->input('fax');
        $utilisateur->updated_by            =      $updated_by;

        $utilisateur->save();

        $operateur->name                    =      $request->input('operateur');
        $operateur->sigle                   =      $request->input('sigle');
        $operateur->numero_agrement         =      $request->input('numero_agrement');
        $operateur->ninea                   =      $request->input('ninea');
        $operateur->rccm                    =      $request->input('registre');
        $operateur->quitus                  =      $request->input('quitus');
        $operateur->debut_quitus            =      $request->input('debut_quitus');
        $operateur->fin_quitus              =      $request->input('fin_quitus');
        $operateur->email1                  =      $request->input('email1');
        $operateur->email2                  =      $request->input('email2');
        $operateur->telephone1              =      $request->input('telephone1');
        $operateur->telephone2              =      $request->input('telephone2');
        $operateur->adresse                 =      $request->input('adresse');

        $operateur->nom_responsable         =      $request->input('nom');
        $operateur->prenom_responsable      =      $request->input('prenom');
        $operateur->cin_responsable         =      $request->input('cin');
        $operateur->telephone_responsable   =      $request->input('telephone');
        $operateur->email_responsable       =      $request->input('email');
        $operateur->fonction_responsable    =      $request->input('fonction_responsable');
        $operateur->operateur_type          =      $request->input('type_operateur');
        $operateur->file10                  =      $request->input('autres_type_operateur');
        $operateur->communes_id             =      $communes_id;
        /* $operateur->types_operateurs_id     =      $types_operateurs_id; */
        $operateur->typestructure           =      $request->input('type_structure');
        $operateur->users_id                =      $utilisateur->id;

        $operateur->save();

        $operateur->regions()->sync($request->input('region'));
        $operateur->modules()->sync($request->input('module'));

        /* dd($request->input('modules')); */

        return redirect()->route('operateurs.index')->with('success', 'operateur modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operateur  $operateur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operateur $operateur)
    {
        $user = auth::user();

        $utilisateurs   =   $operateur->user;
  
        $deleted_by1 = $user->firstname;
        $deleted_by2 = $user->name;
        $deleted_by3 = $user->username;
  
        $deleted_by = $deleted_by1.' '.$deleted_by2.'('.$deleted_by3.')';
  
        $utilisateurs->deleted_by      =      $deleted_by;
  
        $utilisateurs->save();
        $operateur->user->delete();
        $operateur->delete();
          
        $message = $operateur->user->firstname.' '.$operateur->user->name.' a été supprimé(e)';
        return back()->with(compact('message'));
    }

    public function list(Request $request)
    {
        $operateurs=Operateur::withCount('formations')->get();
        return Datatables::of($operateurs)->make(true);
    }

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');

      $data = DB::table('communes')      
      ->where('nom', 'LIKE', "%{$query}%")
        ->get();

      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $commune)
      {
        $id = $commune->id;
        $commune = $commune->nom;
        $communes = Commune::find($id);

        $arrondissement_id = $communes->arrondissement->id;
        $arrondissement_name = $communes->arrondissement->nom;
        $arrondissement = Arrondissement::find($arrondissement_id);

        $departement_id = $arrondissement->departement->id;
        $departement_name = $arrondissement->departement->nom;
        $departement    = Departement::find($departement_id);

        $region = $departement->region->nom;

       $output .= '
       
       <li data-id="'.$id.'" data-commune="'.$commune.'" data-arrondissement="'.$arrondissement_name.'" data-departement="'.$departement_name.'" data-region="'.$region.'"><a href="#">'.$commune.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }

    public function moduleoperateurs($id)
    {
        $operateur = Operateur::find($id);

        return view('operateurs.addmodule', compact('operateur'));
    }
    
    
    function fetche(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');

      $data = DB::table('modules')      
      ->where('name', 'LIKE', "%{$query}%")
        ->get();

      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $module)
      {
        $id = $module->id;
        $module = $module->name;     
        
        $modules = Module::findOrFail($id);
        $domaines_id = $modules->domaines_id;

        $domaines = Domaine::findOrFail($domaines_id);
        $domaine = $domaines->name;

       $output .= '
       
       <li data-id="'.$id.'" data-domaine="'.$domaine.'"><a href="#">'.$module.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }
}
