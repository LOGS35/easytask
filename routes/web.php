<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use EasyTask\Comentario_proyecto;
use EasyTask\Comentario_noticia;
use EasyTask\Task;
use Illuminate\Support\Facades\DB;

Route::get('welcome', function () {
    return view('welcome');
});

/*Route::get('home', function () {
    return view('home');
});*/

/*Route::get('/', function () {
    return view('users.login');
});
*/
/*Route::get('register', function () {
    return view('login.register');
});*/

/*Route::group(['prefix' => '/'], function(){
    Route::resource('users','UsersController');
});*/

/*Route::get('/', function () {
    return view('layout');
});*/
Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

/*Route::group(['middleware' => 'auth'], function(){
    Route::resource('profile','ProfileController');
});*/

Route::post('pdf', 'PdfController@invoice')->name('pdf.proyecto');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('equipo','EquipController');
    Route::get('equipo/{id}/destroy', [
        'uses' => 'EquipController@destroy',
        'as' => 'equipo.destroy'
    ]);
    Route::get('equipo/{id}/expulsar', [
        'uses' => 'EquipController@expulsar',
        'as' => 'equipo.expulsar'
    ]);
    Route::get('equipo/{id}', [
        'uses' => 'EquipController@show',
        'as' => 'equipo.show'
    ]);
   /* Route::post('equipo/findp', [
        'uses' => 'EquipController@buscar',
        'as' => 'equipo.findp'
    ]);*/
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('users','UsersController');
    Route::get('users/{id}/destroy', [
        'uses' => 'UsersController@destroy',
        'as' => 'users.destroy'
    ]);
    Route::get('users/{id}', [
        'uses' => 'UsersController@show',
        'as' => 'users.show'
    ]);
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('clientes','ClienteController');
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('proyecto','ProyectoController');
    Route::get('proyecto/{id}/destroy', [
        'uses' => 'ProyectoController@destroy',
        'as' => 'proyecto.destroy'
    ]);
    /*Route::get('proyecto/add_comments', [
        'uses' => 'ProyectoController@add_comment',
        'as' => 'proyecto.add_comments'
    ]);*/
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('task','TaskController');
    Route::get('task/{id}/destroy', [
        'uses' => 'TaskController@destroy',
        'as' => 'task.destroy'
    ]);
});

Route::group(['middleware' => 'auth'], function(){
    Route::resource('noticia','NoticiaController');
    Route::get('noticia/{id}/story', [
        'uses' => 'NoticiaController@mystory',
        'as' => 'noticia.mystory'
    ]);
    Route::get('noticia/{id}/destroy', [
        'uses' => 'NoticiaController@destroy',
        'as' => 'noticia.destroy'
    ]);
    /*Route::get('noticia/{id}', [
        'uses' => 'NoticiaController@show',
        'as' => 'noticia.show'
    ]);*/
});

Route::get('grafics/grafica1', function(Illuminate\Http\Request $request)
{
    //Carbon\Carbon::parse($noticia->fecha)->format('d-m-Y \a \l\a\s H:i:s')
    $date = Carbon\Carbon::now();
    $monday = new Carbon\Carbon('last monday');
    $tuesday = new Carbon\Carbon('last tuesday');
    $wednesday = new Carbon\Carbon('last wednesday');
    $thursday = new Carbon\Carbon('last thursday');
    $friday = new Carbon\Carbon('last friday');
    $saturday = new Carbon\Carbon('last saturday');
    $sunday = new Carbon\Carbon('last sunday');
    
    $hoy = Carbon\Carbon::parse($date)->format('Y-m-d');
    $lunes = Carbon\Carbon::parse($monday)->format('Y-m-d');
    $martes = Carbon\Carbon::parse($tuesday)->format('Y-m-d');
    $miercoles = Carbon\Carbon::parse($wednesday)->format('Y-m-d');
    $jueves = Carbon\Carbon::parse($thursday)->format('Y-m-d');
    $viernes = Carbon\Carbon::parse($friday)->format('Y-m-d');
    $sabado = Carbon\Carbon::parse($saturday)->format('Y-m-d');
    $domingo = Carbon\Carbon::parse($sunday)->format('Y-m-d');
    
    /*$proyecto = DB::table('proyecto')
            ->select('id')
            ->where('id_equipo',Auth::user()->id_equip)
            ->latest()
            ->first();*/
    $task_count_hoy = DB::table('task')
            ->where('id_proyecto',$request->id_proyecto)
            ->where('estado','BackLog Aprobado')
            ->whereDate('fecha_fin', $hoy)
            ->count();
    $task_count_monday = DB::table('task')
            ->where('id_proyecto',$request->id_proyecto)
            ->where('estado','BackLog Aprobado')
            ->whereDate('fecha_fin', $lunes)
            ->count();
    $task_count_tuesday = DB::table('task')
            ->where('id_proyecto',$request->id_proyecto)
            ->where('estado','BackLog Aprobado')
            ->whereDate('fecha_fin', $martes)
            ->count();
    $task_count_wednesday = DB::table('task')
            ->where('id_proyecto',$request->id_proyecto)
            ->where('estado','BackLog Aprobado')
            ->whereDate('fecha_fin', $miercoles)
            ->count();
    $task_count_thursday = DB::table('task')
            ->where('id_proyecto',$request->id_proyecto)
            ->where('estado','BackLog Aprobado')
            ->whereDate('fecha_fin', $jueves)
            ->count();
    $task_count_friday = DB::table('task')
            ->where('id_proyecto',$request->id_proyecto)
            ->where('estado','BackLog Aprobado')
            ->whereDate('fecha_fin', $viernes)
            ->count();
    $task_count_saturday = DB::table('task')
            ->where('id_proyecto',$request->id_proyecto)
            ->where('estado','BackLog Aprobado')
            ->whereDate('fecha_fin', $sabado)
            ->count();
    $task_count_sunday = DB::table('task')
            ->where('id_proyecto',$request->id_proyecto)
            ->where('estado','BackLog Aprobado')
            ->whereDate('fecha_fin', $domingo)
            ->count();
    //dd($monday);
    $array = array(
        "hoy" => $task_count_hoy,
        "lunes" => $task_count_monday,
        "martes" => $task_count_tuesday,
        "miercoles" => $task_count_wednesday,
        "jueves" => $task_count_thursday,
        "viernes" => $task_count_friday,
        "sabado" => $task_count_saturday,
        "domingo" => $task_count_sunday,
    );
    
    return $array;
});

