<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Justification;
use Log;
use DB;


class CoordinadorController extends Controller
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
        $listaJustificacionesValidando  = DB::table('justifications')->where([['correo_cor','like', auth()->user()->email],['estado', 'like', 'Pendiente']])->get();
        $listaJustificacionesAprobadas = DB::table('justifications')->where([['correo_cor','like', auth()->user()->email],['estado', 'like', 'Aprobado']])->limit(1000)->get();
        $listaJustificacionesRechazadas  = DB::table('justifications')->where([['correo_cor','like', auth()->user()->email],['estado', 'like', 'Rechazado']])->limit(1000)->get();
        Log::Debug($listaJustificacionesValidando);
        return view('coordinador/index', [
            'listaJustificacionesValidando'  => $listaJustificacionesValidando,
            'listaJustificacionesRechazadas' => $listaJustificacionesRechazadas,
            'listaJustificacionesAprobadas'  => $listaJustificacionesAprobadas
        ]);
    }
}
