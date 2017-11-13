<?php

namespace EasyTask\Http\Controllers;

use Illuminate\Http\Request;
use EasyTask\Equipo;
use EasyTask\Proyecto;
use EasyTask\Equipo_Proyecto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class ProyectoController extends Controller
{
    protected $routeMiddleware = [
        'auth' => Middleware\Authenticate::class,
        // otros middleware
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modulos.proyecto.proyecto');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'estado' => 'required|string|max:20',
            'description' => 'required|string|max:100',
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $proyecto = new Proyecto($request->all());
        $proyecto->id_equipo = $request->equipo;
        $proyecto->save(); 
        
        /*$id_proyecto = DB::table('proyecto')
                ->select('id')
                ->latest()
                ->first();*/
        
        /*$equipo_proyecto = new Equipo_Proyecto();
        $equipo_proyecto->id_proy = $id_proyecto->id;
        $equipo_proyecto->id_equipo = $request->equipo;
        $equipo_proyecto->save();*/
        
        /*$equipo = Equipo::find($request->equipo);
        $equipo->id_proy = $id_proyecto->id;
        $equipo->save();*/
        
        return back()->with('status','Proyecto creado!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::find($id);
        $proyecto->delete();
        return back()->with('status','El proyecto: '.$proyecto->name.' fue eliminado');
    }
}
