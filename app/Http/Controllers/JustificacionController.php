<?php

namespace App\Http\Controllers;

use App\Notifications\InboxMessage;
use App\Admin;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\Controller;
use App\Justification;
use App\Files;
use Carbon\Carbon;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarCorreitoAlumnito;
use App\Mail\EnviarCorreitoCoordinadorcito;
use App\Mail\EnviarCorreitoAdministradorcito;
use App\Mail\EnviarCorreitoProfesorcito;

use App\Events\Justification\Submitted as JustificationSubmitted;
use App\Events\Justification\Approved as JustificationApproved;
use App\Events\Justification\Rejected as JustificationRejected;

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
        if(auth()->user()->activacion == '0') {
            logger("############################################33CONSOLA");
            return view('contrasena.cambiar', []);
        }
        // logger("############################################33");
        // logger(auth()->user());
        // $asignaturas = array('NOM_ASIG'=>'Asignatura 1');
        // $asignatura = array('NOM_ASIG'=>'Asignatura 2');
        // array_push($asignaturas, $asignatura);
        // $userEmail = ;
        $result = DB::table('datos_semestre')->where('correo_alum', auth()->user()->email)->get();  // DATOS USUARIO COMPLETOS
        // logger(json_decode(json_encode($result), true));
        $result = json_decode(json_encode($result), true);
        $datosAlumno = DB::table('datos_semestre')->where('correo_alum', auth()->user()->email)->first();
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
        logger('CREANDO REGISTRO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!');
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
            // $admin->notify(new InboxMessage($request));
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
        event(new JustificationSubmitted($request->correo_alum, $request->correoCoordinador, $request, $adjuntos, $resumenAsignaturas));
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
        // $justification->notify(new InboxMessage($request));

        // $result = $this->authorize('alumno/store', $post);
        return redirect()->intended('alumno/index')->with('success', 'JUSTIFICACION CREADA CORRECTAMENTE !!!                      Presiona x para cerrar');

        // return redirect()->route('alumno');
    }

    public function revisar()
    {
        if(auth()->user()->activacion == '0'){
            logger("############################################33CONSOLA");
            return view('contrasena.cambiar', []);
        }
        $justificacion  = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'Pendiente']])->get();
        // $justificacion  = Justification::where([['correo_alum','like', auth()->user()->email]])->get();
        $cantEmitidas   = Justification::where('correo_alum','like', auth()->user()->email)->count();
        $cantAprobadas  = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'aprobada' ]])->count();
        $cantRechazadas = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'rechazada']])->count();
        $cantValidando  = Justification::where([['correo_alum','like', auth()->user()->email],['estado', 'like', 'validando' ]])->count();
        return view('alumno.revisarJustificacion', [
            'justificacion'  => $justificacion,
            'cantEmitidas'   => $cantEmitidas,
            'cantAprobadas'  => $cantAprobadas,
            'cantRechazadas' => $cantRechazadas,
            'cantValidando'  => $cantValidando
        ]);
    }

    public function getAsignaturas($asignaturaId) {
        $user = auth()->user();
        logger($user->email);
        // logger($asignaturaId);
        $asignatura = DB::table('datos_semestre')->where([
            ['NOM_ASIG', 'like', $asignaturaId],
            ['CORREO_ALUM', 'like', $user->email],
        ])->get();
        // $asignatura = DB::table("datos_semestre")->where("NOM_ASIG",$asignaturaId)->pluck("name","id");
        // $asignatura = array(["nombreProfesor", "el Profe"], ["nombreCoordinador", "el Coordinador"]);
        // logger($asignatura);
        return json_encode($asignatura);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $justifications = DB::table('Justifications')->where('id_dato','like', $id)->first();
        $datosAlumno = DB::table('datos_semestre')->where([
            ['correo_alum', 'like', $justifications->CORREO_ALUM],
            ['nom_asig', 'like', $justifications->ASIGNATURA]
        ])->first();

        $imagenes = DB::table('documento')
            ->select('url')
            ->where('nfolio','like', $justifications->NFOLIO)
            ->get();

        return ($justifications->NFOLIO);
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
        $justificacion = Justification::where('id_dato', '=', $id)->first();
        $justificacion->estado = $request->estado;
        $justificacion->COMENTARIO_REC = request('comentarioRechazo');
        $justificacion->save();
        if ($request->estado == 'Aprobado') {
            event(new JustificationApproved(
                $justificacion->CORREO_ALUM,
                $justificacion->CORREO_DOC,
                $justificacion
            ));
        } else {
            //event(new JustificationRejected());
        }
        return redirect()->action('CoordinadorController@index');
    }
}
