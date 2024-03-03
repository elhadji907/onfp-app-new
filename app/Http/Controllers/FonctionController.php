<?php

namespace App\Http\Controllers;

use App\Models\Fonction;
use Illuminate\Http\Request;
use DB;

class FonctionController extends Controller
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
         $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index','store']]);
         $this->middleware('permission:role-create', ['only' => ['create','store']]);
         $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fonctions = Fonction::all();
        return view('fonctions.index', compact('fonctions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fonctions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->query('id');

        $this->validate($request, [
            'name' => 'required|unique:fonctions,name',
            ]);
        $fonction = Fonction::create([
            'name' => $request->input('name'),
            'sigle' => $request->input('sigle'),
        ]);
        return redirect()->route('fonctions.index')
            ->with('success', 'Fonction créée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fonction  $fonction
     * @return \Illuminate\Http\Response
     */
    public function show(Fonction $fonction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fonction  $fonction
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fonction = Fonction::find($id);

        return view('fonctions.edit', compact('fonction'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fonction  $fonction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fonction = Fonction::find($id);

        $this->validate($request, [
            'name' => 'required|unique:fonctions,name,'.$fonction->id,
            'sigle' => 'sometimes|unique:fonctions,sigle,'.$fonction->id,
            ]);
        $fonction->name = $request->input('name');
        $fonction->sigle = $request->input('sigle');
        $fonction->save();
        return redirect()->route('fonctions.index')
            ->with('success', 'Fonction modification avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fonction  $fonction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("fonctions")->where('id', $id)->delete();
        return redirect()->route('fonctions.index')
->with('success', 'Fonction supprimée avec succès');
    }

    
    
    function fetch(Request $request)
    {
     if($request->get('query'))
     {
      $query = $request->get('query');

      $data = DB::table('fonctions')
        ->where('name', 'LIKE', "%{$query}%")
        ->get();

      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $fonction)
      {
        
        $name = $fonction->name;
        $id = $fonction->id;


       $output .= '
       
       <li data-id="'.$id.'" data-name="'.$name.'"><a href="#">'.$name.'</a></li>
       ';
      }
      $output .= '</ul>';
      echo $output;
     }
    }

}
