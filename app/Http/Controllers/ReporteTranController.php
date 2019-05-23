<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTransaccionRequest;
use App\Http\Requests\UpdateTransaccionRequest;
use App\Repositories\TransaccionesRepository;


use App\Http\Requests\Createstock_movesRequest;
use App\Http\Requests\Updatestock_movesRequest;
use App\Repositories\stock_movesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use DB;
use Session;

use App\User;
use App\Models\TipoTransaccion;
use App\Models\locations;
use App\Models\stock_master;
use App\Models\UsuarioNormal;
use App\Models\usuario_bodega;
use App\Models\Log;
use App\Models\Transacciones;

use PDF;

use App\Exports\UsersExport;
use App\Exports\exportPdf1;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Dompdf\Dompdf;

use App\Exports\exportTrans;
use Illuminate\Support\Collection;

class ReporteTranController extends Controller
{

     /** @var  TransaccionRepository */
    private $TransaccionesRepository;

    public function __construct(TransaccionesRepository $transaccionRepo)
    {
        $this->TransaccionesRepository = $transaccionRepo;
    }

    /**
     * Display a listing of the Transaccion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $stockMoves = DB::table('transaccions')->paginate(15);

        $bodeg = DB::table('0_locations')
                ->get();;

        $ub = DB::table('usuario_bodegas')
                ->where('idUsuario', '=', auth()->user()->id)
                ->get();

        $bodegas = new Collection([]);

        foreach ($bodeg as $b) {
            foreach ($ub as $u) 
            {
                if ($b->loc_code == $u->idBodega) 
                {
                    $bodegas->put($b->loc_code, $b->location_name); 
                } 
            }            
        }

        $bodegas->put('0','Seleccione');

        $usuarios = User::pluck('name','id');
        $usuarios->put('0','Seleccione');
        $items = stock_master::pluck('description','stock_id');
        $items->put('0','Seleccione');
        //$usuariosNormal = UsuarioNormal::pluck('nombre','id');

        return view('stock_moves.index', compact('bodegas','usuarios','items'))
            ->with('stockMoves', $stockMoves);
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
        $idBod = $request->input("idBodega");;
        $fecha = $request->input("fecha");;
        $idItm = $request->input("idItemBodega");;
        $idUsuario = $request->input("idUsuario");;

        $use = DB::table('users')
                        ->where('id', '=', $idUsuario)
                        ->first();

        //Valida los valores del filtro 
        if (!empty($idBod) && !empty($fecha) && !empty($idItm) && !empty($idUsuario)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('fecha', '=', $fecha)
                ->where('Item', '=', $idItm)
                ->where('responsable', '=', $use->name)
                ->get();
        }
        elseif (!empty($idBod) && !empty($fecha) && empty($idItm) && !empty($idUsuario))
         {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('fecha', '=', $fecha)
                ->where('responsable', '=', $use->name)
                ->get();
        }
        elseif (empty($idBod) && !empty($fecha) && !empty($idItm) && !empty($idUsuario))
        {
            $transaccions = DB::table('transaccions')
                ->where('fecha', '=', $fecha)
                ->where('Item', '=', $idItm)
                ->where('responsable', '=', $use->name)
                ->get();
        }
        elseif (!empty($idBod) && empty($fecha) && !empty($idItm) && !empty($idUsuario))
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('Item', '=', $idItm)
                ->where('responsable', '=', $use->name)
                ->get();
        }
        elseif (!empty($idBod) && !empty($fecha) && !empty($idItm) && empty($idUsuario))
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('Item', '=', $idItm)
                ->where('fecha', '=', $fecha)
                ->get();
        }
        //---------------------------------------------------------------------------

        elseif (!empty($idBod) && !empty($idItm)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('Item', '=', $idItm)
                ->get();
        }
        elseif (!empty($idBod) && !empty($idUsuario)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('responsable', '=', $use->name)
                ->get();
        }
        elseif (!empty($idBod) && !empty($fecha)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('fecha', '=', $fecha)
                ->get();
        }
        //---------------------------------------------------------------------------

        elseif (!empty($idUsuario) && !empty($idItm)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Item', '=', $idItm)
                ->where('responsable', '=', $use->name)
                ->get();
        }
        elseif (!empty($fecha) && !empty($idItm)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Item', '=', $idItm)
                ->where('fecha', '=', $fecha)
                ->get();
        }
        //---------------------------------------------------------------------------
        elseif (!empty($idUsuario) && !empty($fecha)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Item', '=', $idItm)
                ->where('fecha', '=', $fecha)
                ->get();
        }

        

        elseif (!empty($idBod)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->get();
        }
        elseif (!empty($idItm)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Item', '=', $idItm)
                ->get();
        }
        elseif (!empty($fecha)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('fecha', '=', $fecha)
                ->get();
        }
        elseif (!empty($idUsuario)) 
        {
            $transaccions = DB::table('transaccions')
                ->where('responsable', '=', $use->name)
                ->get();
        }
        elseif (empty($idBod) && empty($fecha) && empty($idItm) && empty($idUsuario)) 
        {
            $transaccions = DB::table('transaccions')
                ->get();
        }

            

        $bodeg = DB::table('0_locations')
                ->get();;

        $ub = DB::table('usuario_bodegas')
                ->where('idUsuario', '=', auth()->user()->id)
                ->get();

        $bodegas = new Collection([]);

        foreach ($bodeg as $b) {
            foreach ($ub as $u) 
            {
                if ($b->loc_code == $u->idBodega) 
                {
                    $bodegas->put($b->loc_code, $b->location_name); 
                } 
            }            
        }

        $bodegas->put('0','Seleccione');
        $usuarios = User::pluck('name','id');
        $usuarios->put('0','Seleccione');
        $items = stock_master::pluck('description','stock_id');
        $items->put('0','Seleccione');

        //$usuariosNormal = UsuarioNormal::pluck('nombre','id');

        $est=1;

        Session::put('transacciones',$transaccions);

        return view('stock_moves.index', compact('bodegas','usuarios','items','idBod','fecha','idItm','idUsuario','est'))
            ->with('stockMoves', $transaccions);

    }

    //-----------------------------------------------------------------------------------
    
     /**
     * Display a listing of the Transaccion.
     *
     * @param Request $request
     *
     * @return Response
     */

