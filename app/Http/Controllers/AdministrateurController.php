<?php

namespace App\Http\Controllers;

use App\Models\Administrateur;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;

class AdministrateurController extends Controller
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
        $administrateurs = Administrateur::all();
        return view('administrateurs.index', compact('administrateurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        $civilites = User::select('civilite')->distinct()->get();
      
        return view('administrateurs.create',compact('roles', 'civilites'));
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
            $request, [
                'civilite'      =>  'required|string|max:10',
                'matricule'     =>  'required|string|max:50',
                'prenom'        =>  'required|string|max:50',
                'nom'           =>  'required|string|max:50',
                'telephone'     =>  'required|string|max:50',
                'email'         =>  'required|email|max:255|unique:users,email',
                'username'      =>  'required|string|max:255|unique:users,username',
                'password'      =>  'required|confirmed|string|min:8|max:50',
            ],
            [
                'password.min'  =>  'Pour des raisons de sécurité, votre mot de passe doit faire au moins :min caractères.'
            ],
            [
                'password.max'  =>  'Pour des raisons de sécurité, votre mot de passe ne doit pas dépasser :max caractères.'
            ]
        );

        $roles_id = Role::where('name','Administrateur')->first()->id;
        $utilisateur = new User([      
            'civilite'      =>      $request->input('civilite'),      
            'firstname'      =>      $request->input('prenom'),
            'name'           =>      $request->input('nom'),
            'email'          =>      $request->input('email'),
            'username'       =>      $request->input('username'),
            'telephone'      =>      $request->input('telephone'),
            'password'       =>      Hash::make($request->input('password')),
            'roles_id'       =>      $roles_id

        ]);
        
        $utilisateur->save();
        
        $administrateur = new Administrateur([
            'matricule'     =>     $request->input('matricule'),
            'users_id'      =>     $utilisateur->id
        ]);

        $administrateur->save();
        return redirect()->route('administrateurs.index')->with('success','utilisateur ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */
    public function show(Administrateur $administrateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$utilisateur = User::find($id);
        $administrateur = Administrateur::find($id);
        $utilisateur=$administrateur->user;        
        //$roles = Role::get();
        $roles = Role::distinct('name')->get()->pluck('name','name')->unique();

        //dd($roles);

        $civilites = User::distinct('civilite')->get()->pluck('civilite','civilite')->unique();
        //return $utilisateur;
        return view('administrateurs.update', compact('administrateur','utilisateur','id','roles','civilites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Administrateur $administrateur)
    {
        $this->validate(
            $request, 
            [
                'civilite'      => 'required|string|max:10',
                'matricule'     =>  'required|string|max:50',
                'prenom'        => 'required|string|max:100',
                'nom'           => 'required|string|max:50',
                'telephone'     => 'required|string|max:50',
                'email'         =>  'required|email|max:255|unique:users,email,'.$administrateur->user->id,
                'username'      =>  'required|string|max:255|unique:users,username,'.$administrateur->user->id,
                'role'          => 'required|string'
            ]);

        /* $administrateur = Administrateur::find($id); */
        $utilisateur=$administrateur->user;

       /*  $roles_id = Role::where('name','Administrateur')->first()->id; */


        $utilisateur->civilite       =      $request->input('civilite');
        $utilisateur->firstname      =      $request->input('prenom');
        $utilisateur->name           =      $request->input('nom');
        $utilisateur->telephone      =      $request->input('telephone');
        $utilisateur->email          =      $request->input('email');
        $utilisateur->username      =      $request->input('username');
       /*  $utilisateur->roles_id       =      $roles_id; */
        $role_id = $request->input('role');
        $roles_id = Role::where('name', $role_id)->first()->id;
        //dd($roles_id);
        $utilisateur->roles_id        =      $roles_id;

        $utilisateur->save();

        $administrateur->matricule   =     $request->input('matricule');
        $administrateur->users_id    =     $utilisateur->id;

        $administrateur->save();
        
        return redirect()->route('administrateurs.index')->with('success','utilisateur modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Administrateur  $administrateur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Administrateur $administrateur)
    {
        $administrateur->delete();
        $message = $administrateur->user->firstname.' '.$administrateur->user->name.' a été supprimé(e)';
        return redirect()->route('administrateurs.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $administrateurs=Administrateur::with('user')->orderBy('created_at', 'asc')->get();
        return Datatables::of($administrateurs)->make(true);
    }
}
