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
use EasyTask\Task;

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
    $task = Task::find($request->id_task);
    $task->id_usuario = $request->id_user;
    $task->estado = $request->estado;
    $task->save(); 
    return $request;
});

Route::get('userfind', 'UsersController@find');
Route::get('equipofind', 'EquipController@find');

Route::get('obteneruser', 'Eloquent\ObjectResponseController@datauser');
Route::get('obtenerequipo', 'Eloquent\ObjectResponseController@dataequipo');
Route::get('obtenerproyecto', 'Eloquent\ObjectResponseController@dataproyecto');
