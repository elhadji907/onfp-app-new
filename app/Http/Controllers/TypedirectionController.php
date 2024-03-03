<?php

namespace App\Http\Controllers;

use App\Models\TypesDirection;
use Illuminate\Http\Request;
use DB;

class TypedirectionController extends Controller
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
        $typedirections = TypesDirection::all();
        return view('typedirections.index', compact('typedirections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('typedirections.create');
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
            'name' => 'required|unique:types_directions,name',
            ]);
        $typedirections = TypesDirection::create(['name' => $request->input('name')]);
        return redirect()->route('typedirections.index')
            ->with('success', 'Type de direction créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TypesDirection  $typesDirection
     * @return \Illuminate\Http\Response
     */
    public function show(TypesDirection $typesDirection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TypesDirection  $typesDirection
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $typedirection = TypesDirection::find($id);

        return view('typedirections.edit', compact('typedirection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TypesDirection  $typesDirection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $typedirection = TypesDirection::find($id);
        $this->validate($request, [
            'name'                  => 'required|unique:types_directions,name,'.$typedirection->id,
            ]);
        $typedirection->name = $request->input('name');
        $typedirection->save();
        return redirect()->route('typedirections.index')
            ->with('success', 'Type de direction modifiéé avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TypesDirection  $typesDirection
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("types_directions")->where('id', $id)->delete();
        return redirect()->route('typedirections.index')
->with('success', 'Type de direction supprimé avec succès');
    }
}
