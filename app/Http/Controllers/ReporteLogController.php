<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLogRequest;
use App\Http\Requests\UpdateLogRequest;
use App\Repositories\LogRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\User;
use DB;
use PDF;
use DateTime;
use Session;

use App\Exports\LogExport;
use App\Exports\exportPdf1;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Dompdf\Dompdf;

use App\Models\log;

class ReporteLogController extends Controller
{
    /** @var  LogRepository */
    private $logRepository;

    public function __construct(LogRepository $logRepo)
    {
        $this->logRepository = $logRepo;
    }

    /**
     * Display a listing of the Log.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $logs = DB::table('logs')->paginate(300);

        $usuarios = User::pluck('name','id');
        $usuarios->put('0','Seleccione');
        
        Session::forget('loger');

        return view('logs.index', compact('usuarios'))
            ->with('logs', $logs);
    }

    /**
     * Display a listing of the Transaccion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //Recibe valores del filtro
        $idUsu = $request->input("idUsu");
        $fecha = $request->input("fecha");

        //Valida los valores del filtro 
        if ($idUsu!=0 && $fecha!=0) 
        {
            $fecha = date('d-m-Y',strtotime($request->input("fecha"))); 
            $logs = DB::table('logs')
                ->where('usuarioLog', '=', $idUsu)
                ->where('fecha', '=', $fecha)
                ->paginate(30);
        }
        elseif ($idUsu==0 && $fecha==0)
        {
             $logs = DB::table('logs')
                ->paginate(30);

        }
        elseif ($idUsu!=0 && $fecha==0) 
        {
            $logs = DB::table('logs')
                ->where('usuarioLog', '=', $idUsu)
                ->paginate(30);

        }
        elseif ($idUsu==0 && $fecha!=0) 
        {
            $fecha = date('d-m-Y',strtotime($request->input("fecha")));
            $logs = DB::table('logs')
                ->where('fecha', '=', $fecha)
                ->paginate(30);
        }

        $est=1;



        /*foreach ($logs as $l) {

            echo date('Y-m-d',strtotime($l->created_at));

        }*/

        Session::put('loger',$logs);

        $usuarios = User::pluck('name','id');
        $usuarios->put('0','Seleccione');

        //return ' '.$idUsu.' '.$fecha;

        return view('logs.index', compact('usuarios'))
            ->with('logs', $logs);

    }

    public function exportExcel() 
    {

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de Item en Excel.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return Excel::download(new LogExport, 'Reporte Logs.xlsx');
    
    }

    public function exportPdf() 
    {


        $data = $this->getData();
        $view =  \View::make('logs.inv', compact('data'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadHTML($view);

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de logs en PDF.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return $pdf->stream('Reporte Log.pdf');
    
    }

    public function getData() 
    {

        $datos = Session::get('loger');

        return $datos;
    }
}
