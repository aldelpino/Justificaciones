<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
>>>>>>> mi-branch
use App\Justificacion;
use App\Files;

use DB;
use Log;


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
        $asignaturas = array('NOM_ASIG'=>'Asignatura 1');
        $asignatura = array('NOM_ASIG'=>'Asignatura 2');
        array_push($asignaturas, $asignatura);
        // echo $competition_all[0]['name'];
        Log::debug($asignaturas[0]['NOM_ASIG']);
        // Log::debug($asignaturas[1]['NOM_ASIG']);

        $result = DB::select('select * from datos_semestre where CORREO_ALUM = "alumno@alumnos.duoc.cl"' );
        $result = array_map(function ($value) {
            return (array)$value;
        }, $result);

        // Log::debug($result[0]);
        // Log::debug($result[1]['NOM_ASIG']);
        // Log::debug($result[2]['NOM_ASIG']);
        // Log::debug($result[3]['NOM_ASIG']);
        // Log::debug($result[4]['NOM_ASIG']);
        // Log::debug($result[5]['NOM_ASIG']);


        $datosAlumno = DB::table('datos_semestre')->where('correo_alum', 'alumno@alumnos.duoc.cl')->first();
        // $datosAlumno->listadoCursos = $result;
        return view('alumno.crearJustificacion', ['datosAlumno' => $datosAlumno, 'infoCursos' => $result]);

             // if (Auth::attempt(DB::table('users')->where($credentials)->get())){
        // $datoAlumno = DB::table('datos_semestre')->where('name'=>'John')->first();
        // $datosAlumno = DB::select('select * from datos_semestre where correo_alum = "b.torol@alumnos.duoc.cl"', [1]);
        // echo $datosAlumno[0]['correo_alum'];
        // echo $datosAlumno->correo_alum;
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

    public function revisar()
    {
        return view('alumno.revisarJustificacion');
    }

    public function getAsignaturas($asignaturaId) {
        $user = auth()->user();
        Log::debug($user->email);
        Log::debug($asignaturaId);
        $asignatura = DB::table('datos_semestre')->where([
            ['NOM_ASIG', 'like', $asignaturaId],
            ['CORREO_ALUM', 'like', $user->email],
        ])->get();
        // $asignatura = DB::table("datos_semestre")->where("NOM_ASIG",$asignaturaId)->pluck("name","id");
        // $asignatura = array(["nombreProfesor", "el Profe"], ["nombreCoordinador", "el Coordinador"]);
        Log::debug($asignatura);
        return json_encode($asignatura);

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
