<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createusuario_bodegaRequest;
use App\Http\Requests\Updateusuario_bodegaRequest;
use App\Repositories\usuario_bodegaRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

use App\User;
use App\Models\locations;
use App\Models\log;
use Illuminate\Support\Collection;
use App\Models\usuario_bodega;

use Illuminate\Support\Facades\Auth;
use DB;

class usuario_bodegaController extends AppBaseController
{
    /** @var  usuario_bodegaRepository */
    private $usuarioBodegaRepository;

    public function __construct(usuario_bodegaRepository $usuarioBodegaRepo)
    {
        $this->usuarioBodegaRepository = $usuarioBodegaRepo;
    }

    /**
     * Display a listing of the usuario_bodega.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $usuarioBodegas = usuario_bodega::paginate(15);

        $usuarios = new Collection();

        if (Auth::user()->rol==2) {

            $bodegueros = DB::table('sadmin_bodeguero')->where('idSadmin', Auth::user()->id)->get();
            
            foreach ($bodegueros as $bod) {
                foreach ($usuarioBodegas as $us) {

                    if ($bod->idBodeguero == $us->idUsuario) {
                        $usuarios->push($us);
                    }
                }
            }
        }
        else if (Auth::user()->rol==3) 
        {
            $bodegueros = DB::table('sadmin_bodeguero')->where('idSadmin', Auth::user()->id)->get();
       
            foreach ($bodegueros as $bod) {
                    
                foreach ($usuarioBodegas as $us) {
                    if ($bod->idBodeguero == $us->idUsuario) {
                           
                        $usuarios->push($us);
                    }

                }

            }
        }
        else if (Auth::user()->rol==1) {

            $usuarios = $usuarioBodegas;

        }

        return view('usuario_bodegas.index')
            ->with('usuarioBodegas', $usuarios);
    }

    /**
     * Show the form for creating a new usuario_bodega.
     *
     * @return Response
     */
    public function create()
    {

        if (Auth::user()->rol==2) {

        //----------Bodegas asignadas al sub admin -----------//
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

            $bodegas = $bd->pluck('location_name','loc_code');

        //----------Bodegueros a cargo del sub admin -----------//

            $bodegueros = DB::table('sadmin_bodeguero')->where('idSadmin', Auth::user()->id)->get();

            $us = DB::table('users')->get();

            $users = new Collection();
           
            foreach ($bodegueros as $bod) {
                    
                foreach ($us as $u) {
                    if ($bod->idBodeguero == $u->id) {
                           
                        $users->push($u);
                    }

                }

            }

            $usuarios = $users->pluck('name','id');
            
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
                        $bd->push($bo);
                    }
                }
            }

            $bodegas = $bd->pluck('location_name','loc_code');

        //----------Bodegueros a cargo del sub admin -----------//

            $bodegueros = DB::table('sadmin_bodeguero')->where('idSadmin', Auth::user()->id)->get();

            $us = DB::table('users')->get();

            $users = new Collection();
           
            foreach ($bodegueros as $bod) {
                    
                foreach ($us as $u) {
                    if ($bod->idBodeguero == $u->id) {
                           
                        $users->push($u);
                    }

                }

            }

            $usuarios = $users->pluck('name','id');
        }
        else if (Auth::user()->rol==1) {

            $usuarios = DB::table('users')->pluck('name','id');
            $bodegas = DB::table('0_locations')->pluck('location_name','loc_code');

        }

        return view('usuario_bodegas.create', compact('usuarios','bodegas'));
    }

    /**
     * Store a newly created usuario_bodega in storage.
     *
     * @param Createusuario_bodegaRequest $request
     *
     * @return Response
     */
    public function store(Createusuario_bodegaRequest $request)
    {
        $input = $request->all();

        $usuarioBodega = $this->usuarioBodegaRepository->create($input);

        Flash::success('Usuario Bodega creado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado un usuario bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('usuarioBodegas.index'));
    }

    /**
     * Display the specified usuario_bodega.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usuarioBodega = $this->usuarioBodegaRepository->find($id);

        if (empty($usuarioBodega)) {
            Flash::error('Usuario Bodega not found');

            return redirect(route('usuarioBodegas.index'));
        }

        return view('usuario_bodegas.show')->with('usuarioBodega', $usuarioBodega);
    }

    /**
     * Show the form for editing the specified usuario_bodega.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usuarioBodega = $this->usuarioBodegaRepository->find($id);

        if (empty($usuarioBodega)) {
            Flash::error('Usuario Bodega not found');

            return redirect(route('usuarioBodegas.index'));
        }


        if (Auth::user()->rol != 1) {
            //----------Bodegas asignadas al sub admin -----------//
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

            $bodegas = $bd->pluck('location_name','loc_code');

        //----------Bodegueros a cargo del sub admin -----------//

            $bodegueros = DB::table('sadmin_bodeguero')->where('idSadmin', Auth::user()->id)->get();

            $us = DB::table('users')->get();

            $users = new Collection();
           
            foreach ($bodegueros as $bod) {
                    
                foreach ($us as $u) {
                    if ($bod->idBodeguero == $u->id) {
                           
                        $users->push($u);
                    }

                }

            }

            $usuarios = $users->pluck('name','id');
        }
        else
        {
            $usuarios = User::pluck('name','id');
            $bodegas = locations::pluck('location_name','loc_code');
        }

        return view('usuario_bodegas.edit',compact('usuarios','bodegas'))->with('usuarioBodega', $usuarioBodega);
    }

    /**
     * Update the specified usuario_bodega in storage.
     *
     * @param int $id
     * @param Updateusuario_bodegaRequest $request
     *
     * @return Response
     */
    public function update($id, Updateusuario_bodegaRequest $request)
    {
        $usuarioBodega = $this->usuarioBodegaRepository->find($id);

        if (empty($usuarioBodega)) {
            Flash::error('Usuario Bodega not found');

            return redirect(route('usuarioBodegas.index'));
        }

        $usuarioBodega = $this->usuarioBodegaRepository->update($request->all(), $id);

        Flash::success('Usuario Bodega actualizado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actualizado un usuario bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('usuarioBodegas.index'));
    }

    /**
     * Remove the specified usuario_bodega from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usuarioBodega = $this->usuarioBodegaRepository->find($id);

        if (empty($usuarioBodega)) {
            Flash::error('Usuario Bodega not found');

            return redirect(route('usuarioBodegas.index'));
        }

        $usr = usuario_bodega::find($id);
        $usr->delete();

        Flash::success('Usuario Bodega eliminado.');

        return redirect(route('usuarioBodegas.index'));
    }
}
