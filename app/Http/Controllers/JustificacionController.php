<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Justificacion;
use App\Files;

class JustificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (auth()->user()->rol == "alumno") {

          $justificacion  = DB::table('justificaciones')->where([['correoAlumno','like', auth()->user()->email],['estado', 'like', 'validando']])->get();
          $cantEmitidas   = DB::table('justificaciones')->where('correoAlumno','like', auth()->user()->email)->count();
          $cantAprobadas  = DB::table('justificaciones')->where([['correoAlumno','like', auth()->user()->email],['estado', 'like', 'aprobada' ]])->count();
          $cantRechazadas = DB::table('justificaciones')->where([['correoAlumno','like', auth()->user()->email],['estado', 'like', 'rechazada']])->count();
          $cantValidando  = DB::table('justificaciones')->where([['correoAlumno','like', auth()->user()->email],['estado', 'like', 'validando' ]])->count();

          return view('alumno.index', [
              'justificacion'  => $justificacion,
              'cantEmitidas'   => $cantEmitidas,
              'cantAprobadas'  => $cantAprobadas,
              'cantRechazadas' => $cantRechazadas,
              'cantValidando'  => $cantValidando
            ]);

        }elseif (auth()->user()->rol == "admin") {
        }elseif (auth()->user()->rol == "coordinador") {

          $listaJustificacionesValidando  = DB::table('justificaciones')->where([['correoCoordinador','like', auth()->user()->email],['estado', 'like', 'validando']])->get();
          $listaJustificacionesRechazadas = DB::table('justificaciones')->where([['correoCoordinador','like', auth()->user()->email],['estado', 'like', 'aprobado']])->get();
          $listaJustificacionesAprobadas  = DB::table('justificaciones')->where([['correoCoordinador','like', auth()->user()->email],['estado', 'like', 'rechazado']])->get();

          return view('coordinador.index', [
            'listaJustificacionesValidando'  => $listaJustificacionesValidando,
            'listaJustificacionesRechazadas' => $listaJustificacionesRechazadas,
            'listaJustificacionesAprobadas'  => $listaJustificacionesAprobadas
          ]);
        }
    }

    public function listaJustificaciones()
    {
      $justificacion  = DB::table('justificaciones')->where('correoAlumno','like', auth()->user()->email)->get();
      return view('alumno.misJustificaciones', ['justificacion' => $justificacion]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('alumno.crearJustificacion');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $justificacion = Justificacion::create($request->all());
        return redirect()->route('alumno');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
