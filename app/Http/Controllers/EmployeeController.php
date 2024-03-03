<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Objet;
use App\Models\Direction;
use App\Models\Courrier;
use App\Models\Recue;
use App\Models\Interne;
use App\Models\Depart;
use App\Models\Category;
use App\Models\Fonction;
use App\Models\Familiale;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Intervention\Image\Facades\Image;
use DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Gestionnaire']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = Carbon::today()->locale('fr_FR');
        $date = $date->copy()->addDays(0);
        $date = $date->isoFormat('LLLL'); // M/D/Y
        $recues = Recue::get()->count();
        $internes = Interne::all();
        $departs = Depart::all();
        $courriers = Courrier::get()->count();

        /*  $chart      = Courrier::all();
         $chart = new Courrierchart;
         $chart->labels(['Départs', 'Arrivés', 'Internes']);
         $chart->dataset('STATISTIQUES', 'bar', [$internes, $recues, $departs])->options([
             'backgroundColor'=>["#3e95cd", "#8e5ea2","#3cba9f"],
         ]); */

        $employees = Employee::all();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
        $directions = Direction::pluck('sigle', 'id');
        $categories = Category::pluck('name', 'id');
        $fonctions = Fonction::pluck('name', 'id');
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'id')->unique();

        return view('employees.create', compact('roles', 'civilites', 'directions', 'categories', 'fonctions', 'familiale'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (User::where('email', $request->email)->exists()) {
            //faire une mise à jour car l'employé existe déjà
            /* dd("existe"); */
            
        $users = User::where('email', $request->email)->get();

        foreach ($users as $key => $user) {
            # code...
        }
        
        $data = request()->validate(
            [
                'civilite'      =>  'required|string|max:10',
                'direction'     =>  'required|string',
                'email'         =>  'required|email|max:255|unique:users,email,'.$user->id,
                'matricule'     =>  'required|string|max:15',
                'categorie'     =>  'required|string|max:50',
                'firstname'     =>  'required|string|max:50',
                'fonction'      =>  'required|string',
                'name'          =>  'required|string|max:50',
                'telephone'     =>  'required|string|max:50',
                'fixe'          =>  'sometimes',
                'cin'           =>  'required|string|min:12|max:15',
                'familiale'     =>  'required|string',
                'adresse'       =>  'string',
                'date_naiss'    =>  'required|date',
                'date_embauche' =>  'required|date',
                'lieu'          =>  'required|string',
                'bp'            =>  'sometimes',
                'fax'           =>  'sometimes',
                'image'         =>  'sometimes|image|max:3000',
                'updated_by'         =>  'string',
            ]
        );


        /* $direction=$request->input('direction'); */
        /* $directions_id = Direction::where('name', $direction)->first()->id; */
        $directions_id = $request->input('direction');
        
        /* $fonction=$request->input('fonction'); */

        /* $fonctions_id = Fonction::where('name', $fonction)->first()->id; */
        $fonctions_id = $request->input('fonction');


        /* $categorie=$request->input('categorie');
        $categories_id = Category::where('name', $categorie)->first()->id; */
        $categories_id = $request->input('categorie');

        $roles_id = Role::where('name', 'Administrateur')->first()->id;

        $date = Carbon::createFromFormat('Y-m-d', $request->input('date_naiss'));
        $fin = $date->addYears(60);

        $civilite = $request->input('civilite');
        
        if ($civilite == "Mme") {
            $sexe = "F";
        } elseif ($civilite == "M.") {
            $sexe = "M";
        } else {
            $sexe = "";
        }

        /* $familiale_id = Familiale::where('name', $request->input('familiale'))->first()->id; */
        $familiale_id = $request->input('familiale');
        $user_connect           =              Auth::user();
        $updated_by             =              strtolower($user_connect->username);
                
        if (request('image')) {
            $imagePath = request('image')->store('avatars', 'public');
    
            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);
            $image->save();
    
            $user->profile->update([
                'image' => $imagePath
                ]);
    
            $user->update([
                'civilite'          => $data['civilite'],
                'sexe'              => $sexe,
                'firstname'         => $data['firstname'],
                'name'              => $data['name'],
                'email'             => $data['email'],
                'date_naissance'    => $data['date_naiss'],
                'lieu_naissance'    => $data['lieu'],
                'familiales_id'     => $familiale_id,
                'adresse'           => $data['adresse'],
                'telephone'         => $data['telephone'],
                'fixe'              => $data['fixe'],
                'bp'                => $data['bp'],
                'fax'               => $data['fax'],
                'roles_id'          => $roles_id,
                'updated_by'        => $updated_by,

                ]);
                
                $employee = new Employee([
                    'matricule'     =>     $request->input('matricule'),
                    'cin'           =>     $request->input('cin'),
                    'date_embauche' =>     $request->input('date_embauche'),
                    'fin'           =>     $fin,
                    'users_id'      =>     $utilisateur->id,
                    'adresse'       =>     $request->input('autre_adresse'),
                    'categories_id' =>     $request->input('categorie'),
                    'directions_id' =>     $request->input('direction'),
                    'fonctions_id'  =>     $fonctions_id
                ]);
                
                $employee->save();
        } else {
            $user->profile->update($data);

            $user->update([
                'civilite'          => $data['civilite'],
                'sexe'              => $sexe,
                'firstname'         => $data['firstname'],
                'name'              => $data['name'],
                'date_naissance'    => $data['date_naiss'],
                'lieu_naissance'    => $data['lieu'],
                'familiales_id'     => $familiale_id,
                'adresse'           => $data['adresse'],
                'bp'                => $data['bp'],
                'fax'               => $data['fax'],
                'telephone'         => $data['telephone'],
                'fixe'              => $data['fixe'],
                'roles_id'          => $roles_id,
                'updated_by'        => $updated_by,

                ]);

                $employee = new Employee([
                    'matricule'     =>     $request->input('matricule'),
                    'cin'           =>     $request->input('cin'),
                    'date_embauche' =>     $request->input('date_embauche'),
                    'fin'           =>     $fin,
                    'users_id'      =>     $user->id,
                    'adresse'       =>     $request->input('autre_adresse'),
                    'categories_id' =>     $request->input('categorie'),
                    'directions_id' =>     $request->input('direction'),
                    'fonctions_id'  =>     $fonctions_id
                ]);
                
                $employee->save();
        }

        $success = $user->firstname.' '.$user->name.' a été modifié(e) avec succès';
        return redirect()->route('employees.index')->with(compact('success'));
        } else {
             
        $this->validate(
            $request,
            [
                'civilite'      =>  'required|string|max:10',
                'matricule'     =>  'required|string|max:50',
                'categorie'     =>  'required|string|max:50',
                'firstname'     =>  'required|string|max:50',
                'name'          =>  'required|string|max:50',
                'telephone'     =>  'required|string|max:50',
                'fixe'          =>  'sometimes',
                'email'         =>  'required|email|max:255|unique:users,email',
                'cin'           =>  'required|string|min:12|max:15',
                'adresse'       =>  'string',
                'familiale'     =>  'required|string',
                'date_naiss'    =>  'required|date',
                'date_embauche' =>  'required|date',
                'lieu'          =>  'required|string',
            ]
        );
        
        $employee = Employee::all()->count();

        if (isset($employee) && $employee <= 0) {
            $user_id = 0;
        } else {
            $user_id         =   Employee::latest('id')->first()->id;
        }

        $longueur            =      strlen($user_id);

        if ($longueur <= 1) {
            $user_id   =   strtolower("00".$user_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $user_id   =   strtolower("0".$user_id);
        } else {
            $user_id   =   strtolower($user_id);
        }

        $username            =   strtolower($request->input('name').$user_id.'E');

        $roles_id = Role::where('name', 'Administrateur')->first()->id;

        $civilite = $request->input('civilite');
        
        if ($civilite == "Mme") {
            $sexe = "F";
        } elseif ($civilite == "M.") {
            $sexe = "M";
        } else {
            $sexe = "";
        }

        $user_connect           =   Auth::user();
        
        $created_by  = strtolower($user_connect->username);
        $updated_by  = strtolower($user_connect->username);

        $familiale_id = $request->input('familiale');

        $fonction=Fonction::find($request->input('fonction'));

        if (Fonction::where('name', $fonction)->exists()) {
            $fonctions_id = Fonction::where('name', $fonction)->first()->id;
         }
         else {
            $fonction = new Fonction([
                'name'     =>     $fonction->name
            ]);
            
            $fonction->save();
            $fonctions_id = $fonction->id;
         }

        $utilisateur = new User([
            'civilite'              =>      $request->input('civilite'),
            'sexe'                  =>      $sexe,
            'firstname'             =>      $request->input('firstname'),
            'name'                  =>      $request->input('name'),
            'username'              =>      $username,
            'date_naissance'        =>      $request->input('date_naiss'),
            'lieu_naissance'        =>      $request->input('lieu'),
            'familiales_id'         =>      $familiale_id,
            'adresse'               =>      $request->input('adresse'),
            'email'                 =>      $request->input('email'),
            'telephone'             =>      $request->input('telephone'),
            'fixe'                  =>      $request->input('fixe'),
            'bp'                    =>      $request->input('bp'),
            'fax'                   =>      $request->input('fax'),
            'password'              =>      Hash::make($request->input('password')),
            'roles_id'              =>      $roles_id,
            'created_by'            =>      $created_by,
            'updated_by'            =>      $updated_by
        ]);
        
        $utilisateur->save();

        $date = Carbon::createFromFormat('Y-m-d', $request->input('date_naiss'));
        $fin = $date->addYears(60);

        $employee = new Employee([
            'matricule'     =>     $request->input('matricule'),
            'cin'           =>     $request->input('cin'),
            'date_embauche' =>     $request->input('date_embauche'),
            'fin'           =>     $fin,
            'users_id'      =>     $utilisateur->id,
            'adresse'       =>      $request->input('autre_adresse'),
            'categories_id' =>     $request->input('categorie'),
            'directions_id' =>     $request->input('direction'),
            'fonctions_id'  =>     $fonctions_id
        ]);
        
        $employee->save();
        return redirect()->route('employees.index')->with('success', 'employee ajouté avec succès !');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $civilites = User::distinct('civilite')->get()->pluck('civilite', 'civilite')->unique();
        $directions = Direction::pluck('name', 'name');
        $categories = Category::pluck('name', 'name');
        $fonctions = Fonction::pluck('name', 'name');
        $familiale = Familiale::distinct('name')->get()->pluck('name', 'name')->unique();

        return view('employees.update', compact('employee', 'directions', 'civilites', 'categories', 'fonctions', 'familiale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $data = request()->validate(
            [
                'civilite'      =>  'required|string|max:10',
                'direction'     =>  'required|string',
                'email'         =>  'required|email|max:255|unique:users,email,'.$employee->user->id,
                'matricule'     =>  'required|string|max:15',
                'categorie'     =>  'required|string|max:50',
                'firstname'     =>  'required|string|max:50',
                'fonction'      =>  'required|string',
                'name'          =>  'required|string|max:50',
                'telephone'     =>  'required|string|max:50',
                'fixe'          =>  'sometimes',
                'cin'           =>  'required|string|min:12|max:15',
                'familiale'     =>  'required|string',
                'adresse'       =>  'string',
                'date_naiss'    =>  'required|date',
                'date_embauche' =>  'required|date',
                'lieu'          =>  'required|string',
                'bp'            =>  'sometimes',
                'fax'           =>  'sometimes',
                'image'         =>  'sometimes|image|max:3000',
                'updated_by'         =>  'string',
            ]
        );

        $user = $employee->user;

        $direction=$request->input('direction');
        $directions_id = Direction::where('name', $direction)->first()->id;

        $fonction_id = Fonction::where('name', $request->input('fonction'))->first()->id;

      /*   if (Fonction::where('name', $fonction)->exists()) {
            $fonction = Fonction::where('name', $fonction)->first()->id;
         }
         else {
            $fonction = new Fonction([
                'name'     =>     $fonction->name
            ]);
            
            $fonction->save();
            $fonctions_id = $fonction->id;
         } */


        $categorie=$request->input('categorie');
        $categories_id = Category::where('name', $categorie)->first()->id;

        $roles_id = Role::where('name', 'Administrateur')->first()->id;

        $date = Carbon::createFromFormat('Y-m-d', $request->input('date_naiss'));
        $fin = $date->addYears(60);

        $civilite = $request->input('civilite');
        
        if ($civilite == "Mme") {
            $sexe = "F";
        } elseif ($civilite == "M.") {
            $sexe = "M";
        } else {
            $sexe = "";
        }

        $familiale_id = Familiale::where('name', $request->input('familiale'))->first()->id;
        $user_connect           =              Auth::user();
        $updated_by             =              strtolower($user_connect->username);
                
        if (request('image')) {
            $imagePath = request('image')->store('avatars', 'public');
    
            $image = Image::make(public_path("/storage/{$imagePath}"))->fit(800, 800);
            $image->save();
    
            $user->profile->update([
                'image' => $imagePath
                ]);
    
            $user->update([
                'civilite'          => $data['civilite'],
                'sexe'              => $sexe,
                'firstname'         => $data['firstname'],
                'name'              => $data['name'],
                'email'             => $data['email'],
                'date_naissance'    => $data['date_naiss'],
                'lieu_naissance'    => $data['lieu'],
                'familiales_id'     => $familiale_id,
                'adresse'           => $data['adresse'],
                'telephone'         => $data['telephone'],
                'fixe'              => $data['fixe'],
                'bp'                => $data['bp'],
                'fax'               => $data['fax'],
                'roles_id'          => $roles_id,
                'updated_by'        => $updated_by,

                ]);
                
            $employee->update([
                'matricule'         =>      $data['matricule'],
                'cin'               =>      $data['cin'],
                'date_embauche'     =>      $data['date_embauche'],
                'adresse'           =>      $data['adresse'],
                'fin'               =>      $fin,
                'directions_id'     =>      $directions_id,
                'fonctions_id'      =>      $fonction_id,
                'categories_id'     =>      $categories_id,
                'roles_id'          =>      $roles_id,

                ]);
        } else {
            $user->profile->update($data);

            $user->update([
                'civilite'          => $data['civilite'],
                'sexe'              => $sexe,
                'firstname'         => $data['firstname'],
                'name'              => $data['name'],
                'date_naissance'    => $data['date_naiss'],
                'lieu_naissance'    => $data['lieu'],
                'familiales_id'     => $familiale_id,
                'adresse'           => $data['adresse'],
                'bp'                => $data['bp'],
                'fax'               => $data['fax'],
                'telephone'         => $data['telephone'],
                'fixe'              => $data['fixe'],
                'roles_id'          => $roles_id,
                'updated_by'        => $updated_by,

                ]);

            $employee->update([
                'matricule'         =>      $data['matricule'],
                'cin'               =>      $data['cin'],
                'date_embauche'     =>      $data['date_embauche'],
                'fin'               =>      $fin,
                'adresse'           =>      $data['adresse'],
                'directions_id'     =>      $directions_id,
                'fonctions_id'      =>      $fonction_id,
                'categories_id'     =>      $categories_id,
                'roles_id'          =>      $roles_id,

                ]);
        }

        $success = $employee->user->firstname.' '.$employee->user->name.' a été modifié(e) avec succès';
        return redirect()->route('employees.index')->with(compact('success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        $user = Auth::user();
        $utilisateurs   =   $employee->user;

        $deleted_by1 = $user->firstname;
        $deleted_by2 = $user->name;
        $deleted_by3 = $user->username;

        $deleted_by = $deleted_by1.' '.$deleted_by2.' ('.$deleted_by3.')';

        $utilisateurs->deleted_by      =      $deleted_by;

        $utilisateurs->save();
       
        $employee->user->delete();
        $employee->delete();

        $message = $employee->user->firstname.' '.$employee->user->name.' a été supprimé(e)';
        return redirect()->route('employees.index')->with('success', 'employé supprimée avec succès !');
    }

    public function list(Request $request)
    {
        $employees=Employee::with('user.employee.fonction')->get();
        return Datatables::of($employees)->make(true);
    }

    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');

      $data = DB::table('users')      
      ->where('email', 'LIKE', "%{$query}%")
        ->get();

      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $user)
      {
        $id = $user->id;
        $email = $user->email;                  
        $prenom = $user->firstname;                  
        $nom = $user->name;                  
        $civilite = $user->civilite;                
        $telephone = $user->telephone;                         

       $output .= '
       
       <li data-id="'.$id.'" data-email="'.$email.'" data-prenom="'.$prenom.'" data-nom="'.$nom.'" data-civilite="'.$civilite.'" data-telephone="'.$telephone.'"><a href="#">'.$email.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }

}
