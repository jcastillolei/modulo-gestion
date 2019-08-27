<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createtransacciones_usuariofinalRequest;
use App\Http\Requests\Updatetransacciones_usuariofinalRequest;
use App\Repositories\transacciones_usuariofinalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use DB;
use Session;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;

use App\Models\usuario_normal;
use App\Models\bodega_usuarionormal;

use App\Models\Log;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\exportTransUsu;


class transacciones_usuariofinalController extends AppBaseController
{
    /** @var  transacciones_usuariofinalRepository */
    private $transaccionesUsuariofinalRepository;

    public function __construct(transacciones_usuariofinalRepository $transaccionesUsuariofinalRepo)
    {
        $this->transaccionesUsuariofinalRepository = $transaccionesUsuariofinalRepo;
    }

    /**
     * Display a listing of the transacciones_usuariofinal.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $transaccionesUsuariofinals = $this->transaccionesUsuariofinalRepository->all();

        if (Auth::user()->rol == 1) {
            
            $usuarios = DB::table('usuario_normals')->get();

        }else{

            $bodegasAcargo = DB::table('usuario_bodegas')->where('idUsuario', Auth::user()->id)->get();
            $bodegass = DB::table('bodega_usuarionormal')->get();

            $usuarios = new Collection();
        
            foreach ($bodegasAcargo as $bod) {
                foreach ($bodegass as $bs) {
                    if ($bod->idBodega == $bs->codBodega) {
                        $usr = DB::table('usuario_normals')->where('id', $bs->idUsuarioNormall)->first();
                        $usuarios->push($usr);
                    }
                }
            }

            $transaccionesFinal = new Collection();

            $transaccions = DB::table('transacciones_usuariofinal')->get();

            foreach ($transaccions as $tr) 
            {
                foreach ($usuarios as $us) 
                {
                    if ($tr->idUsu == $us->id) 
                    {
                        $transaccionesFinal->push($tr);
                    }
                }
            }
        }

        return view('transacciones_usuariofinals.index',compact('usuarios'))
            ->with('transaccionesUsuariofinals', $transaccionesFinal);
    }

    /**
     * Show the form for creating a new transacciones_usuariofinal.
     *
     * @return Response
     */
    public function create()
    {
        return view('transacciones_usuariofinals.create');
    }

