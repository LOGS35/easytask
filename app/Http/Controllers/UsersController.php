<?php

namespace EasyTask\Http\Controllers;

use Illuminate\Http\Request;
//use EasyTask\DataTables\UserDataTable;
/*use EasyTask\Http\Request;*/
use EasyTask\Http\Controllers\Controller;
use EasyTask\User;
use EasyTask\Equipo;
use EasyTask\Proyecto;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use Alert;
use Illuminate\Support\Facades\Validator;
/*use Alert;*/

class UsersController extends Controller
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
    public function find(Request $request)
    {
        $term = trim($request->q);

        if (empty($term)) {
            return \Response::json([]);
        }

        $users = User::search($term)->limit(5)->get();

        $formatted_tags = [];

        foreach ($users as $user) {
            if ($user->id_equip == null) {
                $formatted_tags[] = ['id' => $user->id, 'text' => $user->name.' '.$user->lastname];
            }
        }

        return \Response::json($formatted_tags);
    }
    public function index()
    {
        //
        $users = User::orderBy('id', 'ASC')->get();

            //->paginate(10000);
        return view('modulos.usuarios.usuarios')->with('users', $users);
        //return $dataTable->render('buttons.eloquent.index');
    }
    /*public function getUsers()
    {
        return datatables()->of(DB::table('users'))->toJson();
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('users.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();
        
        return redirect('/users')->with('status', 'Usuario creado!');

        //return Redirect::home();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $equipo = Equipo::find($user->id_equip);
        if ($equipo->id_proy != null) {
            $proyecto = Proyecto::find($equipo->id_proy);
            return view('modulos.usuarios.user-show', ['users' => $user, 'equipo' => $equipo, 'proyecto' => $proyecto]);
        }
            //->paginate(10000);
        return view('modulos.usuarios.user-show', ['users' => $user, 'equipo' => $equipo]);
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
        $v = Validator::make($request->all(), [
            
            'name' => 'required|string|max:20',
            'lastname' => 'required|string|max:20',
            'email' => 'required|string|email|max:40',
            'type' => 'required|max:255',
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->type = $request->type;
        $user->email = $request->email;
        $user->save();
        return redirect()->back()->with('status', 'Usuario modificado!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //alert('<a href="#">Click me</a>')->html()->persistent("No, thanks");
        $user = User::find($id);
        //Alert::message('Robots are working!');
        $user->delete();
        return back()->with('status','El usuario: '.$user->name.' '.$user->lastname.' a sido fue eliminado');
        
    //return home();
        /*$user = User::find($id);
        $user->destroy();*/
        //echo '<script language="javascript">swal("Hello world!");</script>';
        //return back()->with('status','Usuario eliminado');
        
    }
}
