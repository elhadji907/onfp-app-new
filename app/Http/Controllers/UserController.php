<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Demandeur;
use App\Models\Individuelle;
use App\Models\Collective;
use App\Models\Pcharge;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function __construct()
    {
       /*  $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur']);
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
        $users      =   User::skip(0)->take(10000)->get();
        return response(view('users.index', compact('users')));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $civilites      =   User::select('civilite')->distinct()->get();
        $roles          =   Role::pluck('name', 'name')->all();
        return response(view('users.create', compact('civilites', 'roles')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'civilite'      =>  'required|string|max:10',
                'firstname'     =>  'required|string|max:50',
                'name'          =>  'required|string|max:50',
                'telephone'     =>  'required|string|max:50',
                'email'         =>  'required|string|email|max:255|unique:users,email,NULL,id,deleted_at,NULL',
                'username'      =>  'required|string|max:255|unique:users,username,NULL,id,deleted_at,NULL',
                'password'      =>  'required|same:confirm-password',
                'roles'         =>  'required'
            ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        $annee = date('y');
        $user_id             =      User::latest('id')->first()->id;
        $longueur            =      strlen($user_id);

        if ($longueur <= 1) {
            $numero   =   strtolower($annee."000000".$user_id);
        } elseif ($longueur >= 2 && $longueur < 3) {
            $numero   =   strtolower($annee."00000".$user_id);
        } elseif ($longueur >= 3 && $longueur < 4) {
            $numero   =   strtolower($annee."0000".$user_id);
        } elseif ($longueur >= 4 && $longueur < 5) {
            $numero   =   strtolower($annee."000".$user_id);
        } elseif ($longueur >= 5 && $longueur < 6) {
            $numero   =   strtolower($annee."00".$user_id);
        } elseif ($longueur >= 6 && $longueur < 7) {
            $numero   =   strtolower($annee."0".$user_id);
        } else {
            $numero   =   strtolower($annee.$user_id);
        }
        
        $demandeur = Demandeur::create([
            'numero'            =>      $numero,
            'users_id'          =>      $user->id,
        ]);

        $individuelle = Individuelle::create([
            'demandeurs_id'     =>      $demandeur->id,
        ]);

        $collective = Collective::create([
            'demandeurs_id'     =>      $demandeur->id,
        ]);

        $pcharge = Pcharge::create([
            'demandeurs_id'     =>      $demandeur->id,
        ]);


        return response(redirect()->route('users.index')
            ->with('success', 'Utilisateur créé avec succès'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response(view('users.show', compact('user')));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        /* $roles = Role::pluck('name','name')->all(); */
        $userRole = $user->roles->pluck('name', 'name')->all();
        $roles = Role::distinct('name')->pluck('name', 'name')->unique();
        $civilites = User::distinct('civilite')->pluck('civilite', 'civilite')->unique();
       
        return response(view('users.update', compact('roles', 'civilites', 'userRole', 'user')));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'civilite'      =>  'required|string|max:10',
            'firstname'     =>  'required|string|max:50',
            'name'          =>  'required|string|max:50',
            'telephone'     =>  'required|string|max:50',
            'username'      =>  'required|string|max:255|unique:users,username,'.$user->id,
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'password'      => 'same:confirm-password',
            /* 'roles'         => 'required' */
            ]);

        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        
        $user->update($input);
        
        DB::table('model_has_roles')->where('model_id', $user->id)->delete();
        $user->assignRole($request->input('roles'));
        return response(redirect()->route('users.index')
            ->with('success', 'Utilisateur mis à jour avec succès'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès'));
    }
}
