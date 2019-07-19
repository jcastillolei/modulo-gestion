<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateuserRequest;
use App\Http\Requests\UpdateuserRequest;
use App\Repositories\userRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\log;
use App\Models\roles;
use App\Models\Locations;
use App\Models\user_rol;
use App\User;
use Session;

use DB;
use Illuminate\Support\Facades\Auth;

use App\Models\sadmin_bodeguero;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Collection;


class userController extends AppBaseController
{
    /** @var  userRepository */
    private $userRepository;

    public function __construct(userRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the user.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $users = $this->userRepository->all();

        $usuarios = new Collection();

        if (Auth::user()->rol==2) {

            $bodegueros = DB::table('sadmin_bodeguero')->where('idSadmin', Auth::user()->id)->get();
       
            foreach ($bodegueros as $bod) {

                foreach ($users as $us) {
                    
                    if ($bod->idBodeguero == $us->id) {
                        $usuarios->push($us);
                    }

                }

            }

            $sadm = DB::table('users')->where('id', Auth::user()->id)->first();

            $usuarios->push($sadm);

            
        }
        else if (Auth::user()->rol==3) 
        {
            $bodegueros = DB::table('sadmin_bodeguero')->where('idSadmin', Auth::user()->id)->get();
       
            foreach ($bodegueros as $bod) {

                foreach ($users as $us) {
                    
                    if ($bod->idBodeguero == $us->id) {
                        $usuarios->push($us);
                    }

                }

            }

            $sadm = DB::table('users')->where('id', Auth::user()->id)->first();

            $usuarios->push($sadm);
        }
        else if (Auth::user()->rol==1) {

            $usuarios = $users;

        }       

        return view('users.index', compact('roles'))
            ->with('users', $usuarios);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Response
     */
    public function create()
    {

        Session::forget('editando');

        if (Auth::user()->rol == 1) {
            $bodegas = DB::table('0_locations')->pluck('location_name','loc_code');
        }else{
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
        }
        $roles = roles::pluck('nombre','id');
        //$roles = DB::table('roles')->where('cod', '3')->pluck('nombre','cod');
        

        return view('users.create', compact('roles'))->with('bodegas', $bodegas);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param CreateuserRequest $request
     *
     * @return Response
     */
    public function store(CreateuserRequest $request)
    {
        $input = $request->all();

       

        $user = User::create([
            'name' => $request->input("name"),
            'email' => $request->input("email"),
            'password' => Hash::make($request->input("password")),
            'rol' => $request->input("rol"),
        ]);

        //----------Asignar rol a usuario ----------------- //
        $us = DB::table('users')->where('email', $request->input("email"))->first();

        $user_rol = new user_rol;

        $user_rol->idUser = $us->id;
        $user_rol->idRol = $request->input("rol");

        $user_rol->save();

        //----------Asignar subadmin a bodeguero a usuario ----------------- //

        $sadmin_bodeguero = new sadmin_bodeguero;

        $sadmin_bodeguero->idSadmin = Auth::user()->id;

        $sadmin_bodeguero->idBodeguero = $us->id;

        $sadmin_bodeguero->save();

        Flash::success('User creado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha creado un usuario.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('users.index'));
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $roles = roles::pluck('nombre','id');

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


        Session::put('editando','true');

        return view('users.edit', compact('roles','bodegas'))->with('user', $user);
    }

    /**
     * Update the specified user in storage.
     *
     * @param int $id
     * @param UpdateuserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateuserRequest $request)
    {
        //$user = $this->userRepository->find($id);

        $user = User::find($id);

        $user->name=$request->input("name");
        $user->email=$request->input("email");
        $user->rol=$request->input("rol");
        $user->password=Hash::make($request->input("password"));

        $user->save();

        //------------------Modificar user_rol---------------------------//

        DB::table('user_rol')
            ->where('idUser', $id)
            ->update(['idRol' => $request->input("rol")]);

    //------------------------------------------------------------------------------------------------//
        

        Flash::success('User actualizado correctamente.');

        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha actualizado un usuario bodega.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User eliminado.');

        return redirect(route('users.index'));
    }
}
