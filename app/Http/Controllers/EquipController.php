<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Equipo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
//use App\Http\Controllers\Flash;

class EquipController extends Controller
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
        /*$equipo = DB::table('users')
            ->join('equipo', 'users.id_equip', '=', 'equipo.id')
            ->get();*/
        $equipo = DB::table('equipo')
            ->get();
        //dd($equipo);
            //->paginate(10000);
        return view('modulos.equipo.equipo', ['equipo' => $equipo]);
            //->with('equipo', $equipo);
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
            'nombre' => 'required|string|max:20',
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $equipo = new Equipo($request->all());
        $equipo->estado = "Activo";
        //dd($equipo);
        $equipo->save(); 
        
        $id_equip = DB::table('equipo')
                ->select('id')
                ->latest()
                ->first();
        
        //dd($id_equip);
        
        /*$user = User::find($request->user[1]);
        $user->id_equip = $id_equip->id;
        $user->save();*/
        
        foreach ($request->user as $selectedOption) {
            $user = User::find($selectedOption);
            $user->id_equip = $id_equip->id;
            $user->save();
        }
        
        return redirect()->back()->with('status', 'Equipo creado!'); 
        /*$user = User::find($id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->type = $request->type;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('status', 'Usuario modificado!'); */
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
        //$user = User::find($id->id);
        //$user->delete();
        
        //$count = 0;
        $user_id = DB::table('users')
            ->where('id_equip',$id)
            ->get(); 
        
        
        foreach ($user_id as $user_id) {
            $user = User::find($user_id->id);
        //dd($user->id_equip);
            //dd($user);
            $user->id_equip = null;
            $user->save();
        }
        
        $equipo = Equipo::find($id);
        $equipo->estado = 'Inactivo';
        $equipo->save();
        //foreach($user_id as $User) {
            //$user = User::find($user_id);
            /*$user->id_equip = null;
            $user->save();*/
            //$count = $count + 1;
            //dd($user_id);
            //dd($count);
        //}
        //$user->id_equip = null;
        //$user->save();
        //App:abort(404);
        //dd($user);
        //dd($user);
        return back()->with('status', 'El equipo "'. $equipo->nombre .'" a pasado a modo inactivo y los integrantes han pasado a estar sin equipo!');
    }
}