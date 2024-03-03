<?php

namespace App\Http\Controllers;

use App\Models\Gestionnaire;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Charts\Courrierchart;

class GestionnaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['role:super-admin|Administrateur|Demandeur']);
        /* $this->middleware('permission:edit courriers|delete courriers|delete demandes', ['only' => ['index','show']]); */
    }
    
    public function index()
    {
        return view('gestionnaires.index');
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
      
        return view('gestionnaires.create',compact('roles', 'civilites'));
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
            ]
        );

        $roles_id = Role::where('name','Gestionnaire')->first()->id;
        $utilisateur = new User([      
            'civilite'       =>      $request->input('civilite'),      
            'firstname'      =>      $request->input('prenom'),
            'name'           =>      $request->input('nom'),
            'email'          =>      $request->input('email'),
            'username'       =>      $request->input('username'),
            'telephone'      =>      $request->input('telephone'),
            'password'       =>      Hash::make($request->input('password'))

        ]);
        
        $utilisateur->save();
        $utilisateur->assignRole('Gestionnaire');
        
        $gestionnaire = new Gestionnaire([
            'matricule'     =>     $request->input('matricule'),
            'users_id'      =>     $utilisateur->id
        ]);

        $gestionnaire->save();
        return redirect()->route('gestionnaires.index')->with('success','utilisateur ajoutée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gestionnaire  $gestionnaire
     * @return \Illuminate\Http\Response
     */
    public function show(Gestionnaire $gestionnaire)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gestionnaire  $gestionnaire
     * @return \Illuminate\Http\Response
     */
    public function edit(Gestionnaire $gestionnaire)
    {
        //$utilisateur = User::find($id);
        $utilisateur=$gestionnaire->user;        
        //$roles = Role::get();
        $roles = Role::distinct('name')->get()->pluck('name','name')->unique();

        //dd($roles);

        $civilites = User::distinct('civilite')->get()->pluck('civilite','civilite')->unique();
        //return $utilisateur;
        return view('gestionnaires.update', compact('gestionnaire','utilisateur','roles','civilites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gestionnaire  $gestionnaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gestionnaire $gestionnaire)
    {
        
        $this->validate(
            $request, 
            [
                'civilite'      => 'required|string|max:10',
                'matricule'     =>  'required|string|max:50',
                'prenom'        => 'required|string|max:100',
                'nom'           => 'required|string|max:50',
                'telephone'     => 'required|string|max:50',
                'email'         =>  'required|email|max:255|unique:users,email,'.$gestionnaire->user->id,
                'username'      =>  'required|string|max:255|unique:users,username,'.$gestionnaire->user->id
            ]);

        /* $gestionnaire = Gestionnaire::find($id); */
        $utilisateur=$gestionnaire->user;

        $utilisateur->civilite       =       $request->input('civilite');
        $utilisateur->firstname      =      $request->input('prenom');
        $utilisateur->name           =      $request->input('nom');
        $utilisateur->telephone      =      $request->input('telephone');
        $utilisateur->email          =      $request->input('email');
        $utilisateur->username       =      $request->input('username');

        $utilisateur->save();
        $utilisateur->assignRole('Gestionnaire');

        $gestionnaire->matricule   =     $request->input('matricule');
        $gestionnaire->users_id    =     $utilisateur->id;

        $gestionnaire->save();
        
        return redirect()->route('gestionnaires.index')->with('success','utilisateur modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gestionnaire  $gestionnaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gestionnaire $gestionnaire)
    {
        $gestionnaire->delete();
        $message = $gestionnaire->user->firstname.' '.$gestionnaire->user->name.' a été supprimé(e)';
        return redirect()->route('gestionnaires.index')->with(compact('message'));
    }

    public function list(Request $request)
    {
        $gestionnaires=Gestionnaire::with('user')->get();
        return Datatables::of($gestionnaires)->make(true);
    }
}