Route::get('grafics/grafica2', function(Illuminate\Http\Request $request)
{
    /*$proyecto = DB::table('proyecto')
            ->select('id')
            ->where('id_equipo',Auth::user()->id_equip)
            ->latest()
            ->first();*/
    $task_count_total = DB::table('task')
            ->where([
                ['id_proyecto', '=', $request->id_proyecto],
                ['estado', '=', 'BackLog Proyecto'],
            ])
            ->count();
    $task_count_terminado = DB::table('task')
            ->where([
                ['id_proyecto', '=', $request->id_proyecto],
                ['estado', '=', 'BackLog Aprobado'],
            ])
            ->count();
    $task_count_proceso = DB::table('task')
            ->where([
                ['id_proyecto', '=', $request->id_proyecto],
                ['estado', '=', 'BackLog Usuario'],
            ])
            ->orWhere([
                ['id_proyecto', '=', $request->id_proyecto],
                ['estado', '=', 'BackLog Revision'],
            ])
            ->count();
    
    
    
    //dd($monday);
    $array = array(
        "task_count_terminado" => $task_count_terminado,
        "task_count_total" => $task_count_total,
        "task_count_proceso" => $task_count_proceso,
    );
    
    return $array;
});

Route::get('grafics/grafica3', function()
{
    $date = Carbon\Carbon::now();
    $hoy = Carbon\Carbon::parse($date)->format('Y');
    
    $proyecto_uno = DB::table('proyecto')
            ->whereMonth('fecha_fin', '01')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_dos = DB::table('proyecto')
            ->whereMonth('fecha_fin', '02')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_tres = DB::table('proyecto')
            ->whereMonth('fecha_fin', '03')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_cuatro = DB::table('proyecto')
            ->whereMonth('fecha_fin', '04')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_cinco = DB::table('proyecto')
            ->whereMonth('fecha_fin', '05')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_seis = DB::table('proyecto')
            ->whereMonth('fecha_fin', '06')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_siete = DB::table('proyecto')
            ->whereMonth('fecha_fin', '07')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_ocho = DB::table('proyecto')
            ->whereMonth('fecha_fin', '08')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_nueve = DB::table('proyecto')
            ->whereMonth('fecha_fin', '09')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_diez = DB::table('proyecto')
            ->whereMonth('fecha_fin', '10')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_once = DB::table('proyecto')
            ->whereMonth('fecha_fin', '11')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    $proyecto_doce = DB::table('proyecto')
            ->whereMonth('fecha_fin', '12')
            ->whereYear('fecha_fin', '=', $hoy)
            ->count();
    
    //dd($monday);
    $array = array(
        "uno" => $proyecto_uno,
        "dos" => $proyecto_dos,
        "tres" => $proyecto_tres,
        "cuatro" => $proyecto_cuatro,
        "cinco" => $proyecto_cinco,
        "seis" => $proyecto_seis,
        "siete" => $proyecto_siete,
        "ocho" => $proyecto_ocho,
        "nueve" => $proyecto_nueve,
        "diez" => $proyecto_diez,
        "once" => $proyecto_once,
        "doce" => $proyecto_doce,
    );
    
    return $array;
});

Route::get('comments/add_comments_noticia', function(Illuminate\Http\Request $request)
{
    $comment = new Comentario_noticia();
    $comment->descripcion = $request->comentario;
    $comment->id_noticia = $request->id_noticia;
    $comment->id_user = $request->id_user;
    $comment->save(); 
    return '<p>'.$comment->descripcion.'</p>';
});

Route::get('comments/add_comments_proyect', function(Illuminate\Http\Request $request)
{
    $comment = new Comentario_proyecto();
    $comment->descripcion = $request->comentario;
    $comment->id_proyecto = $request->id_proy;
    $comment->id_user = $request->id_user;
    $comment->save(); 
    return '<p>'.$comment->descripcion.'</p>';
});

Route::get('taskmodify', function(Illuminate\Http\Request $request)
{
    $mytime = Carbon\Carbon::now();
//echo $now->format('d-m-Y H:i:s');
    $task = Task::find($request->id_task);
    if($request->id_usuario > 1 || $request->id_usuario == null) {
        $task->id_usuario = $request->id_user;
    }
    $task->estado = $request->estado;
    if($request->dia != null) {
        $task->fecha_fin = $mytime;
    } else {
        $task->fecha_fin = null;
    }
    $task->save(); 
    return $request;
});


Route::get('storage/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = $public_path.'/storage/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);

})->name('storage');

Route::get('userfind', 'UsersController@find');
Route::get('equipofind', 'EquipController@find');
Route::get('proyectofind', 'ProyectoController@find');

Route::get('obteneruser', 'Eloquent\ObjectResponseController@datauser');
Route::get('obtenerequipo', 'Eloquent\ObjectResponseController@dataequipo');
Route::get('obtenerproyecto', 'Eloquent\ObjectResponseController@dataproyecto');
