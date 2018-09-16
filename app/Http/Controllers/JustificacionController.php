<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ContactFormRequest;
use App\Mail\EnviarCorreitoAlumnito;
use App\Mail\EnviarCorreitoCoordinadorcito;
use App\Mail\EnviarCorreitoAdministradorcito;
use App\Mail\EnviarCorreitoProfesorcito;
use App\Justification;
use App\Semester;
use App\Files;
use Carbon\Carbon;

use DB;

class JustificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('alumno.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $justificaciones = Justification::all();
        $asignaturas = array('NOM_ASIG'=>'Asignatura 1');
        $asignatura = array('NOM_ASIG'=>'Asignatura 2');
        array_push($asignaturas, $asignatura);
        $userEmail = auth()->user()->email;
        $result = Semester::where('correo_alum', $userEmail)->get();  // DATOS USUARIO COMPLETOS
        $datosAlumno = Semester::where('correo_alum', $userEmail)->first();
        $time = Carbon::now();
        $folio = date_format($time,'Y').date_format($time,'m').str_random(8);
        return view('alumno.crearJustificacion', [
            'datosAlumno' => $datosAlumno,
            'infoCursos' => $result,
            'folio' => $folio
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(ContactFormRequest $request)
    {
        $resumenAsignaturas = [];
        foreach (json_decode($request->cursosArray, true) as $curso){
            $justification = new Justification();
            $justification->correo_cor = $curso['correoCoordinador'];
            $justification->correo_doc = $curso['correoDocente'];
            $justification->asignatura = $curso['asignatura'];
            $justification->comentario = $request['comentario'];
            $justification->motivo = $request['motivo'];
            $justification->nombre_alum = $request['nombre_alum'].' '.$request['apep_alum'].' '.$request['apem_alum'];
            $justification->correo_alum = $request['correo_alum'];
            $justification->celular_alum = $request['celular_alum'];
            $justification->fec_jus = $request['fechaJustificacion'];
            $justification->nfolio = $request['folio'];
            $justification->estado = 'Pendiente';
            $justification->motivo_rec = 'Pendiente';
            $justification->comentario_rec = 'Pendiente';
            $justification->tipo_inasistencia = $request['tipoInasistencia'] == "evaluacion"?1:0;
            $justification->save();
            $adjuntos = DB::table('documento')
                ->select('url')
                ->where('nfolio','=', $request['folio'])
                ->get();
                logger($adjuntos->toJson());

            array_push($resumenAsignaturas, $justification->asignatura);
        }
        // Mail::to('jcastillo@duoc.cl')->send(new EnviarCorreitoProfesorcito($request, $adjuntos));
        // Mail::to('dseron@duoc.cl')->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos, $resumenAsignaturas));
        // Mail::to('jcastillo@duoc.cl')->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos, $resumenAsignaturas));
        // Mail::to('jcaguirrecl@gmail.com')->send(new EnviarCorreitoAlumnito($request, $adjuntos, $resumenAsignaturas));
        // Mail::to('jcastillo@duoc.cl')->send(new EnviarCorreitoAlumnito($request, $adjuntos, $resumenAsignaturas));
        logger($resumenAsignaturas);
        logger('#########################################################resumenAsignaturas');
        // DESCOMENTAR EN PRODUCCION
        //
        // Mail::to($curso['correoDocente'])->send(new EnviarCorreitoProfesorcito($request, $adjuntos));
        // Mail::to($curso['correocorreoCoordinador'])->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos));
        // Mail::to($request['correo_alum'])->send(new EnviarCorreitoAlumnito($request, $adjuntos));
        // EL profe recibe solo la resolucion del coordinador, sin datos de adjunto. Sacar desde justiController
        // 1 solo correo con resumen de asignaturas para Coordinador
        // 1 solo correo con resumen...Alumno recibe confirmacion de creacion con respaldo de los adjuntos
        // Mail::to('jcastillo@duoc.cl')->send(new EnviarCorreitoProfesorcito($request, $adjuntos));
        // Mail::to('dseron@duoc.cl')->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos));
        // Mail::to('jcaguirrecl@gmail.com')->send(new EnviarCorreitoAlumnito($request, $adjuntos));
        // DESCOMENTAR EN PRODUCCION
        // Mail::to($curso['correoDocente'])->send(new EnviarCorreitoProfesorcito($request, $adjuntos));
        // Mail::to($curso['correocorreoCoordinador'])->send(new EnviarCorreitoCoordinadorcito($request, $adjuntos));
        // Mail::to($request['correo_alum'])->send(new EnviarCorreitoAlumnito($request, $adjuntos));
        return redirect()->intended('alumno/index')->with('success', 'JUSTIFICACION CREADA CORRECTAMENTE !!!                      Presiona x para cerrar');
    }

    public function revisar()
    {
        $justificacion  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Pendiente']])->get();
        // $justificacion  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email]])->get();
        $cantEmitidas   = DB::table('justifications')->where('correo_alum','like', auth()->user()->email)->count();
        $cantAprobadas  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'aprobada' ]])->count();
        $cantRechazadas = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'rechazada']])->count();
        $cantValidando  = DB::table('justifications')->where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'validando' ]])->count();
        logger($justificacion);
        return view('alumno.revisarJustificacion', [
            'justificacion'  => $justificacion,
            'cantEmitidas'   => $cantEmitidas,
            'cantAprobadas'  => $cantAprobadas,
            'cantRechazadas' => $cantRechazadas,
            'cantValidando'  => $cantValidando
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $justifications = DB::table('justifications')->where('id_dato', $id)->first();
        $datosAlumno = DB::table('datos_semestre')
                        ->where([
                            ['correo_alum', 'like', $justifications->CORREO_ALUM],
                            ['nom_asig', 'like', $justifications->ASIGNATURA]
                        ])->first();

       return view('coordinador/edicionJustificaciones', [
           'justifications' => $justifications,
           'datosAlumno' => $datosAlumno
        ]);
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
        $correo_alum = Input::get('correo_alum');
        $comentarioRechazo = Input::get('comentarioRechazo');
        $estado = Input::get('estado');

        Justification::where([['id_dato','like',$id]])
                ->update([
                    'estado' => $estado,
                    'COMENTARIO_REC' => $comentarioRechazo,
                ]);

        return redirect()->action('CoordinadorController@index');
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
