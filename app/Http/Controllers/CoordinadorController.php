<?php

namespace App\Http\Controllers;

use App\Justification;

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
        $listaJustificacionesValidando = Justification::where([['correo_cor','like', auth()->user()->email],['estado', 'like', 'Pendiente']])->get();
        $listaJustificacionesAprobadas = Justification::where([['correo_cor','like', auth()->user()->email],['estado', 'like', 'Aprobado']])->limit(1000)->get();
        $listaJustificacionesRechazadas = Justification::where([['correo_cor','like', auth()->user()->email],['estado', 'like', 'Rechazado']])->limit(1000)->get();
        return view('coordinador/index', [
            'listaJustificacionesValidando'  => $listaJustificacionesValidando,
            'listaJustificacionesRechazadas' => $listaJustificacionesRechazadas,
            'listaJustificacionesAprobadas'  => $listaJustificacionesAprobadas
        ]);
    }
}
