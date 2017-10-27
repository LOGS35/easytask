<?php

namespace App\Http\Controllers\Eloquent;

use App\Http\Controllers\Controller;
use App\User;
use App\Equipo;
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
                    return '<a href="'.route("users.destroy", $user->id).'" class="badge badge-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'.'<a href="'.route("users.show", $user->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                } else {
                    return '<a href="'.route("users.show", $user->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                }   
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
        return $datatables->eloquent(Equipo::query())
            ->addColumn('action','')        
            ->editColumn('action', function ($equipo) {
                if (Auth::user()->type == "Scrum Master") {
                    return '<a href="'.route("equip.destroy", $equipo->id).'" class="badge badge-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>'.'<a href="'.route("equip.show", $equipo->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
                } else {
                    return '<a href="'.route("equip.show", $equipo->id).'" class="badge badge-success"><i class="fa fa-eye" aria-hidden="true"></i></a>';
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
}