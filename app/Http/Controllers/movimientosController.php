<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Models\TipoTransaccion;
use App\Models\locations;
use App\Models\Transacciones;

use App\Models\transacciones_usuariofinal;

use App\Models\stock_master;
use App\Models\stock_moves;
use App\Models\usuario_normal;
use App\Models\Log;
use App\Models\refs;
use App\Models\audit_trail;
use App\Models\gl_trans;
use Session;
use DB;
use Flash;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Input;

class movimientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->rol == 1) {

            $movimientos = new movimientosController();
            
            $usuarios = DB::table('usuario_normals')->get();
            $bd = DB::table('0_locations')->get();
            $bodegas = $bd->pluck('location_name','loc_code');
            $items = $movimientos->obtenerItems();
        }
        else
        {

            $movimientos = new movimientosController();
            $bodegas = $movimientos->obtenerBodegas();
            $usuarios = $movimientos->obtenerUsuarios();
            $items = $movimientos->obtenerItems();
        }

        Session::forget('items');
        Session::forget('acci');

        $repor = null;

        return view('movimientos.index', compact('bodegas','usuarios','items','repor'));
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
        $acc = $request->input("acc");
        $accion = $request->input("accion");
        $idUsuario = $request->input("idUsuario");

        Session::forget('acci');

        if ($acc=="anadir") {

            $item = $request->input("item");
            $cantidad = $request->input("cantidad");


            Session::push('items', [
              'stock_id' => Input::get('item'),
              'cantidad' => Input::get('cantidad')
            ]);         

            $itemsLista = Session::get('items');
        }
        elseif ($acc=="ejecutar") 
        {
            if ($accion==1) 
            {
                Session::push('acci','Despacho');

                $idBod = $request->input("idBodegaOrigen");;
                $fecha = $request->input("fecha");;

                Session::put('idBod',$idBod);
                Session::put('fecha',$fecha);

                if ($idBod == "0" || $idUsuario == "0") {

                    Flash::error('Debes seleccionar bodega y usuario.');

                    $movimientos = new movimientosController();
                    $bodegas = $movimientos->obtenerBodegas();
                    $usuarios = $movimientos->obtenerUsuarios();
                    $items = $movimientos->obtenerItems();

                    $est=1;

                    $itemsLista = Session::get('items');

                    return view('movimientos.index', compact('bodegas','usuarios','items','idBod','fecha','est','repor'))
                        ->with('itemsLista', $itemsLista);
                }

                
                $nroRegistro = stock_moves::where('type', 17)->max('trans_no'); 

                $nroRegistro++;

                $r = refs::where('type', 17)->max('reference'); 

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
                
                    $movimientos = new movimientosController();
                    $bodegas = $movimientos->obtenerBodegas();
                    $usuarios = $movimientos->obtenerUsuarios();
                    $items = $movimientos->obtenerItems();

                    $est=1;

                    $itemsLista = Session::get('items');

                    return view('movimientos.index', compact('bodegas','usuarios','items','idBod','fecha','est','repor'))
                        ->with('itemsLista', $itemsLista);
                }

                $nroGl = gl_trans::where('type', 17)->max('type_no');   

                $nroGl++;


                foreach ($itemsLista as $itm) 
                {
                    $stock = DB::table('0_stock_moves as s')
                    ->leftJoin('0_voided as b', 's.type', '=', 'b.type')
                    ->leftJoin('0_voided as c', 's.trans_no', '=', 'c.id')
                    ->whereNull('c.id')
                    ->where('stock_id',$itm['stock_id'])
                    ->where('tran_date','<=',date('Y-m-d'))
                    ->where('loc_code',$idBod)
                    ->sum('qty'); 

                    if ($stock<$itm['cantidad']) {

                        Flash::error('La cantidad de items que deseas transferir no se encuentra disponible.');

                        $movimientos = new movimientosController();
                        $bodegas = $movimientos->obtenerBodegas();
                        $usuarios = $movimientos->obtenerUsuarios();
                        $items = $movimientos->obtenerItems();

                        $est=1;

                        $itemsLista = Session::get('items');

                        return view('movimientos.index', compact('bodegas','usuarios','items','idBod','fecha','idItm','est'))
                        ->with('itemsLista', $itemsLista);
                    }

                    $ite = DB::table('0_stock_master')->where('stock_id', $itm['stock_id'])->first();

                    DB::statement( 'UPDATE 0_stock_master SET material_cost=?
                        WHERE stock_id=?', [$ite->material_cost, $itm['stock_id']]);

                    $stockMove1 = new stock_moves;

                    $stockMove1->stock_id = $itm['stock_id'];
                    $stockMove1->trans_no = $nroRegistro;
                    $stockMove1->type = 17;
                    $stockMove1->loc_code = $idBod;
                    $stockMove1->tran_date = date('Y-m-d');
                    $stockMove1->reference = $ref;
                    $stockMove1->qty = -$itm['cantidad'];
                    $stockMove1->standard_cost = $ite->material_cost;
                    $stockMove1->price = 0;

                    $stockMove1->save();

                    //--------------------------------------------------------------

                    $glTrans = new gl_trans;

                    $glTrans->type = 17;
                    $glTrans->type_no = $nroGl;
                    $glTrans->tran_date = date('Y-m-d');
                    $glTrans->account = $ite->adjustment_account;
                    $glTrans->dimension_id = 0;
                    $glTrans->dimension2_id = 0;
                    $glTrans->memo_ = '';
                    $glTrans->amount = $ite->material_cost;

                    $glTrans->save();


                    //--------------------------------------------------------------

                    $glTrans2 = new gl_trans;

                    $glTrans2->type = 17;
                    $glTrans2->type_no = $nroGl;
                    $glTrans2->tran_date = date('Y-m-d');
                    $glTrans2->account = $ite->inventory_account;
                    $glTrans2->dimension_id = 0;
                    $glTrans2->dimension2_id = 0;
                    $glTrans2->memo_ = '';
                    $glTrans2->amount = -$ite->material_cost;

                    $glTrans2->save();

                    //-----------------------------------------------------

                    DB::statement( 'REPLACE 0_refs SET reference=?, type=17, id=?', [$ref,$nroGl]);

                    //---------------------------------------------------------------

                    $audit = new audit_trail;

                    $audit->type = 17;
                    $audit->trans_no = $nroGl;
                    $audit->user = 2;
                    $audit->fiscal_year = 2;
                    $audit->gl_seq = 0;
                    $audit->gl_date = date('Y-m-d');
                    $audit->description = 'Despacho realizado a traves del modulo';

                    $audit->save();

                    //---------------------------------------------------------------

                    $transacciones = new Transacciones;

                    $use = DB::table('usuario_normals')
                        ->where('id', '=', $idUsuario)
                        ->first();

                    $transacciones->tipoTransaccion = "Despacho";
                    $transacciones->Bodega = $idBod;
                    $transacciones->Item = $itm['stock_id'];
                    $transacciones->UsuarioSolicitud = $use->nombre;
                    $transacciones->cantidad = $itm['cantidad'];
                    $transacciones->descripcion = 'Despacho realizada desde el modulo.';
                    $transacciones->responsable = auth()->user()->name;
                    $transacciones->autorizadoPor = auth()->user()->name;
                    $transacciones->cargo = ' ';
                    $transacciones->estado = 1;
                    $transacciones->fecha = date('Y-m-d');

                    $transacciones->save();

                    Session::put('usuarioSolicitud',$use->nombre);

                    //-------------------------Registra transacción de usuario final----------------------------------------

                    $transac = new transacciones_usuariofinal;

                    $transac->Id_UsuarioFinal = $use->nombre." ".$use->apellido;
                    $transac->Codigo_bodega = $idBod;
                    $transac->Codigo_item = $itm['stock_id'];
                    $transac->Descripcion_item = $ite->description;
                    $transac->Cantidad = $itm['cantidad'];
                    $transac->tipo_transaccion = "Despacho";
                    $transac->Fecha = date('Y-m-d');

                    $transac->save();
                    
                }

                $repor="true";

                $itemsLista = Session::get('items');

                                   
            }
            elseif ($accion==2) 
            {

                Session::push('acci','Devolucion');

                $idBod = $request->input("idBodegaOrigen");;
                $fecha = $request->input("fecha");;

                Session::put('idBod',$idBod);
                Session::put('fecha',$fecha);

                $nroRegistro = stock_moves::where('type', 17)->max('trans_no'); 

                $nroRegistro++;

                $r = refs::where('type', 17)->max('reference'); 

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

                $nroGl = gl_trans::where('type', 17)->max('type_no');   

                $nroGl++;


                foreach ($itemsLista as $itm) 
                {

                    $ite = DB::table('0_stock_master')->where('stock_id', $itm['stock_id'])->first();

                    DB::statement( 'UPDATE 0_stock_master SET material_cost=?
                        WHERE stock_id=?', [$ite->material_cost, $itm['stock_id']]);



                    $stockMove1 = new stock_moves;

                    $stockMove1->stock_id = $itm['stock_id'];
                    $stockMove1->trans_no = $nroRegistro;
                    $stockMove1->type = 17;
                    $stockMove1->loc_code = $idBod;
                    $stockMove1->tran_date = date('Y-m-d');
                    $stockMove1->reference = $ref;
                    $stockMove1->qty = $itm['cantidad'];
                    $stockMove1->standard_cost = $ite->material_cost;
                    $stockMove1->price = 0;

                    $stockMove1->save();

                    //--------------------------------------------------------------

                    $glTrans = new gl_trans;

                    $glTrans->type = 17;
                    $glTrans->type_no = $nroGl;
                    $glTrans->tran_date = date('Y-m-d');
                    $glTrans->account = $ite->adjustment_account;
                    $glTrans->dimension_id = 0;
                    $glTrans->dimension2_id = 0;
                    $glTrans->memo_ = '';
                    $glTrans->amount = -$ite->material_cost;

                    $glTrans->save();


                    //--------------------------------------------------------------

                    $glTrans2 = new gl_trans;

                    $glTrans2->type = 17;
                    $glTrans2->type_no = $nroGl;
                    $glTrans2->tran_date = date('Y-m-d');
                    $glTrans2->account = $ite->inventory_account;
                    $glTrans2->dimension_id = 0;
                    $glTrans2->dimension2_id = 0;
                    $glTrans2->memo_ = '';
                    $glTrans2->amount = $ite->material_cost;

                    $glTrans2->save();

                    //-----------------------------------------------------

                    DB::statement( 'REPLACE 0_refs SET reference=?, type=17, id=?', [$ref,$nroGl]);

                    //---------------------------------------------------------------

                    $audit = new audit_trail;

                    $audit->type = 17;
                    $audit->trans_no = $nroGl;
                    $audit->user = 2;
                    $audit->fiscal_year = 2;
                    $audit->gl_seq = 0;
                    $audit->gl_date = date('Y-m-d');
                    $audit->description = 'Devolucion realizada a traves del modulo.';

                    $audit->save();

                    //---------------------------------------------------------------

                    $transacciones = new Transacciones;

                    $use = DB::table('usuario_normals')
                        ->where('id', '=', $idUsuario)
                        ->first();

                    $transacciones->tipoTransaccion = "Devolucion";
                    $transacciones->Bodega = $idBod;
                    $transacciones->Item = $itm['stock_id'];
                    $transacciones->UsuarioSolicitud = $use->nombre;
                    $transacciones->cantidad = $itm['cantidad'];
                    $transacciones->descripcion = 'Devolucion realizada desde el modulo.';
                    $transacciones->responsable = auth()->user()->name;
                    $transacciones->autorizadoPor = auth()->user()->name;
                    $transacciones->cargo = ' ';
                    $transacciones->estado = 1;
                    $transacciones->fecha = date('Y-m-d');

                    $transacciones->save();
                    
                    Session::put('usuarioSolicitud',$use->nombre);

                    //-------------------------Registra transacción de usuario final----------------------------------------

                    $transac = new transacciones_usuariofinal;

                    $transac->Id_UsuarioFinal = $use->nombre." ".$use->apellido;
                    $transac->Codigo_bodega = $idBod;
                    $transac->Codigo_item = $itm['stock_id'];
                    $transac->Descripcion_item = $ite->description;
                    $transac->Cantidad = $itm['cantidad'];
                    $transac->tipo_transaccion = "Devolucion";
                    $transac->Fecha = date('Y-m-d');

                    $transac->save();
                }

                $repor="true";

                $itemsLista = Session::get('items');

      
            }
        }
        
        $movimientos = new movimientosController();
        $bodegas = $movimientos->obtenerBodegas();
        $usuarios = $movimientos->obtenerUsuarios();
        $items = $movimientos->obtenerItems();

        $est=1;

        return view('movimientos.index', compact('bodegas','usuarios','items','idBod','fecha','est','repor'))
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
        //
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

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de '. $acci[0];
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return Excel::download(new exportPdfMovs, 'Reporte Movimientos.xlsx');
    
    }

    public function exportPdf() 
    {   
        
        $bodOrg = Session::get('idBod');
        $acci = Session::get('acci');
        $fecha = Session::get('fecha');
        $usSol = Session::get('usuarioSolicitud');

        if ($acci[0]=="Despacho") {
            $acc="Despacho";
        }
        elseif ($acci[0]=="Devolucion") {
            $acc="Devolucion";
        }
        
        echo $acci[0];
        $itemsLista = Session::get('items');   

        $view =  \View::make('movimientos.inv', compact('itemsLista','bodOrg','acc','fecha','usSol'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadHTML($view);

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de '. $acci[0];
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return $pdf->stream('Reporte Transferencia Item.pdf');
    
    }

    public function getData() 
    {

        $datos = Session::get('items');  

        /*Session::forget('items');
        Session::forget('acci');   
*/
        return $datos;
    }

    public function Limpiar() 
    {

        Session::forget('items');

        $movimientos = new movimientosController();
        $bodegas = $movimientos->obtenerBodegas();
        $usuarios = $movimientos->obtenerUsuarios();
        $items = $movimientos->obtenerItems();

        $est=1;

        $itemsLista = Session::get('items');

        return view('movimientos.index', compact('bodegas','usuarios','items','idBod','fecha','est','repor'))
            ->with('itemsLista', $itemsLista);
    }

    public function getUsers(Request $request) 
    {
        if ($request->ajax()) {
            $usuarios = DB::table('usuario_normals')->get();
            foreach ($usuarios as $u) {
                $usuariosArray[$u->id] = $u->nombre;
            }
            return response()->json($usuariosArray);
        }
    }

    public function obtenerBodegas()
    {

        $bods = DB::table('0_locations')->get();

        $bodegasUsuario = DB::table('usuario_bodegas')->where('idUsuario', Auth::user()->id)->get();

        $bd = new Collection();

        foreach ($bodegasUsuario as $b) {
            foreach ($bods as $bo) {
                if ($b->idBodega == $bo->loc_code) {
                    
                    $bd->push($bo);
                }
            }
        }

        $bodegas = new Collection();
        
        $bodegas = $bd->pluck('location_name','loc_code');
        $bodegas->put('0','Seleccione');

        return $bodegas;
    }
    
    public function obtenerUsuarios()
    {

        $bods = DB::table('0_locations')->get();

        $bodegasUsuario = DB::table('usuario_bodegas')->where('idUsuario', Auth::user()->id)->get();

        $bd = new Collection();

        foreach ($bodegasUsuario as $b) {
            foreach ($bods as $bo) {
                if ($b->idBodega == $bo->loc_code) {
                    
                    $bd->push($bo);
                }
            }
        }

        $bodUsNor = DB::table('bodega_usuarionormal')->get();
        $usuarioNormals = new Collection();

        foreach ($bd as $b) {
            foreach ($bodUsNor as $bo) {
                if ($b->loc_code == $bo->codBodega) {
                    $user = DB::table('usuario_normals')->where('id', $bo->idUsuarioNormall)->first();
                    $usuarioNormals->push($user);
                }
            }
        }

        return $usuarioNormals;
    }

    public function obtenerItems()
    {
        $items = stock_master::pluck('description','stock_id');
        $items->put('0','Seleccione');

        return $items;
    }

}
