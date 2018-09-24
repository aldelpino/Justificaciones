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

      $listaJustificacionesValidando  = DB::table('justifications')
                                        ->select('justifications.ID_DATO','NFOLIO', 'RUT_ALU', 'justifications.NOMBRE_ALUM', 'FEC_SOL', 'FEC_JUS', 'ASIGNATURA','ESTADO')
                                        ->join('datos_semestre', 'justifications.correo_alum', 'datos_semestre.correo_alum')
                                        ->where([['justifications.correo_cor','like', auth()->user()->email],['estado', 'like', 'Pendiente']])
                                        ->groupBy('justifications.ID_DATO','NFOLIO', 'RUT_ALU', 'justifications.NOMBRE_ALUM', 'FEC_SOL', 'FEC_JUS', 'ASIGNATURA','ESTADO')
                                        ->get();
      $listaJustificacionesAprobadas = DB::table('justifications')
                                        ->select('justifications.ID_DATO','NFOLIO', 'RUT_ALU', 'justifications.NOMBRE_ALUM', 'FEC_SOL', 'FEC_JUS', 'ASIGNATURA','ESTADO')
                                        ->join('datos_semestre', 'justifications.correo_alum', 'datos_semestre.correo_alum')
                                        ->where([['justifications.correo_cor','like', auth()->user()->email],['estado', 'like', 'Aprobado']])
                                        ->groupBy('justifications.ID_DATO','NFOLIO', 'RUT_ALU', 'justifications.NOMBRE_ALUM', 'FEC_SOL', 'FEC_JUS', 'ASIGNATURA','ESTADO')
                                        ->limit(1000)->get();
      $listaJustificacionesRechazadas  =DB::table('justifications')
                                        ->select('justifications.ID_DATO','NFOLIO', 'RUT_ALU', 'justifications.NOMBRE_ALUM', 'FEC_SOL', 'FEC_JUS', 'ASIGNATURA','ESTADO')
                                        ->join('datos_semestre', 'justifications.correo_alum', 'datos_semestre.correo_alum')
                                        ->where([['justifications.correo_cor','like', auth()->user()->email],['estado', 'like', 'Rechazado']])
                                        ->groupBy('justifications.ID_DATO','NFOLIO', 'RUT_ALU', 'justifications.NOMBRE_ALUM', 'FEC_SOL', 'FEC_JUS', 'ASIGNATURA','ESTADO')
                                        ->limit(1000)->get();
      Log::Debug($listaJustificacionesValidando);
      return view('coordinador/index', [
        'listaJustificacionesValidando'  => $listaJustificacionesValidando,
        'listaJustificacionesRechazadas' => $listaJustificacionesRechazadas,
        'listaJustificacionesAprobadas'  => $listaJustificacionesAprobadas
      ]);
    }


}
