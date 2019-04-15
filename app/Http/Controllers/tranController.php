<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\TipoTransaccion;
use App\Models\Transacciones;
use App\Models\locations;
use App\Models\stock_master;
use App\Models\stock_moves;
use App\Models\UsuarioNormal;
use App\Models\Transaccion;
use App\Models\log;
use App\Models\audit_trail;
use Session;
use DB;

use Illuminate\Support\Facades\Input;

use PDF;
use Flash;

use App\Exports\UsersExport;
use App\Exports\exportPdf1;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Dompdf\Dompdf;
    
use Illuminate\Support\Collection;

class tranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bodegas = locations::pluck('location_name','loc_code');
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

        Session::forget('items');

        $repor = null;

        return view('tran.index', compact('bodegas','usuarios','items','repor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
    

        $accion = $request->input("acc");;

        if ($accion==2) {
            
            $item = $request->input("item");;
            $cantidad = $request->input("cantidad");;


            Session::push('items', [
              'stock_id' => Input::get('item'),
              'cantidad' => Input::get('cantidad')
            ]);                    
        }
        elseif ($accion==1) 
        {

            $idBod = $request->input("idBodegaOrigen");
            $fecha = $request->input("fecha");
            $idItm = $request->input("idBodegaDestino");


            if ($idBod == "0" || $idItm == "0") {

                Flash::error('Debes seleccionar bodegas.');

                $ub = DB::table('usuario_bodegas')
                ->where('idUsuario', '=', auth()->user()->id)
                ->get();

                $bodegas = new Collection([]);
                $bodeg = DB::table('0_locations')
                ->get();;

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

                $itemsLista = Session::get('items');


               return view('tran.index', compact('bodegas','usuarios','items','idBod','fecha','idItm','est','repor'))
                    ->with('itemsLista', $itemsLista);
            }

            Session::put('idBod',$idBod);
            Session::put('fecha',$fecha);
            Session::put('idItm',$idItm);

            $nroRegistro = stock_moves::where('type', 16)->max('trans_no'); 

            $nroRegistro++;

            $r = DB::table('0_refs')->max('reference');

            $rf = substr($r, 0, 3);

            $re = (int)$rf; 

            $re++;

            $ref='';

            if ($re < 100 && $re > 10) {
                $ref = '0'.$re.'/'.date('Y');   
            }
            elseif ($re < 10) 
            {
                $ref = '00'.$re.'/'.date('Y');
            }
            else
            {
                $ref = $re.'/'.date('Y');
            }

            $itemsLista = Session::get('items');

            if (empty($itemsLista)) {
                
                Flash::error('Debes ingresar items.');

                $ub = DB::table('usuario_bodegas')
                ->where('idUsuario', '=', auth()->user()->id)
                ->get();

                $bodegas = new Collection([]);
                $bodeg = DB::table('0_locations')
                ->get();;

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


                $est=1;
               return view('tran.index', compact('bodegas','usuarios','items','idBod','fecha','idItm','est','repor'));
            }

            foreach ($itemsLista as $itm) 
            {
                $stockMove1 = new stock_moves;

                $stockMove1->stock_id = $itm['stock_id'];
                $stockMove1->trans_no = $nroRegistro;
                $stockMove1->type = 16;
                $stockMove1->loc_code = $idBod;
                $stockMove1->tran_date = date('Y-m-d');
                $stockMove1->reference = $ref;
                $stockMove1->qty = -$itm['cantidad'];
                $stockMove1->standard_cost = 0;
                $stockMove1->price = 0;

                $stockMove1->save();

                //--------------------------------------------------------------

                $stockMove2 = new stock_moves;

                $stockMove2->stock_id = $itm['stock_id'];
                $stockMove2->trans_no = $nroRegistro;
                $stockMove2->type = 16;
                $stockMove2->loc_code = $idItm;
                $stockMove2->tran_date = date('Y-m-d');
                $stockMove2->reference = $ref;
                $stockMove2->qty = $itm['cantidad'];
                $stockMove2->standard_cost = 0;
                $stockMove2->price = 0;

                $stockMove2->save();

                //-----------------------------------------------------

                DB::statement( 'REPLACE 0_refs SET reference=?, type=16, id=?', [$ref,$nroRegistro]);

                //---------------------------------------------------------------

                $audit = new audit_trail;

                $audit->type = 16;
                $audit->trans_no = $nroRegistro;
                $audit->user = 2;
                $audit->fiscal_year = 2;
                $audit->gl_seq = 0;
                $audit->gl_date = date('Y-m-d');
                $audit->description = 'Realizado a traves del modulo';

                $audit->save();

                //----------------------------------------------------------------------

                $transacciones = new Transacciones;

                $transacciones->tipoTransaccion = "Transferencia";
                $transacciones->Bodega = $idBod;
                $transacciones->Item = $itm['stock_id'];
                $transacciones->UsuarioSolicitud = " ";
                $transacciones->cantidad = $itm['cantidad'];
                $transacciones->descripcion = 'Transferencia realizada desde el modulo.';
                $transacciones->responsable = auth()->user()->name;
                $transacciones->autorizadoPor = auth()->user()->name;
                $transacciones->cargo = ' ';
                $transacciones->estado = 1;
                $transacciones->fecha = date('Y-m-d');

                $transacciones->save();

                //----------------------------------------------------------------------

                $repor = "true";

                //DB::statement($consulta);
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
        $usuarios = User::pluck('name','id');
        $usuarios->put('0','Seleccione');
        $items = stock_master::pluck('description','stock_id');
        $items->put('0','Seleccione');


        $itemsLista = Session::get('items');

        

        $est=1;
       return view('tran.index', compact('bodegas','usuarios','items','idBod','fecha','idItm','est','repor'))
            ->with('itemsLista', $itemsLista);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datos = Session::get('items');

        $itms = new Collection([]);

        foreach ($datos as $d ) {
            if ($d['stock_id'] == $id) {
                
            }else{
                $itms->put($d['stock_id'], $d['cantidad']);
            }
        }

        Session::put('items',$itms);

        foreach ($itms as $d) {
            echo $d;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $item ,$cantidad)
    {
        echo $item.'-'.$cantidad.'<br>';
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function exportExcel() 
    {

        return Excel::download(new exportPdfTransf, 'Reporte Item.xlsx');
    
    }

    public function exportPdf() 
    {   
        $bodOrg = Session::get('idBod');
        $bodDes = Session::get('idItm');
        
        $data = $this->getData();
        $view =  \View::make('tran.inv', compact('data','bodOrg','bodDes'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadHTML($view);

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de transferencia en PDF.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return $pdf->stream('Reporte Transferencia Item.pdf');
    
    }

    public function getData() 
    {

        $datos = Session::get('items');

        return $datos;
    }

}