    public function Update(Request $request, $idBod ,$idUsu ,$idItm ){

        /*$pdf = \PDF::loadView('ejemplo');
        return $pdf->download('ejemplo.pdf');*/
        //$transaccions = $request->transaccion;

        //Valida los valores del filtro 
        if ($idBod!=0 && $idUsu!=0 && $idItm!=0) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('UsuarioSolicitud', '=', $idUsu)
                ->where('Item', '=', $idItm)
                ->get();
        }
        elseif ($idBod!=0 && $idUsu!=0 && $idItm == 0)
         {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('UsuarioSolicitud', '=', $idUsu)
                ->get();
        }
        elseif ($idUsu!=0 && $idItm!=0 && $idBod == 0) 
        {
            $transaccions = DB::table('transaccions')
                ->where('UsuarioSolicitud', '=', $idUsu)
                ->where('Item', '=', $idItm)
                ->get();
        }
        elseif ($idBod!=0 && $idItm!=0 && $idUsu == 0) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->where('Item', '=', $idItm)
                ->get();
        }
        elseif ($idBod!=0) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Bodega', '=', $idBod)
                ->get();
        }
        elseif ($idItm!=0) 
        {
            $transaccions = DB::table('transaccions')
                ->where('Item', '=', $idItm)
                ->get();
        }
        elseif ($idUsu!=0) 
        {
            $transaccions = DB::table('transaccions')
                ->where('UsuarioSolicitud', '=', $idUsu)
                ->get();
        }
        elseif ($idBod==0 && $idUsu==0 && $idItm==0) 
        {
            $transaccions = DB::table('transaccions')
                ->get();
        }

        


        $pdf = PDF::loadView('pdf.products', compact('transaccions'));

        return $pdf->download('Reporte.pdf');

    
    }

    public function exportExcel() 
    {

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de transaccion.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return Excel::download(new exportTrans, 'Reporte Transacciones.xlsx');
    
    }
}
