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
      $justificacion  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Pendiente']])->get();
      $cantEmitidas   = DB::table('justifications')->where('correo_alum','like', auth()->user()->email)->count();
      $cantAprobadas  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'aprobada' ]])->count();
      $cantRechazadas = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'rechazada']])->count();
      $cantValidando  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'validando' ]])->count();
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