    /**
     * Store a newly created transacciones_usuariofinal in storage.
     *
     * @param Createtransacciones_usuariofinalRequest $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        //Recibe valores del filtro

        $idUsu = $request->input("idUsuario");
        $desde = $request->input("desde");
        $hasta = $request->input("hasta");

        $use = DB::table('users')
            ->where('id', '=', $idUsu)
            ->first();

        if (!empty($idUsu) && !empty($desde) && !empty($hasta)) 
        {
            $transaccions = DB::table('transacciones_usuariofinal')
                ->where('idUsu', '=', $idUsu)
                ->where('Fecha', '=', $desde)
                ->where('Fecha', '=', $hasta)
                ->get();
        }
        elseif (!empty($idUsu) && !empty($desde) && empty($hasta))
         {
            $transaccions = DB::table('transacciones_usuariofinal')
                ->where('idUsu', '=', $idUsu)
                ->where('Fecha', '>=', $desde)
                ->get();
        }
        elseif (!empty($idUsu) && empty($desde) && !empty($hasta))
         {
            $transaccions = DB::table('transacciones_usuariofinal')
                ->where('idUsu', '=', $idUsu)
                ->where('Fecha', '<=', $hasta)
                ->get();
        }
        elseif (empty($idUsu) && !empty($desde) && !empty($hasta))
         {
            $transaccions = DB::table('transacciones_usuariofinal')
                ->where('Fecha', '>=', $desde)
                ->where('Fecha', '<=', $hasta)
                ->get();
        }
        elseif (!empty($idUsu) && empty($desde) && empty($hasta))
         {
            $transaccions = DB::table('transacciones_usuariofinal')
                ->where('idUsu', '=', $idUsu)
                ->get();
        }
        elseif (empty($idUsu) && !empty($desde) && empty($hasta))
         {
            $transaccions = DB::table('transacciones_usuariofinal')
                ->where('Fecha', '>=', $desde)
                ->get();
        }
        elseif (empty($idUsu) && empty($desde) && !empty($hasta))
         {
            $transaccions = DB::table('transacciones_usuariofinal')
                ->where('Fecha', '<=', $hasta)
                ->get();
        }
        elseif (empty($idUsu) && empty($desde) && empty($hasta))
         {
            $transaccions = DB::table('transacciones_usuariofinal')->get();
        }

        
        if (Auth::user()->rol == 1) {
            
            $usuarios = DB::table('usuario_normals')->get();

            Session::put('transacciones',$transaccions);

        }else{

            $bodegasAcargo = DB::table('usuario_bodegas')->where('idUsuario', Auth::user()->id)->get();
            $bodegass = DB::table('bodega_usuarionormal')->get();

            $usuarios = new Collection();
        
            foreach ($bodegasAcargo as $bod) {
                foreach ($bodegass as $bs) {
                    if ($bod->idBodega == $bs->codBodega) {
                        $usr = DB::table('usuario_normals')->where('id', $bs->idUsuarioNormall)->first();
                        $usuarios->push($usr);
                    }
                }
            }

            $transaccionesFinal = new Collection();

            foreach ($transaccions as $tr) 
            {
                foreach ($usuarios as $us) 
                {
                    if ($tr->idUsu == $us->id) 
                    {
                        $transaccionesFinal->push($tr);
                    }
                }
            }
        }

        return view('transacciones_usuariofinals.index', compact('usuarios','est'))
            ->with('transaccionesUsuariofinals', $transaccionesFinal);

        
    }

    /**
     * Display the specified transacciones_usuariofinal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->find($id);

        if (empty($transaccionesUsuariofinal)) {
            Flash::error('Transacciones Usuariofinal not found');

            return redirect(route('transaccionesUsuariofinals.index'));
        }

        return view('transacciones_usuariofinals.show')->with('transaccionesUsuariofinal', $transaccionesUsuariofinal);
    }

    /**
     * Show the form for editing the specified transacciones_usuariofinal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->find($id);

        if (empty($transaccionesUsuariofinal)) {
            Flash::error('Transacciones Usuariofinal not found');

            return redirect(route('transaccionesUsuariofinals.index'));
        }

        return view('transacciones_usuariofinals.edit')->with('transaccionesUsuariofinal', $transaccionesUsuariofinal);
    }

    /**
     * Update the specified transacciones_usuariofinal in storage.
     *
     * @param int $id
     * @param Updatetransacciones_usuariofinalRequest $request
     *
     * @return Response
     */
    public function update($id, Updatetransacciones_usuariofinalRequest $request)
    {
        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->find($id);

        if (empty($transaccionesUsuariofinal)) {
            Flash::error('Transacciones Usuariofinal not found');

            return redirect(route('transaccionesUsuariofinals.index'));
        }

        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->update($request->all(), $id);

        Flash::success('Transacciones Usuariofinal updated successfully.');

        return redirect(route('transaccionesUsuariofinals.index'));
    }

    /**
     * Remove the specified transacciones_usuariofinal from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $transaccionesUsuariofinal = $this->transaccionesUsuariofinalRepository->find($id);

        if (empty($transaccionesUsuariofinal)) {
            Flash::error('Transacciones Usuariofinal not found');

            return redirect(route('transaccionesUsuariofinals.index'));
        }

        $this->transaccionesUsuariofinalRepository->delete($id);

        Flash::success('Transacciones Usuariofinal deleted successfully.');

        return redirect(route('transaccionesUsuariofinals.index'));
    }

    public function exportExcel() 
    {

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha generado un reporte de transacciones de usuarios finales.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return Excel::download(new exportTransUsu, 'Reporte Transacciones.xlsx');
    
    }


}
