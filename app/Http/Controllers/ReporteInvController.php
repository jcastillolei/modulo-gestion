<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createitem_bodegaRequest;
use App\Http\Requests\Updateitem_bodegaRequest;
use App\Repositories\item_bodegaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Session;

use App\Models\stock_master;
use App\User;
use App\Models\TipoTransaccion;
use App\Models\locations;
use App\Models\ItemBodega;
use App\Models\UsuarioNormal;
use DB;
use PDF;

use App\Exports\UsersExport;
use App\Exports\exportPdf1;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Dompdf\Dompdf;
use App\Models\log;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

class ReporteInvController extends Controller
{
    /** @var  ItemBodegaRepository */
    private $itemBodegaRepository;

    public function __construct(item_BodegaRepository $itemBodegaRepo)
    {
        $this->itemBodegaRepository = $itemBodegaRepo;
    }

    /**
     * Display a listing of the ItemBodega.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $itemsBodega = DB::table('0_loc_stock')->get();

        Session::forget('itemsBodega');

        if (Auth::user()->rol == 1) {
            $bodegas = locations::pluck('location_name','loc_code');
        }else{
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
        }

        $bodegas->put('0','Seleccione');

        $items = stock_master::pluck('description','stock_id');
        $items->put('0','Seleccione');

        return view('item_bodegas.index', compact('bodegas','items'))
            ->with('itemsBodega', $itemsBodega);
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
        $idBod = $request->input("idBodega");
        $idItem = $request->input("idItem");

        Session::put('idBodItem',$idBod);

        //Valida los valores del filtro 
        if (!empty($idBod) && !empty($idItem))
        {   
            Session::forget('itemsBodega');
            
            $itemsBodega = DB::table('0_loc_stock')
                ->where('loc_code', '=', $idBod)
                ->where('stock_id', '=', $idItem)
                ->get();

            Session::put('itemsBodega',$itemsBodega);

        }
        elseif (!empty($idBod) && empty($idItem))
        {   
            Session::forget('itemsBodega');
            
            $itemsBodega = DB::table('0_loc_stock')
                ->where('loc_code', '=', $idBod)
                ->get();

            Session::put('itemsBodega',$itemsBodega);

        }
        elseif (empty($idBod) && !empty($idItem))
        {   
            Session::forget('itemsBodega');
            
            $itemsBodega = DB::table('0_loc_stock')
                ->where('stock_id', '=', $idItem)
                ->get();

            Session::put('itemsBodega',$itemsBodega);

        }
        elseif (empty($idBod) && empty($idItem))
        {   
            Session::forget('itemsBodega');
            
            if (Auth::user()->rol==2) {
            //----------Bodegas asignadas al sub admin -----------//
                $bods = DB::table('0_locations')->get();

                $bodegasUsuario = DB::table('usuario_bodegas')->where('idUsuario', Auth::user()->id)->get();

                $bd = new Collection();

                foreach ($bodegasUsuario as $b) {
                    foreach ($bods as $bo) {
                        if ($b->idBodega == $bo->loc_code) {
                            echo $b->idBodega;
                            $bd->push($bo);
                        }
                    }
                }

                $itms = new Collection();

                $items = DB::table('0_loc_stock')
                ->get();

                foreach ($bd as $bodeg) {
                    foreach ($items as $i) {
                        if ($bodeg->loc_code == $i->loc_code) {
                            $itms->push($i);
                        }
                    }
                }

                $itemsBodega = $itms; 
            }
            else if (Auth::user()->rol==3) 
            {
            //----------Bodegas asignadas al sub admin -----------//
                $bods = DB::table('0_locations')->get();

                $bodegasUsuario = DB::table('usuario_bodegas')->where('idUsuario', Auth::user()->id)->get();

                $bd = new Collection();

                foreach ($bodegasUsuario as $b) {
                    foreach ($bods as $bo) {
                        if ($b->idBodega == $bo->loc_code) {
                            echo $b->idBodega;
                            $bd->push($bo);
                        }
                    }
                }

                $itms = new Collection();

                $items = DB::table('0_loc_stock')
                ->get();

                foreach ($bd as $bodeg) {
                    foreach ($items as $i) {
                        if ($bodeg->loc_code == $i->loc_code) {
                            $itms->push($i);
                        }
                    }
                }

                $itemsBodega = $itms;    
            }
            else if (Auth::user()->rol==1) {
                $itemsBodega = DB::table('0_loc_stock')
                ->get();
            }  
            

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

        $est=1;

        $items = stock_master::pluck('description','stock_id');
        $items->put('0','Seleccione');

        

        return view('item_bodegas.index', compact('bodegas','est','idBod','idItem','items'))
           ->with('itemsBodega', $itemsBodega);

    }


//---------------------------------------------------------------------------------------------

    /**
     * Display a listing of the Transaccion.
     *
     * @param Request $request
     *
     * @return Response
     */

    public function Update(Request $request, $idBod){

        /*$pdf = \PDF::loadView('ejemplo');
        return $pdf->download('ejemplo.pdf');*/
        //$transaccions = $request->transaccion;

        //Valida los valores del filtro 
        if ($idBod!=0) 
        {
            $itemsBodega = DB::table('transaccions')
                ->where('idBodega', '=', $idBod)
                ->where('idUsuarioTransaccion', '=', $idUsu)
                ->where('idItemBodega', '=', $idItm)
                ->get();
        }
        elseif ($idBod==0)
         {
            $itemsBodega = DB::table('transaccions')
                ->where('idBodega', '=', $idBod)
                ->where('idUsuarioTransaccion', '=', $idUsu)
                ->get();
        }


        $pdf = PDF::loadView('pdf.products', compact('transaccions'));

        return $pdf->download('Reporte.pdf');
  
        //return $pdf->download('itsolutionstuff.pdf');


        return ' '.$idBod.' '.$idUsu.' '.$idItm.' ';
    }

    public function exportExcel() 
    {
        if (empty(Session::get('itemsBodega'))) {
            $itemsBodega = DB::table('0_loc_stock')
                ->get();
            Session::put('itemsBodega',$itemsBodega);
        }

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de Item en Excel .';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return Excel::download(new UsersExport, 'Reporte Item.xlsx');
    
    }

    public function exportPdf() 
    {


        $data = $this->getData();
        $view =  \View::make('item_bodegas.inv', compact('data'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadHTML($view);

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de transaccion en PDF.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return $pdf->stream('Reporte Item Bodega.pdf');
    
    }

    public function getData() 
    {
        if (empty(Session::get('itemsBodega'))) {
            $itemsBodega = DB::table('0_loc_stock')
                ->get();
            Session::put('itemsBodega',$itemsBodega);
        }

        $datos = Session::get('itemsBodega');

        return $datos;
    }
}
