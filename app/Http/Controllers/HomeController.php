<?php

namespace EasyTask\Http\Controllers;

use Illuminate\Http\Request;
use EasyTask\Noticia;
use EasyTask\Image_noticia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Charts;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$chart = Charts::create('area', 'highcharts')
        ->title('My nice chart')
        ->elementLabel('My nice label')
        ->labels(['Lunes', 'Martes', 'Miércoles','Jueves', 'Viernes', 'Sabado','Domingo'])
        ->values([5,10,20])
        ->dimensions(1000,500)
        ->responsive(false);
        
        $chartpogress = Charts::create('donut', 'highcharts')
        ->title('My nice chart')
        ->labels(['First', 'Second', 'Third'])
        ->values([5,10,20])
        ->dimensions(1000,500)
        ->responsive(false);*/
        
        if (Auth::user()->id_equip == null) {
            $id_proyecto = 1;
            $task_count = 1;
        } else {
            $id_proyecto = DB::table('proyecto')
                        ->select('id', 'created_at','name')
                        ->where('id_equipo',Auth::user()->id_equip)
                        ->latest()
                        ->first();

            $task_count = DB::table('task')
                    ->where('id_proyecto',$id_proyecto->id)
                    ->count();
        }
        $noticia_count = DB::table('noticias')
            ->count();
        $noticia = DB::table('noticias')
            ->join('users', 'noticias.user_id', '=', 'users.id')
            ->join('imagenes_noticias', 'noticias.id', '=', 'imagenes_noticias.id_noticia')
            ->select(DB::raw('noticias.id as noticia_id, noticias.created_at as fecha, noticias.title, noticias.content, users.id as user_id, users.name, users.lastname, imagenes_noticias.name as image'))
            /*->where([['id_proyecto',$id],['estado','=','BackLog Aprobado'],])*/
            ->orderBy('noticias.created_at', 'desc')
            ->paginate(4);

        return view('home',['noticias' => $noticia, 'cantidad' => $noticia_count, 'taskcount' => $task_count, 'id_proyecto' => $id_proyecto]);
    }
}
