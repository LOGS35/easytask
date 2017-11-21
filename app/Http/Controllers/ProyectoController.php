<?php

namespace EasyTask\Http\Controllers;

use Illuminate\Http\Request;
use EasyTask\Equipo;
use EasyTask\Proyecto;
use EasyTask\Task;
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
            'description' => 'required|string|max:300',
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
        $proyecto = Proyecto::find($id);
        $equipo = DB::table('equipo')
            ->where('id',$proyecto->id_equipo)
            ->get();
        $users = DB::table('users')
            ->where('id_equip',$proyecto->id_equipo)
            ->get();
        $comments = DB::table('comentarios_proyecto')
            ->join('users', 'comentarios_proyecto.id_user', '=', 'users.id')
            ->select('users.name','comentarios_proyecto.descripcion','comentarios_proyecto.created_at')
            ->where('id_proyecto',$proyecto->id)
            ->get();
        
        
        //dd($equipo);
        //dd($proyecto);
            //->paginate(10000);
        return view('modulos.proyecto.proyecto-show', ['proyecto' => $proyecto, 'equipo' => $equipo, 'users' => $users, 'comentarios_proyecto' => $comments]);
    }
    
    public function add_comment(Request $request) 
    {
        
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
        $proyecto = Proyecto::find($id);
        $proyecto->name = $request->name;
        $proyecto->description = $request->description;
        $proyecto->estado = $request->estado;
        //dd($equipo);
        $proyecto->save(); 
        
       /* $id_equip = DB::table('equipo')
                ->select('id')
                ->where('id',$id)
                ->get();
        
        dd($id_equipo);
        */
        //dd($id_equip);
        
        /*$user = User::find($request->user[1]);
        $user->id_equip = $id_equip->id;
        $user->save();*/
        
        return redirect()->back()->with('status', 'El proyecto fue actualizado!'); 
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
        return redirect()->route('proyecto.index')->with('status','El proyecto: '.$proyecto->name.' fue eliminado');
    }
}
