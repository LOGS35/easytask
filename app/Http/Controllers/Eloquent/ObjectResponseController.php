<?php

namespace EasyTask\Http\Controllers\Eloquent;

use EasyTask\Http\Controllers\Controller;
use EasyTask\User;
use EasyTask\Equipo;
use EasyTask\Proyecto;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class ObjectResponseController extends Controller
{
    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function datauser(Datatables $datatables)
        
    {
        return $datatables->eloquent(User::query())
                ->editColumn('type', function ($user) {
                if ($user->type == "Scrum Master") {
                    return '<span class="badge badge-danger">' . $user->type . '</span>';
                } else if ($user->type == "Project Owner") {
                    return '<span class="badge badge-warning">' . $user->type . '</span>';
                } else if ($user->type == "Developer") {
                    return '<span class="badge badge-info">' . $user->type . '</span>';
                }
            })
            ->addColumn('action','')        
            ->editColumn('action', function ($user) {
                if (Auth::user()->type == "Scrum Master") {
                    return '<a data-href="'.route("users.destroy", $user->id).'" class="badge badge-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'.'<a href="'.route("users.show", $user->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                } else {
                    return '<a href="'.route("users.show", $user->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }   
            })
            ->editColumn('created_at', function ($user) {
                return date('d/m/Y', strtotime($user->created_at));
            })
                          //->addColumn('action', 'eloquent.tables.users-action')
            ->rawColumns(['type', 'action'])
            ->make(true);
        
        /*$query = User::all();

        return $datatables->collection($query)
                          ->editColumn('name', function ($query) {
                              return '<a href="#">' . $query->name . '</a>';
                          })    
                          ->addColumn('action', 'eloquent.tables.users-action')
                          ->make(true);*/
    }
    public function dataequipo(Datatables $datatables)    
    {
        $query = Equipo::all();
        
        return $datatables->collection($query)
            ->addColumn('action','')        
            ->editColumn('action', function ($equipo) {
                if (Auth::user()->type == "Scrum Master") {
                    return '<a data-href="'.route("equipo.destroy", $equipo->id).'" class="badge badge-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'.'<a href="'.route("equipo.show", $equipo->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                } else {
                    return '<a href="'.route("equipo.show", $equipo->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }   
            })
            ->editColumn('estado', function ($equipo) {
                if ($equipo->estado == "Activo") {
                    return '<span class="badge badge-success">' . $equipo->estado . '</span>';
                } else if ($equipo->estado == "Inactivo") {
                  return '<span class="badge badge-warning">' . $equipo->estado . '</span>';
                }
            })
            ->editColumn('created_at', function ($equipo) {
                return date('d/m/Y', strtotime($equipo->created_at));
            })
            ->rawColumns(['estado', 'action'])
            ->make(true);
    }
    public function dataproyecto(Datatables $datatables)    
    {
        $query = Proyecto::all();
        
        return $datatables->collection($query)
            ->addColumn('action','')        
            ->editColumn('action', function ($proyecto) {
                if (Auth::user()->type == "Scrum Master") {
                    return '<a data-href="'.route("proyecto.destroy", $proyecto->id).'" class="badge badge-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'.'<a href="'.route("proyecto.show", $proyecto->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                } else {
                    return '<a href="'.route("proyecto.show", $proyecto->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }   
            })
            ->editColumn('estado', function ($proyecto) {
                if ($proyecto->estado == "En proceso") {
                    return '<span class="badge badge-info">' . $proyecto->estado . '</span>';
                } else if ($proyecto->estado == "En revisión") {
                  return '<span class="badge badge-primary">' . $proyecto->estado . '</span>';
                } else if ($proyecto->estado == "Incompleto") {
                  return '<span class="badge badge-warning">' . $proyecto->estado . '</span>';
                } else if ($proyecto->estado == "Detenido") {
                  return '<span class="badge badge-danger">' . $proyecto->estado . '</span>';
                } else if ($proyecto->estado == "Terminado") {
                  return '<span class="badge badge-success">' . $proyecto->estado . '</span>';
                }
            })
            ->editColumn('created_at', function ($proyecto) {
                return date('d/m/Y', strtotime($proyecto->created_at));
            })
            ->rawColumns(['estado', 'action'])
            ->make(true);
    }
}