<?php

namespace EasyTask\Http\Controllers;

use Illuminate\Http\Request;
use EasyTask\Noticia;
use EasyTask\Image_noticia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class NoticiaController extends Controller
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
        $noticia = DB::table('noticias')
            ->join('users', 'noticias.user_id', '=', 'users.id')
            ->join('imagenes_noticias', 'noticias.id', '=', 'imagenes_noticias.id_noticia')
            ->select(DB::raw('noticias.id as noticia_id, noticias.created_at as fecha, noticias.title, noticias.content, users.id as user_id, users.name, users.lastname, imagenes_noticias.name as image'))
            /*->where([['id_proyecto',$id],['estado','=','BackLog Aprobado'],])*/
            ->orderBy('noticias.created_at', 'desc')
            ->get();

            //->paginate(10000);
        return view('modulos.noticias.noticias')->with('noticias', $noticia);
    }
    public function mystory($id)
    {
        $noticia = DB::table('noticias')
            ->join('users', 'noticias.user_id', '=', 'users.id')
            ->join('imagenes_noticias', 'noticias.id', '=', 'imagenes_noticias.id_noticia')
            ->select(DB::raw('noticias.id as noticia_id, noticias.created_at as fecha, noticias.title, noticias.content, users.id as user_id, users.name, users.lastname, imagenes_noticias.name as image'))
            ->where('users.id',$id)
            ->orderBy('noticias.created_at', 'desc')
            ->get();

            //->paginate(10000);
        return view('modulos.noticias.noticias')->with('noticias', $noticia);
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
            'title' => 'required|string|max:80',
            'content' => 'required',
            'file' => 'required|mimes:jpeg,bmp,png',
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
       $mytime = \Carbon\Carbon::now()->format('d-m-Y_H-i-s');
        //obtenemos el campo file definido en el formulario
       $file = $request->file('file');
       // dd($file);
       //dd($mytime);
       /*if ($file = null) {
           return redirect()->back()->withInput()->withErrors('No selecciono una imagen para la noticia');
       }*/
       //obtenemos el nombre del archivo
       $nombre = $mytime.'-noticia-'.$file->getClientOriginalName();
        //dd($nombre);
 
       //indicamos que queremos guardar un nuevo archivo en el disco local
       \Storage::disk('local')->put($nombre,  \File::get($file));
        
        $noticia = new Noticia($request->all());
        $noticia->user_id = Auth::user()->id;
        $noticia->save(); 
        
        $id_noticia = DB::table('noticias')
                ->select('id')
                ->latest()
                ->first();
        
        $image_noticia = new Image_noticia();
        $image_noticia->name = $nombre;
        $image_noticia->id_noticia = $id_noticia->id;
        $image_noticia->save();
 
        return redirect()->back()->with('status', 'Noticia creada!'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $noticia = DB::table('noticias')
            ->join('users', 'noticias.user_id', '=', 'users.id')
            ->join('imagenes_noticias', 'noticias.id', '=', 'imagenes_noticias.id_noticia')
            ->select(DB::raw('noticias.id as noticia_id, noticias.created_at as fecha, noticias.title, noticias.content, users.id as user_id, users.name, users.lastname, imagenes_noticias.name as image'))
            ->where('noticias.id',$id)
            ->orderBy('noticias.created_at', 'desc')
            ->get();
        $comments = DB::table('comentarios_noticias')
            ->join('users', 'comentarios_noticias.id_user', '=', 'users.id')
            ->select('users.id','users.name','comentarios_noticias.descripcion','comentarios_noticias.created_at')
            ->where('id_noticia',$id)
            ->get();
        //dd($comments);
        //dd($noticia);
            //->paginate(10000);
        return view('modulos.noticias.noticias-show', ['noticia' => $noticia, 'comentarios' => $comments]);
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
            'title' => 'required|string|max:80',
            'content' => 'required',
        ]);
 
        if ($v->fails())
        {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        
        $noticia = Noticia::find($id);
        $noticia->title = $request->title;
        $noticia->content = $request->content;
        $noticia->save(); 
 
        return redirect()->back()->with('status', 'Noticia actualizada!'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $noticia = Noticia::find($id);
        $noticia->delete();
        return redirect()->route('noticia.index')->with('status','La noticia: "'.$noticia->title.'" fue eliminada');
    }
}
