<?php

namespace EasyTask\Http\Controllers;

use Illuminate\Http\Request;
use EasyTask\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $v = \Validator::make($request->all(), [
            'nombre' => 'required|string|max:50',
            'peso' => 'required|int',
            'description' => 'required|string|max:300',
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $task = new Task($request->all());
        $task->save(); 
        
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
        
        return back()->with('status','Tarea creada!');
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
        //
    }
}
