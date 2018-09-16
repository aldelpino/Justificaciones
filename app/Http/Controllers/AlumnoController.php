<?php

namespace App\Http\Controllers;

use App\Justification;
use App\User;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $verificar = User::select('activacion')->where('email', auth()->user()->email)->get();
        if (! json_decode($verificar, true)[0]['activacion']) {
            return view('contrasena.cambiar', []);
        }

        $justificacion  = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Pendiente']])->get();
        $cantEmitidas   = Justification::where('correo_alum','like', auth()->user()->email)->count();
        $cantAprobadas  = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'aprobada' ]])->count();
        // $cantAprobadas  = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Aprobado' ]])->count();
        $cantRechazadas = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'rechazada']])->count();
        // $cantRechazadas = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Rechazado']])->count();
        $cantValidando  = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'validando' ]])->count();
        // $cantValidando  = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Pendiente' ]])->count();
        return view('alumno.index', [
            'justificacion'  => $justificacion,
            'cantEmitidas'   => $cantEmitidas,
            'cantAprobadas'  => $cantAprobadas,
            'cantRechazadas' => $cantRechazadas,
            'cantValidando'  => $cantValidando
        ]);
    }
}
