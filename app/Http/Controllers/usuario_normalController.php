<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createusuario_normalRequest;
use App\Http\Requests\Updateusuario_normalRequest;
use App\Repositories\usuario_normalRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\log;
use App\Models\usuario_normal;
use App\Models\Locations;
use App\Models\bodega_usuarionormal;
use Flash;
use Response;
use DB;
use Illuminate\Support\Collection;

use Illuminate\Support\Facades\Auth;

class usuario_normalController extends AppBaseController
{
    /** @var  usuario_normalRepository */
    private $usuarioNormalRepository;

    public function __construct(usuario_normalRepository $usuarioNormalRepo)
    {
        $this->usuarioNormalRepository = $usuarioNormalRepo;
    }

    /**
     * Display a listing of the usuario_normal.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $usuarios = DB::table('usuario_normals')->get();
        $usuarioNormals = new Collection();

        if (Auth::user()->rol==2) {

            //----------Bodegas asignadas al sub admin -----------//
            $bods = DB::table('0_locations')->get();

            $bodegasUsuario = DB::table('usuario_bodegas')->where('idUsuario', Auth::user()->id)->get();

            $bodegas = new Collection();

            foreach ($bodegasUsuario as $b) {
                foreach ($bods as $bo) {
                    if ($b->idBodega == $bo->loc_code) {
                        $bodegas->push($bo);
                    }
                }
            }

            //----------Usuarios normales y sus bodegas -----------//
            $bodUsNor = DB::table('bodega_usuarionormal')->get();

            foreach ($bodegas as $b) {
                foreach ($bodUsNor as $bo) {
                    if ($b->loc_code == $bo->codBodega) {
                        $user = DB::table('usuario_normals')->where('id', $bo->idUsuarioNormall)->first();
                        $usuarioNormals->push($user);
                    }
                }
            }

        }
        else if (Auth::user()->rol==3) 
        {
            //----------Bodegas asignadas al sub admin -----------//
            $bods = DB::table('0_locations')->get();

            $bodegasUsuario = DB::table('usuario_bodegas')->where('idUsuario', Auth::user()->id)->get();

            $bodegas = new Collection();

            foreach ($bodegasUsuario as $b) {
                foreach ($bods as $bo) {
                    if ($b->idBodega == $bo->loc_code) {
                        $bodegas->push($bo);
                    }
                }
            }

            //----------Usuarios normales y sus bodegas -----------//
            $bodUsNor = DB::table('bodega_usuarionormal')->get();

            foreach ($bodegas as $b) {
                foreach ($bodUsNor as $bo) {
                    if ($b->loc_code == $bo->codBodega) {
                        $user = DB::table('usuario_normals')->where('id', $bo->idUsuarioNormall)->first();
                        $usuarioNormals->push($user);
                    }
                }
            }
        }
        else if (Auth::user()->rol==1) {

            $usuarioNormals = $usuarios;

        }

        return view('usuario_normals.index')
            ->with('usuarioNormals', $usuarioNormals);
    }

    /**
     * Show the form for creating a new usuario_normal.
     *
     * @return Response
     */
    public function create()
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

        return view('usuario_normals.create', compact('bodegas'));
    }

    /**
     * Store a newly created usuario_normal in storage.
     *
     * @param Createusuario_normalRequest $request
     *
     * @return Response
     */
    public function store(Createusuario_normalRequest $request)
    {
        $input = $request->all();

        $usuarioNormal = $this->usuarioNormalRepository->create($input);

        Flash::success('Usuario Normal creado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado un usuario normal.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        $usuN = DB::table('usuario_normals')->where('correo', $request->input("correo"))->first();

        $bodega_usuarionormal = bodega_usuarionormal::create([
            'codBodega' => $request->input("bod"),
            'idUsuarioNormall' => $usuN->id,
        ]);

        return redirect(route('usuarioNormals.index'));
    }

    /**
     * Display the specified usuario_normal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $usuarioNormal = $this->usuarioNormalRepository->find($id);

        if (empty($usuarioNormal)) {
            Flash::error('Usuario Normal not found');

            return redirect(route('usuarioNormals.index'));
        }

        return view('usuario_normals.show')->with('usuarioNormal', $usuarioNormal);
    }

    /**
     * Show the form for editing the specified usuario_normal.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $usuarioNormal = $this->usuarioNormalRepository->find($id);

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

        if (empty($usuarioNormal)) {
            Flash::error('Usuario Normal not found');

            return redirect(route('usuarioNormals.index'));
        }

        return view('usuario_normals.edit', compact('bodegas'))->with('usuarioNormal', $usuarioNormal);
    }

    /**
     * Update the specified usuario_normal in storage.
     *
     * @param int $id
     * @param Updateusuario_normalRequest $request
     *
     * @return Response
     */
    public function update($id, Updateusuario_normalRequest $request)
    {
        $usuarioNormal = $this->usuarioNormalRepository->find($id);

        if (empty($usuarioNormal)) {
            Flash::error('Usuario Normal not found');

            return redirect(route('usuarioNormals.index'));
        }

        $usuarioNormal->nombre=$request->input("nombre");
        $usuarioNormal->apellido=$request->input("apellido");
        $usuarioNormal->cargo=$request->input("cargo");
        $usuarioNormal->correo=$request->input("correo");
        $usuarioNormal->telefono=$request->input("telefono");

        $usuarioNormal->save();

    //------------------------------------------------------------------------------------------//
        $usuN = DB::table('usuario_normals')->where('correo', $request->input("correo"))->first();

        $userBodega = DB::table('bodega_usuarionormal')->where('idUsuarioNormall', $usuN->id)->first();

        DB::table('bodega_usuarionormal')
            ->where('idUsuarioNormall', $usuN->id)
            ->update(['codBodega' => $request->input("bod")]);

        Flash::success('Usuario Normal actualizado correctamente.');

        return redirect(route('usuarioNormals.index'));
    }

    /**
     * Remove the specified usuario_normal from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $usuarioNormal = $this->usuarioNormalRepository->find($id);

        if (empty($usuarioNormal)) {
            Flash::error('Usuario Normal not found');

            return redirect(route('usuarioNormals.index'));
        }

        $this->usuarioNormalRepository->delete($id);

        Flash::success('Usuario Normal eliminado.');

        return redirect(route('usuarioNormals.index'));
    }
}
