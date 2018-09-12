<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use DB;
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
    // public function index(Request $request)
    // {
    //     Log::Debug($request->session()->all());
    //     Log::Debug(auth()->user());

    //     return view('alumno/index');
    // }
    public function index()
    {

        $verificar = DB::table('users')->select('activacion')->where('email', auth()->user()->email)->get();
        Log::Debug(json_decode($verificar, true)[0]['activacion']);
        if (! json_decode($verificar, true)[0]['activacion']) {
            return view('contrasena.cambiar', []);
        }
   
      $justificacion  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Pendiente']])->get();
      $cantEmitidas   = DB::table('justifications')->where('correo_alum','like', auth()->user()->email)->count();
      $cantAprobadas  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Aprobado' ]])->count();
      $cantRechazadas = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Rechazado']])->count();
      $cantValidando  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Pendiente' ]])->count();
      Log::Debug($justificacion);

      return view('alumno.index', [
          'justificacion'  => $justificacion,
          'cantEmitidas'   => $cantEmitidas,
          'cantAprobadas'  => $cantAprobadas,
          'cantRechazadas' => $cantRechazadas,
          'cantValidando'  => $cantValidando
        ]);
    }
}
