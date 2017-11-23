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
            'name' => 'required|string|max:50',
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
            ->select('users.id','users.name','comentarios_proyecto.descripcion','comentarios_proyecto.created_at')
            ->where('id_proyecto',$proyecto->id)
            ->get();
        $taskuser = DB::table('task')
            /*->join('users', 'task.id_usuario', '=', 'users.id')
            ->select('task.id','task.nombre','task.description','task.peso','users.id','users.name','users.lastname')*/
            ->where([['id_proyecto',$id],['estado','=','BackLog Usuario'],])
            ->orderBy('peso', 'desc')
            ->get();
        $task = DB::table('task')
            ->where([['id_proyecto',$id],['estado','=','BackLog Proyecto'],])
            ->orderBy('peso', 'desc')
            ->get();
        $taskrevision = DB::table('task')
            ->where([['id_proyecto',$id],['estado','=','BackLog Revision'],])
            ->orderBy('peso', 'desc')
            ->get();
        $taskcomplete = DB::table('task')
            ->where([['id_proyecto',$id],['estado','=','BackLog Aprobado'],])
            ->orderBy('peso', 'desc')
            ->get();
        //dd($task);
        
        //dd($equipo);
        //dd($proyecto);
            //->paginate(10000);
        return view('modulos.proyecto.proyecto-show', ['proyecto' => $proyecto, 'equipo' => $equipo, 'comentarios_proyecto' => $comments, 'task' => $task, 'taskuser' => $taskuser, 'users' => $users, 'taskrevision' => $taskrevision, 'taskcomplete' => $taskcomplete]);
    }
    
    /*public function add_comment(Request $request, $id) 
    {
        if($request->ajax()) {
            return response()->json([
                'total' => 'aqui',
                'message' => 'shop'
            ]);
        }
    }*/

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
