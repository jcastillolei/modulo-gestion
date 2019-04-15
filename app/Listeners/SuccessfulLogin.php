<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Models\log;
use App\Models\user_rol;
use DB;
use Session;

class SuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        $log = new Log();

        $log->usuarioLog=auth()->user()->id;
        $log->descripcion='El usuario '.auth()->user()->name.' ha iniciado sesion.';
        $log->estado='1';
        $log->fecha= date('d-m-Y');

        $log->save();

        $user_rol = new user_rol();

        $user = DB::table('user_rol')->where('idUser', '=', auth()->user()->id)->first();

        Session::put('rol',$user->idRol);
    }
}
