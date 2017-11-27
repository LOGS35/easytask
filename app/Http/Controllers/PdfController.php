<?php

namespace EasyTask\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use EasyTask\User;
use EasyTask\Task;
use PDF;
use Carbon;
use Illuminate\Support\Facades\DB;

class PdfController extends Controller
{
     public function invoice(Request $request) 
    {
         $task_count = DB::table('task')
            ->join('users', 'users.id', '=', 'task.id_usuario')
            ->select(DB::raw('users.name, users.lastname, users.email, count(task.id) as task_complete')) 
            ->where('estado','BackLog Aprobado')
            ->whereBetween('fecha_fin', [$request->date_ini, $request->date_fin])
            ->groupBy('users.id')
            ->orderBy('task_complete','desc')
            ->get();
         $fecha_inicial = Carbon\Carbon::parse($request->date_ini)->format('d-m-Y');
         $fecha_final = Carbon\Carbon::parse($request->date_fin)->format('d-m-Y');
         $entrefechas = 'De '.$fecha_inicial.' a '.$fecha_final;
         //dd($task_count);
        //$data = $this->getData();
        $hoy = Carbon\Carbon::now();
        $date = Carbon\Carbon::parse($hoy)->format('d-m-Y');
        $invoice = "Reporte de rendimiento";
        $view =  \View::make('modulos.pdf.invoice', compact('entrefechas','task_count','date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
    }
 
    /*public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }*/
}
